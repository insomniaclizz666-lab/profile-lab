{{--
    =============================================================================
    HALAMAN KOMUNITAS & FORUM DISKUSI LABORATORIUM
    File: resources/views/pages/komunitas.blade.php
    Dependensi:
      - Font Awesome 6 (CDN disertakan via @push('styles'))
      - ScrollCraft Scroll Animation Library (CDN + Graceful Fallback IntersectionObserver)
      - Tailwind CSS v4 (Utility-First)
    Integrasi Data Laravel:
      - Variabel $threads, $topContributors, $popularTags dapat dikirimkan dari
        HomeController::komunitas() atau dibiarkan menggunakan fallback dummy di Blade.
    =============================================================================
--}}

@extends('layouts.app')

@push('styles')
<!-- Font Awesome 6 CDN untuk Ikonografi Forum -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- ScrollCraft Animation Stylesheet (dengan Graceful Fallback) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/scrollcraft@1.0.1/dist/scrollcraft.min.css" onerror="this.onerror=null; window.scrollCraftStyleFailed=true;">

<style>
    /* Dukungan Animasi ScrollCraft & Fallback IntersectionObserver */
    [data-scrollcraft], [data-sc] {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1), transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        will-change: opacity, transform;
    }

    .sc-visible, [data-scrollcraft].sc-revealed, [data-sc].sc-revealed {
        opacity: 1 !important;
        transform: translateY(0) scale(1) !important;
    }

    /* Animasi Pop Counter Vote */
    .vote-pop {
        animation: votePop 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    @keyframes votePop {
        0% { transform: scale(1); }
        50% { transform: scale(1.3); }
        100% { transform: scale(1); }
    }

    /* Animasi Sisip Thread Baru */
    .thread-enter {
        animation: threadEnter 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes threadEnter {
        0% { opacity: 0; transform: translateY(-20px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    /* Aksesibilitas: prefers-reduced-motion */
    @media (prefers-reduced-motion: reduce) {
        *, ::before, ::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
            scroll-behavior: auto !important;
        }
        [data-scrollcraft], [data-sc] {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }
    }
</style>
@endpush

@section('content')
{{-- Flash Message Notification --}}
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toast = document.getElementById('community-toast');
        const toastMsg = document.getElementById('community-toast-msg');
        if (toast && toastMsg) {
            toastMsg.textContent = '{{ addslashes(session('success')) }}';
            toast.classList.remove('translate-y-24', 'opacity-0', 'pointer-events-none');
            toast.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto');
            setTimeout(() => {
                toast.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
                toast.classList.add('translate-y-24', 'opacity-0', 'pointer-events-none');
            }, 5000);
        }
    });
</script>
@endif
@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toast = document.getElementById('community-toast');
        const toastMsg = document.getElementById('community-toast-msg');
        if (toast && toastMsg) {
            toastMsg.textContent = '{{ addslashes(session('error')) }}';
            const icon = toast.querySelector('.fa-circle-check');
            if (icon) icon.className = 'fa-solid fa-circle-xmark text-lg';
            toast.querySelector('.rounded-xl')?.classList.replace('bg-emerald-500/20', 'bg-rose-500/20');
            toast.querySelector('.rounded-xl')?.classList.replace('text-emerald-400', 'text-rose-400');
            toast.classList.remove('translate-y-24', 'opacity-0', 'pointer-events-none');
            toast.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto');
            setTimeout(() => {
                toast.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
                toast.classList.add('translate-y-24', 'opacity-0', 'pointer-events-none');
            }, 5000);
        }
    });
