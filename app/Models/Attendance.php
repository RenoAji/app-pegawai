<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'tanggal',
        'waktu_masuk',
        'waktu_keluar',
        'status_absensi',
        'karyawan_id'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

}
