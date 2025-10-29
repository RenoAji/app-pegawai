@extends('master')
@section('title', 'Daftar Gaji Pegawai')
@section('content')
<div class="container">
    <div class="page-header">
        @if(isset($employee))
            <h1>Riwayat Gaji - {{ $employee->nama_lengkap }}</h1>
            <p>Departemen: {{ $employee->department->nama_departemen ?? '-' }} | Jabatan: {{ $employee->position->nama_jabatan ?? '-' }}</p>
        @else
            <h1>Daftar Gaji Semua Pegawai</h1>
        @endif
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="mb-3">
        @if(isset($employee))
            <a href="{{ route('salaries.create', ['employee_id' => $employee->id]) }}" class="btn btn-primary">Tambah Gaji Bulan Baru</a>
            <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-secondary">Kembali ke Detail Pegawai</a>
        @else
            <a href="{{ route('salaries.create') }}" class="btn btn-primary">Tambah Data Gaji</a>
        @endif
    </div>
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pegawai</th>
                    <th>Bulan</th>
                    <th>Gaji Pokok</th>
                    <th>Tunjangan</th>
                    <th>Potongan</th>
                    <th>Total Gaji</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($salaries as $index => $salary)
                <tr>
                    <td>{{ $salaries->firstItem() + $index }}</td>
                    <td>{{ $salary->employee->nama_lengkap ?? '-' }}</td>
                    <td>{{ date('F Y', strtotime($salary->bulan)) }}</td>
                    <td>Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($salary->potongan, 0, ',', '.') }}</td>
                    <td><strong>Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</strong></td>
                    <td>
                        <a href="{{ route('salaries.show', $salary->id) }}" class="btn btn-sm btn-info">Detail</a>
                        <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data gaji ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center;">
                        @if(isset($employee))
                            Belum ada data gaji untuk pegawai ini
                        @else
                            Tidak ada data gaji
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-3">
        {{ $salaries->links() }}
    </div>
</div>
@endsection