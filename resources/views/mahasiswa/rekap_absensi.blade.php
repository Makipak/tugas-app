@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">Rekap Absensi Saya</h2>

    <table class="w-full table-auto">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2">Pertemuan</th>
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absensi as $absen)
            <tr>
                <td class="border px-4 py-2">{{ $absen->pertemuan_ke }}</td>
                <td class="border px-4 py-2">{{ $absen->tanggal_absensi }}</td>
                <td class="border px-4 py-2">{{ $absen->status_absensi }}</td>
                <td class="border px-4 py-2">{{ $absen->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
