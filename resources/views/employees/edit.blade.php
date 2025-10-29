@extends('master')
@section('title', 'Edit Pegawai')
@section('content')
<div class="container">
    <div class="page-header">
        <h1>Edit Data Pegawai</h1>
    </div>
    
    @if ($errors->any())
        <div style="color: red; margin-bottom: 10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
        <table>
            <tr>
                <td>Nama Lengkap</td>
                <td><input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $employee->nama_lengkap) }}" required></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="email" value="{{ old('email', $employee->email) }}" required></td>
            </tr>
            <tr>
                <td>Nomor Telepon</td>
                <td><input type="text" name="nomor_telepon" value="{{ old('nomor_telepon', $employee->nomor_telepon) }}" required></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td><input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $employee->tanggal_lahir) }}" required></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><textarea name="alamat" required>{{ old('alamat', $employee->alamat) }}</textarea></td>
            </tr>
            <tr>
                <td>Tanggal Masuk</td>
                <td><input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk', $employee->tanggal_masuk) }}" required></td>
            </tr>
            <tr>
                <td>Departemen</td>
                <td>
                    <select name="department_id" required>
                        <option value="">-- Pilih Departemen --</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" 
                                {{ old('department_id', $employee->department_id) == $department->id ? 'selected' : '' }}>
                                {{ $department->nama_departemen }}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>
                    <select name="jabatan_id" required>
                        <option value="">-- Pilih Jabatan --</option>
                        @foreach($positions as $position)
                            <option value="{{ $position->id }}" 
                                {{ old('jabatan_id', $employee->jabatan_id) == $position->id ? 'selected' : '' }}>
                                {{ $position->nama_jabatan }} (Rp {{ number_format($position->gaji_pokok, 2, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <select name="status" required>
                        <option value="aktif" {{ old('status', $employee->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status', $employee->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <button type="submit">Update</button>
                    <a href="{{ route('employees.index') }}">
                        <button type="button">Batal</button>
                    </a>
                </td>
            </tr>
        </table>
    </form>
</div>
@endsection