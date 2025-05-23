<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = ['user_id', 'nim', 'nama_lengkap', 'jurusan', 'angkatan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jadwalPJMK()
    {
        return $this->hasMany(JadwalKelas::class, 'mahasiswa_pjmk_id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}
