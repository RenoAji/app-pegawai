<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Salary::with('employee');
        
        // Filter berdasarkan employee jika ada
        if ($request->has('employee_id') && $request->employee_id) {
            $query->where('karyawan_id', $request->employee_id);
            $employee = Employee::find($request->employee_id);
        }
        
        $salaries = $query->orderBy('bulan', 'desc')->paginate(10);
        
        return view('salaries.index', compact('salaries'))->with('employee', $employee ?? null);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $employees = Employee::orderBy('nama_lengkap')->get();
        
        // Jika ada employee_id dari parameter, set sebagai default
        $selectedEmployee = null;
        if ($request->has('employee_id')) {
            $selectedEmployee = Employee::find($request->employee_id);
        }
        
        return view('salaries.create', compact('employees', 'selectedEmployee'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|date',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'required|numeric|min:0',
            'potongan' => 'required|numeric|min:0',
        ], [
            'karyawan_id.required' => 'Pegawai harus dipilih',
            'karyawan_id.exists' => 'Pegawai tidak valid',
            'bulan.required' => 'Bulan gaji harus diisi',
            'bulan.date' => 'Format bulan tidak valid',
            'gaji_pokok.required' => 'Gaji pokok harus diisi',
            'gaji_pokok.numeric' => 'Gaji pokok harus berupa angka',
            'tunjangan.required' => 'Tunjangan harus diisi',
            'tunjangan.numeric' => 'Tunjangan harus berupa angka',
            'potongan.required' => 'Potongan harus diisi',
            'potongan.numeric' => 'Potongan harus berupa angka',
        ]);

        // Cek apakah sudah ada data gaji untuk bulan yang sama
        $existingSalary = Salary::where('karyawan_id', $validatedData['karyawan_id'])
                                ->where('bulan', $validatedData['bulan'])
                                ->first();
        
        if ($existingSalary) {
            return redirect()->back()
                           ->withErrors(['bulan' => 'Data gaji untuk bulan ini sudah ada'])
                           ->withInput();
        }

        // Hitung total gaji
        $validatedData['total_gaji'] = $validatedData['gaji_pokok'] + $validatedData['tunjangan'] - $validatedData['potongan'];

        $salary = Salary::create($validatedData);

        return redirect()->route('employees.show', $validatedData['karyawan_id'])
                        ->with('success', 'Data gaji berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $salary = Salary::with('employee')->findOrFail($id);
        return view('salaries.show', compact('salary'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $salary = Salary::with('employee')->findOrFail($id);
        $employees = Employee::orderBy('nama_lengkap')->get();
        
        return view('salaries.edit', compact('salary', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $salary = Salary::findOrFail($id);
        
        $validatedData = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|date',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'required|numeric|min:0',
            'potongan' => 'required|numeric|min:0',
        ], [
            'karyawan_id.required' => 'Pegawai harus dipilih',
            'karyawan_id.exists' => 'Pegawai tidak valid',
            'bulan.required' => 'Bulan gaji harus diisi',
            'bulan.date' => 'Format bulan tidak valid',
            'gaji_pokok.required' => 'Gaji pokok harus diisi',
            'gaji_pokok.numeric' => 'Gaji pokok harus berupa angka',
            'tunjangan.required' => 'Tunjangan harus diisi',
            'tunjangan.numeric' => 'Tunjangan harus berupa angka',
            'potongan.required' => 'Potongan harus diisi',
            'potongan.numeric' => 'Potongan harus berupa angka',
        ]);

        // Cek apakah sudah ada data gaji untuk bulan yang sama (kecuali data yang sedang diedit)
        $existingSalary = Salary::where('karyawan_id', $validatedData['karyawan_id'])
                                ->where('bulan', $validatedData['bulan'])
                                ->where('id', '!=', $id)
                                ->first();
        
        if ($existingSalary) {
            return redirect()->back()
                           ->withErrors(['bulan' => 'Data gaji untuk bulan ini sudah ada'])
                           ->withInput();
        }

        // Hitung total gaji
        $validatedData['total_gaji'] = $validatedData['gaji_pokok'] + $validatedData['tunjangan'] - $validatedData['potongan'];

        $salary->update($validatedData);

        return redirect()->route('employees.show', $validatedData['karyawan_id'])
                        ->with('success', 'Data gaji berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $salary = Salary::findOrFail($id);
        $employeeId = $salary->karyawan_id;
        
        $salary->delete();
        
        return redirect()->route('employees.show', $employeeId)
                        ->with('success', 'Data gaji berhasil dihapus');
    }
}
