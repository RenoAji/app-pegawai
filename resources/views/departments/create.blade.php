@extends('master')
@section('title', 'Tambah Departemen')
@section('content')
<div class="container">
    <div class="page-header">
        <h1>Form Tambah Departemen</h1>
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
        
        <form action="{{ route('departments.store') }}" method="POST">
            @csrf
            <table>
                <tr>
                    <td><label for="nama_departemen">Nama Departemen:</label></td>
                    <td><input type="text" id="nama_departemen" name="nama_departemen" value="{{ old('nama_departemen') }}" required></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:right;">
                        <button type="submit">Simpan</button>
                        <a href="{{ route('departments.index') }}">
                            <button type="button">Batal</button>
                        </a>
                    </td>
                </tr>
            </table>
        </form>
</div>
@endsection