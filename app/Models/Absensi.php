<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensi';
    protected $fillable = [
        'jadwal_kelas_id', 'mahasiswa_id', 'pertemuan_ke', 'tanggal_absensi', 'status_absensi', 'keterangan', 'diabsen_oleh'
    ];

    public function jadwalKelas()
    {
        return $this->belongsTo(JadwalKelas::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}