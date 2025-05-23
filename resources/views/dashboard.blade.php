@extends('layouts.app')

@section('title', 'Dashboard Umum')
@section('page_title', 'Dashboard Umum')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Selamat Datang di Dashboard Umum!</h2>
        <p class="text-gray-700">
            Ini adalah halaman dashboard yang dapat diakses oleh semua pengguna yang terautentikasi.
        </p>
        <p class="mt-4">
            Role Anda saat ini: <span class="font-bold text-blue-600">{{ Auth::user()->role }}</span>
        </p>
    </div>

    {{-- Contoh Stats Card --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-800">Total Mahasiswa</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">1200</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-800">Total Dosen</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">75</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-800">Mata Kuliah Aktif</h3>
            <p class="text-3xl font-bold text-yellow-600 mt-2">45</p>
        </div>
    </div>
@endsection
