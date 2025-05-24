@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Dashboard Dosen</h1>

    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Tambah Jadwal --}}
    <div class="bg-white shadow rounded p-6 mb-8">
        <h2 class="text-xl font-semibold mb-4">Tambah Jadwal Kuliah</h2>
        <form action="{{ route('jadwal-kelas.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="kode_mata_kuliah" placeholder="Kode Mata Kuliah" class="border rounded p-2" required>
                <input type="text" name="nama_mata_kuliah" placeholder="Nama Mata Kuliah" class="border rounded p-2" required>
                <select name="hari" class="border rounded p-2" required>
                    <option value="">Pilih Hari</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                </select>
                <input type="time" name="jam_mulai" class="border rounded p-2" required>
                <input type="time" name="jam_selesai" class="border rounded p-2" required>
                <input type="text" name="ruangan" placeholder="Ruangan" class="border rounded p-2" required>
                <input type="number" name="jumlah_pertemuan" placeholder="Jumlah Pertemuan" class="border rounded p-2" required>
                <select name="mahasiswa_pjmk_id" class="border rounded p-2" required>
                    <option value="">Pilih PJMK</option>
                    @foreach ($mahasiswa as $mhs)
                        <option value="{{ $mhs->id }}">{{ $mhs->nama_lengkap }} ({{ $mhs->nim }})</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Jadwal</button>
        </form>
    </div>

    {{-- Jadwal Dosen --}}
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-semibold mb-4">Jadwal Saya</h2>
        @if ($jadwalSaya->isEmpty())
            <p class="text-gray-600">Belum ada jadwal ditambahkan.</p>
        @else
            <table class="w-full table-auto border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">Mata Kuliah</th>
                        <th class="border px-4 py-2">Hari</th>
                        <th class="border px-4 py-2">Jam</th>
                        <th class="border px-4 py-2">Ruangan</th>
                        <th class="border px-4 py-2">PJMK</th>
                        <th class="border px-4 py-2">Rekap</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwalSaya as $jadwal)
                        <tr>
                            <td class="border px-4 py-2">{{ $jadwal->nama_mata_kuliah }}</td>
                            <td class="border px-4 py-2">{{ $jadwal->hari }}</td>
                            <td class="border px-4 py-2">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                            <td class="border px-4 py-2">{{ $jadwal->ruangan }}</td>
                            <td class="border px-4 py-2">{{ $jadwal->mahasiswaPJMK->nama_lengkap ?? '-' }}</td>
                            <td class="border px-4 py-2 text-center">
                                <a href="{{ route('rekap.absensi', $jadwal->id) }}" class="text-blue-600 hover:underline">Lihat</a>
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <a href="{{ route('jadwal-kelas.edit', $jadwal->id) }}" class="text-yellow-600 hover:underline mr-2">Edit</a>
                                <form action="{{ route('jadwal-kelas.destroy', $jadwal->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Yakin hapus jadwal ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
