@extends('layouts.app')

@section('title', 'Rekap Absensi Kelas')
@section('page_title', 'Rekap Absensi Kelas')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-xl font-semibold mb-4">Rekap Absensi Kelas: {{ $jadwal_kelas->nama_mata_kuliah }}</h2>
        <p><strong>Dosen:</strong> {{ $jadwal_kelas->dosen->nama_lengkap ?? '-' }}</p>
        <p><strong>Hari, Jam:</strong> {{ $jadwal_kelas->hari }}, {{ \Carbon\Carbon::parse($jadwal_kelas->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal_kelas->jam_selesai)->format('H:i') }}</p>
        <p><strong>Total Pertemuan:</strong> {{ $jadwal_kelas->jumlah_pertemuan }}</p>
    </div>

    <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold mb-4">Daftar Rekap Absensi</h3>

        @if($absensiRecords->isEmpty())
            <p class="text-gray-600">Belum ada data absensi untuk kelas ini.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Pertemuan Ke-
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Tanggal Absensi
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Mahasiswa
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                NIM
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Catatan
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($absensiRecords as $absensi)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $absensi->pertemuan_ke }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ \Carbon\Carbon::parse($absensi->tanggal_absensi)->format('d M Y') }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $absensi->mahasiswa->nama_lengkap ?? '-' }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $absensi->mahasiswa->nim ?? '-' }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ ucfirst($absensi->status) }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $absensi->catatan ?? '-' }}</p>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="mt-4 text-right">
            <a href="{{ route('dosen.jadwal_kelas.show', $jadwal_kelas->id) }}" class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800">
                Kembali ke Detail Jadwal
            </a>
        </div>
    </div>
@endsection