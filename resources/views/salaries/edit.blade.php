@extends('master')
@section('title', 'Edit Data Gaji')
@section('content')
<div class="container">
    <div class="page-header">
        <h1>Edit Data Gaji</h1>
        <p>Pegawai: {{ $salary->employee->nama_lengkap }} - {{ date('F Y', strtotime($salary->bulan)) }}</p>
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
        <form action="{{ route('salaries.update', $salary->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="karyawan_id">Pegawai <span class="required">*</span></label>
                <select id="karyawan_id" name="karyawan_id" class="form-control" required>
                    <option value="">-- Pilih Pegawai --</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" 
                            {{ (old('karyawan_id', $salary->karyawan_id) == $employee->id) ? 'selected' : '' }}>
                            {{ $employee->nama_lengkap }} - {{ $employee->department->nama_departemen ?? 'Tanpa Departemen' }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="bulan">Bulan Gaji <span class="required">*</span></label>
                <input type="month" id="bulan" name="bulan" class="form-control" value="{{ old('bulan', date('Y-m', strtotime($salary->bulan))) }}" required>
                <small class="form-text">Format: YYYY-MM</small>
            </div>
            
            <div class="form-group">
                <label for="gaji_pokok">Gaji Pokok <span class="required">*</span></label>
                <input type="number" id="gaji_pokok" name="gaji_pokok" class="form-control" value="{{ old('gaji_pokok', $salary->gaji_pokok) }}" min="0" step="1" required>
                <small class="form-text">Dalam Rupiah (tanpa koma atau titik)</small>
            </div>
            
            <div class="form-group">
                <label for="tunjangan">Tunjangan</label>
                <input type="number" id="tunjangan" name="tunjangan" class="form-control" value="{{ old('tunjangan', $salary->tunjangan) }}" min="0" step="1" required>
                <small class="form-text">Dalam Rupiah (tanpa koma atau titik)</small>
            </div>
            
            <div class="form-group">
                <label for="potongan">Potongan</label>
                <input type="number" id="potongan" name="potongan" class="form-control" value="{{ old('potongan', $salary->potongan) }}" min="0" step="1" required>
                <small class="form-text">Dalam Rupiah (tanpa koma atau titik)</small>
            </div>
            
            <div class="form-group">
                <label>Total Gaji Saat Ini</label>
                <div class="form-control-static">
                    <strong>Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</strong>
                </div>
                <small class="form-text">Total akan dihitung ulang setelah disimpan</small>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Data Gaji</button>
                <a href="{{ route('salaries.show', $salary->id) }}" class="btn btn-secondary">Batal</a>
                <a href="{{ route('employees.show', $salary->employee->id) }}" class="btn btn-info">Detail Pegawai</a>
            </div>
        </form>
    </div>
</div>

<script>
    // Auto calculate total preview when values change
    document.addEventListener('DOMContentLoaded', function() {
        const gajiPokok = document.getElementById('gaji_pokok');
        const tunjangan = document.getElementById('tunjangan');
        const potongan = document.getElementById('potongan');
        
        // Create preview element
        const previewDiv = document.createElement('div');
        previewDiv.className = 'alert alert-info';
        previewDiv.style.display = 'none';
        previewDiv.innerHTML = '<strong>Preview Total: </strong><span id="preview-total">Rp 0</span>';
        
        // Insert after potongan field
        potongan.parentNode.insertBefore(previewDiv, potongan.nextSibling);
        
        function updatePreview() {
            const total = parseInt(gajiPokok.value || 0) + parseInt(tunjangan.value || 0) - parseInt(potongan.value || 0);
            document.getElementById('preview-total').textContent = 'Rp ' + total.toLocaleString('id-ID');
            previewDiv.style.display = 'block';
        }
        
        gajiPokok.addEventListener('input', updatePreview);
        tunjangan.addEventListener('input', updatePreview);
        potongan.addEventListener('input', updatePreview);
    });
</script>
@endsection