@extends('layouts.app')

@section('title', 'Detail Jadwal Kelas')
@section('page_title', 'Detail Jadwal Kelas')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-xl font-semibold mb-4">Detail Jadwal Kelas: {{ $jadwal_kelas->nama_mata_kuliah }} ({{ $jadwal_kelas->kode_mata_kuliah }})</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p><strong>Dosen Pengampu:</strong> {{ $jadwal_kelas->dosen->nama_lengkap ?? '-' }}</p>
                <p><strong>Kode Mata Kuliah:</strong> {{ $jadwal_kelas->kode_mata_kuliah }}</p>
                <p><strong>Nama Mata Kuliah:</strong> {{ $jadwal_kelas->nama_mata_kuliah }}</p>
                <p><strong>Hari:</strong> {{ $jadwal_kelas->hari }}</p>
                <p><strong>Jam:</strong> {{ \Carbon\Carbon::parse($jadwal_kelas->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal_kelas->jam_selesai)->format('H:i') }}</p>
                <p><strong>Ruangan:</strong> {{ $jadwal_kelas->ruangan ?? '-' }}</p>
                <p><strong>Jumlah Pertemuan:</strong> {{ $jadwal_kelas->jumlah_pertemuan }}</p>
                <p><strong>PJ MK:</strong> {{ $jadwal_kelas->penanggungJawabMk ? $jadwal_kelas->penanggungJawabMk->nama_lengkap . ' (' . $jadwal_kelas->penanggungJawabMk->nim . ')' : '-' }}</p>
            </div>
        </div>

        <div class="mt-6 flex gap-4">
            <a href="{{ route('dosen.jadwal_kelas.edit', $jadwal_kelas->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded text-sm">
                Edit Jadwal
            </a>
            <a href="{{ route('dosen.jadwal_kelas.absensi.form', $jadwal_kelas->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
                Kelola Absensi
            </a>
            <a href="{{ route('dosen.jadwal_kelas.absensi.list', $jadwal_kelas->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm">
                Lihat Rekap Absensi
            </a>
            <a href="{{ route('dosen.jadwal_kelas.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800 py-2 px-4">
                Kembali ke Daftar Jadwal
            </a>
        </div>
    </div>
@endsection