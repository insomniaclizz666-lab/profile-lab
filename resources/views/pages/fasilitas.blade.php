@extends('layouts.app')

@section('content')
<main class="w-full bg-white text-slate-800">

    <!-- 1. HERO SECTION: LAYANAN LABORATORIUM (Container max-w-screen-2xl px-8 md:px-16) -->
    <section class="py-16 md:py-24 bg-gradient-to-b from-blue-50/50 via-white to-white border-b border-slate-100">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16 text-center">
            
            <!-- Kicker / Tag -->
            <span class="inline-block text-xs sm:text-sm font-bold uppercase tracking-[0.2em] text-[#D97706] mb-4">
                Fasilitas Laboratorium
            </span>

            <!-- Main Title -->
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-[#1E3A8A] tracking-tight leading-tight uppercase max-w-5xl mx-auto">
                Fasilitas untuk Belajar, Meneliti,<br class="hidden sm:inline" /> dan Berkarya
            </h1>

            <!-- Subtitle -->
            <p class="text-slate-600 max-w-3xl mx-auto text-base sm:text-lg md:text-xl mt-6 leading-relaxed font-normal">
                Wargalab SI UTM melayani kebutuhan praktikum, riset, pelatihan, hingga konsultasi sistem informasi bagi mahasiswa, dosen, dan mitra.
            </p>

            <!-- Call to Action Button: Hubungi Kami -->
            <div class="mt-8">
                <a href="#katalog-layanan" class="inline-flex items-center justify-center px-8 py-3 rounded-xl bg-[#F59E0B] hover:bg-[#D97706] text-white font-bold text-sm sm:text-base shadow-md shadow-amber-500/20 hover:shadow-lg transition-all duration-200 active:scale-95">
                    Jelajahi Fasilitas
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
                        <span>6 Jenis Fasilitas</span>
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
                    Fasilitas laboratorium
                </h2>
                <p class="text-slate-600 text-xs sm:text-sm md:text-base mt-2">
                    Dukungan yang tepat untuk setiap tahap pembelajaran, penelitian, dan kolaborasi Anda.
                </p>

                <!-- Filter Tabs: Semua / Mahasiswa / Dosen / Umum -->
                <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-3 mt-6">
                    <button 
                        type="button" 
                        onclick="filterKatalog('all', this)" 
                        class="katalog-tab px-5 py-1.5 rounded-full text-xs font-semibold border border-slate-300 bg-white text-slate-700 hover:border-[#1E3A8A] hover:text-[#1E3A8A] transition-all shadow-sm active:scale-95"
                    >
                        Semua
                    </button>
                    <button 
                        type="button" 
                        onclick="filterKatalog('mahasiswa', this)" 
                        class="katalog-tab px-5 py-1.5 rounded-full text-xs font-semibold border border-[#1E3A8A] bg-[#1E3A8A] text-white shadow-sm transition-all active:scale-95"
                    >
                        Mahasiswa
                    </button>
                    <button 
                        type="button" 
                        onclick="filterKatalog('dosen', this)" 
                        class="katalog-tab px-5 py-1.5 rounded-full text-xs font-semibold border border-slate-300 bg-white text-slate-700 hover:border-[#1E3A8A] hover:text-[#1E3A8A] transition-all shadow-sm active:scale-95"
                    >
                        Dosen
                    </button>
                    <button 
                        type="button" 
                        onclick="filterKatalog('umum', this)" 
                        class="katalog-tab px-5 py-1.5 rounded-full text-xs font-semibold border border-slate-300 bg-white text-slate-700 hover:border-[#1E3A8A] hover:text-[#1E3A8A] transition-all shadow-sm active:scale-95"
                    >
                        Umum
                    </button>
                </div>
            </div>

            <!-- 6 Cards Grid (3 Columns x 2 Rows) -->
            <div id="katalogGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7 mt-10">
                @forelse($fasilitas as $f)
                    <div 
                        data-category="{{ strtolower($f->sasaran) }}" 
                        class="katalog-card bg-white rounded-2xl border border-slate-200/90 p-5 sm:p-6 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group"
                    >
                        <div>
                            <!-- Header Title -->
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-bold text-[#1E3A8A] group-hover:text-blue-900 transition-colors">
                                    {{ $f->judul }}
                                </h3>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $f->status_ketersediaan === 'Tersedia' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                    {{ $f->status_ketersediaan }}
                                </span>
                            </div>

                            <!-- Image -->
                            <div class="relative w-full h-44 rounded-xl overflow-hidden bg-slate-100 my-4 border border-slate-100">
                                <img 
                                    src="{{ $f->foto_path ? (str_starts_with($f->foto_path, 'http') ? $f->foto_path : asset('storage/' . $f->foto_path)) : 'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=700&q=80' }}" 
                                    alt="{{ $f->judul }}" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    loading="lazy"
                                    onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=700&q=80';"
                                />
                                <div class="absolute bottom-2.5 right-2.5 bg-white/90 backdrop-blur-md px-2.5 py-1 rounded-lg shadow-sm border border-slate-200/80 flex items-center gap-1.5">
                                    <span class="text-[10px] font-bold text-[#1E3A8A]">{{ $f->kategori }}</span>
                                </div>
                            </div>

                            <!-- Description -->
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed min-h-[44px]">
                                {{ $f->deskripsi_singkat }}
                            </p>

                            <!-- Target Audience Tag -->
                            <div class="mt-3">
                                <span class="inline-block px-3 py-1 bg-slate-100 text-slate-600 text-[11px] font-medium rounded-md">
                                    Sasaran: {{ ucfirst($f->sasaran) }}
                                </span>
                            </div>

                            <!-- Bullet Points Cakupan -->
                            @if(!empty($f->cakupan))
                                <div class="mt-4 pt-3 border-t border-slate-100 space-y-1.5">
                                    @foreach($f->cakupan as $cp)
                                        <div class="flex items-center gap-2 text-xs text-slate-600">
                                            <span class="text-emerald-500 font-bold">?</span>
                                            <span>{{ $cp }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Action Button Pinjam -->
                        <div class="mt-6 pt-4 border-t border-slate-100">
                            <button 
                                type="button" 
                                onclick="openPeminjamanModalWithItem('{{ $f->judul }}')"
                                class="w-full py-2.5 px-4 rounded-xl font-bold text-xs bg-[#1E3A8A] hover:bg-[#172554] text-white transition-all shadow-sm hover:shadow flex items-center justify-center gap-2"
                            >
                                <span>Ajukan Peminjaman</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-slate-400">
                        Belum ada katalog fasilitas yang tersimpan.
                    </div>
                @endforelse
            </div>
        </div>
    </section>


    <!-- 3. SECTION KETENTUAN PENGGUNAAN & SOP LABORATORIUM (Container max-w-screen-2xl px-8 md:px-16) -->
    <section id="sop-section" class="py-16 sm:py-20 bg-white">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-14 items-center">
                
                <!-- Kolom Kiri: SOP & Ketentuan -->
                <div>
                    <!-- Kicker -->
                    <span class="text-xs sm:text-sm font-bold uppercase tracking-[0.2em] text-[#D97706]">
                        Ketentuan Penggunaan
                    </span>

                    <!-- Heading -->
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#1E3A8A] tracking-tight mt-2 leading-tight">
                        Ketentuan &amp; SOP Peminjaman
                    </h2>

                    <!-- Subtitle Keterangan -->
                    <p class="text-slate-600 text-xs sm:text-sm md:text-base mt-3 leading-relaxed">
                        Pengajuan peminjaman wajib dilakukan minimal 1×24 jam sebelum pemakaian dan barang dikembalikan paling lambat H+2 setelah acara selesai dalam kondisi baik.
                    </p>

                    <!-- Checklist SOP dengan Icon Bulat -->
                    <div class="mt-6 space-y-3.5">
                        
                        <!-- Poin 1: Surat permohonan -->
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-full border border-blue-200 bg-blue-50/80 text-[#1E3A8A] flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <span class="text-xs sm:text-sm text-slate-700 font-medium">Surat permohonan</span>
                        </div>

                        <!-- Poin 2: Waktu peminjaman -->
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-full border border-blue-200 bg-blue-50/80 text-[#1E3A8A] flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-xs sm:text-sm text-slate-700 font-medium">Waktu peminjaman</span>
                        </div>

                        <!-- Poin 3: Kondisi pengembalian & persetujuan -->
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-full border border-blue-200 bg-blue-50/80 text-[#1E3A8A] flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-xs sm:text-sm text-slate-700 font-medium">Kondisi pengembalian dan berita acara</span>
                        </div>

                        <!-- Poin 4: 02 : PC Upgrade -->
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-full border border-blue-200 bg-blue-50/80 text-[#1E3A8A] flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span class="text-xs sm:text-sm text-slate-700 font-medium">Verifikasi kondisi alat sebelum dan sesudah penggunaan</span>
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

                <!-- Kolom Kanan: Gambar Dokumentasi Laboratorium dengan foto random dari internet -->
                <div class="relative">
                    <div class="relative rounded-3xl overflow-hidden bg-slate-100 border border-slate-200/90 shadow-lg group aspect-4/3 sm:aspect-16/10 flex items-center justify-center">
                        
                        <!-- Gambar dari internet: Suasana Laboratorium Komputer Modern -->
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
                    Tiga langkah sederhana untuk memulai aktivitas Anda bersama Wargalab.
                </p>
            </div>

            <!-- Steps Grid (1, 2, 3 dengan Garis Putus-putus) -->
            <div class="relative max-w-6xl mx-auto">
                
                <!-- Garis horizontal putus-putus (hanya tampil di layar desktop md ke atas) -->
                <div class="hidden md:block absolute top-6 left-[18%] right-[18%] h-0.5 border-t-2 border-dashed border-slate-300 z-0"></div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 sm:gap-10 relative z-10">
                    
                    <!-- STEP 1: Pilih Layanan -->
                    <div class="flex flex-col items-center md:items-start text-center md:text-left">
                        <!-- Number Circle -->
                        <div class="w-12 h-12 rounded-full bg-[#1E3A8A] text-white font-extrabold flex items-center justify-center text-lg shadow-md shadow-blue-900/25 ring-4 ring-white shrink-0">
                            1
                        </div>
                        <h3 class="text-base font-bold text-[#1E3A8A] mt-5 mb-2">
                            Pilih Layanan
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Temukan layanan yang sesuai kebutuhan dari katalog di atas.
                        </p>
                    </div>

                    <!-- STEP 2: Isi Pengajuan -->
                    <div class="flex flex-col items-center md:items-start text-center md:text-left">
                        <!-- Number Circle -->
                        <div class="w-12 h-12 rounded-full bg-[#1E3A8A] text-white font-extrabold flex items-center justify-center text-lg shadow-md shadow-blue-900/25 ring-4 ring-white shrink-0">
                            2
                        </div>
                        <h3 class="text-base font-bold text-[#1E3A8A] mt-5 mb-2">
                            Isi Pengajuan
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Lengkapi formulir singkat berisi data diri, tujuan, dan waktu yang diinginkan.
                        </p>
                    </div>

                    <!-- STEP 3: Konfirmasi Admin Lab -->
                    <div class="flex flex-col items-center md:items-start text-center md:text-left">
                        <!-- Number Circle -->
                        <div class="w-12 h-12 rounded-full bg-[#1E3A8A] text-white font-extrabold flex items-center justify-center text-lg shadow-md shadow-blue-900/25 ring-4 ring-white shrink-0">
                            3
                        </div>
                        <h3 class="text-base font-bold text-[#1E3A8A] mt-5 mb-2">
                            Konfirmasi Admin Lab
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Admin laboratorium akan menghubungi Anda untuk konfirmasi jadwal dan persyaratan.
                        </p>
                    </div>

                </div>

                <!-- Callout Banner Bawah -->
                <div class="mt-14 p-5 sm:p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#1E3A8A] flex items-center justify-center shrink-0 border border-blue-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600">
                            Memerlukan inventaris khusus untuk Tugas Akhir, Skripsi, atau Acara Himpunan? Pengajuan dapat dilakukan langsung melalui sistem terpadu.
                        </p>
                    </div>
                    <button 
                        type="button" 
                        onclick="handlePinjam('Perangkat Laboratorium Terpadu', 'Tersedia')" 
                        class="shrink-0 bg-[#F59E0B] hover:bg-[#D97706] text-white font-bold text-xs sm:text-sm px-5 py-2.5 rounded-xl shadow-sm transition active:scale-95"
                    >
                        Ajukan Sekarang &rarr;
                    </button>
                </div>

            </div>

        </div>
    </section>

</main>


<!-- MODAL: DETAIL LAYANAN FASILITAS -->
<div id="detailLayananModal" class="fixed inset-0 z-50 bg-slate-900/70 backdrop-blur-sm items-center justify-center p-4 transition-all" style="display: none;">
    <div class="bg-white rounded-3xl max-w-lg w-full shadow-2xl overflow-hidden border border-slate-200 transform transition-all animate-fade-in">
        
        <!-- Modal Header with Image -->
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

        <!-- Modal Body -->
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

            <!-- Action Buttons -->
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
    <div class="bg-white rounded-3xl max-w-lg w-full shadow-2xl overflow-hidden border border-slate-200 transform transition-all animate-fade-in">
        
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
                    <a href="{{ route('akademik') }}" class="px-3 py-1.5 rounded-lg bg-[#F59E0B] text-white text-xs font-semibold hover:bg-[#D97706] transition">
                        Lihat Jadwal
                    </a>
                </div>

                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold text-[#1E3A8A]">Formulir Berita Acara Kerusakan & Pengembalian</div>
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


<!-- JAVASCRIPT LOGIC UNTUK FILTER KATALOG & MODAL INTERAKTIF -->
<script>
    // Filter Katalog berdasarkan peran pengguna (Semua, Mahasiswa, Dosen, Umum)
    function filterKatalog(kategori, btnElement) {
        // Update styling tombol tab
        const allTabs = document.querySelectorAll('.katalog-tab');
        allTabs.forEach(tab => {
            tab.classList.remove('bg-[#1E3A8A]', 'text-white', 'border-[#1E3A8A]');
            tab.classList.add('bg-white', 'text-slate-700', 'border-slate-300');
        });

        btnElement.classList.remove('bg-white', 'text-slate-700', 'border-slate-300');
        btnElement.classList.add('bg-[#1E3A8A]', 'text-white', 'border-[#1E3A8A]');

        // Filter cards
        const cards = document.querySelectorAll('.katalog-card');
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

