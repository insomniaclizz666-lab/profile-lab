@extends('layouts.app')

@section('content')
<main class="w-full bg-white text-slate-800">

    <!-- 1. HERO SECTION: LAYANAN LABORATORIUM (Container max-w-screen-2xl px-8 md:px-16) -->
    <section class="py-16 md:py-24 bg-gradient-to-b from-blue-50/50 via-white to-white border-b border-slate-100">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16 text-center">
            
            <!-- Kicker / Tag -->
            <span class="inline-block text-xs sm:text-sm font-bold uppercase tracking-[0.2em] text-[#D97706] mb-4">
                Layanan Laboratorium
            </span>

            <!-- Main Title (Layanan untuk Belajar, Meneliti, dan Berkarya) -->
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-[#1E3A8A] tracking-tight leading-tight uppercase max-w-5xl mx-auto">
                Layanan untuk Belajar, Meneliti,<br class="hidden sm:inline" /> dan Berkarya
            </h1>

            <!-- Subtitle -->
            <p class="text-slate-600 max-w-3xl mx-auto text-base sm:text-lg md:text-xl mt-6 leading-relaxed font-normal">
                Wargalab SI UTM melayani kebutuhan praktikum, riset, pelatihan, hingga konsultasi sistem informasi bagi mahasiswa, dosen, dan mitra.
            </p>

            <!-- 2 Call to Action Buttons: Lihat Semua Layanan & Hubungi Kami -->
            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <a href="#katalog-layanan" class="inline-flex items-center justify-center px-8 py-3 rounded-xl bg-[#F59E0B] hover:bg-[#D97706] text-white font-bold text-sm sm:text-base shadow-md shadow-amber-500/20 hover:shadow-lg transition-all duration-200 active:scale-95">
                    Lihat Semua Layanan
                </a>
                <a href="#kontak-khusus" class="inline-flex items-center justify-center px-8 py-3 rounded-xl border-2 border-[#1E3A8A] text-[#1E3A8A] hover:bg-[#1E3A8A] hover:text-white font-bold text-sm sm:text-base transition-all duration-200 active:scale-95 shadow-xs">
                    Hubungi Kami
                </a>
            </div>

            <!-- Feature / Highlights Bar (6 Jenis Layanan, Sasaran Pengguna, Pengajuan Online) -->
            <div class="mt-14 max-w-5xl mx-auto bg-[#EEF5FF] border border-blue-100 rounded-3xl p-6 sm:p-8 md:p-10 shadow-sm">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center justify-center text-center">
                    
                    <!-- Highlight 1: 6 Jenis Layanan -->
                    <div class="flex items-center justify-center gap-3 text-[#1E3A8A] font-bold text-sm sm:text-base">
                        <span class="p-2.5 rounded-xl bg-blue-100/80 text-[#1E3A8A]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </span>
                        <span>6 Jenis Layanan</span>
                    </div>

                    <!-- Highlight 2: Untuk Mahasiswa, Dosen, dan Umum -->
                    <div class="flex items-center justify-center gap-3 text-[#1E3A8A] font-bold text-sm sm:text-base border-t md:border-t-0 md:border-x border-blue-200/70 py-4 md:py-0 px-4">
                        <span class="p-2.5 rounded-xl bg-blue-100/80 text-[#1E3A8A]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </span>
                        <span>Untuk Mahasiswa, Dosen, dan Umum</span>
                    </div>

                    <!-- Highlight 3: Pengajuan Online -->
                    <div class="flex items-center justify-center gap-3 text-[#1E3A8A] font-bold text-sm sm:text-base border-t md:border-t-0 border-blue-200/70 pt-4 md:pt-0">
                        <span class="p-2.5 rounded-xl bg-blue-100/80 text-[#1E3A8A]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </span>
                        <span>Pengajuan Online</span>
                    </div>

                </div>
            </div>

        </div>
    </section>


    <!-- 2. SECTION KATALOG FASILITAS LABORATORIUM (Container max-w-screen-2xl px-8 md:px-16) -->
    <section id="katalog-layanan" class="py-16 sm:py-20 bg-[#F8FAFC] border-y border-slate-200/70">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16">
            
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-8">
                <span class="text-xs sm:text-sm font-bold uppercase tracking-[0.2em] text-[#D97706]">
                    Katalog
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#1E3A8A] tracking-tight mt-1">
                    Katalog Layanan
                </h2>
                <p class="text-slate-600 text-xs sm:text-sm md:text-base mt-2">
                    Dukungan yang tepat untuk setiap tahap pembelajaran, penelitian, dan kolaborasi Anda.
                </p>

                <!-- Filter Tabs: Semua (Aktif Navy) / Mahasiswa / Dosen / Umum -->
                <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-3 mt-6">
                    <button 
                        type="button" 
                        onclick="filterKatalogLayanan('all', this)" 
                        class="layanan-tab px-5 py-1.5 rounded-full text-xs font-semibold border border-[#1E3A8A] bg-[#1E3A8A] text-white shadow-xs transition-all active:scale-95"
                    >
                        Semua
                    </button>
                    <button 
                        type="button" 
                        onclick="filterKatalogLayanan('mahasiswa', this)" 
                        class="layanan-tab px-5 py-1.5 rounded-full text-xs font-semibold border border-slate-300 bg-white text-slate-700 hover:border-[#1E3A8A] hover:text-[#1E3A8A] transition-all shadow-xs active:scale-95"
                    >
                        Mahasiswa
                    </button>
                    <button 
                        type="button" 
                        onclick="filterKatalogLayanan('dosen', this)" 
                        class="layanan-tab px-5 py-1.5 rounded-full text-xs font-semibold border border-slate-300 bg-white text-slate-700 hover:border-[#1E3A8A] hover:text-[#1E3A8A] transition-all shadow-xs active:scale-95"
                    >
                        Dosen
                    </button>
                    <button 
                        type="button" 
                        onclick="filterKatalogLayanan('umum', this)" 
                        class="layanan-tab px-5 py-1.5 rounded-full text-xs font-semibold border border-slate-300 bg-white text-slate-700 hover:border-[#1E3A8A] hover:text-[#1E3A8A] transition-all shadow-xs active:scale-95"
                    >
                        Umum
                    </button>
                </div>
            </div>

            <!-- Grid Kartu Layanan Terpadu -->
            <div id="layananGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7 mt-10">

                @if(isset($layanan) && $layanan->isNotEmpty())
                    @foreach($layanan as $item)
                        @php
                            $imgUrl = $item->foto_path
                                ? (str_starts_with($item->foto_path, 'http') ? $item->foto_path : asset('storage/' . $item->foto_path))
                                : 'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=700&q=80';
                            $sasaranBadge = 'Untuk ' . ucfirst($item->sasaran);
                            $cakupanList = is_array($item->cakupan) ? $item->cakupan : [];
                        @endphp
                        <div data-category="{{ strtolower($item->sasaran) }}" class="layanan-card bg-white rounded-2xl border border-slate-200/90 p-5 sm:p-6 shadow-xs hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                            <div>
                                <h3 class="text-lg font-bold text-[#1E3A8A] group-hover:text-blue-900 transition-colors">{{ $item->judul }}</h3>
                                <div class="relative w-full h-44 rounded-xl overflow-hidden bg-slate-100 my-4 border border-slate-100">
                                    <img src="{{ $imgUrl }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" />
                                    <div class="absolute bottom-2.5 right-2.5 bg-white/90 backdrop-blur-md px-2.5 py-1 rounded-lg shadow-sm border border-slate-200/80 flex items-center gap-1.5">
                                        <img src="{{ asset('logo si.png') }}" alt="SI" class="h-4 w-auto object-contain">
                                        <span class="text-[10px] font-bold text-[#1E3A8A]">Wargalab</span>
                                    </div>
                                </div>
                                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed min-h-[48px]">
                                    {{ $item->deskripsi_singkat }}
                                </p>
                                <div class="mt-3">
                                    <span class="inline-block px-3 py-1 bg-slate-100 text-slate-600 text-[11px] font-medium rounded-md">{{ $sasaranBadge }}</span>
                                </div>
                            </div>
                            <div class="mt-5 pt-3 border-t border-slate-100">
                                <button type="button" onclick='bukaDetailLayanan(@json($item->judul), @json($sasaranBadge), @json($item->deskripsi_lengkap ?? $item->deskripsi_singkat), @json($imgUrl), @json($cakupanList))' class="inline-flex items-center gap-1.5 text-xs font-bold text-[#D97706] hover:text-[#B45309] group-hover:translate-x-1 transition-all">
                                    <span>Lihat Detail</span>
                                    <span class="text-sm font-bold">&rarr;</span>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @else
                <!-- CARD 1: Praktikum -->
                <div data-category="mahasiswa" class="layanan-card bg-white rounded-2xl border border-slate-200/90 p-5 sm:p-6 shadow-xs hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <h3 class="text-lg font-bold text-[#1E3A8A] group-hover:text-blue-900 transition-colors">Praktikum</h3>
                        <div class="relative w-full h-44 rounded-xl overflow-hidden bg-slate-100 my-4 border border-slate-100">
                            <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=700&q=80" alt="Praktikum" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" />
                            <div class="absolute bottom-2.5 right-2.5 bg-white/90 backdrop-blur-md px-2.5 py-1 rounded-lg shadow-sm border border-slate-200/80 flex items-center gap-1.5">
                                <img src="{{ asset('logo si.png') }}" alt="SI" class="h-4 w-auto object-contain">
                                <span class="text-[10px] font-bold text-[#1E3A8A]">Wargalab</span>
                            </div>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed min-h-[48px]">
                            Pelaksanaan praktikum terjadwal dengan bimbingan asisten laboratorium dan modul mingguan.
                        </p>
                        <div class="mt-3">
                            <span class="inline-block px-3 py-1 bg-slate-100 text-slate-600 text-[11px] font-medium rounded-md">Untuk Mahasiswa</span>
                        </div>
                    </div>
                    <div class="mt-5 pt-3 border-t border-slate-100">
                        <button type="button" onclick="bukaDetailLayanan('Praktikum', 'Untuk Mahasiswa', 'Pelaksanaan praktikum terjadwal dengan bimbingan asisten laboratorium dan modul mingguan terstruktur.', 'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=700&q=80', ['Modul praktikum terbit setiap pekan', 'Bimbingan asisten lab tersertifikasi', 'Akses workstation PC Core i7 & RAM 16GB', 'Penilaian tugas dan responsi berkala'])" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#D97706] hover:text-[#B45309] group-hover:translate-x-1 transition-all">
                            <span>Lihat Detail</span>
                            <span class="text-sm font-bold">&rarr;</span>
                        </button>
                    </div>
                </div>

                <!-- CARD 2: Riset Terapan -->
                <div data-category="dosen mahasiswa" class="layanan-card bg-white rounded-2xl border border-slate-200/90 p-5 sm:p-6 shadow-xs hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <h3 class="text-lg font-bold text-[#1E3A8A] group-hover:text-blue-900 transition-colors">Riset Terapan</h3>
                        <div class="relative w-full h-44 rounded-xl overflow-hidden bg-slate-100 my-4 border border-slate-100">
                            <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=700&q=80" alt="Riset Terapan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" />
                            <div class="absolute bottom-2.5 right-2.5 bg-white/90 backdrop-blur-md px-2.5 py-1 rounded-lg shadow-sm border border-slate-200/80 flex items-center gap-1.5">
                                <img src="{{ asset('logo si.png') }}" alt="SI" class="h-4 w-auto object-contain">
                                <span class="text-[10px] font-bold text-[#1E3A8A]">Wargalab</span>
                            </div>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed min-h-[48px]">
                            Fasilitas komputasi dan pendampingan untuk penelitian dosen dan skripsi mahasiswa.
                        </p>
                        <div class="mt-3">
                            <span class="inline-block px-3 py-1 bg-slate-100 text-slate-600 text-[11px] font-medium rounded-md">Untuk Dosen, Mahasiswa</span>
                        </div>
                    </div>
                    <div class="mt-5 pt-3 border-t border-slate-100">
                        <button type="button" onclick="bukaDetailLayanan('Riset Terapan', 'Untuk Dosen, Mahasiswa', 'Fasilitas komputasi dan pendampingan untuk penelitian dosen dan skripsi mahasiswa berbasis AI, Enterprise System, dan Big Data.', 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=700&q=80', ['Server komputasi HPC / GPU Cluster', 'Database riset & repository dataset lokal', 'Pendampingan publikasi jurnal nasional & Scopus', 'Ruang riset khusus peneliti & asisten'])" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#D97706] hover:text-[#B45309] group-hover:translate-x-1 transition-all">
                            <span>Lihat Detail</span>
                            <span class="text-sm font-bold">&rarr;</span>
                        </button>
                    </div>
                </div>

                <!-- CARD 3: Pelatihan & Sertifikasi -->
                <div data-category="mahasiswa dosen umum" class="layanan-card bg-white rounded-2xl border border-slate-200/90 p-5 sm:p-6 shadow-xs hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <h3 class="text-lg font-bold text-[#1E3A8A] group-hover:text-blue-900 transition-colors">Pelatihan & Sertifikasi</h3>
                        <div class="relative w-full h-44 rounded-xl overflow-hidden bg-slate-100 my-4 border border-slate-100">
                            <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=700&q=80" alt="Pelatihan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" />
                            <div class="absolute bottom-2.5 right-2.5 bg-white/90 backdrop-blur-md px-2.5 py-1 rounded-lg shadow-sm border border-slate-200/80 flex items-center gap-1.5">
                                <img src="{{ asset('logo si.png') }}" alt="SI" class="h-4 w-auto object-contain">
                                <span class="text-[10px] font-bold text-[#1E3A8A]">Wargalab</span>
                            </div>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed min-h-[48px]">
                            Pelatihan internal dan persiapan sertifikasi profesi di bidang teknologi informasi.
                        </p>
                        <div class="mt-3">
                            <span class="inline-block px-3 py-1 bg-slate-100 text-slate-600 text-[11px] font-medium rounded-md">Untuk Mahasiswa, Dosen, Umum</span>
                        </div>
                    </div>
                    <div class="mt-5 pt-3 border-t border-slate-100">
                        <button type="button" onclick="bukaDetailLayanan('Pelatihan & Sertifikasi', 'Untuk Mahasiswa, Dosen, Umum', 'Pelatihan internal dan persiapan sertifikasi profesi di bidang teknologi informasi seperti BNSP, Cisco, Mikrotik, dan Web Developer.', 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=700&q=80', ['Sertifikat resmi kompetensi industri', 'Instruktur praktisi & dosen tersertifikasi', 'Materi praktis sesuai standar SKKNI', 'Simulasi ujian sertifikasi terpadu'])" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#D97706] hover:text-[#B45309] group-hover:translate-x-1 transition-all">
                            <span>Lihat Detail</span>
                            <span class="text-sm font-bold">&rarr;</span>
                        </button>
                    </div>
                </div>

                <!-- CARD 4: Peminjaman Ruang & Alat -->
                <div data-category="mahasiswa dosen" class="layanan-card bg-white rounded-2xl border border-slate-200/90 p-5 sm:p-6 shadow-xs hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <h3 class="text-lg font-bold text-[#1E3A8A] group-hover:text-blue-900 transition-colors">Peminjaman Ruang & Alat</h3>
                        <div class="relative w-full h-44 rounded-xl overflow-hidden bg-slate-100 my-4 border border-slate-100">
                            <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=700&q=80" alt="Peminjaman" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" />
                            <div class="absolute bottom-2.5 right-2.5 bg-white/90 backdrop-blur-md px-2.5 py-1 rounded-lg shadow-sm border border-slate-200/80 flex items-center gap-1.5">
                                <img src="{{ asset('logo si.png') }}" alt="SI" class="h-4 w-auto object-contain">
                                <span class="text-[10px] font-bold text-[#1E3A8A]">Wargalab</span>
                            </div>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed min-h-[48px]">
                            Pinjam ruang laboratorium, komputer, dan perangkat jaringan untuk kegiatan akademis.
                        </p>
                        <div class="mt-3">
                            <span class="inline-block px-3 py-1 bg-slate-100 text-slate-600 text-[11px] font-medium rounded-md">Untuk Mahasiswa, Dosen</span>
                        </div>
                    </div>
                    <div class="mt-5 pt-3 border-t border-slate-100">
                        <button type="button" onclick="bukaDetailLayanan('Peminjaman Ruang & Alat', 'Untuk Mahasiswa, Dosen', 'Pinjam ruang laboratorium, komputer, dan perangkat jaringan untuk kegiatan akademis, ujian kompetensi, maupun kegiatan himpunan.', 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=700&q=80', ['Ruang lab full AC kapasitas 40 PC', 'Router, switch & toolkit jaringan Cisco/Mikrotik', 'Proyektor interaktif & sound system', 'Perizinan terpusat secara online'])" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#D97706] hover:text-[#B45309] group-hover:translate-x-1 transition-all">
                            <span>Lihat Detail</span>
                            <span class="text-sm font-bold">&rarr;</span>
                        </button>
                    </div>
                </div>

                <!-- CARD 5: Pengabdian Masyarakat -->
                <div data-category="dosen umum" class="layanan-card bg-white rounded-2xl border border-slate-200/90 p-5 sm:p-6 shadow-xs hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <h3 class="text-lg font-bold text-[#1E3A8A] group-hover:text-blue-900 transition-colors">Pengabdian Masyarakat</h3>
                        <div class="relative w-full h-44 rounded-xl overflow-hidden bg-slate-100 my-4 border border-slate-100">
                            <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?auto=format&fit=crop&w=700&q=80" alt="Pengabdian" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" />
                            <div class="absolute bottom-2.5 right-2.5 bg-white/90 backdrop-blur-md px-2.5 py-1 rounded-lg shadow-sm border border-slate-200/80 flex items-center gap-1.5">
                                <img src="{{ asset('logo si.png') }}" alt="SI" class="h-4 w-auto object-contain">
                                <span class="text-[10px] font-bold text-[#1E3A8A]">Wargalab</span>
                            </div>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed min-h-[48px]">
                            Pendampingan digitalisasi untuk sekolah, UMKM, dan instansi di sekitar kampus.
                        </p>
                        <div class="mt-3">
                            <span class="inline-block px-3 py-1 bg-slate-100 text-slate-600 text-[11px] font-medium rounded-md">Untuk Dosen, Umum</span>
                        </div>
                    </div>
                    <div class="mt-5 pt-3 border-t border-slate-100">
                        <button type="button" onclick="bukaDetailLayanan('Pengabdian Masyarakat', 'Untuk Dosen, Umum', 'Pendampingan digitalisasi untuk sekolah, UMKM, dan instansi di sekitar kampus melalui penerapan teknologi tepat guna.', 'https://images.unsplash.com/photo-1573164713988-8665fc963095?auto=format&fit=crop&w=700&q=80', ['Literasi digital untuk UMKM Madura', 'Pelatihan sistem informasi sekolah & desa', 'Pengembangan profil web desa & katalog lokal', 'Kerjasama kemitraan Pengabdian Dosen'])" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#D97706] hover:text-[#B45309] group-hover:translate-x-1 transition-all">
                            <span>Lihat Detail</span>
                            <span class="text-sm font-bold">&rarr;</span>
                        </button>
                    </div>
                </div>

                <!-- CARD 6: Konsultasi Sistem Informasi -->
                <div data-category="dosen umum" class="layanan-card bg-white rounded-2xl border border-slate-200/90 p-5 sm:p-6 shadow-xs hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <h3 class="text-lg font-bold text-[#1E3A8A] group-hover:text-blue-900 transition-colors">Konsultasi Sistem Informasi</h3>
                        <div class="relative w-full h-44 rounded-xl overflow-hidden bg-slate-100 my-4 border border-slate-100">
                            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=700&q=80" alt="Konsultasi" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" />
                            <div class="absolute bottom-2.5 right-2.5 bg-white/90 backdrop-blur-md px-2.5 py-1 rounded-lg shadow-sm border border-slate-200/80 flex items-center gap-1.5">
                                <img src="{{ asset('logo si.png') }}" alt="SI" class="h-4 w-auto object-contain">
                                <span class="text-[10px] font-bold text-[#1E3A8A]">Wargalab</span>
                            </div>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed min-h-[48px]">
                            Konsultasi perancangan, pengembangan, dan audit sistem informasi bersama tim ahli.
                        </p>
                        <div class="mt-3">
                            <span class="inline-block px-3 py-1 bg-slate-100 text-slate-600 text-[11px] font-medium rounded-md">Untuk Dosen, Umum</span>
                        </div>
                    </div>
                    <div class="mt-5 pt-3 border-t border-slate-100">
                        <button type="button" onclick="bukaDetailLayanan('Konsultasi Sistem Informasi', 'Untuk Dosen, Umum', 'Konsultasi perancangan, pengembangan, dan audit tata kelola sistem informasi bersama tim dosen pakar & asisten ahli.', 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=700&q=80', ['Perancangan arsitektur enterprise sistem', 'Audit keamanan informasi & tata kelola IT', 'Review rancang bangun aplikasi web & mobile', 'Konsultasi integrasi database & API'])" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#D97706] hover:text-[#B45309] group-hover:translate-x-1 transition-all">
                            <span>Lihat Detail</span>
                            <span class="text-sm font-bold">&rarr;</span>
                        </button>
                    </div>
                </div>
                @endif

            </div>

        </div>
    </section>


    <!-- 3. SECTION LAYANAN UNGGULAN: Praktikum Terpadu dengan Asisten Terseleksi (Container max-w-screen-2xl px-8 md:px-16) -->
    <section id="highlight-praktikum" class="py-16 sm:py-20 bg-white">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-14 items-center">
                
                <!-- Kolom Kiri: Layanan Unggulan -->
                <div>
                    <!-- Kicker -->
                    <span class="text-xs sm:text-sm font-bold uppercase tracking-[0.2em] text-[#D97706]">
                        Layanan Unggulan
                    </span>

                    <!-- Heading -->
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#1E3A8A] tracking-tight mt-2 leading-tight">
                        Praktikum Terpadu dengan<br class="hidden sm:inline" /> Asisten Terseleksi
                    </h2>

                    <!-- Subtitle Keterangan -->
                    <p class="text-slate-600 text-xs sm:text-sm md:text-base mt-3 leading-relaxed">
                        Setiap materi praktikum dirancang komprehensif untuk menumbuhkan skill eksplorasi dan pemecahan masalah dalam lingkungan riset terstandar.
                    </p>

                    <!-- Checklist SOP dengan Icon Bulat -->
                    <div class="mt-6 space-y-3.5">
                        
                        <!-- Poin 1: Jadwal praktikum teratur -->
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-full border border-blue-200 bg-blue-50/80 text-[#1E3A8A] flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span class="text-xs sm:text-sm text-slate-700 font-medium">Jadwal praktikum teratur per semester</span>
                        </div>

                        <!-- Poin 2: Dibimbing asisten kompeten -->
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-full border border-blue-200 bg-blue-50/80 text-[#1E3A8A] flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <span class="text-xs sm:text-sm text-slate-700 font-medium">Dibimbing asisten (CO Praktikum) kompeten</span>
                        </div>

                        <!-- Poin 3: Modul dan penilaian terstruktur -->
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-full border border-blue-200 bg-blue-50/80 text-[#1E3A8A] flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-xs sm:text-sm text-slate-700 font-medium">Modul dan penilaian terstruktur</span>
                        </div>

                        <!-- Poin 4: Maks. 20 slot per sesi -->
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-full border border-blue-200 bg-blue-50/80 text-[#1E3A8A] flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span class="text-xs sm:text-sm text-slate-700 font-medium">Maks. 20 slot per sesi</span>
                        </div>

                    </div>

                    <!-- Tombol Aksi: Lihat Modul Praktikum -->
                    <div class="mt-8">
                        <button 
                            type="button" 
                            onclick="bukaModulSopModal()" 
                            class="inline-flex items-center gap-2 bg-[#1E3A8A] hover:bg-[#1e40af] text-white font-semibold text-xs sm:text-sm px-6 py-3 rounded-xl shadow-md shadow-blue-900/20 hover:shadow-lg transition-all duration-200 active:scale-95"
                        >
                            <span>Lihat Modul Praktikum</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>

                </div>

                <!-- Kolom Kanan: Foto Dokumentasi Laboratorium dari internet -->
                <div class="relative">
                    <div class="relative rounded-3xl overflow-hidden bg-slate-100 border border-slate-200/90 shadow-lg group aspect-4/3 sm:aspect-16/10 flex items-center justify-center">
                        
                        <!-- Gambar dari internet: Suasana Laboratorium Modern -->
                        <img 
                            src="https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=1000&q=80" 
                            alt="Dokumentasi Laboratorium Sistem Informasi UTM" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                            loading="lazy"
                        />

                        <!-- Gradient Overlay Tipis -->
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-slate-900/20 to-transparent"></div>

                        <!-- Floating Label Tengah: Dokumentasi Laboratorium -->
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-4">
                            <div class="w-12 h-12 rounded-2xl bg-white/80 backdrop-blur-md flex items-center justify-center text-[#1E3A8A] mb-2 shadow-md">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span class="text-sm sm:text-base font-bold text-white drop-shadow-md">
                                Dokumentasi laboratorium
                            </span>
                        </div>

                        <!-- Floating Badge Kanan Bawah: 15+ Fasilitas Aktif -->
                        <div class="absolute bottom-4 right-4 bg-white/95 backdrop-blur-md px-3.5 py-1.5 rounded-xl shadow-lg border border-slate-100 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span class="text-xs font-bold text-[#1E3A8A]">15+ Fasilitas Aktif</span>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- 4. SECTION ALUR: CARA MENGAJUKAN LAYANAN (Container max-w-screen-2xl px-8 md:px-16) -->
    <section class="py-16 sm:py-20 bg-[#F8FAFC] border-t border-slate-200/80">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16">
            
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-14">
                <span class="text-xs sm:text-sm font-bold uppercase tracking-[0.2em] text-[#D97706]">
                    Alur
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#1E3A8A] tracking-tight mt-1">
                    Cara Mengajukan Layanan
                </h2>
                <p class="text-slate-600 text-xs sm:text-sm md:text-base mt-2">
                    Tiga langkah sederhana untuk memulai aktivitas bersama Wargalab.
                </p>
            </div>

            <!-- Steps Grid (1, 2, 3 dengan Garis Putus-putus) -->
            <div class="relative max-w-6xl mx-auto">
                
                <!-- Garis horizontal putus-putus -->
                <div class="hidden md:block absolute top-6 left-[18%] right-[18%] h-0.5 border-t-2 border-dashed border-slate-300 z-0"></div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 sm:gap-10 relative z-10">
                    
                    <!-- STEP 1: Pilih Layanan -->
                    <div class="flex flex-col items-center md:items-start text-center md:text-left">
                        <div class="w-12 h-12 rounded-full bg-[#1E3A8A] text-white font-extrabold flex items-center justify-center text-lg shadow-md shadow-blue-900/25 ring-4 ring-white shrink-0">
                            1
                        </div>
                        <h3 class="text-base font-bold text-[#1E3A8A] mt-5 mb-2">
                            Pilih layanan
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Tentukan layanan yang sesuai kebutuhan dari katalog di atas.
                        </p>
                    </div>

                    <!-- STEP 2: Isi Pengajuan -->
                    <div class="flex flex-col items-center md:items-start text-center md:text-left">
                        <div class="w-12 h-12 rounded-full bg-[#1E3A8A] text-white font-extrabold flex items-center justify-center text-lg shadow-md shadow-blue-900/25 ring-4 ring-white shrink-0">
                            2
                        </div>
                        <h3 class="text-base font-bold text-[#1E3A8A] mt-5 mb-2">
                            Isi pengajuan
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Lengkapi formulir singkat berisi data diri, tujuan, dan waktu yang diinginkan.
                        </p>
                    </div>

                    <!-- STEP 3: Konfirmasi Admin Lab -->
                    <div class="flex flex-col items-center md:items-start text-center md:text-left">
                        <div class="w-12 h-12 rounded-full bg-[#1E3A8A] text-white font-extrabold flex items-center justify-center text-lg shadow-md shadow-blue-900/25 ring-4 ring-white shrink-0">
                            3
                        </div>
                        <h3 class="text-base font-bold text-[#1E3A8A] mt-5 mb-2">
                            Konfirmasi admin lab
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Admin laboratorium akan menghubungi Anda untuk konfirmasi jadwal dan persyaratan.
                        </p>
                    </div>

                </div>

            </div>

        </div>
    </section>


    <!-- 5. SECTION FAQ: PERTANYAAN SEPUTAR LAYANAN (Container max-w-screen-2xl px-8 md:px-16) -->
    <section class="py-16 sm:py-20 bg-white border-t border-slate-200/80">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16">
            <div class="max-w-4xl mx-auto">
            
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs sm:text-sm font-bold uppercase tracking-[0.2em] text-[#D97706]">
                    Informasi Lengkap
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#1E3A8A] tracking-tight mt-1">
                    Pertanyaan Seputar Layanan
                </h2>
                <p class="text-slate-600 text-xs sm:text-sm md:text-base mt-2">
                    Hal-hal yang perlu Anda ketahui sebelum mengajukan layanan.
                </p>
            </div>

            <!-- Accordion FAQ List -->
            <div class="space-y-4">
                
                <!-- FAQ 1 -->
                <div class="border border-slate-200/90 rounded-2xl bg-white shadow-xs overflow-hidden transition-all duration-200">
                    <button 
                        type="button" 
                        onclick="toggleFaq('faq1')" 
                        class="w-full p-5 sm:p-6 text-left flex items-center justify-between gap-4 font-bold text-[#1E3A8A] text-sm sm:text-base hover:text-blue-900 transition-colors"
                    >
                        <span>Siapa yang boleh menggunakan layanan laboratorium?</span>
                        <svg id="icon-faq1" class="w-5 h-5 text-slate-400 transform transition-transform duration-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="faq1" class="hidden px-5 sm:px-6 pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Layanan terbuka untuk seluruh civitas akademika Universitas Trunojoyo Madura (Mahasiswa dan Dosen Sistem Informasi), serta mitra instansi luar atau masyarakat umum sesuai dengan jenis perizinan dan SOP laboratorium yang berlaku.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="border border-slate-200/90 rounded-2xl bg-white shadow-xs overflow-hidden transition-all duration-200">
                    <button 
                        type="button" 
                        onclick="toggleFaq('faq2')" 
                        class="w-full p-5 sm:p-6 text-left flex items-center justify-between gap-4 font-bold text-[#1E3A8A] text-sm sm:text-base hover:text-blue-900 transition-colors"
                    >
                        <span>Apakah layanan ini berbayar?</span>
                        <svg id="icon-faq2" class="w-5 h-5 text-slate-400 transform transition-transform duration-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="faq2" class="hidden px-5 sm:px-6 pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Layanan praktikum reguler perkuliahan dan penelitian tugas akhir mahasiswa SI UTM bersifat gratis (tidak dipungut biaya). Untuk pelatihan sertifikasi profesi atau jasa konsultasi audit eksternal berlaku ketentuan pembiayaan kemitraan resmi prodi.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="border border-slate-200/90 rounded-2xl bg-white shadow-xs overflow-hidden transition-all duration-200">
                    <button 
                        type="button" 
                        onclick="toggleFaq('faq3')" 
                        class="w-full p-5 sm:p-6 text-left flex items-center justify-between gap-4 font-bold text-[#1E3A8A] text-sm sm:text-base hover:text-blue-900 transition-colors"
                    >
                        <span>Berapa lama proses konfirmasi pengajuan?</span>
                        <svg id="icon-faq3" class="w-5 h-5 text-slate-400 transform transition-transform duration-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="faq3" class="hidden px-5 sm:px-6 pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Proses verifikasi dan konfirmasi pengajuan biasanya memakan waktu maksimal 1x24 jam kerja. Notifikasi persetujuan atau jadwal kalibrasi alat akan diteruskan oleh laboran melalui email atau kontak WhatsApp yang Anda daftarkan.
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="border border-slate-200/90 rounded-2xl bg-white shadow-xs overflow-hidden transition-all duration-200">
                    <button 
                        type="button" 
                        onclick="toggleFaq('faq4')" 
                        class="w-full p-5 sm:p-6 text-left flex items-center justify-between gap-4 font-bold text-[#1E3A8A] text-sm sm:text-base hover:text-blue-900 transition-colors"
                    >
                        <span>Bagaimana jika layanan yang saya butuhkan tidak ada di daftar?</span>
                        <svg id="icon-faq4" class="w-5 h-5 text-slate-400 transform transition-transform duration-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="faq4" class="hidden px-5 sm:px-6 pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Anda dapat memanfaatkan opsi permohonan konsultasi khusus dengan menekan tombol "Hubungi Kami" di bagian bawah halaman. Tim laboran dan dosen pembina lab akan mengkaji kebutuhan spesifik perangkat maupun ruangan Anda.
                    </div>
                </div>

            </div>

        </div>
        </div>
    </section>


    <!-- 6. SECTION BOTTOM BANNER: BUTUH LAYANAN KHUSUS? (Container max-w-screen-2xl px-8 md:px-16) -->
    <section id="kontak-khusus" class="py-14 sm:py-20 bg-slate-50">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16">
            <div class="relative rounded-3xl overflow-hidden bg-[#1E3A8A] text-white p-8 sm:p-14 text-center shadow-xl max-w-6xl mx-auto">
                
                <!-- Background Geometric Accents -->
                <div class="absolute -right-10 -bottom-10 w-64 h-64 rounded-full bg-blue-600/30 blur-2xl pointer-events-none"></div>
                <div class="absolute -left-10 -top-10 w-64 h-64 rounded-full bg-amber-400/10 blur-2xl pointer-events-none"></div>

                <div class="relative z-10 max-w-2xl mx-auto">
                    <!-- Heading -->
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold tracking-tight mb-3">
                        Butuh layanan khusus?
                    </h2>

                    <!-- Subtitle -->
                    <p class="text-blue-100 text-xs sm:text-sm md:text-base leading-relaxed mb-8">
                        Ceritakan kebutuhan Anda, tim laboratorium siap membantu mencari solusi.
                    </p>

                    <!-- 2 Buttons: Hubungi Kami & Lihat Kegiatan -->
                    <div class="flex flex-wrap items-center justify-center gap-4">
                        <button 
                            type="button" 
                            onclick="handlePinjam('Layanan Konsultasi Khusus Laboratorium', 'Tersedia')" 
                            class="px-7 py-3 rounded-xl bg-[#F59E0B] hover:bg-[#D97706] text-white font-bold text-xs sm:text-sm shadow-md shadow-amber-500/25 transition active:scale-95 cursor-pointer"
                        >
                            Hubungi Kami
                        </button>
                        <a 
                            href="{{ route('riset') }}" 
                            class="px-7 py-3 rounded-xl border border-white/60 hover:bg-white/10 text-white font-semibold text-xs sm:text-sm transition active:scale-95"
                        >
                            Lihat Kegiatan
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>


<!-- MODAL: DETAIL LAYANAN FASILITAS -->
<div id="detailLayananModal" class="fixed inset-0 z-50 bg-slate-900/70 backdrop-blur-sm items-center justify-center p-4 transition-all" style="display: none;">
    <div class="bg-white rounded-3xl max-w-lg w-full shadow-2xl overflow-hidden border border-slate-200 animate-fade-in">
        
        <div class="relative h-48 w-full bg-slate-900 overflow-hidden">
            <img id="detailModalImage" src="" alt="Layanan" class="w-full h-full object-cover opacity-90">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/40 to-transparent"></div>
            
            <button 
                type="button" 
                onclick="tutupDetailLayanan()" 
                class="absolute top-4 right-4 w-9 h-9 rounded-full bg-white/20 hover:bg-white/40 backdrop-blur-md text-white flex items-center justify-center transition"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="absolute bottom-4 left-5 right-5 text-white">
                <span id="detailModalBadge" class="inline-block px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-[#F59E0B] text-white mb-1.5 uppercase tracking-wide">
                    Kategori
                </span>
                <h3 id="detailModalTitle" class="text-xl font-bold leading-tight">
                    Nama Layanan
                </h3>
            </div>
        </div>

        <div class="p-6">
            <p id="detailModalDesc" class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-4">
                Deskripsi lengkap layanan.
            </p>

            <div class="mb-5">
                <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Cakupan & Fasilitas:</h4>
                <ul id="detailModalList" class="space-y-2 text-xs text-slate-600">
                    <!-- Populated dynamically -->
                </ul>
            </div>

            <div class="flex items-center gap-3 pt-3 border-t border-slate-100">
                <button 
                    type="button" 
                    onclick="tutupDetailLayanan()" 
                    class="w-1/2 py-2.5 px-4 rounded-xl border border-slate-300 text-slate-700 font-semibold text-xs hover:bg-slate-50 transition"
                >
                    Tutup
                </button>
                <button 
                    type="button" 
                    id="detailModalSubmitBtn"
                    class="w-1/2 py-2.5 px-4 rounded-xl bg-[#1E3A8A] hover:bg-[#1e40af] text-white font-semibold text-xs shadow-md transition"
                >
                    Ajukan Layanan
                </button>
            </div>
        </div>

    </div>
</div>


<!-- MODAL: LIHAT MODUL PRAKTIKUM & SOP -->
<div id="modulSopModal" class="fixed inset-0 z-50 bg-slate-900/70 backdrop-blur-sm items-center justify-center p-4 transition-all" style="display: none;">
    <div class="bg-white rounded-3xl max-w-lg w-full shadow-2xl overflow-hidden border border-slate-200 animate-fade-in">
        
        <div class="bg-[#1E3A8A] p-5 text-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-bold">Modul Praktikum & SOP Laboratorium</h3>
                    <p class="text-xs text-blue-100">Wargalab Sistem Informasi UTM</p>
                </div>
            </div>
            <button 
                type="button" 
                onclick="tutupModulSopModal()" 
                class="text-white/80 hover:text-white p-1 rounded-lg hover:bg-white/10 transition"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-6">
            <div class="space-y-3">
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold text-[#1E3A8A]">SOP Peminjaman Inventaris Lab 2026</div>
                        <div class="text-[11px] text-slate-500">PDF Document • 1.2 MB</div>
                    </div>
                    <a href="javascript:void(0)" onclick="alert('Mengunduh SOP Peminjaman Inventaris Lab 2026...')" class="px-3 py-1.5 rounded-lg bg-[#1E3A8A] text-white text-xs font-semibold hover:bg-blue-800 transition">
                        Unduh
                    </a>
                </div>

                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold text-[#1E3A8A]">Modul Terpadu Praktikum SI Semester Ganjil</div>
                        <div class="text-[11px] text-slate-500">Kumpulan 6 Modul Praktikum • 4.8 MB</div>
                    </div>
                    <a href="javascript:void(0)" onclick="handleDownloadModul()" class="px-3 py-1.5 rounded-lg bg-[#F59E0B] text-white text-xs font-semibold hover:bg-[#D97706] transition">
                        Unduh
                    </a>
                </div>

                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold text-[#1E3A8A]">Formulir Berita Acara Peminjaman & Kerusakan</div>
                        <div class="text-[11px] text-slate-500">Docx Template • 540 KB</div>
                    </div>
                    <a href="javascript:void(0)" onclick="alert('Mengunduh Formulir Berita Acara...')" class="px-3 py-1.5 rounded-lg bg-slate-200 text-slate-700 text-xs font-semibold hover:bg-slate-300 transition">
                        Unduh
                    </a>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-100 flex justify-end">
                <button 
                    type="button" 
                    onclick="tutupModulSopModal()" 
                    class="py-2 px-5 rounded-xl bg-slate-100 text-slate-700 text-xs font-semibold hover:bg-slate-200 transition"
                >
                    Tutup
                </button>
            </div>
        </div>

    </div>
</div>


<!-- JAVASCRIPT LOGIC (Filter Katalog, Modal, & Accordion FAQ) -->
<script>
    // Toggle FAQ Accordion
    function toggleFaq(id) {
        const answer = document.getElementById(id);
        const icon = document.getElementById('icon-' + id);
        
        if (answer.classList.contains('hidden')) {
            answer.classList.remove('hidden');
            icon.classList.add('rotate-180');
        } else {
            answer.classList.add('hidden');
            icon.classList.remove('rotate-180');
        }
    }

    // Filter Katalog berdasarkan peran pengguna (Semua, Mahasiswa, Dosen, Umum)
    function filterKatalogLayanan(kategori, btnElement) {
        const allTabs = document.querySelectorAll('.layanan-tab');
        allTabs.forEach(tab => {
            tab.classList.remove('bg-[#1E3A8A]', 'text-white', 'border-[#1E3A8A]');
            tab.classList.add('bg-white', 'text-slate-700', 'border-slate-300');
        });

        btnElement.classList.remove('bg-white', 'text-slate-700', 'border-slate-300');
        btnElement.classList.add('bg-[#1E3A8A]', 'text-white', 'border-[#1E3A8A]');

        const cards = document.querySelectorAll('.layanan-card');
        cards.forEach(card => {
            const cardCategories = card.getAttribute('data-category') || '';
            if (kategori === 'all' || cardCategories.includes(kategori)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Modal Detail Layanan
    function bukaDetailLayanan(title, badge, desc, imgUrl, points) {
        document.getElementById('detailModalTitle').innerText = title;
        document.getElementById('detailModalBadge').innerText = badge;
        document.getElementById('detailModalDesc').innerText = desc;
        document.getElementById('detailModalImage').src = imgUrl;

        const listContainer = document.getElementById('detailModalList');
        listContainer.innerHTML = '';
        if (points && points.length > 0) {
            points.forEach(pt => {
                const li = document.createElement('li');
                li.className = 'flex items-center gap-2';
                li.innerHTML = `<svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg><span>${pt}</span>`;
                listContainer.appendChild(li);
            });
        }

        const submitBtn = document.getElementById('detailModalSubmitBtn');
        submitBtn.onclick = function() {
            tutupDetailLayanan();
            if (typeof handlePinjam === 'function') {
                handlePinjam(title, 'Tersedia');
            } else {
                alert('Silakan ajukan permohonan melalui formulir peminjaman terpadu.');
            }
        };

        const modal = document.getElementById('detailLayananModal');
        modal.style.display = 'flex';
    }

    function tutupDetailLayanan() {
        const modal = document.getElementById('detailLayananModal');
        modal.style.display = 'none';
    }

    // Modal SOP & Modul Praktikum
    function bukaModulSopModal() {
        document.getElementById('modulSopModal').style.display = 'flex';
    }

    function tutupModulSopModal() {
        document.getElementById('modulSopModal').style.display = 'none';
    }

    // Tutup modal jika klik di luar box modal
    window.addEventListener('click', function(event) {
        const detailModal = document.getElementById('detailLayananModal');
        if (event.target === detailModal) {
            tutupDetailLayanan();
        }
        const sopModal = document.getElementById('modulSopModal');
        if (event.target === sopModal) {
            tutupModulSopModal();
        }
    });
</script>
@endsection
