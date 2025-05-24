<?php

namespace App\Http\Controllers;

use App\Models\{Absensi, Mahasiswa, JadwalKelas, Dosen};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalKelasController extends Controller
{
    public function index()
    {
    $user = Auth::user();
    $dosen = $user->dosen;

    $jadwalSaya = JadwalKelas::where('dosen_id', $dosen->id)->get();
    $mahasiswa = Mahasiswa::all();

    return view('dashboard.dosen', compact('jadwalSaya', 'mahasiswa'));
    }


    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        return view('dashboard.dosen', compact('mahasiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mata_kuliah' => 'required',
            'nama_mata_kuliah' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruangan' => 'required',
            'jumlah_pertemuan' => 'required|integer',
            'mahasiswa_pjmk_id' => 'required',
        ]);

        $dosen = Auth::user()->dosen;

        JadwalKelas::create([
            'kode_mata_kuliah' => $request->kode_mata_kuliah,
            'nama_mata_kuliah' => $request->nama_mata_kuliah,
            'dosen_id' => $dosen->id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ruangan' => $request->ruangan,
            'jumlah_pertemuan' => $request->jumlah_pertemuan,
            'mahasiswa_pjmk_id' => $request->mahasiswa_pjmk_id,
        ]);

        return redirect()->route('jadwal-kelas.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function show($id)
    {
        $jadwal = JadwalKelas::findOrFail($id);
        return view('dashboard.dosen', compact('jadwal'));
    }

    public function edit($id)
    {
    $jadwal = JadwalKelas::findOrFail($id);
    $mahasiswas = Mahasiswa::all();

    return view('jadwal.edit', compact('jadwal', 'mahasiswas'));
    }



    public function update(Request $request, $id)
    {
        $jadwal = JadwalKelas::findOrFail($id);

        $request->validate([
            'kode_mata_kuliah' => 'required',
            'nama_mata_kuliah' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruangan' => 'required',
            'jumlah_pertemuan' => 'required|integer',
            'mahasiswa_pjmk_id' => 'required',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('jadwal-kelas.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function updateInline(Request $request, $id)
{
    $jadwal = JadwalKelas::findOrFail($id);
    $jadwal->update([
        'hari' => $request->hari,
        'jam_mulai' => $request->jam_mulai,
        'jam_selesai' => $request->jam_selesai,
        'ruangan' => $request->ruangan,
        'mahasiswa_pjmk_id' => $request->mahasiswa_pjmk_id,
    ]);

    return redirect()->route('dashboard.dosen')->with('success', 'Jadwal berhasil diupdate!');
}


    public function destroy($id)
    {
        $jadwal = JadwalKelas::findOrFail($id);
        $jadwal->delete();

        return back()->with('success', 'Jadwal berhasil dihapus.');
    }
}
