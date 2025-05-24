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

@forelse($rekapAbsensi as $jadwalId => $absensis)
    <div class="mb-4">
        <h4 class="font-bold">{{ optional($absensis->first()->jadwalKelas)->nama_mata_kuliah }}</h4>
        <ul class="list-disc ml-6">
            @foreach ($absensis as $absen)
                <li>Pertemuan ke-{{ $absen->pertemuan_ke }} - {{ $absen->status_absensi }} ({{ $absen->tanggal_absensi }})</li>
            @endforeach
        </ul>
    </div>
@empty
    <p>Belum ada data absensi.</p>
@endforelse



    @foreach($jadwal as $j)
    @if($j->mahasiswa_pjmk_id === $mahasiswa->id)
        <a href="{{ route('absensi.form', ['jadwalId' => $j->id]) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Absensi {{ $j->nama_mata_kuliah }}
        </a>
    @endif
@endforeach
</div>
@endsection
