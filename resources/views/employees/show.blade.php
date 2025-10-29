@extends('master')
@section('title', 'Detail Pegawai')
@section('content')
<div class="container">
    <div class="page-header">
        <h1>Detail Pegawai</h1>
    </div>
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>Nama Lengkap</th>
                <td>{{ $employee->nama_lengkap }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $employee->email }}</td>
            </tr>
            <tr>
                <th>Nomor Telepon</th>
                <td>{{ $employee->nomor_telepon }}</td>
            </tr>
            <tr>
                <th>Tanggal Lahir</th>
                <td>{{ $employee->tanggal_lahir }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $employee->alamat }}</td>
            </tr>
            <tr>
                <th>Tanggal Masuk</th>
                <td>{{ $employee->tanggal_masuk }}</td>
            </tr>
            <tr>
                <th>Departemen</th>
                <td>{{ $employee->department->nama_departemen ?? '-' }}</td>
            </tr>
            <tr>
                <th>Jabatan</th>
                <td>{{ $employee->position->nama_jabatan ?? '-' }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ ucfirst($employee->status) }}</td>
            </tr>
        </table>

        @if($employee->salary)
        <h2>Informasi Gaji Terkini</h2>
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>Gaji Pokok</th>
                <td>Rp {{ number_format($employee->salary->gaji_pokok, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Tunjangan</th>
                <td>Rp {{ number_format($employee->salary->tunjangan, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Potongan</th>
                <td>Rp {{ number_format($employee->salary->potongan, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Total Gaji</th>
                <td><strong>Rp {{ number_format($employee->salary->total_gaji, 2, ',', '.') }}</strong></td>
            </tr>
        </table>

        @if($employee->salary->count() > 1)
        <h3>Riwayat Gaji</h3>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Gaji Pokok</th>
                    <th>Tunjangan</th>
                    <th>Potongan</th>
                    <th>Total Gaji</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employee->salary->sortByDesc('bulan') as $salary)
                <tr>
                    <td>{{ date('F Y', strtotime($salary->bulan)) }}</td>
                    <td>Rp {{ number_format($salary->gaji_pokok, 2, ',', '.') }}</td>
                    <td>Rp {{ number_format($salary->tunjangan, 2, ',', '.') }}</td>
                    <td>Rp {{ number_format($salary->potongan, 2, ',', '.') }}</td>
                    <td>Rp {{ number_format($salary->total_gaji, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        @else
        <p style="color: red;">Tidak ada data gaji untuk pegawai ini.</p>
        @endif

        <br>
    <div class="btn-group">
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Kembali ke List</a>
        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary">Edit</a>
    </div>
</div>
@endsection