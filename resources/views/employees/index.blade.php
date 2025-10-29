@extends('master')
@section('title', 'Daftar Pegawai')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Daftar Pegawai</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="mb-3">
        <a href="{{ route('employees.create') }}" class="btn btn-primary">Tambah Pegawai</a>
    </div>
    
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>Nomor Telepon</th>
            <th>Departemen</th>
            <th>Jabatan</th>
            <th>Total Gaji</th>
            <th>Status</th>
            <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($employees as $index => $employee)
            <tr>
                <td>{{ $employees->firstItem() + $index }}</td>
                <td>{{ $employee->nama_lengkap }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->nomor_telepon }}</td>
                <td>{{ $employee->department->nama_departemen ?? '-' }}</td>
                <td>{{ $employee->position->nama_jabatan ?? '-' }}</td>
                <td>{{ $employee->salary ? 'Rp ' . number_format($employee->salary->total_gaji, 0, ',', '.') : 'Belum ada data' }}</td>
                <td>{{ ucfirst($employee->status) }}</td>
                <td>
                    <a href="{{ route('employees.show', $employee->id) }}">Detail</a> |
                    <a href="{{ route('employees.edit', $employee->id) }}">Edit</a> |
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus pegawai ini?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center;">Tidak ada data pegawai</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="mt-3">
        {{ $employees->links() }}
    </div>
</div>
@endsection