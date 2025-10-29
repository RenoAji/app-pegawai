@extends('master')
@section('title', 'Detail Jabatan')
@section('content')
<div class="container">
    <div class="page-header">
        <h1>Detail Jabatan</h1>
    </div>
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>ID</th>
                <td>{{ $position->id }}</td>
            </tr>
            <tr>
                <th>Nama Jabatan</th>
                <td>{{ $position->nama_jabatan }}</td>
            </tr>
            <tr>
                <th>Gaji Pokok</th>
                <td>Rp {{ number_format($position->gaji_pokok, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Dibuat Pada</th>
                <td>{{ $position->created_at->format('d-m-Y H:i:s') }}</td>
            </tr>
            <tr>
                <th>Diupdate Pada</th>
                <td>{{ $position->updated_at->format('d-m-Y H:i:s') }}</td>
            </tr>
        </table>
        
        @if($position->employees->isNotEmpty())
        <h2>Pegawai dengan Jabatan Ini</h2>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pegawai</th>
                    <th>Email</th>
                    <th>Departemen</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($position->employees as $index => $employee)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $employee->nama_lengkap }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->department->nama_departemen ?? '-' }}</td>
                    <td>{{ ucfirst($employee->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>Tidak ada pegawai dengan jabatan ini.</p>
        @endif
        
    
    <div class="btn-group">
        <a href="{{ route('positions.index') }}" class="btn btn-secondary">Kembali ke List</a>
        <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-primary">Edit</a>
    </div>
</div>
@endsection
