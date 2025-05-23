@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">Input Absensi Mahasiswa</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('absensi.store') }}" method="POST">
        @csrf
        <input type="hidden" name="jadwal_kelas_id" value="{{ $jadwal->id }}">
        <input type="hidden" name="pertemuan_ke" value="{{ $pertemuanKe }}">
        <input type="hidden" name="tanggal_absensi" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">

        <table class="w-full table-auto mb-6">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">Nama Mahasiswa</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswa as $mhs)
                <tr>
                    <td class="border px-4 py-2">{{ $mhs->nama_lengkap }}</td>
                    <td class="border px-4 py-2">
                        <select name="status_absensi[{{ $mhs->id }}]" class="border rounded p-1 w-full">
                            <option value="Hadir">Hadir</option>
                            <option value="Izin">Izin</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Alpha">Alpha</option>
                        </select>
                        <input type="hidden" name="mahasiswa_id[]" value="{{ $mhs->id }}">
                    </td>
                    <td class="border px-4 py-2">
                        <input type="text" name="keterangan[{{ $mhs->id }}]" placeholder="Opsional..." class="w-full border rounded p-1">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Absensi</button>
    </form>
</div>
@endsection
