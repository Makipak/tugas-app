<h2>Edit Jadwal: {{ $jadwal->mata_kuliah }}</h2>

<form action="{{ route('jadwal-kelas.update', $jadwal->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Hari</label>
    <input type="text" name="hari" value="{{ $jadwal->hari }}">

    <label>Jam</label>
    <input type="text" name="jam" value="{{ $jadwal->jam }}">

    <label>Penanggung Jawab</label>
    <select name="pjmk_id">
        @foreach ($mahasiswas as $mhs)
            <option value="{{ $mhs->id }}" {{ $jadwal->pjmk_id == $mhs->id ? 'selected' : '' }}>
                {{ $mhs->nama_lengkap }}
            </option>
        @endforeach
    </select>

    <button type="submit">Update</button>
</form>
