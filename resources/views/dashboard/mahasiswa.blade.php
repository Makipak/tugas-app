@extends('layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Selamat Datang, {{ $mahasiswa->nama_lengkap }}</h2>

    <h3 class="text-lg font-semibold mb-2">📚 Jadwal Mata Kuliah</h3>
    <ul class="mb-6">
        @foreach($jadwal as $j)
            <li>{{ $j->nama_mata_kuliah }} - {{ $j->hari }} ({{ $j->jam_mulai }} - {{ $j->jam_selesai }})</li>
        @endforeach
    </ul>

    <h3 class="text-lg font-semibold mb-2">📝 Rekap Absensi</h3>
    <ul class="mb-6">
        @forelse($rekapAbsensi as $absen)
    <li>Pertemuan ke-{{ $absen->pertemuan_ke }} - {{ $absen->status_absensi }}</li>
        @empty
    <li>Belum ada data absensi.</li>
        @endforelse
    </ul>

    @foreach($jadwal as $j)
    @if($j->mahasiswa_pjmk_id === $mahasiswa->id)
        <a href="{{ route('absensi.form', ['jadwalId' => $j->id]) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Absensi {{ $j->nama_mata_kuliah }}
        </a>
    @endif
@endforeach
</div>
@endsection
