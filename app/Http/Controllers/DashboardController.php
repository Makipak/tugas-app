<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\JadwalKelas;
use App\Models\Absensi;


class DashboardController extends Controller
{
    public function mahasiswaDashboard()
    {
    $user = Auth::user();
    $mahasiswa = $user->mahasiswa;

    $jadwal = JadwalKelas::with('dosen')->get();
    $rekapAbsensi = Absensi::with('jadwalKelas')
    ->where('mahasiswa_id', $mahasiswa->id)
    ->orderBy('tanggal_absensi')
    ->get()
    ->groupBy('jadwal_kelas_id');

    // Cek apakah mahasiswa ini terdaftar sebagai PJMK di salah satu jadwal
    $isPJMK = JadwalKelas::where('mahasiswa_pjmk_id', $mahasiswa->id)->exists();

    return view('dashboard.mahasiswa', compact('jadwal', 'rekapAbsensi', 'mahasiswa', 'isPJMK'));
    }

    public function dosenDashboard()
{
    $user = Auth::user();
    $dosen = $user->dosen;

    $jadwalSaya = JadwalKelas::where('dosen_id', $dosen->id)->with('mahasiswaPJMK')->get();
    $mahasiswa = Mahasiswa::all();

    return view('dashboard.dosen', compact('jadwalSaya', 'mahasiswa'));
}

public function index()
{
    $user = Auth::user();

    if ($user->role === 'dosen') {
        return redirect()->route('dashboard.dosen');
    } elseif ($user->role === 'mahasiswa') {
        return redirect()->route('dashboard.mahasiswa');
    }

    abort(403);
}

}
