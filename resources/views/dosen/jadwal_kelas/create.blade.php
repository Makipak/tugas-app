@extends('layouts.app')

@section('title', 'Tambah Jadwal Kelas Baru')
@section('page_title', 'Tambah Jadwal Kelas Baru')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Tambah Jadwal Kelas Baru</h2>

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

        <form action="{{ route('dosen.jadwal_kelas.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="kode_mata_kuliah" class="block text-gray-700 text-sm font-bold mb-2">Kode Mata Kuliah:</label>
                <input type="text" name="kode_mata_kuliah" id="kode_mata_kuliah" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('kode_mata_kuliah') border-red-500 @enderror" value="{{ old('kode_mata_kuliah') }}" required>
                @error('kode_mata_kuliah')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nama_mata_kuliah" class="block text-gray-700 text-sm font-bold mb-2">Nama Mata Kuliah:</label>
                <input type="text" name="nama_mata_kuliah" id="nama_mata_kuliah" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_mata_kuliah') border-red-500 @enderror" value="{{ old('nama_mata_kuliah') }}" required>
                @error('nama_mata_kuliah')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="hari" class="block text-gray-700 text-sm font-bold mb-2">Hari:</label>
                <select name="hari" id="hari" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('hari') border-red-500 @enderror" required>
                    <option value="">Pilih Hari</option>
                    <option value="Senin" {{ old('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                    <option value="Selasa" {{ old('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                    <option value="Rabu" {{ old('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                    <option value="Kamis" {{ old('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                    <option value="Jumat" {{ old('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                    <option value="Sabtu" {{ old('hari') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                    <option value="Minggu" {{ old('hari') == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                </select>
                @error('hari')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="jam_mulai" class="block text-gray-700 text-sm font-bold mb-2">Jam Mulai:</label>
                    <input type="time" name="jam_mulai" id="jam_mulai" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('jam_mulai') border-red-500 @enderror" value="{{ old('jam_mulai') }}" required>
                    @error('jam_mulai')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="jam_selesai" class="block text-gray-700 text-sm font-bold mb-2">Jam Selesai:</label>
                    <input type="time" name="jam_selesai" id="jam_selesai" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('jam_selesai') border-red-500 @enderror" value="{{ old('jam_selesai') }}" required>
                    @error('jam_selesai')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="ruangan" class="block text-gray-700 text-sm font-bold mb-2">Ruangan (Opsional):</label>
                <input type="text" name="ruangan" id="ruangan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('ruangan') border-red-500 @enderror" value="{{ old('ruangan') }}">
                @error('ruangan')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jumlah_pertemuan" class="block text-gray-700 text-sm font-bold mb-2">Jumlah Pertemuan:</label>
                <input type="number" name="jumlah_pertemuan" id="jumlah_pertemuan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('jumlah_pertemuan') border-red-500 @enderror" value="{{ old('jumlah_pertemuan', 16) }}" required min="1">
                @error('jumlah_pertemuan')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="penanggung_jawab_mk_id" class="block text-gray-700 text-sm font-bold mb-2">Penanggung Jawab Mata Kuliah (Opsional):</label>
                <select name="penanggung_jawab_mk_id" id="penanggung_jawab_mk_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('penanggung_jawab_mk_id') border-red-500 @enderror">
                    <option value="">-- Pilih Mahasiswa --</option>
                    @foreach($mahasiswaList as $mahasiswa)
                        <option value="{{ $mahasiswa->id }}" {{ old('penanggung_jawab_mk_id') == $mahasiswa->id ? 'selected' : '' }}>
                            {{ $mahasiswa->nama_lengkap }} ({{ $mahasiswa->nim }})
                        </option>
                    @endforeach
                </select>
                @error('penanggung_jawab_mk_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Simpan Jadwal
                </button>
                <a href="{{ route('dosen.jadwal_kelas.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection