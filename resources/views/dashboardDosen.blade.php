@extends('layouts.app')

@section('title', 'Dashboard Dosen')
@section('page_title', 'Dashboard Dosen')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-xl font-semibold mb-4">Selamat Datang, Dosen {{ $dosen->nama_lengkap ?? Auth::user()->username }}!</h2>
        <p class="text-gray-700">
            Ini adalah dashboard khusus Anda sebagai dosen. Di sini Anda bisa melihat ringkasan jadwal kelas dan mengelola absensi.
        </p>
        <div class="mt-4 border-t pt-4">
            <h3 class="text-lg font-semibold mb-2">Informasi Pribadi:</h3>
            <p><strong>NIDN:</strong> {{ $dosen->nidn ?? '-' }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Bidang Keahlian:</strong> {{ $dosen->bidang_keahlian ?? '-' }}</p>
        </div>
    </div>

    <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">Kelas yang Anda Ajar</h3>
            <a href="{{ route('dosen.jadwal_kelas.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
                Kelola Semua Jadwal
            </a>
        </div>

        @if($jadwalKelas->isEmpty())
            <p class="text-gray-600">Anda belum memiliki jadwal kelas yang terdaftar.</p>
            <p class="text-gray-600 mt-2">Silakan <a href="{{ route('dosen.jadwal_kelas.create') }}" class="text-blue-600 hover:underline font-semibold">tambah jadwal kelas baru</a>.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Kode MK
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Mata Kuliah
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Jadwal
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                PJ MK
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwalKelas as $jadwal)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $jadwal->kode_mata_kuliah }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $jadwal->nama_mata_kuliah }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $jadwal->hari }}, {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }} ({{ $jadwal->ruangan }})</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ $jadwal->penanggungJawabMk ? $jadwal->penanggungJawabMk->nama_lengkap . ' (' . $jadwal->penanggungJawabMk->nim . ')' : '-' }}
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <a href="{{ route('dosen.jadwal_kelas.show', $jadwal->id) }}" class="text-purple-600 hover:text-purple-900 font-medium mr-2">Detail</a>
                                <a href="{{ route('dosen.jadwal_kelas.absensi.form', $jadwal->id) }}" class="text-blue-600 hover:text-blue-900 font-medium">Kelola Absensi</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 text-right">
                <a href="{{ route('dosen.jadwal_kelas.create') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">
                    + Tambah Jadwal Kelas Baru
                </a>
            </div>
        @endif
    </div>
@endsection