<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Profil Laboratorium
        Schema::create('profil_laboratorium', function (Blueprint $table) {
            $table->id();
            $table->string('jabatan'); // kaprodi, kepala_lab, sekretaris, laboran
            $table->string('nama');
            $table->string('gelar')->nullable();
            $table->string('foto_path')->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Statistik Umum (Hero numbers)
        Schema::create('statistik_umum', function (Blueprint $table) {
            $table->id();
            $table->string('key', 50)->unique();
            $table->string('label', 100);
            $table->string('nilai', 20);
            $table->string('satuan', 30)->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 3. Dosen Riset
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip')->nullable();
            $table->string('foto_path')->nullable();
            $table->string('prodi')->default('S1'); // S1, S2, S1,S2
            $table->string('keahlian')->nullable();
            $table->string('bidang_minat')->nullable(); // datascience, software, governance
            $table->string('no_telp', 30)->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 4. Ruang Lab
        Schema::create('ruang_lab', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10); // A, B, C, D
            $table->string('nama_ruang');
            $table->integer('kapasitas_pc')->default(0);
            $table->string('lokasi')->nullable();
            $table->text('deskripsi')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 5. Mata Kuliah Praktikum
        Schema::create('mata_kuliah_praktikum', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ruang_lab_id')->nullable()->constrained('ruang_lab')->nullOnDelete();
            $table->string('nama');
            $table->integer('semester');
            $table->integer('sks')->default(2);
            $table->string('status')->default('aktif'); // aktif, selesai, belum_mulai
            $table->timestamps();
        });

        // 6. Modul Praktikum
        Schema::create('modul_praktikum', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliah_praktikum')->cascadeOnDelete();
            $table->string('judul');
            $table->string('file_path');
            $table->string('versi', 20)->default('1.0');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        // 7. Layanan
        Schema::create('layanan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('deskripsi_singkat')->nullable();
            $table->text('deskripsi_lengkap')->nullable();
            $table->string('foto_path')->nullable();
            $table->string('sasaran')->default('mahasiswa'); // mahasiswa, dosen, umum
            $table->json('cakupan')->nullable(); // bullet points
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 8. Fasilitas (Inventaris & Fasilitas Lab)
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('deskripsi_singkat')->nullable();
            $table->text('deskripsi_lengkap')->nullable();
            $table->string('foto_path')->nullable();
            $table->string('kategori')->default('Fasilitas Ruang'); // Alat / Ruang / Inventaris
            $table->string('sasaran')->default('mahasiswa');
            $table->json('cakupan')->nullable();
            $table->enum('status_ketersediaan', ['Tersedia', 'Sedang Dipinjam', 'Perbaikan'])->default('Tersedia');
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 9. FAQ
        Schema::create('faq', function (Blueprint $table) {
            $table->id();
            $table->string('halaman')->default('umum'); // layanan, fasilitas, riset, komunitas, umum
            $table->text('pertanyaan');
            $table->text('jawaban');
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 10. SOP Poin
        Schema::create('sop_poin', function (Blueprint $table) {
            $table->id();
            $table->string('halaman')->default('fasilitas'); // fasilitas, layanan
            $table->text('isi');
            $table->integer('urutan')->default(0);
            $table->string('icon_type', 50)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 11. Asesmen Pertanyaan
        Schema::create('asesmen_pertanyaan', function (Blueprint $table) {
            $table->id();
            $table->text('pertanyaan');
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 12. Asesmen Opsi
        Schema::create('asesmen_opsi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pertanyaan_id')->constrained('asesmen_pertanyaan')->cascadeOnDelete();
            $table->text('teks');
            $table->string('nilai_bidang', 50); // datascience, software, governance
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // 13. Events
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('kategori')->default('Workshop'); // Workshop, Praktikum, Sharing Session
            $table->string('status')->default('Akan Datang'); // Akan Datang, Berlangsung, Selesai
            $table->string('status_registrasi')->default('Open'); // Open, Closed
            $table->date('tanggal');
            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable();
            $table->string('lokasi')->default('Laboratorium Sistem Informasi');
            $table->text('deskripsi')->nullable();
            $table->string('thumbnail_path')->nullable();
            $table->string('mentor_nama')->nullable();
            $table->string('mentor_role')->nullable();
            $table->string('mentor_avatar_path')->nullable();
            $table->integer('kuota_total')->default(50);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 14. Event Registrations
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nama');
            $table->string('nim', 30);
            $table->string('email');
            $table->string('angkatan', 10)->nullable();
            $table->string('status')->default('pending'); // pending, confirmed, cancelled
            $table->timestamp('registered_at')->useCurrent();
            $table->timestamps();

            $table->unique(['event_id', 'nim']);
        });

        // 15. Event Materials (Arsip & Dokumen)
        Schema::create('event_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->string('nama');
            $table->string('tipe', 20)->default('pdf'); // pdf, ppt, video, link
            $table->string('file_path')->nullable();
            $table->string('github_url')->nullable();
            $table->timestamps();
        });

        // 16. Threads (Komunitas)
        Schema::create('threads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('author_nama');
            $table->string('author_role')->default('Mahasiswa');
            $table->string('author_avatar_path')->nullable();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('body');
            $table->string('kategori')->default('Lainnya'); // Laravel, Database, Web Development, Lainnya
            $table->string('code_language', 50)->nullable();
            $table->text('code_content')->nullable();
            $table->boolean('is_solved')->default(false);
            $table->integer('views_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // 17. Thread Votes
        Schema::create('thread_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('thread_id')->constrained('threads')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('voter_ip', 45)->nullable();
            $table->string('tipe', 10)->default('up'); // up, down
            $table->timestamps();

            $table->index(['thread_id', 'voter_ip']);
        });

        // 18. Thread Tags
        Schema::create('thread_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('thread_id')->constrained('threads')->cascadeOnDelete();
            $table->string('tag', 50);
            $table->timestamps();
        });

        // 19. Pengajuan Layanan
        Schema::create('pengajuan_layanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('jenis', 30)->default('layanan'); // layanan, fasilitas
            $table->unsignedBigInteger('referensi_id')->nullable();
            $table->string('nama');
            $table->string('email');
            $table->string('nim_nip', 30);
            $table->text('pesan')->nullable();
            $table->string('status', 30)->default('pending'); // pending, diproses, selesai, ditolak
            $table->text('catatan_admin')->nullable();
            $table->timestamp('submitted_at')->useCurrent();
            $table->timestamps();
        });

        // 20. Peminjaman Fasilitas & Alat (Khusus dikelola Admin/Laboran)
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('fasilitas_id')->nullable()->constrained('fasilitas')->nullOnDelete();
            $table->string('nama_alat_ruang');
            $table->string('nama_peminjam');
            $table->string('nim_nip', 30);
            $table->string('email')->nullable();
            $table->string('no_telp', 30)->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->string('durasi')->nullable();
            $table->text('keperluan');
            $table->string('status', 30)->default('Pending'); // Pending, Disetujui, Ditolak, Selesai
            $table->text('catatan_laboran')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
        Schema::dropIfExists('pengajuan_layanan');
        Schema::dropIfExists('thread_tags');
        Schema::dropIfExists('thread_votes');
        Schema::dropIfExists('threads');
        Schema::dropIfExists('event_materials');
        Schema::dropIfExists('event_registrations');
        Schema::dropIfExists('events');
        Schema::dropIfExists('asesmen_opsi');
        Schema::dropIfExists('asesmen_pertanyaan');
        Schema::dropIfExists('sop_poin');
        Schema::dropIfExists('faq');
        Schema::dropIfExists('fasilitas');
        Schema::dropIfExists('layanan');
        Schema::dropIfExists('modul_praktikum');
        Schema::dropIfExists('mata_kuliah_praktikum');
        Schema::dropIfExists('ruang_lab');
        Schema::dropIfExists('dosen');
        Schema::dropIfExists('statistik_umum');
        Schema::dropIfExists('profil_laboratorium');
    }
};

