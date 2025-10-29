@extends('master')
@section('title', 'Daftar Absensi')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Daftar Absensi</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="mb-3">
        <a href="{{ route('attendances.create') }}" class="btn btn-primary">Tambah Absensi</a>
    </div>
    
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pegawai</th>
                <th>Tanggal</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
                <th>Status Absensi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendances as $index => $attendance)
            <tr>
                <td>{{ $attendances->firstItem() + $index }}</td>
                <td>{{ $attendance->employee->nama_lengkap ?? '-' }}</td>
                <td>{{ $attendance->tanggal }}</td>
                <td>{{ $attendance->waktu_masuk ?? '-' }}</td>
                <td>{{ $attendance->waktu_keluar ?? '-' }}</td>
                <td>
                    <span style="padding: 3px 8px; border-radius: 3px; 
                        @if($attendance->status_absensi == 'hadir') background-color: #28a745; color: white;
                        @elseif($attendance->status_absensi == 'izin') background-color: #ffc107; color: black;
                        @elseif($attendance->status_absensi == 'sakit') background-color: #17a2b8; color: white;
                        @else background-color: #dc3545; color: white;
                        @endif">
                        {{ ucfirst($attendance->status_absensi) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('attendances.show', $attendance->id) }}">Detail</a> |
                    <a href="{{ route('attendances.edit', $attendance->id) }}">Edit</a> |
                    <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus absensi ini?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;">Tidak ada data absensi</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="mt-3">
        {{ $attendances->links() }}
    </div>
</div>
@endsection
