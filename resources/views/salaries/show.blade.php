@extends('master')
@section('title', 'Detail Gaji Pegawai')
@section('content')
<div class="container">
    <div class="page-header">
        <h1>Detail Gaji - {{ date('F Y', strtotime($salary->bulan)) }}</h1>
    </div>
    
    <div class="detail-container">
        <h2>Informasi Pegawai</h2>
        <table class="detail-table">
            <tr>
                <th>Nama Lengkap</th>
                <td>{{ $salary->employee->nama_lengkap ?? '-' }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $salary->employee->email ?? '-' }}</td>
            </tr>
            <tr>
                <th>Departemen</th>
                <td>{{ $salary->employee->department->nama_departemen ?? '-' }}</td>
            </tr>
            <tr>
                <th>Jabatan</th>
                <td>{{ $salary->employee->position->nama_jabatan ?? '-' }}</td>
            </tr>
        </table>
        
        <h2>Detail Gaji</h2>
        <table class="detail-table">
            <tr>
                <th>Bulan</th>
                <td>{{ date('F Y', strtotime($salary->bulan)) }}</td>
            </tr>
            <tr>
                <th>Gaji Pokok</th>
                <td>Rp {{ number_format($salary->gaji_pokok, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Tunjangan</th>
                <td>Rp {{ number_format($salary->tunjangan, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Potongan</th>
                <td class="text-danger">- Rp {{ number_format($salary->potongan, 2, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <th>Total Gaji</th>
                <td><strong>Rp {{ number_format($salary->total_gaji, 2, ',', '.') }}</strong></td>
            </tr>
        </table>
        
        <h3>Rincian Perhitungan</h3>
        <div class="calculation-box">
            <div class="calc-item">
                <span>Gaji Pokok:</span>
                <span>Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</span>
            </div>
            <div class="calc-item">
                <span>Tunjangan:</span>
                <span class="text-success">+ Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</span>
            </div>
            <div class="calc-item">
                <span>Potongan:</span>
                <span class="text-danger">- Rp {{ number_format($salary->potongan, 0, ',', '.') }}</span>
            </div>
            <hr>
            <div class="calc-item total">
                <span><strong>Total Gaji:</strong></span>
                <span><strong>Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</strong></span>
            </div>
        </div>
        
        <h3>Informasi Sistem</h3>
        <table class="detail-table">
            <tr>
                <th>Dibuat Pada</th>
                <td>{{ $salary->created_at->format('d-m-Y H:i:s') }}</td>
            </tr>
            <tr>
                <th>Diupdate Pada</th>
                <td>{{ $salary->updated_at->format('d-m-Y H:i:s') }}</td>
            </tr>
        </table>
    </div>
    
    <div class="btn-group">
        <a href="{{ route('salaries.index') }}" class="btn btn-secondary">Kembali ke List</a>
        <a href="{{ route('employees.show', $salary->employee->id) }}" class="btn btn-info">Detail Pegawai</a>
        <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-primary">Edit Gaji</a>
        <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data gaji ini?')">Hapus</button>
        </form>
    </div>
</div>

<style>
.calculation-box {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 5px;
    padding: 20px;
    margin: 20px 0;
}

.calc-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    padding: 5px 0;
}

.calc-item.total {
    font-size: 1.2em;
    border-top: 2px solid #007bff;
    padding-top: 15px;
    margin-top: 15px;
}

.text-success {
    color: #28a745 !important;
}

.text-danger {
    color: #dc3545 !important;
}

.total-row {
    background-color: #e7f3ff;
    font-weight: bold;
}
</style>
@endsection