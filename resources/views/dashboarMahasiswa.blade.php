@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')
@section('page_title', 'Dashboard Mahasiswa')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Selamat Datang di Dashboard Mahasiswa, {{ Auth::user()->mahasiswa->nama_lengkap ?? Auth::user()->username }}!</h2>
        <p class="text-gray-700">Ini adalah halaman dashboard khusus untuk mahasiswa. Di sini Anda bisa melihat jadwal mata kuliah dan riwayat absensi Anda.</p>
        {{-- Tambahkan konten spesifik mahasiswa di sini --}}
        <div class="mt-4">
            <h3 class="text-lg font-semibold mb-2">Informasi Anda:</h3>
            <p><strong>NIM:</strong> {{ Auth::user()->mahasiswa->nim ?? '-' }}</p>
            <p><strong>Jurusan:</strong> {{ Auth::user()->mahasiswa->jurusan ?? '-' }}</p>
            <p><strong>Angkatan:</strong> {{ Auth::user()->mahasiswa->angkatan ?? '-' }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        </div>
    </div>
@endsection