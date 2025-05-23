<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal_kelas', function (Blueprint $table) {
            $table->string('kode_mata_kuliah', 20);
            $table->string('nama_mata_kuliah', 100);
            $table->foreignId('dosen_id')->constrained('dosen')->onDelete('cascade');
            $table->enum('hari', ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('ruangan')->nullable();
            $table->integer('jumlah_pertemuan');
            $table->foreignId('mahasiswa_pjmk_id')->nullable()->constrained('mahasiswa')->onDelete('set null');
            $table->timestamps();
            $table->id();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kelas');
    }
};
