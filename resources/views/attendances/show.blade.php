@extends('master')
@section('title', 'Detail Absensi Pegawai')
@section('content')
<div class="container">
    <div class="page-header">
        <h1>Detail Absensi</h1>
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>ID</th>
                <td>{{ $attendance->id }}</td>
            </tr>
            <tr>
                <th>Nama Pegawai</th>
                <td>{{ $attendance->employee->nama_lengkap ?? '-' }}</td>
            </tr>
            <tr>
                <th>Email Pegawai</th>
                <td>{{ $attendance->employee->email ?? '-' }}</td>
            </tr>
            <tr>
                <th>Departemen</th>
                <td>{{ $attendance->employee->department->nama_departemen ?? '-' }}</td>
            </tr>
            <tr>
                <th>Jabatan</th>
                <td>{{ $attendance->employee->position->nama_jabatan ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>{{ $attendance->tanggal }}</td>
            </tr>
            <tr>
                <th>Waktu Masuk</th>
                <td>{{ $attendance->waktu_masuk ?? '-' }}</td>
            </tr>
            <tr>
                <th>Waktu Keluar</th>
                <td>{{ $attendance->waktu_keluar ?? 'Belum keluar' }}</td>
            </tr>
            <tr>
                <th>Status Absensi</th>
                <td>
                    <span style="padding: 5px 10px; border-radius: 3px; 
                        @if($attendance->status_absensi == 'hadir') background-color: #28a745; color: white;
                        @elseif($attendance->status_absensi == 'izin') background-color: #ffc107; color: black;
                        @elseif($attendance->status_absensi == 'sakit') background-color: #17a2b8; color: white;
                        @else background-color: #dc3545; color: white;
                        @endif">
                        {{ ucfirst($attendance->status_absensi) }}
                    </span>
                </td>
            </tr>
            <tr>
                <th>Dibuat Pada</th>
                <td>{{ $attendance->created_at->format('d-m-Y H:i:s') }}</td>
            </tr>
            <tr>
                <th>Diupdate Pada</th>
                <td>{{ $attendance->updated_at->format('d-m-Y H:i:s') }}</td>
            </tr>
        </table>
    
    <div class="btn-group">
        <a href="{{ route('attendances.index') }}" class="btn btn-secondary">Kembali ke List</a>
        <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-primary">Edit</a>
    </div>
    </div>
</div>
@endsection