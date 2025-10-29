@extends('master')
@section('title', 'Daftar Departemen')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Daftar Departemen</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="mb-3">
        <a href="{{ route('departments.create') }}" class="btn btn-primary">Tambah Departemen</a>
    </div>
    
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Departemen</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($departments as $index => $department)
            <tr>
                <td>{{ $departments->firstItem() + $index }}</td>
                <td>{{ $department->nama_departemen }}</td>
                <td>
                    <a href="{{ route('departments.show', $department->id) }}">Detail</a> |
                    <a href="{{ route('departments.edit', $department->id) }}">Edit</a> |
                    <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus departemen ini?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" style="text-align:center;">Tidak ada data departemen</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="mt-3">
        {{ $departments->links() }}
    </div>
</div>
@endsection