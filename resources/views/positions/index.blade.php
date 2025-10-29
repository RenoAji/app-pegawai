@extends('master')
@section('title', 'Daftar Jabatan')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Daftar Jabatan</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="mb-3">
        <a href="{{ route('positions.create') }}" class="btn btn-primary">Tambah Jabatan</a>
    </div>
    
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Jabatan</th>
                <th>Gaji Pokok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($positions as $index => $position)
            <tr>
                <td>{{ $positions->firstItem() + $index }}</td>
                <td>{{ $position->nama_jabatan }}</td>
                <td>Rp {{ number_format($position->gaji_pokok, 2, ',', '.') }}</td>
                <td>
                    <a href="{{ route('positions.show', $position->id) }}">Detail</a> |
                    <a href="{{ route('positions.edit', $position->id) }}">Edit</a> |
                    <form action="{{ route('positions.destroy', $position->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus jabatan ini?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align:center;">Tidak ada data jabatan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="mt-3">
        {{ $positions->links() }}
    </div>
</div>
@endsection
