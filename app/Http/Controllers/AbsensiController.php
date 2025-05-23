<?php

namespace App\Http\Controllers;

use App\Models\{Absensi, Mahasiswa, JadwalKelas, Dosen};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        $absensi = Absensi::where('mahasiswa_id', $mahasiswa->id)->get();

        return view('mahasiswa.absensi_index', compact('absensi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_kelas_id' => 'required',
            'mahasiswa_id' => 'required',
            'pertemuan_ke' => 'required',
            'tanggal_absensi' => 'required|date',
            'status_absensi' => 'required',
        ]);

        Absensi::create([
            'jadwal_kelas_id' => $request->jadwal_kelas_id,
            'mahasiswa_id' => $request->mahasiswa_id,
            'pertemuan_ke' => $request->pertemuan_ke,
            'tanggal_absensi' => $request->tanggal_absensi,
            'status_absensi' => $request->status_absensi,
            'keterangan' => $request->keterangan,
            'diabsen_oleh' => Auth::user()->id,
        ]);

        return back()->with('success', 'Absensi berhasil disimpan.');
    }
}

