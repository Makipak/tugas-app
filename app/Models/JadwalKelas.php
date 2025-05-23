<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKelas extends Model
{
    use HasFactory;
    protected $table = 'jadwal_kelas';
    protected $fillable = [
        'kode_mata_kuliah', 'nama_mata_kuliah', 'dosen_id', 'hari',
        'jam_mulai', 'jam_selesai', 'ruangan', 'jumlah_pertemuan', 'mahasiswa_pjmk_id'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function mahasiswaPJMK()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_pjmk_id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}