</script>
@endif
@php
    /**
     * Fallback Data Dummy Komunitas & Forum.
     * Jika Controller mengirimkan $threads, $topContributors, atau $popularTags,
     * Blade akan memprioritaskan data database tersebut.
     */
    $threads = $threads ?? [
        [
            'id' => 1,
            'title' => 'Cara mengatasi error SQLSTATE[23000]: Integrity constraint violation saat migrasi foreign key di Laravel 11?',
            'slug' => 'mengatasi-error-sqlstate-integrity-constraint-laravel-11',
            'body' => 'Saat menjalankan php artisan migrate:fresh pada modul peminjaman inventaris laboratorium, saya selalu mendapatkan error foreign key constraint fails. Apakah urutan nama tabel pada skema migrasi mempengaruhi dependency injection relasi database MySQL?',
            'author' => [
                'name' => 'Dimas Arya Putra',
                'role' => 'Mahasiswa',
                'avatar' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=160&q=80',
            ],
            'created_at' => '2026-10-29 17:30:00',
            'time_relative' => '2 jam lalu',
            'votes_count' => 18,
            'replies_count' => 6,
            'views_count' => 342,
            'is_solved' => true,
            'category' => 'Laravel',
            'tags' => ['Laravel', 'Database', 'MySQL'],
            'code_snippet' => [
                'language' => 'PHP / SQL',
                'code' => "SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row:
a foreign key constraint fails (`wargalab_si`.`peminjaman`, CONSTRAINT `peminjaman_fasilitas_id_foreign`
FOREIGN KEY (`fasilitas_id`) REFERENCES `fasilitas` (`id`) ON DELETE CASCADE)

Schema::create('peminjaman', function (Blueprint \$table) {
    \$table->id();
    \$table->foreignId('fasilitas_id')->constrained('fasilitas')->cascadeOnDelete();
    \$table->string('nim_peminjam', 20);
    \$table->timestamps();
});"
            ],
        ],
        [
            'id' => 2,
            'title' => 'Best practice penanganan asynchronous fetch API & auto refresh JWT token pada Vanilla JavaScript',
            'slug' => 'best-practice-async-fetch-jwt-vanilla-js',
            'body' => 'Saya sedang membangun single-page client untuk portal monitoring IoT Lab Sistem Informasi tanpa framework. Bagaimana arsitektur interceptor yang efisien untuk menangkap response 401 Unauthorized lalu memperbarui access token di latar belakang sebelum mengulang request awal?',
            'author' => [
                'name' => 'Rizky Maulana',
                'role' => 'Asisten Lab',
                'avatar' => 'https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?auto=format&fit=crop&w=160&q=80',
            ],
            'created_at' => '2026-10-29 15:10:00',
            'time_relative' => '4 jam lalu',
            'votes_count' => 31,
            'replies_count' => 12,
            'views_count' => 1240,
            'is_solved' => true,
            'category' => 'Web Development',
            'tags' => ['WebDevelopment', 'JavaScript', 'Keamanan'],
            'code_snippet' => [
                'language' => 'JavaScript',
                'code' => "async function authenticatedFetch(url, options = {}) {
    let token = localStorage.getItem('access_token');
    options.headers = { ...options.headers, 'Authorization': `Bearer \${token}` };

    let response = await fetch(url, options);
    if (response.status === 401) {
        // Request token baru menggunakan refresh token
        const newToken = await refreshToken();
        options.headers['Authorization'] = `Bearer \${newToken}`;
        return fetch(url, options); // Ulangi request
    }
    return response.json();
}"
            ],
        ],
        [
            'id' => 3,
            'title' => 'Diskusi & Rekomendasi Topik Skripsi Bidang Enterprise Architecture & Business Intelligence di Lab SI',
            'slug' => 'rekomendasi-topik-skripsi-enterprise-architecture',
            'body' => 'Halo rekan-rekan civitas laboratorium SI UTM! Bagi mahasiswa semester 7 yang sedang mempersiapkan proposal skripsi, apakah ada bidang studi kasus riil di laboratorium atau instansi mitra yang membutuhkan perancangan TOGAF ADM atau dashboard analitik prediktif?',
            'author' => [
                'name' => 'Dr. Aris Sugiharto, M.Kom.',
                'role' => 'Dosen Pembina',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=160&q=80',
            ],
            'created_at' => '2026-10-29 11:45:00',
            'time_relative' => '8 jam lalu',
            'votes_count' => 45,
            'replies_count' => 24,
            'views_count' => 2850,
            'is_solved' => false,
            'category' => 'Lainnya',
            'tags' => ['Akademik', 'Skripsi', 'Riset'],
            'code_snippet' => null, // Contoh thread tanpa blok kode
        ],
        [
            'id' => 4,
            'title' => 'Optimasi query agregasi PostgreSQL dengan ratusan ribu baris log perangkat: B-Tree vs BRIN Index?',
            'slug' => 'optimasi-query-postgresql-btree-vs-brin-index',
            'body' => 'Untuk tabel server_metrics yang mencatat suhu dan utilisasi CPU komputer lab setiap 5 detik, query range date menjadi lambat. Kapan waktu yang ideal beralih dari B-Tree index standar ke Block Range Index (BRIN) untuk menghemat ruang memori buffer cache?',
            'author' => [
                'name' => 'Bima Kusuma, M.T.',
                'role' => 'Alumni',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=160&q=80',
            ],
            'created_at' => '2026-10-28 20:15:00',
            'time_relative' => 'Kemarin',
            'votes_count' => 14,
            'replies_count' => 5,
            'views_count' => 580,
            'is_solved' => true,
            'category' => 'Database',
            'tags' => ['Database', 'PostgreSQL', 'Optimasi'],
            'code_snippet' => [
                'language' => 'SQL',
                'code' => "-- Pembuatan BRIN Index untuk tabel log metrik berskala besar
CREATE INDEX idx_metrics_recorded_at_brin 
ON server_metrics USING brin (recorded_at) 
WITH (pages_per_range = 128);

EXPLAIN ANALYZE
SELECT device_id, AVG(cpu_usage)
FROM server_metrics
WHERE recorded_at >= '2026-10-01' AND recorded_at < '2026-10-29'
GROUP BY device_id;"
            ],
        ],
        [
            'id' => 5,
            'title' => 'Mengapa Docker container Python FastAPI sering restart dengan exit code 137 pada VPS RAM 1GB?',
            'slug' => 'docker-fastapi-exit-code-137-oom-killed',
            'body' => 'Saat memproses batch upload berkas dataset tugas akhir mahasiswa menggunakan pandas di dalam container Docker, tiba-tiba service mati. Di log tertulis OOMKilled = true. Adakah rekomendasi konfigurasi gunicorn worker dan swap memory yang tepat?',
            'author' => [
                'name' => 'Nabila Rahmawati',
                'role' => 'Asisten Lab',
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=160&q=80',
            ],
            'created_at' => '2026-10-28 14:00:00',
            'time_relative' => 'Kemarin',
            'votes_count' => 9,
            'replies_count' => 3,
            'views_count' => 410,
            'is_solved' => false,
            'category' => 'Python',
            'tags' => ['Python', 'Docker', 'DevOps'],
            'code_snippet' => [
                'language' => 'Bash / Docker',
                'code' => "# Cek status keluar container
docker inspect container_fastapi --format='{{.State.ExitCode}} {{.State.OOMKilled}}'
# Output: 137 true

# Docker Compose limitasi memori berlebih:
services:
  fastapi_app:
    image: labsi/fastapi-analytics:latest
    deploy:
      resources:
        limits:
          memory: 450M"
            ],
        ],
        [
            'id' => 6,
            'title' => 'Mencegah Masalah N+1 Query pada Eloquent Relationship saat memuat riwayat peminjaman',
            'slug' => 'mencegah-masalah-n-plus-1-query-eloquent-laravel',
            'body' => 'Ketika me-render tabel laporan tahunan peminjaman inventaris, query log menunjukkan ada ratusan SELECT query terpisah ke tabel mahasiswa dan fasilitas. Bagaimana cara melakukan eager loading bertingkat dengan kondisi relasi tertentu?',
            'author' => [
                'name' => 'Fahmi Pratama',
                'role' => 'Alumni',
                'avatar' => 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?auto=format&fit=crop&w=160&q=80',
            ],
            'created_at' => '2026-10-27 09:20:00',
            'time_relative' => '2 hari lalu',
            'votes_count' => 22,
            'replies_count' => 8,
            'views_count' => 910,
            'is_solved' => true,
            'category' => 'Laravel',
            'tags' => ['Laravel', 'Database', 'Performance'],
            'code_snippet' => [
                'language' => 'PHP',
                'code' => "// SEBELUM (N+1 Query Issue):
\$peminjaman = Peminjaman::all(); // Melakukan query terpisah per baris

// SESUDAH (Eager Loading Efisien):
\$peminjaman = Peminjaman::with([
    'fasilitas' => function (\$q) {
        \$q->select('id', 'nama_alat', 'lokasi');
    },
    'mahasiswa:id,nim,nama_lengkap'
])->latest()->paginate(25);"
            ],
        ],
    ];

    $topContributors = $topContributors ?? [
        [
            'rank' => 1,
            'name' => 'Rizky Maulana',
            'role' => 'Koordinator Asisten Lab',
            'avatar' => 'https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?auto=format&fit=crop&w=120&q=80',
            'solved_count' => 42,
            'points' => 3850,
        ],
        [
            'rank' => 2,
            'name' => 'Fahmi Pratama, S.Kom.',
            'role' => 'Alumni / Senior Developer',
            'avatar' => 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?auto=format&fit=crop&w=120&q=80',
            'solved_count' => 35,
            'points' => 3120,
        ],
        [
            'rank' => 3,
            'name' => 'Nabila Rahmawati',
            'role' => 'Asisten Lab Data',
            'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=120&q=80',
            'solved_count' => 28,
            'points' => 2480,
        ],
        [
            'rank' => 4,
            'name' => 'Bima Kusuma, M.T.',
            'role' => 'Alumni / DevOps Engineer',
            'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=120&q=80',
            'solved_count' => 21,
            'points' => 1950,
        ],
        [
            'rank' => 5,
            'name' => 'Dimas Arya Putra',
            'role' => 'Mahasiswa Aktif',
            'avatar' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=120&q=80',
            'solved_count' => 16,
            'points' => 1420,
        ],
    ];

    $popularTags = $popularTags ?? [
        ['name' => 'Laravel', 'count' => 54],
        ['name' => 'WebDevelopment', 'count' => 48],
        ['name' => 'Python', 'count' => 36],
        ['name' => 'Database', 'count' => 31],
        ['name' => 'MySQL', 'count' => 24],
        ['name' => 'DevOps', 'count' => 19],
        ['name' => 'Jaringan', 'count' => 15],
        ['name' => 'Skripsi', 'count' => 12],
    ];
@endphp

