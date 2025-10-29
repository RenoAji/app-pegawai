<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = Attendance::with('employee.department')->latest()->paginate(5);
        return view('attendances.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::with('department')->get();
        return view('attendances.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|numeric|unique:attendances',
            'status_absensi' => 'required|string|max:50',
        ]);

        Attendance::create([
            'karyawan_id'=>$request['karyawan_id'],
            'tanggal'=>now(),
            'status_absensi'=>$request['status_absensi'],
            'waktu_masuk'=>now(),
            'waktu_keluar'=>null,
        ]);

        return redirect()->route('attendances.index')
            ->with('success', 'Attendance created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attendance = Attendance::with(['employee.department', 'employee.position', 'employee'])->findOrFail($id);
        return view('attendances.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $attendance = Attendance::with('employee')->findOrFail($id);
        return view('attendances.edit', compact('attendance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status_absensi' => 'required|string|max:50',
            'keluar' => 'nullable|boolean',
        ]);

        Attendance::where('id', $id)->update([
            'tanggal'=>now(),
            'status_absensi'=>$request['status_absensi'],
            'waktu_masuk'=>now(),
            'waktu_keluar'=>$request->has('keluar') && $request['keluar'] ? now() : null,
        ]);

        return redirect()->route('attendances.index')
            ->with('success', 'Attendance updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();
        
        return redirect()->route('attendances.index')
            ->with('success', 'Attendance deleted successfully.');
    }
}
