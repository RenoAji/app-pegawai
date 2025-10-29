@extends('master')
@section('title', 'Tambah Jabatan')
@section('content')
<div class="container">
    <div class="page-header">
        <h1>Form Tambah Jabatan</h1>
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
        
        <form action="{{ route('positions.store') }}" method="POST">
            @csrf
            <table>
                <tr>
                    <td><label for="nama_jabatan">Nama Jabatan:</label></td>
                    <td><input type="text" id="nama_jabatan" name="nama_jabatan" value="{{ old('nama_jabatan') }}" required></td>
                </tr>
                <tr>
                    <td><label for="gaji_pokok">Gaji Pokok:</label></td>
                    <td>
                        <input type="number" id="gaji_pokok" name="gaji_pokok" value="{{ old('gaji_pokok', 0) }}" min="0" step="0.01" required>
                        <small>(Rp)</small>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:right;">
                        <button type="submit">Simpan</button>
                        <a href="{{ route('positions.index') }}">
                            <button type="button">Batal</button>
                        </a>
                    </td>
                </tr>
            </table>
        </form>
</div>
@endsection
