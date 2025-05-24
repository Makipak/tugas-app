<?php

namespace App\Http\Controllers;

use App\Models\{Absensi, Mahasiswa, JadwalKelas, Dosen};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{

    public function rekap($jadwalId)
    {
    $jadwal = JadwalKelas::findOrFail($jadwalId);
    $absensi = Absensi::with('mahasiswa')->where('jadwal_kelas_id', $jadwalId)->get();

    return view('dosen.rekap_absensi', compact('jadwal', 'absensi'));
    }

    public function formInput($jadwalId)
    {
        $jadwal = JadwalKelas::findOrFail($jadwalId);
        $user = Auth::user();

    // Cek apakah user adalah mahasiswa PJMK untuk jadwal ini
    if ($jadwal->mahasiswa_pjmk_id !== $user->mahasiswa->id) {
        abort(403, 'Kamu bukan PJMK untuk jadwal ini.');
    }

        $mahasiswa = Mahasiswa::all();


    return view('mahasiswa.pjmk_absensi', [
        'jadwal' => $jadwal,
        'pertemuanKe' => 1,
        'mahasiswa' => $mahasiswa
    ]);
    }


    public function index()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        $absensi = Absensi::where('mahasiswa_id', $mahasiswa->id)->get();

        return view('mahasiswa.rekap_absensi', compact('absensi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertemuan_ke' => 'required',
            'tanggal_absensi' => 'required|date',
            'status_absensi' => 'required|array',
            'mahasiswa_id' => 'required|array',
            'jadwal_kelas_id' => 'required',
        ]);

        foreach ($request->mahasiswa_id as $mhsId) {
            Absensi::create([
            'jadwal_kelas_id' => $request->jadwal_kelas_id,
            'mahasiswa_id' => $mhsId, // ✅ Pakai ID yang sedang di-loop
            'pertemuan_ke' => $request->pertemuan_ke,
            'tanggal_absensi' => now(),
            'status_absensi' => $request->status_absensi[$mhsId] ?? 'Alpha', // ✅ Ambil sesuai ID
            'keterangan' => $request->keterangan[$mhsId] ?? null, // ✅ Ambil sesuai ID
            'diabsen_oleh' => Auth::user()->role === 'dosen' ? 'dosen' : 'pj_mk',
            ]);
        }


        return back()->with('success', 'Absensi berhasil disimpan.');
    }
}

