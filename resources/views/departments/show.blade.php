@extends('master')
@section('title', 'Detail Departemen')
@section('content')
<div class="container">
    <div class="page-header">
        <h1>Detail Departemen</h1>
    </div>
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>ID</th>
                <td>{{ $department->id }}</td>
            </tr>
            <tr>
                <th>Nama Departemen</th>
                <td>{{ $department->nama_departemen }}</td>
            </tr>
            <tr>
                <th>Dibuat Pada</th>
                <td>{{ $department->created_at }}</td>
            </tr>
            <tr>
                <th>Diupdate Pada</th>
                <td>{{ $department->updated_at }}</td>
            </tr>
        </table>
    
    <div class="btn-group">
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Kembali ke List</a>
        <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-primary">Edit</a>
    </div>
</div>
@endsection