@extends('master')
@section('title', 'Tambah Pegawai')
@section('content')
<div class="container">
    <div class="page-header">
        <h1>Form Tambah Pegawai</h1>
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
        
        <form action="{{ route('employees.store') }}" method="POST">
            @csrf
            <table>
                <tr>
                    <td><label for="nama_lengkap">Nama Lengkap:</label></td>
                    <td><input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" id="email" name="email" value="{{ old('email') }}" required></td>
                </tr>
                <tr>
                    <td><label for="nomor_telepon">Nomor Telepon:</label></td>
                    <td><input type="text" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}" required></td>
                </tr>
                <tr>
                    <td><label for="tanggal_lahir">Tanggal Lahir:</label></td>
                    <td><input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required></td>
                </tr>
                <tr>
                    <td><label for="alamat">Alamat:</label></td>
                    <td><textarea id="alamat" name="alamat" required>{{ old('alamat') }}</textarea></td>
                </tr>
                <tr>
                    <td><label for="tanggal_masuk">Tanggal Masuk:</label></td>
                    <td><input type="date" id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" required></td>
                </tr>
                <tr>
                    <td><label for="department_id">Departemen:</label></td>
                    <td>
                        <select id="department_id" name="department_id" required>
                            <option value="">-- Pilih Departemen --</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->nama_departemen }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="jabatan_id">Jabatan:</label></td>
                    <td>
                        <select id="jabatan_id" name="jabatan_id" required>
                            <option value="">-- Pilih Jabatan --</option>
                            @foreach($positions as $position)
                                <option value="{{ $position->id }}" {{ old('jabatan_id') == $position->id ? 'selected' : '' }}>
                                    {{ $position->nama_jabatan }} (Rp {{ number_format($position->gaji_pokok, 2, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="status">Status:</label></td>
                    <td>
                        <select id="status" name="status" required>
                            <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="background-color: #e3f2fd; padding: 10px;">
                        <small><em>💡 Catatan: Data gaji akan ditambahkan terpisah setelah pegawai dibuat</em></small>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:right;">
                        <button type="submit">Simpan</button>
                        <a href="{{ route('employees.index') }}">
                            <button type="button">Batal</button>
                        </a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
@endsection