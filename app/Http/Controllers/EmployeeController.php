<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use App\Models\Salary;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with(['department', 'position', 'salary'])->latest()->paginate(5);
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.create', compact('departments', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:employees,email',
            'nomor_telepon' => 'required|string|max:15',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|in:aktif,nonaktif',
            'department_id' => 'required|exists:departments,id',
            'jabatan_id' => 'required|exists:positions,id',
            'tunjangan' => 'required|numeric|min:0',
            'potongan' => 'required|numeric|min:0'
        ]);
        
        // Create employee
        $employee = Employee::create($request->only([
            'nama_lengkap',
            'email',
            'nomor_telepon',
            'tanggal_lahir',
            'alamat',
            'tanggal_masuk',
            'status',
            'department_id',
            'jabatan_id'
        ]));
        
        // Get gaji_pokok from position
        $position = Position::findOrFail($request->jabatan_id);
        $gajiPokok = $position->gaji_pokok;
        $tunjangan = $request->tunjangan;
        $potongan = $request->potongan;
        $totalGaji = $gajiPokok + $tunjangan - $potongan;
        
        // Create salary record for current month
        Salary::create([
            'karyawan_id' => $employee->id,
            'bulan' => now()->format('Y-m'),
            'gaji_pokok' => $gajiPokok,
            'tunjangan' => $tunjangan,
            'potongan' => $potongan,
            'total_gaji' => $totalGaji
        ]);
        
        return redirect()->route('employees.index')
            ->with('success', 'Employee and salary created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::with(['department', 'position', 'salary'])->findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:employees,email,' . $id,
            'nomor_telepon' => 'required|string|max:15',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|in:aktif,nonaktif',
            'department_id' => 'required|exists:departments,id',
            'jabatan_id' => 'required|exists:positions,id',
            'tunjangan' => 'required|numeric|min:0',
            'potongan' => 'required|numeric|min:0'
        ]);
        
        $employee = Employee::findOrFail($id);
        
        // Update employee data
        $employee->update($request->only([
            'nama_lengkap',
            'email',
            'nomor_telepon',
            'tanggal_lahir',
            'alamat',
            'tanggal_masuk',
            'status',
            'department_id',
            'jabatan_id'
        ]));
        
        // Get gaji_pokok from position
        $position = Position::findOrFail($request->jabatan_id);
        $gajiPokok = $position->gaji_pokok;
        $tunjangan = $request->tunjangan;
        $potongan = $request->potongan;
        $totalGaji = $gajiPokok + $tunjangan - $potongan;
        
        // Update or create salary record for current month
        Salary::updateOrCreate(
            [
                'karyawan_id' => $employee->id,
                'bulan' => now()->format('Y-m')
            ],
            [
                'gaji_pokok' => $gajiPokok,
                'tunjangan' => $tunjangan,
                'potongan' => $potongan,
                'total_gaji' => $totalGaji
            ]
        );
        
        return redirect()->route('employees.index')
            ->with('success', 'Employee and salary updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        
        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
