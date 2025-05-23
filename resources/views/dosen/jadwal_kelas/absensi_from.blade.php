@extends('layouts.app')

@section('title', 'Kelola Absensi Kelas')
@section('page_title', 'Kelola Absensi Kelas')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-xl font-semibold mb-4">Absensi Kelas: {{ $jadwal_kelas->nama_mata_kuliah }}</h2>
        <p><strong>Dosen:</strong> {{ $jadwal_kelas->dosen->nama_lengkap ?? '-' }}</p>
        <p><strong>Hari, Jam:</strong> {{ $jadwal_kelas->hari }}, {{ \Carbon\Carbon::parse($jadwal_kelas->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal_kelas->jam_selesai)->format('H:i') }}</p>
        <p><strong>Ruangan:</strong> {{ $jadwal_kelas->ruangan ?? '-' }}</p>
    </div>

    <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold mb-4">Input Absensi Pertemuan</h3>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                <ul class="mt-3 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dosen.jadwal_kelas.absensi.store', $jadwal_kelas->id) }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="pertemuan_ke" class="block text-gray-700 text-sm font-bold mb-2">Pertemuan Ke-:</label>
                    <input type="number" name="pertemuan_ke" id="pertemuan_ke" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('pertemuan_ke') border-red-500 @enderror" value="{{ old('pertemuan_ke', $absensiHariIni->first()->pertemuan_ke ?? '') }}" min="1" max="{{ $jadwal_kelas->jumlah_pertemuan }}" required>
                    @error('pertemuan_ke')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="tanggal_absensi" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Absensi:</label>
                    <input type="date" name="tanggal_absensi" id="tanggal_absensi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tanggal_absensi') border-red-500 @enderror" value="{{ old('tanggal_absensi', \Carbon\Carbon::today()->format('Y-m-d')) }}" required>
                    @error('tanggal_absensi')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="overflow-x-auto mb-6">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Mahasiswa
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Catatan (Opsional)
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswaList as $index => $mahasiswa)
                            @php
                                $currentAbsensi = $absensiHariIni->firstWhere('mahasiswa_id', $mahasiswa->id);
                                $oldStatus = old('absensi.' . $index . '.status', $currentAbsensi->status ?? 'hadir');
                                $oldCatatan = old('absensi.' . $index . '.catatan', $currentAbsensi->catatan ?? '');
                            @endphp
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <input type="hidden" name="absensi[{{ $index }}][mahasiswa_id]" value="{{ $mahasiswa->id }}">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $mahasiswa->nama_lengkap }} ({{ $mahasiswa->nim }})</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <select name="absensi[{{ $index }}][status]" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="hadir" {{ $oldStatus == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                        <option value="sakit" {{ $oldStatus == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                        <option value="izin" {{ $oldStatus == 'izin' ? 'selected' : '' }}>Izin</option>
                                        <option value="alpha" {{ $oldStatus == 'alpha' ? 'selected' : '' }}>Alpha</option>
                                    </select>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <input type="text" name="absensi[{{ $index }}][catatan]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $oldCatatan }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Simpan Absensi
                </button>
                <a href="{{ route('dosen.jadwal_kelas.show', $jadwal_kelas->id) }}" class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800">
                    Kembali
                </a>
            </div>
        </form>
    </div>
@endsection