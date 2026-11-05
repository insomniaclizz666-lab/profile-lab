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
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('kategori')->default('Berita'); // Berita, Pengumuman, Agenda
            $table->text('ringkasan')->nullable();
            $table->longText('isi');
            $table->string('penulis')->default('Admin Lab SI');
            $table->string('foto_path')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->integer('views')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('galeri', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('kategori')->default('Praktikum'); // Praktikum, Workshop, Riset
            $table->string('foto_path')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('testimoni', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('role')->default('Mahasiswa'); // Mahasiswa, Asisten Lab, Alumni
            $table->string('angkatan')->nullable(); // misal "Angkatan 2022"
            $table->text('kutipan');
            $table->string('foto_path')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimoni');
        Schema::dropIfExists('galeri');
        Schema::dropIfExists('berita');
    }
};

