@extends('master')
@section('title', 'Tambah Absensi Pegawai')
@section('content')
<div class="container">
    <div class="page-header">
        <h1>Form Tambah Absensi</h1>
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

<form action="{{ route('attendances.store') }}" method="POST">
    @csrf
    <table>
        <tr>
            <td><label for="karyawan_id">Pegawai:</label></td>
            <td>
                <select id="karyawan_id" name="karyawan_id" required>
                    <option value="">-- Pilih Pegawai --</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ old('karyawan_id') == $employee->id ? 'selected' : '' }}>
                            {{ $employee->nama_lengkap }} - {{ $employee->department->nama_departemen ?? '-' }}
                        </option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="status_absensi">Status Absensi:</label></td>
            <td>
                <select id="status_absensi" name="status_absensi" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="hadir" {{ old('status_absensi') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="izin" {{ old('status_absensi') == 'izin' ? 'selected' : '' }}>Izin</option>
                    <option value="sakit" {{ old('status_absensi') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                    <option value="alpha" {{ old('status_absensi') == 'alpha' ? 'selected' : '' }}>Alpha</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="background-color: #f0f0f0; padding: 5px;">
                <small><i>Tanggal dan waktu masuk akan diisi otomatis saat ini</i></small>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:right;">
                <button type="submit">Simpan</button>
                <a href="{{ route('attendances.index') }}">
                    <button type="button">Batal</button>
                </a>
            </td>
        </tr>
    </table>
</form>
</div>
@endsection

