@extends('master')
@section('title', 'Edit Departemen')
@section('content')
<div class="container">
    <div class="page-header">
        <h1>Edit Data Departemen</h1>
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
    
    <form action="{{ route('departments.update', $department->id) }}" method="POST">
        @csrf
        @method('PUT')
        <table>
            <tr>
                <td>Nama Departemen</td>
                <td><input type="text" name="nama_departemen" value="{{ old('nama_departemen', $department->nama_departemen) }}" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">Update</button>
                    <a href="{{ route('departments.index') }}">
                        <button type="button">Batal</button>
                    </a>
                </td>
            </tr>
        </table>
    </form>
</div>
@endsection