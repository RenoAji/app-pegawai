@extends('master')
@section('title', 'Tambah Data Gaji')
@section('content')
<div class="container">
    <div class="page-header">
        <h1>Form Tambah Data Gaji</h1>
    </div>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="form-container">
        <form action="{{ route('salaries.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="karyawan_id">Pegawai <span class="required">*</span></label>
                <select id="karyawan_id" name="karyawan_id" class="form-control" required>
                    <option value="">-- Pilih Pegawai --</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" 
                            {{ (old('karyawan_id') == $employee->id || (isset($selectedEmployee) && $selectedEmployee->id == $employee->id)) ? 'selected' : '' }}>
                            {{ $employee->nama_lengkap }} - {{ $employee->department->nama_departemen ?? 'Tanpa Departemen' }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="bulan">Bulan Gaji <span class="required">*</span></label>
                <input type="month" id="bulan" name="bulan" class="form-control" value="{{ old('bulan', date('Y-m')) }}" required>
                <small class="form-text">Format: YYYY-MM (contoh: {{ date('Y-m') }})</small>
            </div>
            
            <div class="form-group">
                <label for="gaji_pokok">Gaji Pokok <span class="required">*</span></label>
                <input type="number" id="gaji_pokok" name="gaji_pokok" class="form-control" value="{{ old('gaji_pokok', 0) }}" min="0" step="1" required>
                <small class="form-text">Dalam Rupiah (tanpa koma atau titik)</small>
            </div>
            
            <div class="form-group">
                <label for="tunjangan">Tunjangan</label>
                <input type="number" id="tunjangan" name="tunjangan" class="form-control" value="{{ old('tunjangan', 0) }}" min="0" step="1" required>
                <small class="form-text">Dalam Rupiah (tanpa koma atau titik)</small>
            </div>
            
            <div class="form-group">
                <label for="potongan">Potongan</label>
                <input type="number" id="potongan" name="potongan" class="form-control" value="{{ old('potongan', 0) }}" min="0" step="1" required>
                <small class="form-text">Dalam Rupiah (tanpa koma atau titik)</small>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan Data Gaji</button>
                <a href="{{ route('salaries.index') }}" class="btn btn-secondary">Batal</a>
                @if(isset($selectedEmployee))
                    <a href="{{ route('employees.show', $selectedEmployee->id) }}" class="btn btn-info">Kembali ke Detail Pegawai</a>
                @endif
            </div>
        </form>
    </div>
</div>

<script>
    // Auto calculate total when values change
    document.addEventListener('DOMContentLoaded', function() {
        const gajiPokok = document.getElementById('gaji_pokok');
        const tunjangan = document.getElementById('tunjangan');
        const potongan = document.getElementById('potongan');
        
        function updateTotal() {
            const total = parseInt(gajiPokok.value || 0) + parseInt(tunjangan.value || 0) - parseInt(potongan.value || 0);
            // You can add a total display here if needed
        }
        
        gajiPokok.addEventListener('input', updateTotal);
        tunjangan.addEventListener('input', updateTotal);
        potongan.addEventListener('input', updateTotal);
    });
</script>
@endsection