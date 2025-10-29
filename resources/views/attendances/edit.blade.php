@extends('master')
@section('title', 'Edit Absensi Pegawai')
@section('content')
<div class="container">
    <div class="page-header">
        <h1>Edit Data Absensi</h1>
    </div>
    
    <form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
        @csrf
        @method('PUT')
        <table>
            <tr>
                <td>Nama Pegawai</td>
                <td><strong>{{ $attendance->employee->nama_lengkap ?? '-' }}</strong></td>
            </tr>
            <tr>
                <td>Tanggal Saat Ini</td>
                <td><strong>{{ $attendance->tanggal }}</strong></td>
            </tr>
            <tr>
                <td>Status Absensi</td>
                <td>
                    <select name="status_absensi" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="hadir" {{ old('status_absensi', $attendance->status_absensi) == 'hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="izin" {{ old('status_absensi', $attendance->status_absensi) == 'izin' ? 'selected' : '' }}>Izin</option>
                        <option value="sakit" {{ old('status_absensi', $attendance->status_absensi) == 'sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="alpha" {{ old('status_absensi', $attendance->status_absensi) == 'alpha' ? 'selected' : '' }}>Alpha</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Waktu Masuk</td>
                <td><strong>{{ $attendance->waktu_masuk ?? '-' }}</strong></td>
            </tr>
            <tr>
                <td>Waktu Keluar</td>
                <td>
                    @if($attendance->waktu_keluar)
                        <strong>{{ $attendance->waktu_keluar }}</strong>
                    @else
                        <input type="checkbox" name="keluar" value="1" {{ old('keluar') ? 'checked' : '' }}>
                        <label for="keluar">Tandai sebagai keluar (waktu saat ini)</label>
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="2" style="background-color: #f0f0f0; padding: 5px;">
                    <small><i>Tanggal dan waktu akan diupdate ke waktu saat ini</i></small>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">Update</button>
                    <a href="{{ route('attendances.index') }}">
                        <button type="button">Batal</button>
                    </a>
                </td>
            </tr>
        </table>
    </form>
</div>
@endsection