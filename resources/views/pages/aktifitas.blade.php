@extends('layouts.app')

@push('styles')
<!-- Font Awesome 6 CDN untuk ikonografi standar industri -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- ScrollCraft Animation Library Stylesheet (dengan graceful fallback) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/scrollcraft@1.0.1/dist/scrollcraft.min.css" onerror="this.onerror=null; window.scrollCraftStyleFailed=true;">

<style>
    /* Dukungan animasi ScrollCraft & Fallback IntersectionObserver */
    [data-scrollcraft], [data-sc] {
        opacity: 0;
        transform: translateY(24px);
        transition: opacity 0.65s cubic-bezier(0.16, 1, 0.3, 1), transform 0.65s cubic-bezier(0.16, 1, 0.3, 1);
        will-change: opacity, transform;
    }

    .sc-visible, [data-scrollcraft].sc-revealed, [data-sc].sc-revealed {
        opacity: 1 !important;
        transform: translateY(0) scale(1) !important;
    }

    /* Dukungan Aksesibilitas: prefers-reduced-motion */
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

    /* Kalender Grid Transition Styling */
    .cal-day-cell {
        min-height: 80px;
        transition: all 0.2s ease;
    }
    @media (min-width: 640px) {
        .cal-day-cell {
            min-height: 104px;
        }
    }
</style>
@endpush

@section('content')
{{-- Flash message: tampilkan dari session setelah redirect --}}
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof showToast === 'function') {
            showToast('{{ addslashes(session('success')) }}');
        }
    });
