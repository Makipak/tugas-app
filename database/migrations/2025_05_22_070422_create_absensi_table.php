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
        Schema::table('absensi', function (Blueprint $table) {
            // Pastikan kolomnya unsignedBigInteger dulu
            $table->unsignedBigInteger('jadwal_kelas_id')->change();
            $table->unsignedBigInteger('mahasiswa_id')->change();

            // Tambah foreign key constraint
            $table->foreign('jadwal_kelas_id')->references('id')->on('jadwal_kelas')->onDelete('cascade');
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('absensi', function (Blueprint $table) {
            $table->dropForeign(['jadwal_kelas_id']);
            $table->dropForeign(['mahasiswa_id']);
        });
    }
};
