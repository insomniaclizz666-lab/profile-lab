<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tambah detail jadwal ke mata_kuliah_praktikum
        Schema::table('mata_kuliah_praktikum', function (Blueprint $table) {
            if (!Schema::hasColumn('mata_kuliah_praktikum', 'hari')) {
                $table->string('hari', 20)->nullable()->default('Senin');
            }
            if (!Schema::hasColumn('mata_kuliah_praktikum', 'jam_mulai')) {
                $table->time('jam_mulai')->nullable()->default('08:00:00');
            }
            if (!Schema::hasColumn('mata_kuliah_praktikum', 'jam_selesai')) {
                $table->time('jam_selesai')->nullable()->default('10:30:00');
            }
            if (!Schema::hasColumn('mata_kuliah_praktikum', 'kelas')) {
                $table->string('kelas', 10)->nullable()->default('A');
            }
            if (!Schema::hasColumn('mata_kuliah_praktikum', 'dosen_pengampu')) {
                $table->string('dosen_pengampu')->nullable();
            }
        });

        // 2. Tambah detail jadwal dan ruang lab ke peminjaman
        Schema::table('peminjaman', function (Blueprint $table) {
            if (!Schema::hasColumn('peminjaman', 'ruang_lab_id')) {
                $table->foreignId('ruang_lab_id')->nullable()->constrained('ruang_lab')->nullOnDelete();
            }
            if (!Schema::hasColumn('peminjaman', 'jam_mulai')) {
                $table->string('jam_mulai', 10)->nullable()->default('08:00');
            }
            if (!Schema::hasColumn('peminjaman', 'jam_selesai')) {
                $table->string('jam_selesai', 10)->nullable()->default('12:00');
            }
            if (!Schema::hasColumn('peminjaman', 'sesi')) {
                $table->string('sesi', 50)->nullable()->default('Pagi (08:00 - 12:00)');
            }
        });
    }

    public function down(): void
    {
        Schema::table('mata_kuliah_praktikum', function (Blueprint $table) {
            $table->dropColumn(['hari', 'jam_mulai', 'jam_selesai', 'kelas', 'dosen_pengampu']);
        });

        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropForeign(['ruang_lab_id']);
            $table->dropColumn(['ruang_lab_id', 'jam_mulai', 'jam_selesai', 'sesi']);
        });
    }
};

