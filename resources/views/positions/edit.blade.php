@extends('master')
@section('title', 'Edit Jabatan')
@section('content')
<div class="container">
    <div class="page-header">
        <h1>Edit Data Jabatan</h1>
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
    
    <form action="{{ route('positions.update', $position->id) }}" method="POST">
        @csrf
        @method('PUT')
        <table>
            <tr>
                <td>Nama Jabatan</td>
                <td><input type="text" name="nama_jabatan" value="{{ old('nama_jabatan', $position->nama_jabatan) }}" required></td>
            </tr>
            <tr>
                <td>Gaji Pokok</td>
                <td>
                    <input type="number" name="gaji_pokok" value="{{ old('gaji_pokok', $position->gaji_pokok) }}" min="0" step="0.01" required>
                    <small>(Rp)</small>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">Update</button>
                    <a href="{{ route('positions.index') }}">
                        <button type="button">Batal</button>
                    </a>
                </td>
            </tr>
        </table>
    </form>
</div>
@endsection