<main class="w-full text-slate-800 bg-white min-h-screen pb-16">

    <!-- ==========================================
         1. HEADER BANNER KOMUNITAS
         Latar gradient soft blue ke white senada dengan Halaman Riset
         ========================================== -->
    <header class="relative overflow-hidden bg-gradient-to-b from-blue-50/50 via-white to-white py-16 md:py-24 border-b border-slate-100">
        <div class="relative max-w-screen-2xl mx-auto px-8 md:px-16">
            <div class="max-w-4xl mx-auto text-center space-y-5">
                
                <!-- Tagline Kicker Amber -->
                <span data-scrollcraft="fade-up" data-sc="fade-up" data-sc-delay="100" class="inline-block text-xs sm:text-sm font-bold uppercase tracking-[0.2em] text-[#D97706] mb-2">
                    <i class="fa-solid fa-comments text-[#D97706] mr-1.5"></i> Forum Terbuka Civitas Laboratorium SI
                </span>

                <!-- Judul H1 -->
                <h1 data-scrollcraft="fade-up" data-sc="fade-up" data-sc-delay="200" class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-[#1E3A8A] tracking-tight leading-tight uppercase max-w-5xl mx-auto">
                    KOMUNITAS & FORUM DISKUSI
                </h1>

                <!-- Deskripsi -->
                <p data-scrollcraft="fade-up" data-sc="fade-up" data-sc-delay="300" class="text-slate-600 max-w-3xl mx-auto text-base sm:text-lg md:text-xl mt-6 leading-relaxed font-normal">
                    Ruang kolaborasi teknis mahasiswa, asisten lab, dosen, dan alumni untuk memecahkan kendala pemrograman, berbagi snippet kode, dan berdiskusi seputar riset teknologi informasi.
                </p>

                <!-- Box Statistik Ringkas -->
                <div data-scrollcraft="fade-up" data-sc="fade-up" data-sc-delay="400" class="pt-6 max-w-3xl mx-auto">
                    <div class="grid grid-cols-3 gap-3 p-6 sm:p-8 bg-[#EEF5FF] rounded-3xl border border-blue-100 text-center shadow-xs">
                        <div>
                            <span class="block text-3xl sm:text-4xl font-extrabold text-[#1E3A8A] tracking-tight" id="stat-threads-count">{{ count($threads) }}</span>
                            <span class="text-xs sm:text-sm font-bold uppercase tracking-wider text-[#D97706] mt-2 block">Topik Diskusi</span>
                        </div>
                        <div class="border-x border-blue-200/70 px-2 sm:px-4">
                            <span class="block text-3xl sm:text-4xl font-extrabold text-[#1E3A8A] tracking-tight">450+</span>
                            <span class="text-xs sm:text-sm font-bold uppercase tracking-wider text-[#D97706] mt-2 block">Anggota Aktif</span>
                        </div>
                        <div>
                            <span class="block text-3xl sm:text-4xl font-extrabold text-[#1E3A8A] tracking-tight" id="stat-solved-count">4</span>
                            <span class="text-xs sm:text-sm font-bold uppercase tracking-wider text-[#D97706] mt-2 block">Solusi Terpecahkan</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </header>


    <!-- ==========================================
         2. BILAH AKSI UTAMA (MAIN ACTION BAR)
         Filter Tab Segmented (Terbaru/Populer/Belum Terjawab) & Tombol Buat Topik
         ========================================== -->
    <nav class="sticky top-20 z-20 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs py-3.5 mb-8" aria-label="Bilah filter topik diskusi">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16 flex flex-col sm:flex-row items-center justify-between gap-4">
            
            <!-- Segmented Control Filter Tabs -->
            <div class="flex items-center gap-1.5 p-1 bg-slate-100 rounded-xl border border-slate-200/80 w-full sm:w-auto" role="tablist" aria-label="Filter status diskusi">
                <button 
                    type="button" 
                    id="tab-btn-latest" 
                    onclick="switchThreadTab('latest')" 
                    role="tab" 
                    aria-selected="true" 
                    class="flex-1 sm:flex-none px-4 py-2 rounded-lg text-xs sm:text-sm font-semibold transition-all duration-200 bg-[#1E3A8A] text-white shadow-xs focus:outline-hidden focus:ring-2 focus:ring-[#1E3A8A]"
                >
                    <i class="fa-solid fa-clock-rotate-left mr-1.5 text-xs"></i>
                    <span>Terbaru</span>
                </button>
                <button 
                    type="button" 
                    id="tab-btn-popular" 
                    onclick="switchThreadTab('popular')" 
                    role="tab" 
                    aria-selected="false" 
                    class="flex-1 sm:flex-none px-4 py-2 rounded-lg text-xs sm:text-sm font-medium transition-all duration-200 text-slate-600 hover:text-[#1E3A8A] hover:bg-white focus:outline-hidden focus:ring-2 focus:ring-[#1E3A8A]"
                >
                    <i class="fa-solid fa-fire text-amber-500 mr-1.5 text-xs"></i>
                    <span>Populer</span>
                </button>
                <button 
                    type="button" 
                    id="tab-btn-unsolved" 
                    onclick="switchThreadTab('unsolved')" 
                    role="tab" 
                    aria-selected="false" 
                    class="flex-1 sm:flex-none px-4 py-2 rounded-lg text-xs sm:text-sm font-medium transition-all duration-200 text-slate-600 hover:text-[#1E3A8A] hover:bg-white focus:outline-hidden focus:ring-2 focus:ring-[#1E3A8A]"
                >
                    <i class="fa-regular fa-circle-question text-rose-500 mr-1.5 text-xs"></i>
                    <span>Belum Terjawab</span>
                </button>
            </div>

            <!-- Bagian Kanan: Indikator Filter Tag Aktif + Tombol Buat Diskusi Baru -->
            <div class="flex items-center justify-between sm:justify-end gap-3 w-full sm:w-auto">
                <!-- Chip Filter Tag Aktif (Dinamis via JS) -->
                <div id="active-tag-chip" class="hidden items-center gap-1.5 px-3 py-1.5 bg-blue-50 border border-blue-200 text-[#1E3A8A] rounded-lg text-xs font-bold">
                    <i class="fa-solid fa-tag text-[10px]"></i>
                    <span id="active-tag-name">#Laravel</span>
                    <button type="button" onclick="resetFilterTag()" class="ml-1 text-blue-400 hover:text-[#1E3A8A]" aria-label="Hapus filter tag">
                        <i class="fa-solid fa-xmark text-xs"></i>
                    </button>
                </div>

                <!-- Tombol Buat Diskusi Baru -->
                <button 
                    type="button" 
                    id="btn-open-thread-modal"
                    onclick="openNewThreadModal(this)" 
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-[#F59E0B] hover:bg-[#D97706] text-white font-bold text-xs sm:text-sm shadow-md shadow-amber-500/20 hover:shadow-lg transition active:scale-95 focus:outline-hidden focus:ring-2 focus:ring-[#F59E0B] focus:ring-offset-2"
                >
                    <i class="fa-solid fa-plus text-xs"></i>
                    <span>Buat Diskusi Baru</span>
                </button>
            </div>

        </div>
    </nav>


    <!-- ==========================================
         LAYOUT DUA KOLOM: 75% Konten Thread vs 25% Sidebar
         Grid 12 kolom (lg:col-span-9 dan lg:col-span-3)
         ========================================== -->
    <div class="max-w-screen-2xl mx-auto px-8 md:px-16">
        <div class="grid grid-cols-12 gap-8">
            
            <!-- ==========================================
                 3. AREA UTAMA THREAD (KOLOM KIRI 75%)
                 ========================================== -->
            <section class="col-span-12 lg:col-span-9 space-y-6" aria-labelledby="thread-list-title">
                <h2 id="thread-list-title" class="sr-only">Daftar Thread Diskusi Komunitas</h2>

                <!-- Container Daftar Thread -->
                <div id="threads-container" class="space-y-5">
                    @foreach($threads as $thread)
                        @php
                            $staggerDelay = ($loop->index % 4) * 80 + 50;
                            $hasCode = !empty($thread['code_snippet']);
                            $voteScore = $thread['votes_count'] ?? 0;
                            $isSolved = $thread['is_solved'] ?? false;
                        @endphp

                        <article 
                            class="thread-card group bg-white rounded-2xl border border-slate-200/90 shadow-xs hover:shadow-md transition-all duration-200 overflow-hidden flex flex-col sm:flex-row"
                            data-id="{{ $thread['id'] }}"
                            data-category="{{ $thread['category'] ?? '' }}"
                            data-tags="{{ implode(',', $thread['tags'] ?? []) }}"
                            data-solved="{{ $isSolved ? 'true' : 'false' }}"
                            data-score="{{ $voteScore }}"
                            data-views="{{ $thread['views_count'] ?? 0 }}"
                            data-timestamp="{{ strtotime($thread['created_at']) }}"
                            data-scrollcraft="fade-up"
                            data-sc="fade-up"
                            data-sc-delay="{{ $staggerDelay }}"
                        >
                            <!-- Widget Vote Interaktif (Kolom Kiri) -->
                            <div class="flex sm:flex-col items-center justify-between sm:justify-start gap-1 p-3.5 sm:p-4 bg-slate-50/70 border-b sm:border-b-0 sm:border-r border-slate-100 sm:w-16 shrink-0 text-center">
                                <!-- Tombol Upvote -->
                                <button 
                                    type="button" 
                                    data-vote="up" 
                                    onclick="handleVote(this, 1)"
                                    aria-pressed="false"
                                    aria-label="Upvote topik ini"
                                    class="vote-btn vote-up w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 hover:text-[#1E3A8A] hover:bg-blue-50 transition active:scale-90 focus:outline-hidden focus:ring-2 focus:ring-[#1E3A8A]"
                                >
                                    <i class="fa-solid fa-chevron-up text-sm"></i>
                                </button>

                                <!-- Counter Skor Vote -->
                                <span class="vote-score text-sm font-black text-slate-700 my-0.5" data-base-score="{{ $voteScore }}">
                                    {{ $voteScore }}
                                </span>

                                <!-- Tombol Downvote -->
                                <button 
                                    type="button" 
                                    data-vote="down" 
                                    onclick="handleVote(this, -1)"
                                    aria-pressed="false"
                                    aria-label="Downvote topik ini"
                                    class="vote-btn vote-down w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition active:scale-90 focus:outline-hidden focus:ring-2 focus:ring-rose-500"
                                >
                                    <i class="fa-solid fa-chevron-down text-sm"></i>
                                </button>
                            </div>

                            <!-- Konten Thread (Kolom Kanan) -->
                            <div class="p-5 sm:p-6 flex-1 flex flex-col justify-between space-y-4">
                                
                                <div class="space-y-3">
                                    <!-- Meta Baris Penulis & Status Solved -->
                                    <div class="flex flex-wrap items-center justify-between gap-2 text-xs">
                                        <div class="flex items-center gap-2.5">
                                            <img 
                                                src="{{ $thread['author']['avatar'] }}" 
                                                alt="{{ $thread['author']['name'] }}" 
                                                class="w-7 h-7 rounded-full object-cover border border-slate-200 shrink-0"
                                                loading="lazy"
                                                onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($thread['author']['name']) }}&background=1e3a8a&color=fff';"
                                            >
                                            <span class="font-bold text-slate-800">{{ $thread['author']['name'] }}</span>
                                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-blue-50 text-[#1E3A8A] border border-blue-100">
                                                {{ $thread['author']['role'] }}
                                            </span>
                                            <span class="text-slate-300">•</span>
                                            <time datetime="{{ $thread['created_at'] }}" class="text-slate-500 font-medium">
                                                {{ $thread['time_relative'] }}
                                            </time>
                                        </div>

                                        <!-- Badge Terjawab / Solved -->
                                        @if($isSolved)
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-2xs">
                                                <i class="fa-solid fa-circle-check text-xs"></i>
                                                <span>Terjawab / Solved</span>
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Judul Pertanyaan -->
                                    <h3 class="text-base sm:text-lg font-bold text-[#1E3A8A] leading-snug">
                                        <a href="javascript:void(0)" class="hover:text-blue-900 transition-colors">
                                            {{ $thread['title'] }}
                                        </a>
                                    </h3>

                                    <!-- Cuplikan Isi Pertanyaan -->
                                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed line-clamp-3">
                                        {{ $thread['body'] }}
                                    </p>

                                    <!-- Preview Blok Kode (Bila Tersedia) -->
                                    @if($hasCode)
                                        <div class="bg-slate-900 text-slate-100 rounded-xl overflow-hidden border border-slate-800 my-3 shadow-inner">
                                            <!-- Header Bar Snippet -->
                                            <div class="flex items-center justify-between px-3.5 py-2 bg-slate-800/90 border-b border-slate-700/60 text-xs">
                                                <div class="flex items-center gap-1.5">
                                                    <span class="w-2.5 h-2.5 rounded-full bg-rose-500 inline-block"></span>
                                                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500 inline-block"></span>
                                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 inline-block"></span>
                                                    <span class="ml-2 font-mono text-[11px] text-slate-400 font-semibold">{{ $thread['code_snippet']['language'] }}</span>
                                                </div>
                                                <button 
                                                    type="button" 
                                                    onclick="copyCode(this)" 
                                                    class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-[11px] font-medium text-slate-300 hover:text-white hover:bg-slate-700/80 transition focus:outline-hidden"
                                                    aria-label="Salin potongan kode"
                                                >
                                                    <i class="fa-regular fa-copy"></i>
                                                    <span class="copy-label">Salin</span>
                                                </button>
                                            </div>
                                            <!-- Code Content -->
                                            <pre class="p-3.5 overflow-x-auto font-mono text-[12px] leading-relaxed text-slate-200"><code>{{ $thread['code_snippet']['code'] }}</code></pre>
                                        </div>
                                    @endif
                                </div>

                                <!-- Footer Thread: Tags & Statistik Komentar/Views -->
                                <div class="flex flex-wrap items-center justify-between gap-3 pt-3 border-t border-slate-100 text-xs">
                                    <!-- Daftar Tag -->
                                    <div class="flex flex-wrap items-center gap-1.5">
                                        @foreach($thread['tags'] as $tag)
                                            <button 
                                                type="button" 
                                                onclick="filterByTag('{{ $tag }}')"
                                                class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-blue-50 hover:text-[#1E3A8A] hover:border-blue-200 text-slate-600 text-[11px] font-medium transition cursor-pointer"
                                            >
                                                #{{ $tag }}
                                            </button>
                                        @endforeach
                                    </div>

                                    <!-- Statistik Komentar & Views -->
                                    <div class="flex items-center gap-4 text-slate-500 font-medium ml-auto">
                                        <span class="flex items-center gap-1.5" title="{{ $thread['replies_count'] }} balasan">
                                            <i class="fa-regular fa-comment-dots text-[#D97706] text-sm"></i>
                                            <span>{{ $thread['replies_count'] }} Balasan</span>
                                        </span>
                                        <span class="flex items-center gap-1.5" title="{{ $thread['views_count'] }} dilihat">
                                            <i class="fa-regular fa-eye text-slate-400 text-sm"></i>
                                            <span>{{ number_format($thread['views_count'], 0, ',', '.') }}</span>
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Empty State (Bila Filter Tidak Menemukan Data) -->
                <div id="threads-empty-state" class="hidden text-center py-16 px-4 bg-white rounded-3xl border border-dashed border-slate-300 shadow-2xs">
                    <div class="w-16 h-16 mx-auto bg-blue-50 rounded-2xl flex items-center justify-center text-[#1E3A8A] mb-4 text-2xl">
                        <i class="fa-regular fa-comments"></i>
                    </div>
                    <h3 class="text-lg font-bold text-[#1E3A8A]">Tidak ada diskusi yang cocok</h3>
                    <p class="text-sm text-slate-500 max-w-md mx-auto mt-1 mb-6">
                        Belum ada topik pertanyaan dengan kriteria filter atau tag yang Anda pilih. Silakan reset filter atau jadilah yang pertama bertanya!
                    </p>
                    <button 
                        type="button" 
                        onclick="resetFilterTag()"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#1E3A8A] hover:bg-blue-900 text-white font-bold text-xs sm:text-sm rounded-xl shadow-md transition active:scale-95"
                    >
                        <i class="fa-solid fa-arrow-rotate-left"></i>
                        <span>Tampilkan Semua Diskusi</span>
                    </button>
                </div>

                <!-- Tombol Muat Lebih Banyak (Simulasi) -->
                <div class="pt-6 text-center">
                    <button 
                        type="button" 
                        id="btn-load-more" 
                        onclick="loadMoreThreads()" 
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs sm:text-sm shadow-xs transition active:scale-95 focus:outline-hidden focus:ring-2 focus:ring-[#1E3A8A]"
                    >
                        <i id="load-more-spinner" class="fa-solid fa-circle-notch fa-spin text-[#1E3A8A] hidden"></i>
                        <span id="load-more-text">Muat Lebih Banyak Diskusi</span>
                    </button>
                </div>

            </section>


            <!-- ==========================================
                 4. SIDEBAR KOMUNITAS (KOLOM KANAN 25%)
                 Sticky di Desktop, Menumpuk di Bawah pada Layar Mobile
                 ========================================== -->
            <aside class="col-span-12 lg:col-span-3 space-y-6 lg:sticky lg:top-36 self-start" aria-label="Sidebar Komunitas">
                
                <!-- Card 1: Top Kontributor (Leaderboard) -->
                <div 
                    class="bg-white rounded-2xl border border-slate-200/90 shadow-xs p-5 space-y-4"
                    data-scrollcraft="fade-up"
                    data-sc="fade-up"
                    data-sc-delay="150"
                >
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <h3 class="text-sm font-bold text-[#1E3A8A] flex items-center gap-2">
                            <i class="fa-solid fa-trophy text-[#F59E0B] text-base"></i>
                            <span>Top Kontributor</span>
                        </h3>
                        <span class="text-[11px] font-semibold text-slate-500">Bulan Ini</span>
                    </div>

                    <div class="space-y-3">
                        @foreach($topContributors as $contributor)
                            @php
                                $isFirst = ($contributor['rank'] === 1);
                                $medal = match($contributor['rank']) {
                                    1 => '🥇',
                                    2 => '🥈',
                                    3 => '🥉',
                                    default => '#' . $contributor['rank']
                                };
                            @endphp
                            <div class="flex items-center justify-between gap-3 p-2 rounded-xl transition {{ $isFirst ? 'bg-amber-50/70 border border-amber-200/60' : 'hover:bg-slate-50' }}">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <span class="text-sm font-bold {{ $isFirst ? 'text-amber-600' : 'text-slate-400 w-5 text-center' }}">
                                        {{ $medal }}
                                    </span>
                                    <img 
                                        src="{{ $contributor['avatar'] }}" 
                                        alt="{{ $contributor['name'] }}" 
                                        class="w-8 h-8 rounded-full object-cover border border-slate-200 shrink-0"
                                        loading="lazy"
                                        onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($contributor['name']) }}&background=f59e0b&color=fff';"
                                    >
                                    <div class="min-w-0">
                                        <p class="text-xs font-bold text-slate-800 truncate">{{ $contributor['name'] }}</p>
                                        <p class="text-[10px] text-slate-500 truncate">{{ $contributor['solved_count'] }} Solusi</p>
                                    </div>
                                </div>
                                <span class="text-xs font-black text-amber-600 shrink-0">
                                    {{ number_format($contributor['points'], 0, ',', '.') }} <span class="text-[10px] font-normal text-amber-700">pts</span>
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Card 2: Kategori Diskuri Populer -->
                <div 
                    class="bg-white rounded-2xl border border-slate-200/90 shadow-xs p-5 space-y-4"
                    data-scrollcraft="fade-up"
                    data-sc="fade-up"
                    data-sc-delay="250"
                >
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <h3 class="text-sm font-bold text-[#1E3A8A] flex items-center gap-2">
                            <i class="fa-solid fa-tags text-[#1E3A8A] text-sm"></i>
                            <span>Kategori Populer</span>
                        </h3>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        @foreach($popularTags as $ptag)
                            <button 
                                type="button" 
                                onclick="filterByTag('{{ $ptag['name'] }}')"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-50 hover:bg-blue-50 border border-slate-200 hover:border-blue-200 text-slate-700 hover:text-[#1E3A8A] text-xs font-medium transition cursor-pointer"
                            >
                                <span>#{{ $ptag['name'] }}</span>
                                <span class="text-[10px] px-1.5 py-0.2 rounded-full bg-slate-200/70 text-slate-600 font-semibold">{{ $ptag['count'] }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Card 3: Etika & Tata Tertib Berdiskusi -->
                <div 
                    class="bg-white rounded-2xl border border-slate-200/90 shadow-xs p-5 space-y-3"
                    data-scrollcraft="fade-up"
                    data-sc="fade-up"
                    data-sc-delay="350"
                >
                    <h3 class="text-sm font-bold text-[#1E3A8A] flex items-center gap-2 pb-2 border-b border-slate-100">
                        <i class="fa-solid fa-shield-halved text-emerald-600 text-sm"></i>
                        <span>Etika Berdiskusi</span>
                    </h3>

                    <ul class="space-y-2.5 text-xs text-slate-600 leading-relaxed">
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 shrink-0"></i>
                            <span>Gunakan bahasa sopan dan hargai sesama civitas laboratorium.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 shrink-0"></i>
                            <span>Cari topik serupa terlebih dahulu sebelum membuat pertanyaan baru.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 shrink-0"></i>
                            <span>Sertakan potongan kode, tangkapan layar, atau pesan error yang jelas.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 shrink-0"></i>
                            <span>Tandai jawaban yang paling tepat sebagai <b>Solved</b> untuk membantu yang lain.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 shrink-0"></i>
                            <span>Hindari tindakan spam, promosi terselubung, atau plagiarisme kode.</span>
                        </li>
                    </ul>
                </div>

            </aside>

        </div>
    </div>


    <!-- ==========================================
         5. MODAL BUAT TOPIK DISKUSI BARU
         Accessible dialog, focus trap, validasi karakter, loading state
         ========================================== -->
    <div 
        id="new-thread-modal" 
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm transition-opacity duration-300 opacity-0 pointer-events-none"
        role="dialog" 
        aria-modal="true" 
        aria-labelledby="modal-thread-title"
    >
        <!-- Backdrop Dismiss Layer -->
        <div class="absolute inset-0" onclick="closeNewThreadModal()"></div>

        <!-- Panel Modal -->
        <div class="relative bg-white rounded-3xl max-w-xl w-full shadow-2xl border border-slate-200 overflow-hidden transform scale-95 transition-all duration-300 z-10 max-h-[90vh] flex flex-col">
            
            <!-- Modal Header -->
            <div class="bg-[#1E3A8A] px-6 py-5 text-white flex items-center justify-between">
                <div>
                    <span class="text-xs font-semibold text-blue-100 uppercase tracking-wider block">Forum Diskusi</span>
                    <h3 id="modal-thread-title" class="text-lg font-bold">Buat Topik Pertanyaan Baru</h3>
                </div>
                <button 
                    type="button" 
                    onclick="closeNewThreadModal()" 
                    class="text-blue-100 hover:text-white p-2 rounded-xl hover:bg-white/10 transition focus:outline-hidden focus:ring-2 focus:ring-white"
                    aria-label="Tutup modal pembuatan topik"
                >
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Modal Body Form -->
            <div class="p-6 overflow-y-auto space-y-4">
                
                {{-- 
                    Form buat thread baru — POST ke route komunitas.store Laravel.
                    novalidate dihapus agar browser & JS validasi berjalan.
                --}}
                <form id="new-thread-form" method="POST" action="{{ route('komunitas.store') }}" class="space-y-4">
                    @csrf

                    <!-- Input Judul Pertanyaan (10 - 120 Karakter) -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="thread-title-input" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                                Judul Pertanyaan <span class="text-rose-500">*</span>
                            </label>
                            <span id="thread-title-counter" class="text-[11px] font-medium text-slate-400">0/120</span>
                        </div>
                        <input 
                            type="text" 
                            id="thread-title-input" 
                            name="judul"
                            required 
                            maxlength="120"
                            placeholder="Contoh: Mengapa migration foreign key di Laravel 11 gagal dibuat?"
                            class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-300 focus:outline-hidden focus:ring-2 focus:ring-[#1E3A8A] focus:border-[#1E3A8A] transition"
                            aria-describedby="title-error"
                            aria-invalid="false"
                        >
                        <p id="title-error" class="hidden text-xs text-rose-600 mt-1.5 font-medium flex items-center gap-1.5">
                            <i class="fa-solid fa-circle-exclamation shrink-0"></i>
                            <span>Judul pertanyaan harus diisi antara 10 hingga 120 karakter.</span>
                        </p>
                    </div>

                    <!-- Dropdown Kategori Tag -->
                    <div>
                        <label for="thread-category-input" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Kategori Utama <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <select 
                                id="thread-category-input" 
                                name="kategori"
                                class="w-full py-2.5 pl-4 pr-10 bg-white text-slate-800 text-sm rounded-xl border border-slate-300 focus:outline-hidden focus:ring-2 focus:ring-[#1E3A8A] focus:border-[#1E3A8A] appearance-none cursor-pointer"
                            >
                                <option value="Web Development">Web Development</option>
                                <option value="Laravel">Laravel</option>
                                <option value="Python">Python</option>
                                <option value="Database">Database & SQL</option>
                                <option value="Jaringan">Jaringan Komputer</option>
                                <option value="Lainnya">Lainnya / Teori Riset</option>
                            </select>
                            <span class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-slate-500">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Input Detail Pertanyaan (Textarea, Min 30 Karakter) -->
                    <div>
                        <label for="thread-body-input" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Detail Pertanyaan & Potongan Kode <span class="text-rose-500">*</span>
                        </label>
                        <textarea 
                            id="thread-body-input" 
                            name="body"
                            rows="5" 
                            required 
                            placeholder="Jelaskan kendala Anda secara spesifik. Sertakan alur eksekusi, pesan error terminal, atau potongan kode yang bermasalah..."
                            class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-300 focus:outline-hidden focus:ring-2 focus:ring-[#1E3A8A] focus:border-[#1E3A8A] transition leading-relaxed font-sans"
                            aria-describedby="body-error"
                            aria-invalid="false"
                        ></textarea>                        <p id="body-error" class="hidden text-xs text-rose-600 mt-1.5 font-medium flex items-center gap-1.5">
                            <i class="fa-solid fa-circle-exclamation shrink-0"></i>
                            <span>Detail pertanyaan wajib diisi minimal 30 karakter.</span>
                        </p>
                    </div>

                    <!-- Tombol Aksi Modal -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                        <button 
                            type="button" 
                            onclick="closeNewThreadModal()" 
                            class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 font-semibold text-xs sm:text-sm transition focus:outline-hidden"
                        >
                            Batal
                        </button>
                        <button 
                            type="submit" 
                            id="btn-submit-thread" 
                            class="px-6 py-2.5 rounded-xl bg-[#F59E0B] hover:bg-[#D97706] text-white font-bold text-xs sm:text-sm shadow-md shadow-amber-500/20 hover:shadow-lg transition active:scale-95 flex items-center gap-2 focus:outline-hidden focus:ring-2 focus:ring-[#F59E0B] focus:ring-offset-2"
                        >
                            <i id="submit-thread-icon" class="fa-solid fa-paper-plane text-xs"></i>
                            <i id="submit-thread-spinner" class="fa-solid fa-circle-notch fa-spin text-xs hidden"></i>
                            <span id="submit-thread-text">Terbitkan Diskusi</span>
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>


    <!-- ==========================================
         6. TOAST NOTIFIKASI SUKSES
         Accessible Live Region Toast Alert
         ========================================== -->
    <div 
        id="community-toast" 
        class="fixed bottom-6 right-6 z-50 max-w-md w-full bg-slate-900 text-white p-4 rounded-2xl shadow-2xl border border-slate-700 flex items-start gap-3.5 transform translate-y-24 opacity-0 transition-all duration-300 pointer-events-none"
        role="alert" 
        aria-live="assertive"
    >
        <div class="w-9 h-9 rounded-xl bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 flex items-center justify-center shrink-0">
            <i class="fa-solid fa-circle-check text-lg"></i>
        </div>
        <div class="flex-1 min-w-0">
            <h5 class="text-sm font-bold text-white">Sukses!</h5>
            <p id="community-toast-msg" class="text-xs text-slate-300 mt-0.5 leading-relaxed">
                Topik diskusi Anda telah berhasil diterbitkan ke forum laboratorium.
            </p>
        </div>
        <button 
            type="button" 
            onclick="dismissToast()" 
            class="text-slate-400 hover:text-white p-1 rounded-lg transition" 
            aria-label="Tutup notifikasi"
        >
            <i class="fa-solid fa-xmark text-sm"></i>
        </button>
    </div>

</main>
@endsection

@push('scripts')
<!-- ScrollCraft Animation Library JS (dengan Auto Fallback) -->
<script src="https://cdn.jsdelivr.net/npm/scrollcraft@1.0.1/dist/scrollcraft.min.js" onerror="this.onerror=null; window.scrollCraftScriptFailed=true;"></script>

<script>
/**
 * =========================================================================
 * LOGIKA JAVASCRIPT: FORUM KOMUNITAS LABORATORIUM (VANILLA JS ES6+)
 * Terbungkus rapi dalam IIFE untuk mencegah polusi scope global.
 * Fungsi interaktif diekspos melalui window.* secara terkontrol.
 * =========================================================================
 */
(function () {
    'use strict';

    // State Manajemen Vote Per-Thread (Simulasi State Sisi Klien)
    // 0 = Netral, 1 = Upvoted, -1 = Downvoted
    const userVotes = {};

    // State Filter & Navigasi
    let activeTab = 'latest'; // 'latest' | 'popular' | 'unsolved'
    let activeTag = null;    // null atau string nama tag (misal 'Laravel')
    let modalTriggerBtn = null;
    let toastTimeout = null;

    /**
     * Inisialisasi saat DOM siap
     */
    document.addEventListener('DOMContentLoaded', function () {
        initCharacterCounter();
        initScrollCraft();

        // Listener Keyboard Global (Esc untuk menutup modal)
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' || e.key === 'Esc') {
                const modal = document.getElementById('new-thread-modal');
                if (modal && !modal.classList.contains('pointer-events-none')) {
                    closeNewThreadModal();
                }
            }
        });
    });


    /**
     * ---------------------------------------------------------------------
     * 1. SISTEM VOTE INTERAKTIF (Upvote / Downvote)
     * Aturan:
     * - Netral -> Upvote: +1
     * - Upvoted -> Upvote lagi: 0 (batal)
     * - Netral -> Downvote: -1
     * - Downvoted -> Downvote lagi: 0 (batal)
     * - Upvoted -> Downvote: -2
     * - Downvoted -> Upvote: +2
     * ---------------------------------------------------------------------
     */
    function handleVote(button, delta) {
        if (!button) return;

        // Cegah klik cepat berulang (Throttling)
        if (button.dataset.voting === 'true') return;
        button.dataset.voting = 'true';
        setTimeout(() => { delete button.dataset.voting; }, 500);

        const card = button.closest('.thread-card');
        if (!card) return;

        const threadId = card.getAttribute('data-id');
        const scoreEl = card.querySelector('.vote-score');
        const upBtn = card.querySelector('.vote-up');
        const downBtn = card.querySelector('.vote-down');

        // Tentukan tipe vote
        const voteType = (delta === 1) ? 'up' : 'down';

        // Update tampilan optimistis (langsung berubah sebelum response)
        const currentVote = userVotes[threadId] || 0;
        let newVote = 0;
        if (delta === 1) {
            newVote = (currentVote === 1) ? 0 : 1;
        } else {
            newVote = (currentVote === -1) ? 0 : -1;
        }

        const baseScore = parseInt(scoreEl?.getAttribute('data-base-score') || '0', 10);
        if (scoreEl) {
            scoreEl.textContent = baseScore + newVote;
            scoreEl.setAttribute('data-base-score', baseScore + newVote);
        }

        userVotes[threadId] = newVote;

        // Update visual tombol
        updateVoteButtons(upBtn, downBtn, scoreEl, newVote);

        // Kirim ke backend via fetch AJAX
        fetch(`/komunitas/thread/${threadId}/vote`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    || '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ type: voteType }),
        })
        .then(res => res.json())
        .then(data => {
            // Sinkronisasi skor real dari server
            if (data.score !== undefined && scoreEl) {
                scoreEl.textContent = data.score;
                scoreEl.setAttribute('data-base-score', data.score);
            }
        })
        .catch(err => {
            // Rollback jika gagal
            console.warn('Vote gagal, rollback:', err);
            userVotes[threadId] = currentVote;
            const rollbackScore = parseInt(scoreEl?.getAttribute('data-base-score') || '0', 10);
            if (scoreEl) scoreEl.textContent = rollbackScore;
            updateVoteButtons(upBtn, downBtn, scoreEl, currentVote);
        });
    }

    function updateVoteButtons(upBtn, downBtn, scoreEl, vote) {
        if (!scoreEl) return;

        // Tombol Upvote
        if (vote === 1) {
            if (upBtn) {
                upBtn.classList.remove('text-slate-400');
                upBtn.classList.add('text-[#1E3A8A]', 'bg-blue-50');
                upBtn.setAttribute('aria-pressed', 'true');
            }
        } else {
            if (upBtn) {
                upBtn.classList.remove('text-[#1E3A8A]', 'bg-blue-50');
                upBtn.classList.add('text-slate-400');
                upBtn.setAttribute('aria-pressed', 'false');
            }
        }

        // Tombol Downvote
        if (vote === -1) {
            if (downBtn) {
                downBtn.classList.remove('text-slate-400');
                downBtn.classList.add('text-rose-600', 'bg-rose-50');
                downBtn.setAttribute('aria-pressed', 'true');
            }
        } else {
            if (downBtn) {
                downBtn.classList.remove('text-rose-600', 'bg-rose-50');
                downBtn.classList.add('text-slate-400');
                downBtn.setAttribute('aria-pressed', 'false');
            }
        }

        // Warna skor
        scoreEl.classList.remove('text-[#1E3A8A]', 'text-rose-600', 'text-slate-700');
        if (vote === 1) scoreEl.classList.add('text-[#1E3A8A]');
        else if (vote === -1) scoreEl.classList.add('text-rose-600');
        else scoreEl.classList.add('text-slate-700');

        // Animasi pop
        scoreEl.classList.remove('vote-pop');
        void scoreEl.offsetWidth;
        scoreEl.classList.add('vote-pop');
    }


    /**
     * ---------------------------------------------------------------------
     * 2. FILTER TAB POSTINGAN (Terbaru, Populer, Belum Terjawab)
     * ---------------------------------------------------------------------
     */
    function switchThreadTab(tabName) {
        activeTab = tabName;

        const tabs = {
            'latest': document.getElementById('tab-btn-latest'),
            'popular': document.getElementById('tab-btn-popular'),
            'unsolved': document.getElementById('tab-btn-unsolved'),
        };

        const activeClass = "flex-1 sm:flex-none px-4 py-2 rounded-lg text-xs sm:text-sm font-semibold transition-all duration-200 bg-[#1E3A8A] text-white shadow-xs focus:outline-hidden focus:ring-2 focus:ring-[#1E3A8A]";
        const inactiveClass = "flex-1 sm:flex-none px-4 py-2 rounded-lg text-xs sm:text-sm font-medium transition-all duration-200 text-slate-600 hover:text-[#1E3A8A] hover:bg-white focus:outline-hidden focus:ring-2 focus:ring-[#1E3A8A]";

        Object.keys(tabs).forEach(key => {
            const btn = tabs[key];
            if (!btn) return;
            if (key === tabName) {
                btn.className = activeClass;
                btn.setAttribute('aria-selected', 'true');
            } else {
                btn.className = inactiveClass;
                btn.setAttribute('aria-selected', 'false');
            }
        });

        applyThreadFiltersAndSort();
    }


    /**
     * ---------------------------------------------------------------------
     * 3. FILTER BY TAG (Dari Thread atau Sidebar)
     * ---------------------------------------------------------------------
     */
    function filterByTag(tagName) {
        // Hapus tanda '#' jika ada
        const cleanTag = tagName.replace(/^#/, '');
        activeTag = cleanTag;

        const chip = document.getElementById('active-tag-chip');
        const chipName = document.getElementById('active-tag-name');
        if (chip && chipName) {
            chipName.textContent = `#${cleanTag}`;
            chip.classList.remove('hidden');
            chip.classList.add('inline-flex');
        }

        applyThreadFiltersAndSort();
    }

    function resetFilterTag() {
        activeTag = null;
        const chip = document.getElementById('active-tag-chip');
        if (chip) {
            chip.classList.add('hidden');
            chip.classList.remove('inline-flex');
        }
        applyThreadFiltersAndSort();
    }

    function applyThreadFiltersAndSort() {
        const container = document.getElementById('threads-container');
        if (!container) return;

        const cards = Array.from(container.querySelectorAll('.thread-card'));
        let visibleCount = 0;

        // 1. Saring Visibilitas berdasarkan Tab dan Tag
        cards.forEach(card => {
            const isSolved = (card.getAttribute('data-solved') === 'true');
            const cardTags = (card.getAttribute('data-tags') || '').toLowerCase().split(',');
            const cardCategory = (card.getAttribute('data-category') || '').toLowerCase();

            let matchTab = true;
            if (activeTab === 'unsolved') {
                matchTab = !isSolved;
            }

            let matchTag = true;
            if (activeTag) {
                const target = activeTag.toLowerCase();
                matchTag = cardTags.includes(target) || cardCategory === target;
            }

            if (matchTab && matchTag) {
                card.classList.remove('hidden');
                visibleCount++;
            } else {
                card.classList.add('hidden');
            }
        });

        // 2. Urutkan Kartu yang Tampil
        cards.sort((a, b) => {
            if (activeTab === 'popular') {
                // Urutkan berdasarkan Skor Vote + Views
                const scoreA = parseInt(a.getAttribute('data-score') || '0', 10);
                const viewsA = parseInt(a.getAttribute('data-views') || '0', 10);
                const scoreB = parseInt(b.getAttribute('data-score') || '0', 10);
                const viewsB = parseInt(b.getAttribute('data-views') || '0', 10);
                return (scoreB * 2 + viewsB) - (scoreA * 2 + viewsA);
            } else {
                // Default: Urutkan berdasarkan Timestamp Terbaru
                const timeA = parseInt(a.getAttribute('data-timestamp') || '0', 10);
                const timeB = parseInt(b.getAttribute('data-timestamp') || '0', 10);
                return timeB - timeA;
            }
        });

        // Terapkan ulang urutan ke DOM
        cards.forEach(card => container.appendChild(card));

        // 3. Tampilkan Empty State Jika Kosong
        const emptyState = document.getElementById('threads-empty-state');
        if (emptyState) {
            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }
        }
    }


    /**
     * ---------------------------------------------------------------------
     * 4. SALIN KODE KE CLIPBOARD (Copy Code)
     * ---------------------------------------------------------------------
     */
    function copyCode(button) {
        if (!button) return;
        const codeBlock = button.closest('.bg-slate-900')?.querySelector('code');
        if (!codeBlock) return;

        const textToCopy = codeBlock.innerText;
        const labelEl = button.querySelector('.copy-label');
        const iconEl = button.querySelector('i');

        function showSuccess() {
            if (labelEl) labelEl.textContent = 'Tersalin!';
            if (iconEl) {
                iconEl.className = 'fa-solid fa-check text-emerald-400';
            }
            setTimeout(() => {
                if (labelEl) labelEl.textContent = 'Salin';
                if (iconEl) {
                    iconEl.className = 'fa-regular fa-copy';
                }
            }, 2000);
        }

        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(textToCopy).then(showSuccess).catch(err => {
                fallbackCopy(textToCopy, showSuccess);
            });
        } else {
            fallbackCopy(textToCopy, showSuccess);
        }
    }

    function fallbackCopy(text, callback) {
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.position = 'fixed';
        textArea.style.left = '-999999px';
        textArea.style.top = '-999999px';
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        try {
            document.execCommand('copy');
            if (callback) callback();
        } catch (err) {
            console.error('Gagal menyalin:', err);
        }
        document.body.removeChild(textArea);
    }


    /**
     * ---------------------------------------------------------------------
     * 5. MODAL BUAT TOPIK BARU & FOCUS MANAGEMENT
     * ---------------------------------------------------------------------
     */
    function initCharacterCounter() {
        const titleInput = document.getElementById('thread-title-input');
        const counterEl = document.getElementById('thread-title-counter');
        if (titleInput && counterEl) {
            titleInput.addEventListener('input', function () {
                const len = this.value.length;
                counterEl.textContent = `${len}/120`;
                if (len >= 110) {
                    counterEl.className = 'text-[11px] font-bold text-amber-500';
                } else {
                    counterEl.className = 'text-[11px] font-medium text-slate-400';
                }
            });
        }
    }

    function openNewThreadModal(triggerBtn) {
        modalTriggerBtn = triggerBtn || document.activeElement;

        const modal = document.getElementById('new-thread-modal');
        if (!modal) return;

        // Reset form & error states
        const form = document.getElementById('new-thread-form');
        if (form) form.reset();

        const counterEl = document.getElementById('thread-title-counter');
        if (counterEl) counterEl.textContent = '0/120';

        clearFormErrors();

        // Buka modal dengan animasi masuk
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100', 'pointer-events-auto');

        const panel = modal.querySelector('.relative.bg-white');
        if (panel) {
            panel.classList.remove('scale-95');
            panel.classList.add('scale-100');
        }

        // Kunci scroll dokumen
        document.body.classList.add('overflow-hidden');

        // Fokus ke input judul
        setTimeout(() => {
            const titleInput = document.getElementById('thread-title-input');
            if (titleInput) titleInput.focus();
        }, 150);
    }

    function closeNewThreadModal() {
        const modal = document.getElementById('new-thread-modal');
        if (!modal) return;

        const panel = modal.querySelector('.relative.bg-white');
        if (panel) {
            panel.classList.remove('scale-100');
            panel.classList.add('scale-95');
        }

        modal.classList.remove('opacity-100', 'pointer-events-auto');
        modal.classList.add('opacity-0', 'pointer-events-none');

        // Buka kembali scroll body
        document.body.classList.remove('overflow-hidden');

        // Kembalikan fokus ke tombol pembuka
        if (modalTriggerBtn && typeof modalTriggerBtn.focus === 'function') {
            modalTriggerBtn.focus();
        }
    }

    function clearFormErrors() {
        const titleInput = document.getElementById('thread-title-input');
        const titleError = document.getElementById('title-error');
        if (titleInput) {
            titleInput.classList.remove('border-rose-500', 'focus:ring-rose-500');
            titleInput.setAttribute('aria-invalid', 'false');
        }
        if (titleError) titleError.classList.add('hidden');

        const bodyInput = document.getElementById('thread-body-input');
        const bodyError = document.getElementById('body-error');
        if (bodyInput) {
            bodyInput.classList.remove('border-rose-500', 'focus:ring-rose-500');
            bodyInput.setAttribute('aria-invalid', 'false');
        }
        if (bodyError) bodyError.classList.add('hidden');
    }

    function submitNewThread(e) {
        // Form sudah POST ke backend Laravel — hanya lakukan validasi client-side di sini
        const titleInput = document.getElementById('thread-title-input');
        const titleError = document.getElementById('title-error');
        const bodyInput = document.getElementById('thread-body-input');
        const bodyError = document.getElementById('body-error');

        const titleVal = (titleInput?.value || '').trim();
        const bodyVal = (bodyInput?.value || '').trim();

        let isValid = true;

        // Validasi Judul (10 - 120 Karakter)
        if (titleVal.length < 10 || titleVal.length > 120) {
            isValid = false;
            if (titleInput) {
                titleInput.classList.add('border-rose-500');
                titleInput.setAttribute('aria-invalid', 'true');
            }
            if (titleError) titleError.classList.remove('hidden');
            if (titleInput) titleInput.focus();
        } else {
            if (titleInput) {
                titleInput.classList.remove('border-rose-500');
                titleInput.setAttribute('aria-invalid', 'false');
            }
            if (titleError) titleError.classList.add('hidden');
        }

        // Validasi Isi (Min 30 Karakter)
        if (bodyVal.length < 30) {
            isValid = false;
            if (bodyInput) {
                bodyInput.classList.add('border-rose-500');
                bodyInput.setAttribute('aria-invalid', 'true');
            }
            if (bodyError) bodyError.classList.remove('hidden');
        } else {
            if (bodyInput) {
                bodyInput.classList.remove('border-rose-500');
                bodyInput.setAttribute('aria-invalid', 'false');
            }
            if (bodyError) bodyError.classList.add('hidden');
        }

        if (!isValid) {
            e.preventDefault(); // Cegah submit jika tidak valid
            return;
        }

        // Loading State Tombol Submit
        const submitBtn = document.getElementById('btn-submit-thread');
        const submitIcon = document.getElementById('submit-thread-icon');
        const submitSpinner = document.getElementById('submit-thread-spinner');
        const submitText = document.getElementById('submit-thread-text');

        if (submitBtn) submitBtn.disabled = true;
        if (submitIcon) submitIcon.classList.add('hidden');
        if (submitSpinner) submitSpinner.classList.remove('hidden');
        if (submitText) submitText.textContent = 'Menerbitkan...';

        // Biarkan form submit ke backend (tidak ada e.preventDefault())
    }

    function insertNewThreadDOM(data) {
        const container = document.getElementById('threads-container');
        if (!container) return;

        const newArticle = document.createElement('article');
        newArticle.className = "thread-card thread-enter group bg-white rounded-2xl border border-slate-200/90 shadow-xs hover:shadow-md transition-all duration-200 overflow-hidden flex flex-col sm:flex-row";
        newArticle.setAttribute('data-id', data.id);
        newArticle.setAttribute('data-category', data.category);
        newArticle.setAttribute('data-tags', data.tags.join(','));
        newArticle.setAttribute('data-solved', 'false');
        newArticle.setAttribute('data-score', '0');
        newArticle.setAttribute('data-views', '1');
        newArticle.setAttribute('data-timestamp', data.timestamp);

        newArticle.innerHTML = `
            <div class="flex sm:flex-col items-center justify-between sm:justify-start gap-1 p-3.5 sm:p-4 bg-slate-50/70 border-b sm:border-b-0 sm:border-r border-slate-100 sm:w-16 shrink-0 text-center">
                <button type="button" data-vote="up" onclick="handleVote(this, 1)" aria-pressed="false" aria-label="Upvote topik ini" class="vote-btn vote-up w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 hover:text-[#1E3A8A] hover:bg-blue-50 transition active:scale-90 focus:outline-hidden">
                    <i class="fa-solid fa-chevron-up text-sm"></i>
                </button>
                <span class="vote-score text-sm font-black text-slate-700 my-0.5" data-base-score="0">0</span>
                <button type="button" data-vote="down" onclick="handleVote(this, -1)" aria-pressed="false" aria-label="Downvote topik ini" class="vote-btn vote-down w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition active:scale-90 focus:outline-hidden">
                    <i class="fa-solid fa-chevron-down text-sm"></i>
                </button>
            </div>
            <div class="p-5 sm:p-6 flex-1 flex flex-col justify-between space-y-4">
                <div class="space-y-3">
                    <div class="flex flex-wrap items-center justify-between gap-2 text-xs">
                        <div class="flex items-center gap-2.5">
                            <span class="w-7 h-7 rounded-full bg-[#1E3A8A] text-white font-bold flex items-center justify-center text-xs">U</span>
                            <span class="font-bold text-slate-800">${escapeHTML(data.author)}</span>
                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-blue-50 text-[#1E3A8A] border border-blue-100">Mahasiswa</span>
                            <span class="text-slate-300">•</span>
                            <time class="text-slate-500 font-medium">${data.time}</time>
                        </div>
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-[#1E3A8A] leading-snug">
                        <a href="javascript:void(0)" class="hover:text-blue-900 transition-colors">${escapeHTML(data.title)}</a>
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed line-clamp-3">${escapeHTML(data.body)}</p>
                </div>
                <div class="flex flex-wrap items-center justify-between gap-3 pt-3 border-t border-slate-100 text-xs">
                    <div class="flex flex-wrap items-center gap-1.5">
                        ${data.tags.map(t => `<button type="button" onclick="filterByTag('${escapeHTML(t)}')" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-blue-50 hover:text-[#1E3A8A] text-slate-600 text-[11px] font-medium transition cursor-pointer">#${escapeHTML(t)}</button>`).join('')}
                    </div>
                    <div class="flex items-center gap-4 text-slate-500 font-medium ml-auto">
                        <span class="flex items-center gap-1.5">
                            <i class="fa-regular fa-comment-dots text-[#D97706] text-sm"></i>
                            <span>0 Balasan</span>
                        </span>
                        <span class="flex items-center gap-1.5">
                            <i class="fa-regular fa-eye text-slate-400 text-sm"></i>
                            <span>1</span>
                        </span>
                    </div>
                </div>
            </div>
        `;

        // Sisipkan di posisi teratas
        container.insertBefore(newArticle, container.firstChild);

        // Jika empty state aktif, sembunyikan
        const emptyState = document.getElementById('threads-empty-state');
        if (emptyState) emptyState.classList.add('hidden');
    }

    function escapeHTML(str) {
        return str.replace(/[&<>'"]/g, 
            tag => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                "'": '&#39;',
                '"': '&quot;'
            }[tag] || tag)
        );
    }


    /**
     * ---------------------------------------------------------------------
     * 6. SIMULASI MUAT LEBIH BANYAK (Load More)
     * ---------------------------------------------------------------------
     */
    function loadMoreThreads() {
        const btn = document.getElementById('btn-load-more');
        const spinner = document.getElementById('load-more-spinner');
        const text = document.getElementById('load-more-text');
        if (!btn) return;

        btn.disabled = true;
        if (spinner) spinner.classList.remove('hidden');
        if (text) text.textContent = 'Memuat arsip diskusi...';

        setTimeout(() => {
            btn.disabled = false;
            if (spinner) spinner.classList.add('hidden');
            if (text) text.textContent = 'Semua Diskusi Telah Ditampilkan';
            showToast('Seluruh arsip diskusi terkini telah selesai dimuat.');
        }, 700);
    }


    /**
     * ---------------------------------------------------------------------
     * 7. TOAST NOTIFIKASI
     * ---------------------------------------------------------------------
     */
    function showToast(message) {
        const toast = document.getElementById('community-toast');
        const msgEl = document.getElementById('community-toast-msg');
        if (!toast) return;

        if (msgEl) msgEl.textContent = message;

        toast.classList.remove('translate-y-24', 'opacity-0', 'pointer-events-none');
        toast.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto');

        if (toastTimeout) clearTimeout(toastTimeout);
        toastTimeout = setTimeout(() => {
            dismissToast();
        }, 4500);
    }

    function dismissToast() {
        const toast = document.getElementById('community-toast');
        if (!toast) return;

        toast.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
        toast.classList.add('translate-y-24', 'opacity-0', 'pointer-events-none');
    }


    /**
     * ---------------------------------------------------------------------
     * 8. INISIALISASI SCROLLCRAFT & INTERSECTIONOBSERVER FALLBACK
     * ---------------------------------------------------------------------
     */
    function initScrollCraft() {
        const isReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const targets = document.querySelectorAll('[data-scrollcraft], [data-sc]');

        if (isReducedMotion) {
            targets.forEach(el => {
                el.classList.add('sc-visible');
                el.style.opacity = '1';
                el.style.transform = 'none';
            });
            return;
        }

        if (typeof window.ScrollCraft !== 'undefined' && !window.scrollCraftScriptFailed) {
            try {
                window.ScrollCraft.init({
                    offset: 60,
                    duration: 650,
                    easing: 'cubic-bezier(0.16, 1, 0.3, 1)'
                });
                return;
            } catch (err) {
                console.warn('ScrollCraft init error, beralih ke IntersectionObserver fallback:', err);
            }
        }

        // Fallback IntersectionObserver
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const delay = parseInt(entry.target.getAttribute('data-sc-delay') || '0', 10);
                        setTimeout(() => {
                            entry.target.classList.add('sc-visible');
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'none';
                        }, delay);
                        obs.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.08,
                rootMargin: '0px 0px -30px 0px'
            });

            targets.forEach(t => observer.observe(t));
        } else {
            targets.forEach(el => {
                el.classList.add('sc-visible');
                el.style.opacity = '1';
                el.style.transform = 'none';
            });
        }
    }


    /**
     * ---------------------------------------------------------------------
     * EKSPOS FUNGSI KE WINDOW SCOPE (Untuk Handler HTML)
     * ---------------------------------------------------------------------
     */
    window.handleVote = handleVote;
    window.switchThreadTab = switchThreadTab;
    window.filterByTag = filterByTag;
    window.resetFilterTag = resetFilterTag;
    window.copyCode = copyCode;
    window.openNewThreadModal = openNewThreadModal;
    window.closeNewThreadModal = closeNewThreadModal;
    window.submitNewThread = submitNewThread;
    window.loadMoreThreads = loadMoreThreads;
    window.dismissToast = dismissToast;

    // Tambahkan event listener submit di form untuk validasi client-side
    document.addEventListener('DOMContentLoaded', function () {
        const threadForm = document.getElementById('new-thread-form');
        if (threadForm) {
            threadForm.addEventListener('submit', submitNewThread);
        }
    });

})();
</script>
@endpush