</script>
@endif
@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toast = document.getElementById('toast-notification');
        const toastMsg = document.getElementById('toast-message');
        const toastIcon = toast?.querySelector('.fa-circle-check');
        if (toast) {
            if (toastMsg) toastMsg.textContent = '{{ addslashes(session('error')) }}';
            if (toastIcon) toastIcon.className = 'fa-solid fa-circle-xmark text-lg';
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
     * Fallback Data Dummy Aktivitas Laboratorium.
     * Jika Controller mengirimkan $events atau $archives, Blade akan memprioritaskannya.
     * Struktur data dibuat komprehensif, mencakup variasi kategori, status, dan kuota.
     */
    $events = $events ?? [
        [
            'id' => 1,
            'title' => 'Workshop UI/UX Design & Prototyping Modern dengan Figma',
            'slug' => 'workshop-ui-ux-design-figma',
            'category' => 'Workshop', // Workshop | Praktikum | Sharing Session
            'status' => 'Akan Datang', // Akan Datang | Berlangsung | Selesai
            'registration_status' => 'Open', // Open | Closed
            'date' => '2026-11-12',
            'date_formatted' => '12 Nov 2026',
            'time' => '09:00 - 12:00 WIB',
            'location' => 'Lab Komputer 2 & Hybrid Zoom',
            'description' => 'Mempelajari metodologi Design Thinking, wireframing, high-fidelity UI design, component variants, hingga prototyping interaktif dengan studi kasus riil sistem informasi kampus.',
            'thumbnail' => 'https://images.unsplash.com/photo-1581291518857-4e27b48ff24e?auto=format&fit=crop&w=800&q=80',
            'mentor' => [
                'name' => 'Fahmi Pratama, S.Kom.',
                'role' => 'Alumni & Lead Product Designer',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=160&q=80',
            ],
            'quota_filled' => 32,
            'quota_total' => 50,
        ],
        [
            'id' => 2,
            'title' => 'Praktikum Intensif: Advanced Laravel 11 & Clean API Architecture',
            'slug' => 'praktikum-laravel-api',
            'category' => 'Praktikum',
            'status' => 'Berlangsung',
            'registration_status' => 'Closed',
            'date' => '2026-11-05',
            'date_formatted' => '05 Nov 2026',
            'time' => '13:00 - 16:30 WIB',
            'location' => 'Lab Rekayasa Perangkat Lunak',
            'description' => 'Implementasi Clean Architecture, repository pattern, automated testing dengan Pest, serta security hardening pada RESTful API berbasis Laravel untuk skala enterprise.',
            'thumbnail' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80',
            'mentor' => [
                'name' => 'Dr. Aris Sugiharto, M.Kom.',
                'role' => 'Dosen Pembina Lab RPL',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=160&q=80',
            ],
            'quota_filled' => 40,
            'quota_total' => 40,
        ],
        [
            'id' => 3,
            'title' => 'Sharing Session: Roadmap Karier Cloud Engineer & DevSecOps di Big Tech',
            'slug' => 'sharing-session-cloud-engineer',
            'category' => 'Sharing Session',
            'status' => 'Akan Datang',
            'registration_status' => 'Open',
            'date' => '2026-11-18',
            'date_formatted' => '18 Nov 2026',
            'time' => '19:30 - 21:30 WIB',
            'location' => 'Online Live Zoom & Youtube Stream',
            'description' => 'Eksplorasi langkah strategis meniti karier DevOps/Cloud, persiapan sertifikasi internasional (AWS/GCP), dan kiat menembus seleksi tech company terkemuka.',
            'thumbnail' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=800&q=80',
            'mentor' => [
                'name' => 'Bima Kusuma, M.T.',
                'role' => 'Alumni / Senior DevOps Engineer',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=160&q=80',
            ],
            'quota_filled' => 88,
            'quota_total' => 100,
        ],
        [
            'id' => 4,
            'title' => 'Hands-on Bootcamp: Data Analytics & Dashboarding with Python & SQL',
            'slug' => 'bootcamp-data-analytics',
            'category' => 'Workshop',
            'status' => 'Akan Datang',
            'registration_status' => 'Open',
            'date' => '2026-11-22',
            'date_formatted' => '22 Nov 2026',
            'time' => '08:30 - 15:00 WIB',
            'location' => 'Lab Data & Kecerdasan Buatan',
            'description' => 'Eksplorasi exploratory data analysis (EDA), data wrangling dengan Pandas, visualisasi Matplotlib & Seaborn, hingga deployment interactive dashboard Streamlit.',
            'thumbnail' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=80',
            'mentor' => [
                'name' => 'Nabila Rahmawati, S.Tr.Kom.',
                'role' => 'Asisten Lab Basis Data',
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=160&q=80',
            ],
            'quota_filled' => 47,
            'quota_total' => 50,
        ],
        [
            'id' => 5,
            'title' => 'Praktikum Mandiri: Docker Containerization & CI/CD Pipeline',
            'slug' => 'praktikum-docker-cicd',
            'category' => 'Praktikum',
            'status' => 'Akan Datang',
            'registration_status' => 'Open',
            'date' => '2026-11-27',
            'date_formatted' => '27 Nov 2026',
            'time' => '10:00 - 13:00 WIB',
            'location' => 'Lab Jaringan Komputer',
            'description' => 'Praktik langsung packaging aplikasi microservices dengan Dockerfile, Docker Compose, serta integrasi automasi pengujian dan deployment via GitHub Actions.',
            'thumbnail' => 'https://images.unsplash.com/photo-1605745341112-85968b19335b?auto=format&fit=crop&w=800&q=80',
            'mentor' => [
                'name' => 'Rizky Maulana',
                'role' => 'Koordinator Asisten Lab',
                'avatar' => 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?auto=format&fit=crop&w=160&q=80',
            ],
            'quota_filled' => 18,
            'quota_total' => 45,
        ],
        [
            'id' => 6,
            'title' => 'Sharing Session: Penulisan Proposal Skripsi & Publikasi Jurnal SINTA',
            'slug' => 'sharing-session-skripsi-jurnal',
            'category' => 'Sharing Session',
            'status' => 'Selesai',
            'registration_status' => 'Closed',
            'date' => '2026-10-20',
            'date_formatted' => '20 Okt 2026',
            'time' => '14:00 - 16:30 WIB',
            'location' => 'Ruang Seminar Lab SI Lt. 2',
            'description' => 'Bedah kiat menyusun rumusan masalah, sistematika tinjauan pustaka, penggunaan reference manager Zotero, dan strategi submit ke jurnal ilmiah terindeks SINTA.',
            'thumbnail' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=800&q=80',
            'mentor' => [
                'name' => 'Prof. Dr. Ir. Indah Wahyuni, M.T.',
                'role' => 'Dosen Peneliti & Reviewer',
                'avatar' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=160&q=80',
            ],
            'quota_filled' => 60,
            'quota_total' => 60,
        ],
    ];

    $archives = $archives ?? [
        [
            'id' => 1,
            'date' => '2026-10-20',
            'date_formatted' => '20 Okt 2026',
            'title' => 'Sharing Session: Penulisan Proposal Skripsi & Publikasi Jurnal SINTA',
            'category' => 'Sharing Session',
            'status' => 'Selesai',
            'materials' => [
                ['type' => 'pdf', 'name' => 'Panduan Skripsi.pdf', 'url' => '#'],
                ['type' => 'ppt', 'name' => 'Slide Presentasi.pptx', 'url' => '#'],
            ],
            'github' => null,
        ],
        [
            'id' => 2,
            'date' => '2026-10-14',
            'date_formatted' => '14 Okt 2026',
            'title' => 'Workshop Microservices with Go & gRPC Protocol',
            'category' => 'Workshop',
            'status' => 'Selesai',
            'materials' => [
                ['type' => 'pdf', 'name' => 'Modul gRPC Go.pdf', 'url' => '#'],
            ],
            'github' => 'https://github.com/wargalab-si/workshop-go-grpc',
        ],
        [
            'id' => 3,
            'date' => '2026-09-28',
            'date_formatted' => '28 Sep 2026',
            'title' => 'Praktikum Terjadwal: Database Optimization & Indexing di PostgreSQL',
            'category' => 'Praktikum',
            'status' => 'Selesai',
            'materials' => [
                ['type' => 'pdf', 'name' => 'Modul Query Optimization.pdf', 'url' => '#'],
                ['type' => 'ppt', 'name' => 'Explain Analyze Slides.pptx', 'url' => '#'],
            ],
            'github' => 'https://github.com/wargalab-si/praktikum-db-indexing',
        ],
        [
            'id' => 4,
            'date' => '2026-09-15',
            'date_formatted' => '15 Sep 2026',
            'title' => 'Workshop React 19 & Tailwind CSS v4 Component Systems',
            'category' => 'Workshop',
            'status' => 'Selesai',
            'materials' => [
                ['type' => 'pdf', 'name' => 'React 19 Architecture Guide.pdf', 'url' => '#'],
            ],
            'github' => 'https://github.com/wargalab-si/react19-tailwind4-starter',
        ],
        [
            'id' => 5,
            'date' => '2026-08-30',
            'date_formatted' => '30 Agu 2026',
            'title' => 'Sharing Session: Menembus Beasiswa IISMA & Magang MSIB Kemendikbud',
            'category' => 'Sharing Session',
            'status' => 'Selesai',
            'materials' => [
                ['type' => 'ppt', 'name' => 'Roadmap & Essay Portfolio.pptx', 'url' => '#'],
                ['type' => 'pdf', 'name' => 'Checklist Berkas IISMA.pdf', 'url' => '#'],
            ],
            'github' => null,
        ],
        [
            'id' => 6,
            'date' => '2026-08-12',
            'date_formatted' => '12 Agu 2026',
            'title' => 'Praktikum Pemrograman Web Lanjut: Fullstack Inertia.js & Vue',
            'category' => 'Praktikum',
            'status' => 'Selesai',
            'materials' => [
                ['type' => 'pdf', 'name' => 'Panduan Lab Inertia.pdf', 'url' => '#'],
            ],
            'github' => 'https://github.com/wargalab-si/praktikum-inertia-vue',
        ],
    ];
@endphp

<main class="w-full text-slate-800 bg-white min-h-screen">

    <!-- ==========================================
         1. HERO BANNER: AGENDA & AKTIVITAS LABORATORIUM
         Gaya Halaman Riset: Gradient lembut, Navy #1E3A8A, Aksen Amber #D97706, Box Soft Blue #EEF5FF
         ========================================== -->
    <header class="py-16 md:py-24 bg-gradient-to-b from-blue-50/50 via-white to-white border-b border-slate-100">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16 text-center">
            
            <!-- Kicker / Tagline -->
            <span class="inline-block text-xs sm:text-sm font-bold uppercase tracking-[0.2em] text-[#D97706] mb-4">
                <i class="fa-solid fa-calendar-days text-[#D97706] mr-1.5"></i> Agenda & Aktivitas Laboratorium
            </span>

            <!-- Judul H1 -->
            <h1 data-scrollcraft="fade-up" data-sc="fade-up" data-sc-delay="200" class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-[#1E3A8A] tracking-tight leading-tight uppercase max-w-5xl mx-auto">
                AGENDA & AKTIVITAS<br>LABORATORIUM SISTEM INFORMASI
            </h1>

            <!-- Subjudul -->
            <p data-scrollcraft="fade-up" data-sc="fade-up" data-sc-delay="300" class="text-slate-600 max-w-3xl mx-auto text-base sm:text-lg md:text-xl mt-6 leading-relaxed font-normal">
                Tingkatkan keahlian teknis melalui rangkaian workshop praktis, praktikum terstruktur, dan sharing session eksklusif bersama asisten, dosen, serta praktisi industri.
            </p>

            <!-- Bilah Pencarian & Dropdown Filter (Box Biru Lembut #EEF5FF seperti Riset) -->
            <div data-scrollcraft="fade-up" data-sc="fade-up" data-sc-delay="400" class="mt-10 max-w-4xl mx-auto">
                <div class="bg-[#EEF5FF] border border-blue-100 p-4 sm:p-5 rounded-3xl shadow-sm flex flex-col md:flex-row gap-3 items-center">
                    
                    <!-- Search Input Real-Time -->
                    <div class="relative flex-1 w-full">
                        <label for="event-search" class="sr-only">Cari workshop, praktikum, atau mentor</label>
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-magnifying-glass text-sm"></i>
                        </span>
                        <input 
                            type="text" 
                            id="event-search" 
                            placeholder="Cari workshop, praktikum, atau mentor..." 
                            class="w-full pl-10 pr-10 py-2.5 sm:py-3 bg-white text-slate-800 placeholder-slate-400 text-sm rounded-xl border border-blue-200/80 focus:outline-none focus:ring-2 focus:ring-[#1E3A8A] focus:border-[#1E3A8A] shadow-xs transition"
                            aria-label="Cari kegiatan laboratorium"
                        >
                        <!-- Clear Button (Muncul jika ada teks) -->
                        <button 
                            type="button" 
                            id="search-clear-btn" 
                            class="hidden absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none"
                            aria-label="Bersihkan pencarian"
                        >
                            <i class="fa-solid fa-circle-xmark text-sm"></i>
                        </button>
                    </div>

                    <!-- Dropdown Filter: Kategori & Status -->
                    <div class="flex flex-col sm:flex-row gap-2.5 w-full md:w-auto">
                        <!-- Filter Kategori -->
                        <div class="relative w-full sm:w-44">
                            <label for="filter-category" class="sr-only">Filter Kategori</label>
                            <select 
                                id="filter-category" 
                                class="w-full py-2.5 sm:py-3 pl-3 pr-8 bg-white text-slate-800 text-sm rounded-xl border border-blue-200/80 font-medium focus:outline-none focus:ring-2 focus:ring-[#1E3A8A] focus:border-[#1E3A8A] shadow-xs appearance-none cursor-pointer"
                            >
                                <option value="all">Semua Kategori</option>
                                <option value="Workshop">Workshop</option>
                                <option value="Praktikum">Praktikum</option>
                                <option value="Sharing Session">Sharing Session</option>
                            </select>
                            <span class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-500">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </span>
                        </div>

                        <!-- Filter Status -->
                        <div class="relative w-full sm:w-44">
                            <label for="filter-status" class="sr-only">Filter Status</label>
                            <select 
                                id="filter-status" 
                                class="w-full py-2.5 sm:py-3 pl-3 pr-8 bg-white text-slate-800 text-sm rounded-xl border border-blue-200/80 font-medium focus:outline-none focus:ring-2 focus:ring-[#1E3A8A] focus:border-[#1E3A8A] shadow-xs appearance-none cursor-pointer"
                            >
                                <option value="all">Semua Status</option>
                                <option value="Akan Datang">Akan Datang</option>
                                <option value="Berlangsung">Berlangsung</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                            <span class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-500">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </header>


    <!-- ==========================================
         2. HEADER SEKSI & TOGGLE TAMPILAN
         Penghitung kegiatan & Segmented Switcher (Kartu vs Kalender)
         ========================================== -->
    <section class="max-w-screen-2xl mx-auto px-8 md:px-16 pt-12 pb-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-slate-200/80 pb-5">
            <div>
                <span class="text-xs sm:text-sm font-bold uppercase tracking-[0.2em] text-[#D97706]">
                    Jadwal & Agenda
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#1E3A8A] tracking-tight uppercase flex items-center gap-2.5 mt-1">
                    <span>Daftar Kegiatan</span>
                    <span id="event-counter" class="text-xs font-bold px-3 py-1 rounded-full bg-blue-50 text-[#1E3A8A] border border-blue-100">
                        Menampilkan {{ count($events) }} kegiatan
                    </span>
                </h2>
                <p class="text-sm sm:text-base text-slate-600 mt-1">Eksplorasi jadwal kegiatan akademik, workshop, dan agenda laboratorium terkini.</p>
            </div>

            <!-- Segmented Control Switcher -->
            <div class="inline-flex p-1 bg-slate-100 rounded-xl border border-slate-200/90 shadow-inner" role="group" aria-label="Opsi tampilan daftar kegiatan">
                <button 
                    type="button" 
                    id="view-btn-card" 
                    onclick="toggleEventView('card')" 
                    class="px-4 py-2 rounded-lg text-xs sm:text-sm font-bold transition-all duration-200 flex items-center gap-2 bg-[#1E3A8A] text-white shadow-sm"
                    aria-pressed="true"
                >
                    <i class="fa-solid fa-table-cells-large"></i>
                    <span>Kartu</span>
                </button>
                <button 
                    type="button" 
                    id="view-btn-calendar" 
                    onclick="toggleEventView('calendar')" 
                    class="px-4 py-2 rounded-lg text-xs sm:text-sm font-semibold transition-all duration-200 flex items-center gap-2 text-slate-600 hover:text-[#1E3A8A] hover:bg-white"
                    aria-pressed="false"
                >
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>Kalender</span>
                </button>
            </div>
        </div>
    </section>


    <!-- ==========================================
         3. GRID EVENT CARD (Card View)
         Grid 1 (mobile), 2 (md), 3 (xl) kolom
         ========================================== -->
    <section id="card-view-container" class="max-w-screen-2xl mx-auto px-8 md:px-16 pb-16">
        <div id="events-grid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 lg:gap-8">
            
            @foreach($events as $event)
                @php
                    // Hitung persentase kuota peserta secara defensif
                    $total = max(1, $event['quota_total'] ?? 50);
                    $filled = $event['quota_filled'] ?? 0;
                    $pct = min(100, round(($filled / $total) * 100));

                    // Tentukan warna bar kuota berdasarkan persentase
                    if ($pct > 90) {
                        $quotaColor = 'bg-rose-500';
                        $quotaTextColor = 'text-rose-600';
                    } elseif ($pct >= 70) {
                        $quotaColor = 'bg-[#F59E0B]';
                        $quotaTextColor = 'text-[#D97706]';
                    } else {
                        $quotaColor = 'bg-[#1E3A8A]';
                        $quotaTextColor = 'text-[#1E3A8A]';
                    }

                    // Kategori badge style (Navy, Sky, Amber)
                    $categoryStyles = [
                        'Workshop' => 'bg-[#1E3A8A] text-white',
                        'Praktikum' => 'bg-[#0284C7] text-white',
                        'Sharing Session' => 'bg-[#D97706] text-white',
                    ];
                    $eventCategory = $event['category'] ?? 'Workshop';
                    $catClass = $categoryStyles[$eventCategory] ?? 'bg-[#1E3A8A] text-white';

                    // Status badge style
                    $statusStyles = [
                        'Akan Datang' => 'bg-blue-50 text-[#1E3A8A] border-blue-200',
                        'Berlangsung' => 'bg-amber-50 text-[#D97706] border-amber-200',
                        'Selesai'     => 'bg-slate-100 text-slate-600 border-slate-200',
                    ];
                    $eventStatus = $event['status'] ?? 'Akan Datang';
                    $statusClass = $statusStyles[$eventStatus] ?? 'bg-slate-100 text-slate-600 border-slate-200';

                    $registrationStatus = $event['registration_status'] ?? 'Open';
                    $isClosed = ($registrationStatus === 'Closed' || $filled >= $total);
                    $staggerDelay = ($loop->index % 3) * 100 + 100;
                    $thumbnailUrl = $event['thumbnail'] ?? 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=800&q=80';
                    $mentorName = $event['mentor']['name'] ?? 'Mentor Lab';
                    $mentorRole = $event['mentor']['role'] ?? 'Asisten Lab';
                    $mentorAvatar = $event['mentor']['avatar'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($mentorName) . '&background=1E3A8A&color=fff';
                @endphp

                <article 
                    class="event-card group bg-white rounded-2xl border border-slate-200/90 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col overflow-hidden"
                    data-id="{{ $event['id'] ?? $loop->iteration }}"
                    data-title="{{ strtolower($event['title'] ?? '') }}"
                    data-category="{{ $eventCategory }}"
                    data-status="{{ $eventStatus }}"
                    data-mentor="{{ strtolower($mentorName) }}"
                    data-date="{{ $event['date'] ?? '' }}"
                    data-scrollcraft="fade-up"
                    data-sc="fade-up"
                    data-sc-delay="{{ $staggerDelay }}"
                >
                    <!-- Thumbnail Media -->
                    <div class="relative aspect-video w-full overflow-hidden bg-slate-100">
                        <img 
                            src="{{ $thumbnailUrl }}" 
                            alt="{{ $event['title'] ?? 'Thumbnail Event' }}" 
                            loading="lazy" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=800&q=80';"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent opacity-60"></div>
                        
                        <!-- Badge Kategori (Kiri Atas) -->
                        <span class="absolute top-3 left-3 px-3 py-1 rounded-lg text-xs font-bold tracking-wide shadow-md {{ $catClass }}">
                            {{ $eventCategory }}
                        </span>

                        <!-- Badge Registrasi (Kanan Atas) -->
                        <span class="absolute top-3 right-3 px-2.5 py-1 rounded-lg text-xs font-bold shadow-md {{ $registrationStatus === 'Open' ? 'bg-emerald-500 text-white' : 'bg-rose-500 text-white' }}">
                            {{ $registrationStatus }}
                        </span>

                        <!-- Badge Status Pelaksanaan (Kiri Bawah Thumbnail) -->
                        <span class="absolute bottom-3 left-3 px-2.5 py-0.5 rounded-md text-[11px] font-bold border backdrop-blur-md bg-white/95 {{ $statusClass }}">
                            {{ $eventStatus }}
                        </span>
                    </div>

                    <!-- Konten Card Body -->
                    <div class="p-5 sm:p-6 flex-1 flex flex-col justify-between space-y-4">
                        
                        <div class="space-y-3">
                            <!-- Meta Info Baris (Tanggal, Waktu, Lokasi) -->
                            <div class="flex flex-wrap items-center gap-y-1.5 gap-x-3 text-xs text-slate-500 font-medium">
                                <span class="flex items-center gap-1.5">
                                    <i class="fa-regular fa-calendar text-[#D97706]"></i>
                                    <span>{{ $event['date_formatted'] ?? ($event['date'] ?? '-') }}</span>
                                </span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center gap-1.5">
                                    <i class="fa-regular fa-clock text-[#D97706]"></i>
                                    <span>{{ $event['time'] ?? '-' }}</span>
                                </span>
                            </div>

                            <div class="text-xs text-slate-500 font-medium flex items-center gap-1.5">
                                <i class="fa-solid fa-location-dot text-[#1E3A8A] shrink-0"></i>
                                <span class="truncate">{{ $event['location'] ?? 'Laboratorium SI' }}</span>
                            </div>

                            <!-- Judul Event -->
                            <h3 class="text-lg font-bold text-[#1E3A8A] leading-snug line-clamp-2 group-hover:text-blue-900 transition-colors">
                                {{ $event['title'] ?? 'Agenda Laboratorium' }}
                            </h3>

                            <!-- Deskripsi Singkat -->
                            <p class="text-sm text-slate-600 line-clamp-3 leading-relaxed">
                                {{ $event['description'] ?? '' }}
                            </p>
                        </div>

                        <!-- Blok Mentor & Kuota -->
                        <div class="space-y-4 pt-3 border-t border-slate-100">
                            
                            <!-- Blok Mentor -->
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full overflow-hidden border border-white shadow-xs shrink-0 ring-2 ring-blue-50">
                                    <img 
                                        src="{{ $mentorAvatar }}" 
                                        alt="{{ $mentorName }}" 
                                        class="w-full h-full object-cover"
                                        onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($mentorName) }}&background=1E3A8A&color=fff';"
                                    >
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs font-bold text-slate-800 truncate">{{ $mentorName }}</p>
                                    <p class="text-[11px] text-slate-500 truncate">{{ $mentorRole }}</p>
                                </div>
                            </div>

                            <!-- Progress Bar Kuota Peserta -->
                            <div>
                                <div class="flex items-center justify-between text-xs font-semibold mb-1.5">
                                    <span class="text-slate-600">{{ $filled }}/{{ $total }} Kuota Terisi</span>
                                    <span class="{{ $quotaTextColor }}">{{ $pct }}%</span>
                                </div>
                                <div 
                                    class="w-full bg-slate-100 rounded-full h-2 overflow-hidden border border-slate-200/60"
                                    role="progressbar" 
                                    aria-valuenow="{{ $pct }}" 
                                    aria-valuemin="0" 
                                    aria-valuemax="100" 
                                    aria-label="Kapasitas kuota peserta: {{ $pct }} persen terisi"
                                >
                                    <div class="h-2 rounded-full transition-all duration-500 {{ $quotaColor }}" style="width: {{ $pct }}%"></div>
                                </div>
                            </div>

                            <!-- Tombol Aksi Registrasi (Warna Amber #F59E0B / #D97706 seperti Riset) -->
                            <div>
                                @if($isClosed)
                                    <button 
                                        type="button" 
                                        disabled 
                                        class="w-full py-2.5 px-4 rounded-xl text-xs sm:text-sm font-semibold bg-slate-100 text-slate-400 border border-slate-200 cursor-not-allowed flex items-center justify-center gap-2"
                                    >
                                        <i class="fa-solid fa-ban"></i>
                                        <span>{{ $filled >= $total ? 'Kuota Penuh' : 'Pendaftaran Ditutup' }}</span>
                                    </button>
                                @else
                                    <button 
                                        type="button" 
                                        onclick="openRegistrationModal({{ json_encode($event) }}, this)"
                                        class="w-full py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold bg-[#F59E0B] hover:bg-[#D97706] text-white shadow-md shadow-amber-500/20 hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2 focus:outline-none focus:ring-2 focus:ring-[#1E3A8A] focus:ring-offset-2 active:scale-[0.98]"
                                        aria-label="Daftar kegiatan {{ $event['title'] }}"
                                    >
                                        <i class="fa-solid fa-ticket"></i>
                                        <span>Daftar Sekarang</span>
                                    </button>
                                @endif
                            </div>

                        </div>

                    </div>
                </article>
            @endforeach

        </div>

        <!-- Empty State (Tampil bila filter tidak menemukan hasil) -->
        <div id="events-empty-state" class="hidden text-center py-16 px-4 bg-white rounded-3xl border border-dashed border-slate-300 mt-6 shadow-sm">
            <div class="w-16 h-16 mx-auto bg-blue-50 rounded-2xl flex items-center justify-center text-[#1E3A8A] mb-4 text-2xl">
                <i class="fa-solid fa-calendar-xmark"></i>
            </div>
            <h3 class="text-lg font-bold text-[#1E3A8A]">Tidak ada kegiatan yang cocok</h3>
            <p class="text-sm text-slate-500 max-w-md mx-auto mt-1 mb-6">
                Tidak ditemukan agenda laboratorium dengan kata kunci atau filter terpilih. Silakan ubah filter atau lakukan pencarian lain.
            </p>
            <button 
                type="button" 
                id="btn-reset-filters" 
                onclick="resetEventFilters()"
                class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#1E3A8A] hover:bg-blue-900 text-white font-bold text-xs sm:text-sm rounded-xl shadow-md shadow-blue-950/20 transition-all active:scale-95"
            >
                <i class="fa-solid fa-arrow-rotate-left"></i>
                <span>Reset Filter</span>
            </button>
        </div>
    </section>


    <!-- ==========================================
         4. CALENDAR VIEW
         Kalender bulanan interaktif JS Murni (Single source of truth)
         ========================================== -->
    <section id="calendar-view-container" class="hidden max-w-screen-2xl mx-auto px-8 md:px-16 pb-16">
        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-5 sm:p-8">
            
            <!-- Calendar Navigation Header -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6 pb-5 border-b border-slate-100">
                <div>
                    <span class="text-xs sm:text-sm font-bold uppercase tracking-[0.2em] text-[#D97706]">
                        Kalender Interaktif
                    </span>
                    <h3 id="cal-month-year" class="text-xl sm:text-2xl font-extrabold text-[#1E3A8A] tracking-tight uppercase mt-0.5">
                        <!-- Diisi via JS: misal "November 2026" -->
                    </h3>
                    <p class="text-xs text-slate-500 mt-1">Pilih tanggal ber-highlight untuk melihat agenda laboratorium pada hari tersebut.</p>
                </div>

                <div class="flex items-center gap-2">
                    <button 
                        type="button" 
                        onclick="calNavMonth(-1)" 
                        class="p-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-blue-50 hover:text-[#1E3A8A] hover:border-blue-200 transition focus:outline-none focus:ring-2 focus:ring-[#1E3A8A]" 
                        aria-label="Bulan Sebelumnya"
                    >
                        <i class="fa-solid fa-chevron-left text-sm"></i>
                    </button>
                    <button 
                        type="button" 
                        onclick="calGoToday()" 
                        class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-700 hover:bg-blue-50 hover:text-[#1E3A8A] hover:border-blue-200 transition focus:outline-none focus:ring-2 focus:ring-[#1E3A8A]"
                    >
                        Hari Ini
                    </button>
                    <button 
                        type="button" 
                        onclick="calNavMonth(1)" 
                        class="p-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-blue-50 hover:text-[#1E3A8A] hover:border-blue-200 transition focus:outline-none focus:ring-2 focus:ring-[#1E3A8A]" 
                        aria-label="Bulan Berikutnya"
                    >
                        <i class="fa-solid fa-chevron-right text-sm"></i>
                    </button>
                </div>
            </div>

            <!-- Header Nama Hari (Sen - Min) -->
            <div class="grid grid-cols-7 gap-1 sm:gap-2 text-center text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">
                <div class="py-2">Sen</div>
                <div class="py-2">Sel</div>
                <div class="py-2">Rab</div>
                <div class="py-2">Kam</div>
                <div class="py-2">Jum</div>
                <div class="py-2 text-[#1E3A8A]">Sab</div>
                <div class="py-2 text-rose-500">Min</div>
            </div>

            <!-- Kalender Grid 7 Kolom (Rendered by JS) -->
            <div id="cal-grid" class="grid grid-cols-7 gap-1 sm:gap-2">
                <!-- Di-generate otomatis oleh initCalendar() -->
            </div>

            <!-- Panel Detail Event Hari Terpilih -->
            <div id="cal-selected-day-panel" class="mt-8 pt-6 border-t border-slate-100">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-base font-bold text-[#1E3A8A] flex items-center gap-2">
                        <i class="fa-solid fa-calendar-check text-[#1E3A8A]"></i>
                        <span id="cal-selected-date-text">Agenda pada Tanggal Terpilih</span>
                    </h4>
                </div>
                <div id="cal-selected-events-list" class="space-y-3">
                    <!-- Event cards rendered via JS -->
                </div>
            </div>

            <!-- Legenda Warna Kategori -->
            <div class="mt-8 pt-5 border-t border-slate-100 flex flex-wrap items-center justify-between gap-4 text-xs text-slate-600">
                <span class="font-bold text-slate-700">Keterangan:</span>
                <div class="flex flex-wrap items-center gap-4">
                    <span class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded-full bg-[#1E3A8A] inline-block"></span>
                        <span>Workshop</span>
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded-full bg-[#0284C7] inline-block"></span>
                        <span>Praktikum</span>
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded-full bg-[#D97706] inline-block"></span>
                        <span>Sharing Session</span>
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded-full border-2 border-[#1E3A8A] inline-block"></span>
                        <span>Hari Ini</span>
                    </span>
                </div>
            </div>

        </div>
    </section>


    <!-- ==========================================
         5. TABEL ARSIP & DOKUMENTASI KEGIATAN
         Latar #F8FAFC bergaya Halaman Riset
         ========================================== -->
    <section class="py-16 md:py-20 bg-[#F8FAFC] border-t border-slate-200/80">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16">
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6 sm:p-8">
                
                <div class="mb-6">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                        <div>
                            <span class="text-xs sm:text-sm font-bold uppercase tracking-[0.2em] text-[#D97706]">
                                Dokumentasi & Modul
                            </span>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#1E3A8A] tracking-tight uppercase flex items-center gap-2.5 mt-1">
                                <i class="fa-solid fa-box-archive text-[#1E3A8A]"></i>
                                <span>Arsip & Dokumentasi Kegiatan</span>
                            </h2>
                            <p class="text-sm sm:text-base text-slate-600 mt-1">
                                Akses materi presentasi, modul panduan laboratorium, serta repository kode sumber dari kegiatan yang telah selesai.
                            </p>
                        </div>
                        <span id="archive-counter" class="text-xs font-bold px-3 py-1 rounded-full bg-blue-50 text-[#1E3A8A] border border-blue-100 shrink-0">
                            {{ count($archives) }} Dokumen
                        </span>
                    </div>
                </div>

                <!-- Responsive Wrapper -->
                <div class="overflow-x-auto rounded-2xl border border-blue-100 shadow-xs">
                    <table class="w-full text-left text-sm text-slate-700 min-w-[760px]" id="archive-table">
                        
                        <!-- Sticky Header -->
                        <thead class="bg-[#EEF5FF] text-[#1E3A8A] uppercase text-xs font-bold tracking-wider border-b border-blue-100 sticky top-0 backdrop-blur-xs">
                            <tr>
                                <th scope="col" class="py-3.5 px-4 font-bold text-[#1E3A8A]">Tanggal</th>
                                <th scope="col" class="py-3.5 px-4 font-bold text-[#1E3A8A]">Nama Kegiatan</th>
                                <th scope="col" class="py-3.5 px-4 font-bold text-[#1E3A8A]">Kategori</th>
                                <th scope="col" class="py-3.5 px-4 font-bold text-[#1E3A8A]">Status</th>
                                <th scope="col" class="py-3.5 px-4 font-bold text-[#1E3A8A]">Materi</th>
                                <th scope="col" class="py-3.5 px-4 font-bold text-[#1E3A8A]">Repository</th>
                            </tr>
                        </thead>

                        <!-- Table Body -->
                        <tbody class="divide-y divide-slate-100" id="archive-table-body">
                            @foreach($archives as $item)
                                @php
                                    $catBadge = match($item['category']) {
                                        'Workshop' => 'bg-blue-50 text-[#1E3A8A] border-blue-200',
                                        'Praktikum' => 'bg-sky-50 text-[#0284C7] border-sky-200',
                                        'Sharing Session' => 'bg-amber-50 text-[#D97706] border-amber-200',
                                        default => 'bg-slate-50 text-slate-700 border-slate-200',
                                    };
                                @endphp
                                <tr 
                                    class="archive-row even:bg-slate-50/50 hover:bg-blue-50/50 transition-colors"
                                    data-title="{{ strtolower($item['title']) }}"
                                    data-category="{{ $item['category'] }}"
                                    data-date="{{ $item['date'] }}"
                                    data-scrollcraft="fade-up"
                                    data-sc="fade-up"
                                    data-sc-delay="{{ ($loop->index % 4) * 80 + 50 }}"
                                >
                                    <!-- Kolom Tanggal -->
                                    <td class="py-4 px-4 font-medium text-slate-800 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <i class="fa-regular fa-calendar-check text-[#D97706]"></i>
                                            <span>{{ $item['date_formatted'] }}</span>
                                        </div>
                                    </td>

                                    <!-- Kolom Nama Kegiatan -->
                                    <td class="py-4 px-4 font-bold text-slate-900 max-w-xs">
                                        <span class="line-clamp-2 hover:text-[#1E3A8A] transition-colors">{{ $item['title'] }}</span>
                                    </td>

                                    <!-- Kolom Kategori -->
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <span class="px-2.5 py-1 rounded-full text-xs font-bold border {{ $catBadge }}">
                                            {{ $item['category'] }}
                                        </span>
                                    </td>

                                    <!-- Kolom Status -->
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <i class="fa-solid fa-check text-[10px]"></i>
                                            <span>{{ $item['status'] }}</span>
                                        </span>
                                    </td>

                                    <!-- Kolom Materi (PDF Merah / PPT Oranye) -->
                                    <td class="py-4 px-4">
                                        <div class="flex flex-wrap items-center gap-2">
                                            @foreach($item['materials'] as $mat)
                                                @if($mat['type'] === 'pdf')
                                                    <a 
                                                        href="{{ $mat['url'] }}" 
                                                        class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 text-xs font-semibold transition"
                                                        title="Unduh {{ $mat['name'] }}"
                                                        aria-label="Unduh berkas PDF {{ $mat['name'] }}"
                                                    >
                                                        <i class="fa-solid fa-file-pdf text-rose-500 text-sm"></i>
                                                        <span class="hidden sm:inline">PDF</span>
                                                    </a>
                                                @elseif($mat['type'] === 'ppt')
                                                    <a 
                                                        href="{{ $mat['url'] }}" 
                                                        class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-200 text-xs font-semibold transition"
                                                        title="Unduh {{ $mat['name'] }}"
                                                        aria-label="Unduh slide presentasi {{ $mat['name'] }}"
                                                    >
                                                        <i class="fa-solid fa-file-powerpoint text-amber-500 text-sm"></i>
                                                        <span class="hidden sm:inline">PPT</span>
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </td>

                                    <!-- Kolom Repository GitHub -->
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        @if(!empty($item['github']))
                                            <a 
                                                href="{{ $item['github'] }}" 
                                                target="_blank" 
                                                rel="noopener noreferrer"
                                                class="inline-flex items-center gap-1.5 text-xs font-bold text-[#1E3A8A] hover:text-blue-900 transition p-1.5 rounded-lg hover:bg-blue-50"
                                                aria-label="Buka repositori GitHub untuk {{ $item['title'] }}"
                                            >
                                                <i class="fa-brands fa-github text-base"></i>
                                                <span class="underline">Repository</span>
                                                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                                            </a>
                                        @else
                                            <span class="text-slate-400 font-medium pl-2">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            <!-- Baris kosong saat filter tabel tidak menemukan hasil -->
                            <tr id="archive-empty-row" class="hidden">
                                <td colspan="6" class="py-10 text-center text-slate-500">
                                    <i class="fa-solid fa-folder-open text-3xl text-slate-300 mb-2 block"></i>
                                    Tidak ada arsip dokumentasi yang sesuai dengan filter pencarian.
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </section>


    <!-- ==========================================
         6. MODAL KONFIRMASI PENDAFTARAN
         Gaya Riset: Header Navy #1E3A8A, Box Soft Blue #EEF5FF, Tombol Amber #F59E0B
         ========================================== -->
    <div 
        id="registration-modal" 
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-sm transition-opacity duration-300 opacity-0 pointer-events-none"
        role="dialog" 
        aria-modal="true" 
        aria-labelledby="modal-event-title"
        aria-describedby="modal-event-desc"
    >
        <!-- Modal Backdrop Click Dismiss Layer -->
        <div class="absolute inset-0" onclick="closeRegistrationModal()"></div>

        <!-- Panel Modal -->
        <div class="relative bg-white rounded-3xl max-w-lg w-full shadow-2xl border border-slate-200 overflow-hidden transform scale-95 transition-all duration-300 z-10 max-h-[90vh] flex flex-col">
            
            <!-- Modal Header -->
            <div class="bg-[#1E3A8A] px-6 py-5 text-white flex items-center justify-between">
                <div>
                    <span class="text-xs font-semibold text-blue-100 uppercase tracking-wider block">Formulir Pendaftaran</span>
                    <h3 class="text-lg font-bold">Konfirmasi Keikutsertaan</h3>
                </div>
                <button 
                    type="button" 
                    onclick="closeRegistrationModal()" 
                    class="text-white/80 hover:text-white p-2 rounded-xl hover:bg-white/10 transition focus:outline-none focus:ring-2 focus:ring-white"
                    aria-label="Tutup modal pendaftaran"
                >
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Modal Body Scrollable -->
            <div class="p-6 overflow-y-auto space-y-5">
                
                <!-- Ringkasan Event Terpilih -->
                <div class="bg-[#EEF5FF] rounded-2xl p-4 border border-blue-100 space-y-2">
                    <div class="flex items-center justify-between gap-2">
                        <span id="modal-event-category" class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-[#1E3A8A] text-white">
                            Workshop
                        </span>
                        <span id="modal-event-status" class="text-xs font-bold text-emerald-700 bg-emerald-100 px-2.5 py-0.5 rounded-md">
                            Open
                        </span>
                    </div>

                    <h4 id="modal-event-title" class="font-bold text-[#1E3A8A] text-base leading-snug">
                        <!-- Diisi secara dinamis -->
                    </h4>

                    <div class="space-y-1 text-xs text-slate-600 pt-1">
                        <p id="modal-event-datetime" class="flex items-center gap-2">
                            <i class="fa-regular fa-calendar-check text-[#1E3A8A] w-4"></i>
                            <span>--</span>
                        </p>
                        <p id="modal-event-location" class="flex items-center gap-2">
                            <i class="fa-solid fa-location-dot text-[#1E3A8A] w-4"></i>
                            <span>--</span>
                        </p>
                        <p id="modal-event-mentor" class="flex items-center gap-2">
                            <i class="fa-solid fa-chalkboard-user text-[#1E3A8A] w-4"></i>
                            <span>--</span>
                        </p>
                    </div>
                </div>

                <!-- Formulir Pendaftaran Peserta -->
                <form id="registration-form" method="POST" action="" class="space-y-4">
                    @csrf
                    <input type="hidden" id="modal-event-id" name="event_id" value="">

                    <!-- Input Nama Mahasiswa -->
                    <div>
                        <label for="reg-name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Nama Lengkap Mahasiswa <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-regular fa-user text-sm"></i>
                            </span>
                            <input 
                                type="text" 
                                id="reg-name"
                                name="nama"
                                required 
                                placeholder="Masukkan nama lengkap Anda..."
                                class="w-full pl-10 pr-4 py-2.5 text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-[#1E3A8A] focus:border-[#1E3A8A] transition"
                            >
                        </div>
                    </div>

                    <!-- Input NIM -->
                    <div>
                        <label for="reg-nim" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Nomor Induk Mahasiswa (NIM) <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-id-card text-sm"></i>
                            </span>
                            <input 
                                type="text" 
                                id="reg-nim"
                                name="nim"
                                required 
                                maxlength="12"
                                placeholder="Contoh: 230411100001 (8-12 digit angka)"
                                aria-describedby="nim-error"
                                aria-invalid="false"
                                class="w-full pl-10 pr-4 py-2.5 text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-[#1E3A8A] focus:border-[#1E3A8A] transition"
                            >
                        </div>
                        <p id="nim-error" class="hidden text-xs text-rose-600 mt-1.5 font-medium flex items-center gap-1.5">
                            <i class="fa-solid fa-circle-exclamation shrink-0"></i>
                            <span id="nim-error-text">NIM wajib diisi dengan 8 hingga 12 digit angka murni.</span>
                        </p>
                    </div>

                    <!-- Input Email -->
                    <div>
                        <label for="reg-email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Email Kampus / Mahasiswa <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-regular fa-envelope text-sm"></i>
                            </span>
                            <input 
                                type="email" 
                                id="reg-email"
                                name="email"
                                required 
                                placeholder="nama@student.trunojoyo.ac.id"
                                class="w-full pl-10 pr-4 py-2.5 text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-[#1E3A8A] focus:border-[#1E3A8A] transition"
                            >
                        </div>
                    </div>

                    <!-- Input Angkatan (Opsional) -->
                    <div>
                        <label for="reg-angkatan" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Angkatan <span class="text-slate-400 font-normal">(Opsional)</span>
                        </label>
                        <input 
                            type="text" 
                            id="reg-angkatan"
                            name="angkatan"
                            maxlength="10"
                            placeholder="Contoh: 2023"
                            class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-[#1E3A8A] focus:border-[#1E3A8A] transition"
                        >
                    </div>

                    <!-- Checkbox Persetujuan -->
                    <div class="pt-2">
                        <label class="flex items-start gap-3 cursor-pointer select-none">
                            <input 
                                type="checkbox" 
                                id="modal-agree-checkbox"
                                class="mt-1 w-4 h-4 rounded text-[#1E3A8A] focus:ring-[#1E3A8A] border-slate-300 cursor-pointer"
                            >
                            <span class="text-xs text-slate-600 leading-relaxed">
                                Saya menyatakan bersedia hadir sesuai jadwal yang ditentukan, mematuhi tata tertib laboratorium, dan menjaga fasilitas dengan penuh tanggung jawab.
                            </span>
                        </label>
                        <p id="agree-error" class="hidden text-xs text-rose-600 mt-1 font-medium pl-7">
                            Persetujuan tata tertib wajib dicentang untuk melanjutkan.
                        </p>
                    </div>

                    <!-- Tombol Aksi Modal -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                        <button 
                            type="button" 
                            onclick="closeRegistrationModal()" 
                            class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-50 font-semibold text-xs sm:text-sm transition focus:outline-none focus:ring-2 focus:ring-slate-300"
                        >
                            Batal
                        </button>
                        <button 
                            type="button"
                            id="submit-reg-btn"
                            onclick="handleRegistrationClientValidate()"
                            class="px-6 py-2.5 rounded-xl bg-[#F59E0B] hover:bg-[#D97706] text-white font-bold text-xs sm:text-sm shadow-md shadow-amber-500/20 hover:shadow-lg transition active:scale-95 flex items-center gap-2 focus:outline-none focus:ring-2 focus:ring-[#1E3A8A] focus:ring-offset-2"
                        >
                            <i id="submit-icon" class="fa-solid fa-paper-plane"></i>
                            <i id="submit-spinner" class="fa-solid fa-circle-notch fa-spin hidden"></i>
                            <span id="submit-text">Konfirmasi Pendaftaran</span>
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>


    <!-- ==========================================
         7. TOAST NOTIFIKASI SUKSES PENDAFTARAN
         Accessible live region toast banner
         ========================================== -->
    <div 
        id="toast-notification" 
        class="fixed bottom-6 right-6 z-50 max-w-md w-full bg-slate-900 text-white p-4 rounded-2xl shadow-2xl border border-slate-700 flex items-start gap-3.5 transform translate-y-24 opacity-0 transition-all duration-300 pointer-events-none"
        role="alert" 
        aria-live="assertive"
    >
        <div class="w-9 h-9 rounded-xl bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 flex items-center justify-center shrink-0">
            <i class="fa-solid fa-circle-check text-lg"></i>
        </div>
        <div class="flex-1 min-w-0">
            <h5 class="text-sm font-bold text-white">Pendaftaran Berhasil!</h5>
            <p id="toast-message" class="text-xs text-slate-300 mt-0.5 leading-relaxed">
                Data pendaftaran Anda telah tercatat pada sistem Laboratorium Sistem Informasi UTM.
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
<!-- ScrollCraft Animation Library JS (dengan auto fallback IntersectionObserver) -->
<script src="https://cdn.jsdelivr.net/npm/scrollcraft@1.0.1/dist/scrollcraft.min.js" onerror="this.onerror=null; window.scrollCraftScriptFailed=true;"></script>

<script>
/**
 * =========================================================================
 * LOGIKA JAVASCRIPT VANILLA: HALAMAN AKTIVITAS LABORATORIUM
 * Menangani Filter, Realtime Search, Switcher Tampilan, Kalender Mandiri,
 * Validasi Modal Aksesibel, dan Fallback Animasi ScrollCraft.
 * =========================================================================
 */

// Konstanta Validasi NIM (Bisa disesuaikan kebutuhan prodi UTM)
const NIM_MIN_LENGTH = 8;
const NIM_MAX_LENGTH = 12;

// Data Event Global (Single Source of Truth dari Blade PHP)
const ALL_EVENTS = @json($events);

// State Aplikasi
let currentView = 'card'; // 'card' | 'calendar'
let calCurrentDate = new Date(); // Referensi bulan kalender
let modalTriggerButton = null;   // Simpan tombol pemicu untuk focus trap

document.addEventListener('DOMContentLoaded', function () {
    // 1. Inisialisasi Filter & Pencarian Real-Time
    initFiltersAndSearch();

    // 2. Inisialisasi Kalender Interaktif
    initCalendar();

    // 3. Inisialisasi Animasi ScrollCraft (dengan fallback)
    initScrollAnimations();

    // 4. Global Keyboard Listener (Esc untuk modal)
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' || e.key === 'Esc') {
            const modal = document.getElementById('registration-modal');
            if (modal && !modal.classList.contains('pointer-events-none')) {
                closeRegistrationModal();
            }
        }
    });
});


/**
 * -------------------------------------------------------------------------
 * TOGGLE TAMPILAN: KARTU VS KALENDER
 * -------------------------------------------------------------------------
 */
function toggleEventView(view) {
    currentView = view;
    const cardContainer = document.getElementById('card-view-container');
    const calendarContainer = document.getElementById('calendar-view-container');
    const btnCard = document.getElementById('view-btn-card');
    const btnCalendar = document.getElementById('view-btn-calendar');

    if (view === 'card') {
        cardContainer.classList.remove('hidden');
        calendarContainer.classList.add('hidden');

        // Style Tombol Aktif / Nonaktif
        btnCard.className = "px-4 py-2 rounded-lg text-xs sm:text-sm font-bold transition-all duration-200 flex items-center gap-2 bg-[#1E3A8A] text-white shadow-sm";
        btnCard.setAttribute('aria-pressed', 'true');

        btnCalendar.className = "px-4 py-2 rounded-lg text-xs sm:text-sm font-semibold transition-all duration-200 flex items-center gap-2 text-slate-600 hover:text-[#1E3A8A] hover:bg-white";
        btnCalendar.setAttribute('aria-pressed', 'false');
    } else {
        cardContainer.classList.add('hidden');
        calendarContainer.classList.remove('hidden');

        // Style Tombol Aktif / Nonaktif
        btnCalendar.className = "px-4 py-2 rounded-lg text-xs sm:text-sm font-bold transition-all duration-200 flex items-center gap-2 bg-[#1E3A8A] text-white shadow-sm";
        btnCalendar.setAttribute('aria-pressed', 'true');

        btnCard.className = "px-4 py-2 rounded-lg text-xs sm:text-sm font-semibold transition-all duration-200 flex items-center gap-2 text-slate-600 hover:text-[#1E3A8A] hover:bg-white";
        btnCard.setAttribute('aria-pressed', 'false');

        // Render ulang kalender saat ditampilkan
        renderCalendar();
    }
}


/**
 * -------------------------------------------------------------------------
 * FILTER & PENCARIAN REAL-TIME
 * Menyaring Card Event & Baris Arsip secara serempak
 * -------------------------------------------------------------------------
 */
function initFiltersAndSearch() {
    const searchInput = document.getElementById('event-search');
    const clearBtn = document.getElementById('search-clear-btn');
    const categorySelect = document.getElementById('filter-category');
    const statusSelect = document.getElementById('filter-status');

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            if (this.value.trim().length > 0) {
                clearBtn.classList.remove('hidden');
            } else {
                clearBtn.classList.add('hidden');
            }
            applyEventFilters();
        });
    }

    if (clearBtn) {
        clearBtn.addEventListener('click', function () {
            searchInput.value = '';
            clearBtn.classList.add('hidden');
            searchInput.focus();
            applyEventFilters();
        });
    }

    if (categorySelect) {
        categorySelect.addEventListener('change', applyEventFilters);
    }

    if (statusSelect) {
        statusSelect.addEventListener('change', applyEventFilters);
    }
}

function applyEventFilters() {
    const searchVal = (document.getElementById('event-search')?.value || '').toLowerCase().trim();
    const categoryVal = document.getElementById('filter-category')?.value || 'all';
    const statusVal = document.getElementById('filter-status')?.value || 'all';

    // 1. Filter Grid Card
    const cards = document.querySelectorAll('.event-card');
    let visibleCount = 0;

    cards.forEach(card => {
        const title = card.getAttribute('data-title') || '';
        const mentor = card.getAttribute('data-mentor') || '';
        const category = card.getAttribute('data-category') || '';
        const status = card.getAttribute('data-status') || '';

        const matchSearch = (!searchVal || title.includes(searchVal) || mentor.includes(searchVal) || category.toLowerCase().includes(searchVal));
        const matchCategory = (categoryVal === 'all' || category === categoryVal);
        const matchStatus = (statusVal === 'all' || status === statusVal);

        if (matchSearch && matchCategory && matchStatus) {
            card.classList.remove('hidden');
            visibleCount++;
        } else {
            card.classList.add('hidden');
        }
    });

    // Update Counter Event
    const counterEl = document.getElementById('event-counter');
    if (counterEl) {
        counterEl.textContent = `Menampilkan ${visibleCount} kegiatan`;
    }

    // Toggle Empty State Card
    const emptyState = document.getElementById('events-empty-state');
    if (emptyState) {
        if (visibleCount === 0) {
            emptyState.classList.remove('hidden');
        } else {
            emptyState.classList.add('hidden');
        }
    }

    // 2. Filter Tabel Arsip (mengikuti kata kunci dan kategori)
    const archiveRows = document.querySelectorAll('.archive-row');
    let visibleArchiveCount = 0;

    archiveRows.forEach(row => {
        const title = row.getAttribute('data-title') || '';
        const category = row.getAttribute('data-category') || '';

        const matchSearch = (!searchVal || title.includes(searchVal) || category.toLowerCase().includes(searchVal));
        const matchCategory = (categoryVal === 'all' || category === categoryVal);

        if (matchSearch && matchCategory) {
            row.classList.remove('hidden');
            visibleArchiveCount++;
        } else {
            row.classList.add('hidden');
        }
    });

    const archiveEmptyRow = document.getElementById('archive-empty-row');
    if (archiveEmptyRow) {
        if (visibleArchiveCount === 0) {
            archiveEmptyRow.classList.remove('hidden');
        } else {
            archiveEmptyRow.classList.add('hidden');
        }
    }

    const archiveCounter = document.getElementById('archive-counter');
    if (archiveCounter) {
        archiveCounter.textContent = `${visibleArchiveCount} Dokumen`;
    }
}

function resetEventFilters() {
    const searchInput = document.getElementById('event-search');
    const clearBtn = document.getElementById('search-clear-btn');
    const categorySelect = document.getElementById('filter-category');
    const statusSelect = document.getElementById('filter-status');

    if (searchInput) searchInput.value = '';
    if (clearBtn) clearBtn.classList.add('hidden');
    if (categorySelect) categorySelect.value = 'all';
    if (statusSelect) statusSelect.value = 'all';

    applyEventFilters();
}


/**
 * -------------------------------------------------------------------------
 * KALENDER BULANAN INTERAKTIF (VANILLA JS)
 * Single Source of Truth dari array ALL_EVENTS
 * -------------------------------------------------------------------------
 */
const MONTH_NAMES = [
    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
];

function initCalendar() {
    // Tetapkan bulan default sesuai data event pertama (atau bulan berjalan)
    if (ALL_EVENTS.length > 0 && ALL_EVENTS[0].date) {
        calCurrentDate = new Date(ALL_EVENTS[0].date);
    } else {
        calCurrentDate = new Date();
    }
    renderCalendar();
}

function calNavMonth(offset) {
    calCurrentDate.setMonth(calCurrentDate.getMonth() + offset);
    renderCalendar();
}

function calGoToday() {
    calCurrentDate = new Date();
    renderCalendar();
}

function renderCalendar() {
    const calGrid = document.getElementById('cal-grid');
    const monthYearTitle = document.getElementById('cal-month-year');
    if (!calGrid || !monthYearTitle) return;

    const year = calCurrentDate.getFullYear();
    const month = calCurrentDate.getMonth();

    monthYearTitle.textContent = `${MONTH_NAMES[month]} ${year}`;

    // Tanggal pertama dan jumlah hari bulan ini
    const firstDayIndex = new Date(year, month, 1).getDay(); // 0 = Minggu
    // Konversi ke format Senin = 0, Minggu = 6
    const adjustedFirstDay = (firstDayIndex === 0) ? 6 : firstDayIndex - 1;

    const totalDaysInMonth = new Date(year, month + 1, 0).getDate();
    const prevMonthDays = new Date(year, month, 0).getDate();

    // Map Event berdasarkan tanggal (YYYY-MM-DD)
    const eventMap = {};
    ALL_EVENTS.forEach(ev => {
        if (!eventMap[ev.date]) {
            eventMap[ev.date] = [];
        }
        eventMap[ev.date].push(ev);
    });

    const today = new Date();
    const todayStr = `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, '0')}-${String(today.getDate()).padStart(2, '0')}`;

    let html = '';

    // 1. Sel Hari dari Bulan Sebelumnya (Diredupkan)
    for (let i = adjustedFirstDay; i > 0; i--) {
        const prevDateNum = prevMonthDays - i + 1;
        html += `
            <div class="cal-day-cell p-2 rounded-xl bg-slate-50/50 text-slate-300 border border-slate-100 flex flex-col justify-between pointer-events-none select-none">
                <span class="text-xs font-semibold">${prevDateNum}</span>
            </div>
        `;
    }

    // 2. Sel Hari Bulan Berjalan
    let firstEventDateFound = null;

    for (let day = 1; day <= totalDaysInMonth; day++) {
        const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        const dayEvents = eventMap[dateStr] || [];
        const isToday = (dateStr === todayStr);
        const hasEvents = dayEvents.length > 0;

        if (hasEvents && !firstEventDateFound) {
            firstEventDateFound = dateStr;
        }

        let cellClasses = "cal-day-cell p-2 rounded-xl border flex flex-col justify-between cursor-pointer transition ";
        if (isToday) {
            cellClasses += "border-[#1E3A8A] ring-2 ring-blue-200 bg-blue-50/50 text-[#1E3A8A] ";
        } else if (hasEvents) {
            cellClasses += "border-blue-200 bg-white hover:border-[#1E3A8A] hover:shadow-md ";
        } else {
            cellClasses += "border-slate-100 bg-white hover:bg-slate-50 ";
        }

        html += `
            <div class="${cellClasses}" onclick="showCalendarDayEvents('${dateStr}')" tabindex="0" role="button" aria-label="Tanggal ${day} ${MONTH_NAMES[month]} ${year}, ${dayEvents.length} kegiatan">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold ${isToday ? 'text-[#1E3A8A]' : 'text-slate-700'}">${day}</span>
                    ${isToday ? '<span class="text-[10px] bg-[#1E3A8A] text-white px-1.5 py-0.2 rounded font-bold">Hari Ini</span>' : ''}
                </div>

                <!-- Indikator Dot Kategori Event -->
                <div class="mt-1 space-y-1 overflow-hidden">
                    ${dayEvents.map(ev => {
                        let dotColor = 'bg-[#1E3A8A]';
                        if (ev.category === 'Praktikum') dotColor = 'bg-[#0284C7]';
                        if (ev.category === 'Sharing Session') dotColor = 'bg-[#D97706]';
                        return `
                            <div class="flex items-center gap-1">
                                <span class="w-2 h-2 rounded-full ${dotColor} shrink-0"></span>
                                <span class="text-[10px] font-medium text-slate-700 truncate hidden sm:inline">${ev.title}</span>
                            </div>
                        `;
                    }).join('')}
                </div>
            </div>
        `;
    }

    // 3. Sel Hari Bulan Berikutnya
    const totalCellsSoFar = adjustedFirstDay + totalDaysInMonth;
    const remainingCells = (7 - (totalCellsSoFar % 7)) % 7;

    for (let j = 1; j <= remainingCells; j++) {
        html += `
            <div class="cal-day-cell p-2 rounded-xl bg-slate-50/50 text-slate-300 border border-slate-100 flex flex-col justify-between pointer-events-none select-none">
                <span class="text-xs font-semibold">${j}</span>
            </div>
        `;
    }

    calGrid.innerHTML = html;

    // Tampilkan kegiatan dari tanggal pertama ber-event, atau hari ini
    if (firstEventDateFound) {
        showCalendarDayEvents(firstEventDateFound);
    } else {
        showCalendarDayEvents(todayStr);
    }
}

function showCalendarDayEvents(dateStr) {
    const listEl = document.getElementById('cal-selected-events-list');
    const titleEl = document.getElementById('cal-selected-date-text');
    if (!listEl || !titleEl) return;

    const [y, m, d] = dateStr.split('-');
    const formattedDate = `${parseInt(d, 10)} ${MONTH_NAMES[parseInt(m, 10) - 1]} ${y}`;
    titleEl.textContent = `Agenda Kegiatan pada ${formattedDate}`;

    const matchedEvents = ALL_EVENTS.filter(ev => ev.date === dateStr);

    if (matchedEvents.length === 0) {
        listEl.innerHTML = `
            <div class="p-6 text-center bg-slate-50 rounded-2xl border border-slate-200 text-slate-500 text-xs sm:text-sm">
                <i class="fa-regular fa-calendar-xmark text-2xl text-slate-400 mb-1.5 block"></i>
                Tidak ada agenda kegiatan laboratorium pada tanggal ini.
            </div>
        `;
        return;
    }

    let itemsHtml = '';
    matchedEvents.forEach(ev => {
        let catBadge = 'bg-[#1E3A8A] text-white';
        if (ev.category === 'Praktikum') catBadge = 'bg-[#0284C7] text-white';
        if (ev.category === 'Sharing Session') catBadge = 'bg-[#D97706] text-white';

        const isClosed = (ev.registration_status === 'Closed' || ev.quota_filled >= ev.quota_total);

        itemsHtml += `
            <div class="p-4 sm:p-5 bg-[#EEF5FF] rounded-2xl border border-blue-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-xs">
                <div class="space-y-1.5 min-w-0">
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold ${catBadge}">${ev.category}</span>
                        <span class="text-xs text-slate-500 font-medium flex items-center gap-1">
                            <i class="fa-regular fa-clock text-[#D97706]"></i> ${ev.time}
                        </span>
                        <span class="text-xs text-slate-500 font-medium flex items-center gap-1">
                            <i class="fa-solid fa-location-dot text-[#1E3A8A]"></i> ${ev.location}
                        </span>
                    </div>
                    <h5 class="text-base font-bold text-[#1E3A8A] leading-snug">${ev.title}</h5>
                    <p class="text-xs text-slate-600 font-medium">Mentor: ${ev.mentor.name} (${ev.mentor.role})</p>
                </div>

                <div class="shrink-0 w-full sm:w-auto">
                    ${isClosed ? `
                        <button type="button" disabled class="w-full sm:w-auto px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 text-slate-400 border border-slate-200 cursor-not-allowed">
                            Pendaftaran Ditutup
                        </button>
                    ` : `
                        <button type="button" onclick='openRegistrationModal(${JSON.stringify(ev)}, this)' class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold bg-[#F59E0B] hover:bg-[#D97706] text-white shadow-md shadow-amber-500/20 hover:shadow-lg transition">
                            Daftar Sekarang
                        </button>
                    `}
                </div>
            </div>
        `;
    });

    listEl.innerHTML = itemsHtml;
}


/**
 * -------------------------------------------------------------------------
 * MODAL KONFIRMASI PENDAFTARAN & FOCUS TRAP
 * -------------------------------------------------------------------------
 */
function openRegistrationModal(eventData, triggerEl) {
    modalTriggerButton = triggerEl || document.activeElement;

    // Isi Data Ringkasan Modal
    document.getElementById('modal-event-id').value = eventData.id || '';
    document.getElementById('modal-event-title').textContent = eventData.title || '';
    document.getElementById('modal-event-category').textContent = eventData.category || 'Workshop';
    document.getElementById('modal-event-status').textContent = eventData.registration_status || 'Open';
    document.getElementById('modal-event-datetime').innerHTML = `<i class="fa-regular fa-calendar-check text-[#D97706] w-4"></i><span>${eventData.date_formatted || ''} | ${eventData.time || ''}</span>`;
    document.getElementById('modal-event-location').innerHTML = `<i class="fa-solid fa-location-dot text-[#1E3A8A] w-4"></i><span>${eventData.location || ''}</span>`;
    document.getElementById('modal-event-mentor').innerHTML = `<i class="fa-solid fa-chalkboard-user text-[#1E3A8A] w-4"></i><span>${eventData.mentor ? eventData.mentor.name : ''}</span>`;

    // Set action URL POST ke route events.register Laravel
    const form = document.getElementById('registration-form');
    if (form && eventData.id) {
        form.action = `/events/${eventData.id}/daftar`;
    }

    // Reset Form Error State
    resetModalForm();

    // Auto-fill nama dan NIM dari session user (jika ada)
    @auth
    if (!document.getElementById('reg-name').value) {
        document.getElementById('reg-name').value = '{{ addslashes(Auth::user()->name ?? '') }}';
    }
    if (!document.getElementById('reg-nim').value) {
        document.getElementById('reg-nim').value = '{{ addslashes(Auth::user()->nim_nip ?? '') }}';
    }
    if (!document.getElementById('reg-email').value) {
        document.getElementById('reg-email').value = '{{ addslashes(Auth::user()->email ?? '') }}';
    }
    @endauth

    // Buka Modal dengan Transisi
    const modal = document.getElementById('registration-modal');
    modal.classList.remove('opacity-0', 'pointer-events-none');
    modal.classList.add('opacity-100', 'pointer-events-auto');

    const panel = modal.querySelector('.relative.bg-white');
    panel.classList.remove('scale-95');
    panel.classList.add('scale-100');

    // Kunci scroll halaman
    document.body.classList.add('overflow-hidden');

    // Focus Trap: Arahkan fokus ke input NIM
    setTimeout(() => {
        const nimInput = document.getElementById('reg-nim');
        if (nimInput) nimInput.focus();
    }, 150);
}

function closeRegistrationModal() {
    const modal = document.getElementById('registration-modal');
    if (!modal) return;

    const panel = modal.querySelector('.relative.bg-white');
    panel.classList.remove('scale-100');
    panel.classList.add('scale-95');

    modal.classList.remove('opacity-100', 'pointer-events-auto');
    modal.classList.add('opacity-0', 'pointer-events-none');

    // Kembalikan scroll halaman
    document.body.classList.remove('overflow-hidden');

    // Kembalikan fokus ke tombol pemicu
    if (modalTriggerButton && typeof modalTriggerButton.focus === 'function') {
        modalTriggerButton.focus();
    }
}

function resetModalForm() {
    const form = document.getElementById('registration-form');
    if (form) form.reset();

    const nimInput = document.getElementById('reg-nim');
    const nimError = document.getElementById('nim-error');
    if (nimInput) {
        nimInput.classList.remove('border-rose-500', 'focus:ring-rose-500');
        nimInput.setAttribute('aria-invalid', 'false');
    }
    if (nimError) nimError.classList.add('hidden');

    const agreeError = document.getElementById('agree-error');
    if (agreeError) agreeError.classList.add('hidden');

    // Reset tombol submit
    const submitBtn = document.getElementById('submit-reg-btn');
    const submitIcon = document.getElementById('submit-icon');
    const submitSpinner = document.getElementById('submit-spinner');
    const submitText = document.getElementById('submit-text');

    if (submitBtn) submitBtn.disabled = false;
    if (submitIcon) submitIcon.classList.remove('hidden');
    if (submitSpinner) submitSpinner.classList.add('hidden');
    if (submitText) submitText.textContent = 'Konfirmasi Pendaftaran';
}

function handleRegistrationClientValidate(e) {
    // Validasi client-side sebelum submit form POST nyata
    const nimInput = document.getElementById('reg-nim');
    const nimError = document.getElementById('nim-error');
    const nimErrorText = document.getElementById('nim-error-text');
    const agreeCheckbox = document.getElementById('modal-agree-checkbox');
    const agreeError = document.getElementById('agree-error');

    let isValid = true;

    // 1. Validasi NIM (Hanya angka, 8-12 digit)
    const nimValue = (nimInput?.value || '').trim();
    const isDigitsOnly = /^\d+$/.test(nimValue);

    if (!isDigitsOnly || nimValue.length < NIM_MIN_LENGTH || nimValue.length > NIM_MAX_LENGTH) {
        isValid = false;
        nimInput.classList.add('border-rose-500');
        nimInput.setAttribute('aria-invalid', 'true');
        nimErrorText.textContent = `NIM harus berupa angka ${NIM_MIN_LENGTH}-${NIM_MAX_LENGTH} digit.`;
        nimError.classList.remove('hidden');
        nimInput.focus();
    } else {
        nimInput.classList.remove('border-rose-500');
        nimInput.setAttribute('aria-invalid', 'false');
        nimError.classList.add('hidden');
    }

    // 2. Validasi Checkbox Persetujuan
    if (!agreeCheckbox || !agreeCheckbox.checked) {
        isValid = false;
        if (agreeError) agreeError.classList.remove('hidden');
    } else {
        if (agreeError) agreeError.classList.add('hidden');
    }

    if (!isValid) return;

    // Tampilkan loading state lalu submit
    const submitBtn = document.getElementById('submit-reg-btn');
    const submitIcon = document.getElementById('submit-icon');
    const submitSpinner = document.getElementById('submit-spinner');
    const submitText = document.getElementById('submit-text');

    if (submitBtn) submitBtn.disabled = true;
    if (submitIcon) submitIcon.classList.add('hidden');
    if (submitSpinner) submitSpinner.classList.remove('hidden');
    if (submitText) submitText.textContent = 'Memproses...';

    // Submit form nyata ke backend Laravel
    document.getElementById('registration-form').submit();
}


/**
 * -------------------------------------------------------------------------
 * TOAST NOTIFIKASI
 * -------------------------------------------------------------------------
 */
let toastTimeout = null;

function showToast(message) {
    const toast = document.getElementById('toast-notification');
    const toastMsg = document.getElementById('toast-message');
    if (!toast) return;

    if (toastMsg) toastMsg.textContent = message;

    toast.classList.remove('translate-y-24', 'opacity-0', 'pointer-events-none');
    toast.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto');

    if (toastTimeout) clearTimeout(toastTimeout);
    toastTimeout = setTimeout(() => {
        dismissToast();
    }, 5000);
}

function dismissToast() {
    const toast = document.getElementById('toast-notification');
    if (!toast) return;

    toast.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
    toast.classList.add('translate-y-24', 'opacity-0', 'pointer-events-none');
}


/**
 * -------------------------------------------------------------------------
 * ANIMASI SCROLL: SCROLLCRAFT & INTERSECTIONOBSERVER FALLBACK
 * Memastikan konten tetap muncul secara elegan walau library eksternal gagal dimuat.
 * -------------------------------------------------------------------------
 */
function initScrollAnimations() {
    // Hormati preferensi aksesibilitas pengguna: prefers-reduced-motion
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

    // Jika ScrollCraft Library berhasil dimuat dari CDN
    if (typeof window.ScrollCraft !== 'undefined' && !window.scrollCraftScriptFailed) {
        try {
            window.ScrollCraft.init({
                offset: 80,
                duration: 700,
                easing: 'cubic-bezier(0.16, 1, 0.3, 1)'
            });
            return;
        } catch (err) {
            console.warn('ScrollCraft inisialisasi gagal, mengalihkan ke IntersectionObserver fallback:', err);
        }
    }

    // Fallback Mandiri: IntersectionObserver Browser API
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
            rootMargin: '0px 0px -40px 0px'
        });

        targets.forEach(target => observer.observe(target));
    } else {
        // Fallback untuk browser lawas tanpa observer
        targets.forEach(el => {
            el.classList.add('sc-visible');
            el.style.opacity = '1';
            el.style.transform = 'none';
        });
    }
}
</script>
@endpush
