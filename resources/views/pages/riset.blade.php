@extends('layouts.app')

@section('content')
<main class="w-full text-slate-800 bg-white">

    <!-- 1. SECTION HERO BANNER: KEAHLIAN & PEMINATAN (Container max-w-screen-2xl px-8 md:px-16) -->
    <section class="py-16 md:py-24 bg-gradient-to-b from-blue-50/50 via-white to-white">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16 text-center">
            
            <!-- Kicker / Tagline -->
            <span class="inline-block text-xs sm:text-sm font-bold uppercase tracking-[0.2em] text-[#D97706] mb-4">
                Eksplorasi Riset & Peminatan
            </span>

            <!-- Headline Utama (Diperbesar ke text-5xl md:text-6xl font-extrabold) -->
            <h1 class="text-5xl md:text-6xl font-extrabold text-[#1E3A8A] tracking-tight leading-tight uppercase max-w-5xl mx-auto">
                CARI KEAHLIAN DAN<br>BIDANG MINATMU DISINI
            </h1>

            <!-- Sub-deskripsi di bawahnya (Diperbesar ke text-lg md:text-xl dengan max-w-3xl mx-auto) -->
            <p class="text-slate-600 max-w-3xl mx-auto text-lg md:text-xl mt-6 leading-relaxed font-normal">
                Temukan bidang peminatan keilmuan yang tepat serta dosen pembimbing riset di Laboratorium Sistem Informasi Universitas Trunojoyo Madura.
            </p>

            <!-- Box Statistik (Lebar max-w-5xl mx-auto, padding p-8 md:p-10, angka text-4xl md:text-5xl font-extrabold) -->
            <div class="mt-14 max-w-5xl mx-auto bg-[#EEF5FF] border border-blue-100 rounded-3xl p-8 md:p-10 shadow-sm">
                <div class="grid grid-cols-3 gap-6 sm:gap-10 items-center justify-center text-center">
                    
                    <!-- Stat 1: 30+ Penelitian -->
                    <div class="flex flex-col items-center">
                        <div class="text-4xl md:text-5xl font-extrabold text-[#1E3A8A] tracking-tight">
                            30+
                        </div>
                        <div class="text-xs sm:text-sm font-bold uppercase tracking-wider text-[#D97706] mt-2">
                            PENELITIAN
                        </div>
                    </div>

                    <!-- Stat 2: 30+ Dosen -->
                    <div class="flex flex-col items-center border-x border-blue-200/70 px-3 sm:px-8">
                        <div class="text-4xl md:text-5xl font-extrabold text-[#1E3A8A] tracking-tight">
                            30+
                        </div>
                        <div class="text-xs sm:text-sm font-bold uppercase tracking-wider text-[#D97706] mt-2">
                            DOSEN
                        </div>
                    </div>

                    <!-- Stat 3: 10+ Peminatan -->
                    <div class="flex flex-col items-center">
                        <div class="text-4xl md:text-5xl font-extrabold text-[#1E3A8A] tracking-tight">
                            10+
                        </div>
                        <div class="text-xs sm:text-sm font-bold uppercase tracking-wider text-[#D97706] mt-2">
                            PEMINATAN
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>


    <!-- 2. SECTION DOSEN RISET (Container max-w-screen-2xl, Grid gap-8, Avatar w-28 h-28 md:w-32 md:h-32, Card p-8) -->
    <section class="py-16 md:py-24 bg-[#F8FAFC] border-y border-slate-200/80">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16">
            
            <!-- Judul Section: DOSEN RISET -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs sm:text-sm font-bold uppercase tracking-[0.2em] text-[#D97706]">
                    Katalog Dosen
                </span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-[#1E3A8A] tracking-tight uppercase mt-2">
                    DOSEN RISET
                </h2>
                <p class="text-slate-600 text-base md:text-lg mt-3">
                    Profil dosen peneliti dan kepakaran keilmuan di Program Studi Sistem Informasi UTM.
                </p>
            </div>

            <!-- Grid Kartu Dosen Dinamis dari Database Supabase -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($dosen as $d)
                    <div class="bg-white rounded-2xl border border-slate-200/90 p-8 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col items-center text-left group">
                        <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-full overflow-hidden border-2 border-white shadow-md mb-5 bg-slate-100 ring-4 ring-blue-50 group-hover:scale-105 transition-transform duration-300 shrink-0">
                            <img src="{{ asset($d->foto_path ?? 'wahyudi-290x300.png') }}" alt="{{ $d->nama }}" class="w-full h-full object-cover">
                        </div>
                        <div class="w-full text-xs sm:text-sm font-medium text-slate-800 leading-normal space-y-2 pt-4 border-t border-slate-100">
                            <p class="font-bold text-[#1E3A8A] text-sm sm:text-base truncate group-hover:text-blue-900 transition-colors" title="{{ $d->nama }}">
                                <span class="text-slate-400 font-semibold">NAMA:</span> {{ $d->nama }}
                            </p>
                            <p><span class="text-slate-400 font-semibold">NIP :</span> {{ $d->nip ?? '-' }}</p>
                            <p><span class="text-slate-400 font-semibold">PRODI :</span> SISTEM INFORMASI {{ $d->prodi }}</p>
                            <p><span class="text-slate-400 font-semibold">KEAHLIAN :</span> <span class="inline-block bg-blue-50 text-[#1E3A8A] font-bold px-2.5 py-0.5 rounded text-xs uppercase">{{ $d->keahlian ?? 'General IT' }}</span></p>
                            <p><span class="text-slate-400 font-semibold">NO. TLP :</span> {{ $d->no_telp ?? '-' }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 text-center py-12 text-slate-400">
                        Belum ada data profil dosen riset di database.
                    </div>
                @endforelse
            </div>

        </div>
    </section>


    <!-- 3. SECTION ALUR MENGHUBUNGI DOSEN (Container max-w-screen-2xl px-8 md:px-16) -->
    <section class="py-16 md:py-24 bg-white">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16">
            
            <!-- Judul Section -->
            <div class="text-center max-w-3xl mx-auto mb-14">
                <span class="text-xs sm:text-sm font-bold uppercase tracking-[0.2em] text-[#D97706]">
                    Alur Komunikasi
                </span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-[#1E3A8A] tracking-tight uppercase mt-2">
                    ALUR MENGHUBUNGI DOSEN
                </h2>
                <p class="text-slate-600 text-base md:text-lg mt-3">
                    Tiga langkah terstruktur untuk mengajukan bimbingan riset atau konsultasi ke dosen.
                </p>
            </div>

            <!-- Box Container Biru Lembut #EEF5FF (max-w-6xl) -->
            <div class="bg-[#EEF5FF] border border-blue-100 rounded-3xl p-8 md:p-14 shadow-sm max-w-6xl mx-auto relative">
                
                <!-- Garis horizontal putus-putus untuk desktop -->
                <div class="hidden md:block absolute top-18 left-[18%] right-[18%] h-0.5 border-t-2 border-dashed border-blue-200/80 z-0"></div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 sm:gap-12 relative z-10">
                    
                    <!-- Langkah 1: Pilih Layanan -->
                    <div class="flex flex-col items-center md:items-start text-center md:text-left">
                        <div class="w-14 h-14 rounded-full bg-[#1E3A8A] text-white font-extrabold flex items-center justify-center text-xl shadow-md shadow-blue-950/20 ring-4 ring-white shrink-0 mb-5">
                            1
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-[#1E3A8A] mb-2">
                            Pilih dosen pembimbing
                        </h3>
                        <p class="text-sm md:text-base text-slate-600 leading-relaxed">
                            Pilih dosen berdasarkan keahlian dan bidang riset yang sesuai dari katalog dosen di atas.
                        </p>
                    </div>

                    <!-- Langkah 2: Isi Pengajuan -->
                    <div class="flex flex-col items-center md:items-start text-center md:text-left">
                        <div class="w-14 h-14 rounded-full bg-[#1E3A8A] text-white font-extrabold flex items-center justify-center text-xl shadow-md shadow-blue-950/20 ring-4 ring-white shrink-0 mb-5">
                            2
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-[#1E3A8A] mb-2">
                            Ajukan bimbingan
                        </h3>
                        <p class="text-sm md:text-base text-slate-600 leading-relaxed">
                            Sampaikan topik riset, tujuan penelitian, dan jadwal yang diinginkan melalui formulir singkat.
                        </p>
                    </div>

                    <!-- Langkah 3: Konfirmasi Admin Lab -->
                    <div class="flex flex-col items-center md:items-start text-center md:text-left">
                        <div class="w-14 h-14 rounded-full bg-[#1E3A8A] text-white font-extrabold flex items-center justify-center text-xl shadow-md shadow-blue-950/20 ring-4 ring-white shrink-0 mb-5">
                            3
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-[#1E3A8A] mb-2">
                            Konfirmasi admin lab
                        </h3>
                        <p class="text-sm md:text-base text-slate-600 leading-relaxed">
                            Admin laboratorium akan menghubungi Anda untuk konfirmasi jadwal dan persyaratan.
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </section>


    <!-- 4. SECTION EKSPLORASI BIDANG MINAT (Container max-w-screen-2xl px-8 md:px-16) -->
    <section class="py-16 md:py-24 bg-white border-t border-slate-100">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16 text-center sm:text-left">
            <div class="max-w-5xl mx-auto">
                
                <!-- Kicker -->
                <div class="text-center sm:text-left mb-2">
                    <span class="text-xs sm:text-sm font-bold uppercase tracking-[0.2em] text-[#D97706]">
                        EKSPLORASI BIDANG MINAT
                    </span>
                </div>

                <!-- Big Question Headline -->
                <h2 class="text-3xl md:text-5xl font-extrabold text-[#1E3A8A] tracking-tight leading-tight mb-4">
                    belum yakin dengan bidang minatmu ?
                </h2>

                <!-- Paragraph Description -->
                <p class="text-slate-600 text-base md:text-lg leading-relaxed font-normal mb-8 max-w-4xl">
                    Ikuti asesmen singkat berbasis kasus industri untuk mengetahui rekomendasi bidang minat yang cocok dengangaya belajar dan keunggulan teknismu.
                </p>

                <!-- Wide Action Button: Mulai Test Bidang Minat -->
                <div>
                    <button 
                        type="button" 
                        onclick="bukaAsesmenModal()"
                        class="w-full py-4 px-8 rounded-xl bg-[#F59E0B] hover:bg-[#D97706] text-white font-bold text-base sm:text-lg shadow-md shadow-amber-500/20 hover:shadow-lg transition-all active:scale-98 text-center inline-flex items-center justify-center gap-2 cursor-pointer max-w-2xl mx-auto"
                    >
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                        <span>mulai test bidang minat</span>
                    </button>
                </div>

            </div>
        </div>
    </section>


    <!-- 5. SECTION HASIL ASESMEN ANDA & REKOMENDASI DOSEN (Container max-w-screen-2xl px-8 md:px-16) -->
    <section id="hasil-asesmen-section" class="py-16 md:py-24 bg-[#F8FAFC] border-t border-slate-200/80">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16">
            <div class="max-w-6xl mx-auto">
                
                <!-- Header Bar Pill: Hasil asesmen anda (Warna Navy Elegan) -->
                <div class="w-full py-4 px-8 rounded-2xl bg-[#1E3A8A] text-white font-bold text-base sm:text-lg text-center shadow-sm mb-8 tracking-wide">
                    Hasil asesmen anda
                </div>

                <!-- Outer Container Box Bersih & Elegan -->
                <div class="rounded-3xl border border-slate-200/90 bg-white p-8 md:p-12 shadow-sm">
                    
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-stretch">
                        
                        <!-- Kolom Kiri: Score Circle 30% Data Science -->
                        <div class="md:col-span-4 bg-gradient-to-br from-blue-50/80 to-[#EEF5FF] rounded-2xl p-6 sm:p-8 flex flex-col items-center justify-center text-center border border-blue-100 shadow-sm">
                            
                            <!-- Circle Percentage 30% -->
                            <div class="w-32 h-32 sm:w-36 sm:h-36 rounded-full bg-white flex items-center justify-center shadow-md border-4 border-[#1E3A8A]">
                                <span id="hasilPersenText" class="text-3xl sm:text-4xl font-extrabold text-[#1E3A8A]">
                                    30%
                                </span>
                            </div>

                            <!-- Label Minat -->
                            <h3 id="hasilBidangText" class="text-lg sm:text-xl font-bold text-[#1E3A8A] mt-5">
                                Data science
                            </h3>

                            <span class="inline-block px-4 py-1.5 bg-amber-100/70 text-amber-800 text-xs font-bold rounded-full mt-2.5 border border-amber-200">
                                Kecocokan Tertinggi
                            </span>

                        </div>

                        <!-- Kolom Kanan: Rekomendasi Dosen (3 Kartu Dosen) -->
                        <div class="md:col-span-8 flex flex-col justify-between">
                            
                            <!-- Judul Rekomendasi Dosen -->
                            <h4 class="text-base sm:text-lg font-bold text-[#1E3A8A] text-center mb-6 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5 text-[#F59E0B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                                <span>Rekomendasi dosen</span>
                            </h4>

                            <!-- 3 Kartu Dosen Rekomendasi -->
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                                
                                <!-- Kartu Rekomendasi 1 -->
                                <div class="bg-[#F8FAFC] rounded-2xl p-5 flex flex-col items-center text-left border border-slate-200/80 shadow-sm hover:border-blue-200 hover:shadow-md transition-all">
                                    <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-white shadow-sm mb-3 bg-slate-100 shrink-0">
                                        <img src="{{ asset('wahyudi-290x300.png') }}" alt="Dosen Rekomendasi" class="w-full h-full object-cover">
                                    </div>
                                    <div class="w-full text-xs text-slate-700 leading-normal space-y-1">
                                        <p class="font-bold text-[#1E3A8A] truncate"><span class="text-slate-400">NAMA:</span> WAHYUDI AGUSTIONO, M.Sc.</p>
                                        <p><span class="text-slate-400 font-medium">NIP :</span> 198008182005011001</p>
                                        <p class="truncate"><span class="text-slate-400 font-medium">PRODI :</span> SISTEM INFORMASI</p>
                                        <p><span class="text-slate-400 font-medium">KEAHLIAN :</span> <span class="text-[#1E3A8A] font-bold">DATA MINING</span></p>
                                        <p><span class="text-slate-400 font-medium">NO. TLP :</span> 081234567890</p>
                                    </div>
                                </div>

                                <!-- Kartu Rekomendasi 2 -->
                                <div class="bg-[#F8FAFC] rounded-2xl p-5 flex flex-col items-center text-left border border-slate-200/80 shadow-sm hover:border-blue-200 hover:shadow-md transition-all">
                                    <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-white shadow-sm mb-3 bg-slate-100 shrink-0">
                                        <img src="{{ asset('doniii-294x300.png') }}" alt="Dosen Rekomendasi" class="w-full h-full object-cover">
                                    </div>
                                    <div class="w-full text-xs text-slate-700 leading-normal space-y-1">
                                        <p class="font-bold text-[#1E3A8A] truncate"><span class="text-slate-400">NAMA:</span> Dr. FIRMAN MAULANA</p>
                                        <p><span class="text-slate-400 font-medium">NIP :</span> 197904122003121003</p>
                                        <p class="truncate"><span class="text-slate-400 font-medium">PRODI :</span> SISTEM INFORMASI</p>
                                        <p><span class="text-slate-400 font-medium">KEAHLIAN :</span> <span class="text-[#1E3A8A] font-bold">MACHINE LEARNING</span></p>
                                        <p><span class="text-slate-400 font-medium">NO. TLP :</span> 081345678901</p>
                                    </div>
                                </div>

                                <!-- Kartu Rekomendasi 3 -->
                                <div class="bg-[#F8FAFC] rounded-2xl p-5 flex flex-col items-center text-left border border-slate-200/80 shadow-sm hover:border-blue-200 hover:shadow-md transition-all">
                                    <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-white shadow-sm mb-3 bg-slate-100 shrink-0">
                                        <img src="{{ asset('wahyudi-290x300.png') }}" alt="Dosen Rekomendasi" class="w-full h-full object-cover">
                                    </div>
                                    <div class="w-full text-xs text-slate-700 leading-normal space-y-1">
                                        <p class="font-bold text-[#1E3A8A] truncate"><span class="text-slate-400">NAMA:</span> SITI AISYAH, M.Kom.</p>
                                        <p><span class="text-slate-400 font-medium">NIP :</span> 198801122014042002</p>
                                        <p class="truncate"><span class="text-slate-400 font-medium">PRODI :</span> SISTEM INFORMASI</p>
                                        <p><span class="text-slate-400 font-medium">KEAHLIAN :</span> <span class="text-[#1E3A8A] font-bold">DATA ANALYTICS</span></p>
                                        <p><span class="text-slate-400 font-medium">NO. TLP :</span> 081678901234</p>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>

</main>


<!-- MODAL: ASESMEN MINAT RISET INTERAKTIF (Gaya Fasilitas: Navy, Amber, Elegan) -->
<div id="asesmenModal" class="fixed inset-0 z-50 bg-slate-900/70 backdrop-blur-sm items-center justify-center p-4 transition-all" style="display: none;">
    <div class="bg-white rounded-3xl max-w-lg w-full shadow-2xl overflow-hidden border border-slate-200 animate-fade-in">
        
        <div class="bg-[#1E3A8A] p-5 text-white flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold">Asesmen Cepat Bidang Minat Riset</h3>
                <p class="text-xs text-blue-100">Laboratorium Sistem Informasi UTM</p>
            </div>
            <button 
                type="button" 
                onclick="tutupAsesmenModal()" 
                class="text-white/80 hover:text-white p-1 rounded-lg hover:bg-white/10 transition"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form onsubmit="hitungHasilAsesmen(event)" class="p-6 space-y-4 text-xs sm:text-sm">
            
            <div>
                <label class="block font-bold text-slate-800 mb-1.5">1. Apa topik yang paling menarik minat belajarmu?</label>
                <select id="tanya1" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-[#1E3A8A] focus:outline-none">
                    <option value="datascience">Analisis Data, Pola Konsumen, & Kecerdasan Buatan (AI)</option>
                    <option value="software">Rekayasa Web, Mobile App, & Arsitektur Microservices</option>
                    <option value="governance">Audit Keamanan, Tata Kelola IT (COBIT), & Manajemen Resiko</option>
                </select>
            </div>

            <div>
                <label class="block font-bold text-slate-800 mb-1.5">2. Gaya pemecahan masalah yang paling kamu sukai?</label>
                <select id="tanya2" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-[#1E3A8A] focus:outline-none">
                    <option value="datascience">Mengeksplorasi dataset, visualisasi grafik, & modeling statistik</option>
                    <option value="software">Mendesain UI/UX interaktif & menyusun logika kode modular</option>
                    <option value="governance">Mengevaluasi standar kepatuhan proses bisnis instansi</option>
                </select>
            </div>

            <div>
                <label class="block font-bold text-slate-800 mb-1.5">3. Ekspektasi peran masa depan di industri?</label>
                <select id="tanya3" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-[#1E3A8A] focus:outline-none">
                    <option value="datascience">Data Analyst / Machine Learning Engineer</option>
                    <option value="software">Fullstack Web Engineer / Product Developer</option>
                    <option value="governance">IT Auditor / Chief Information Officer (CIO)</option>
                </select>
            </div>

            <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                <button 
                    type="button" 
                    onclick="tutupAsesmenModal()" 
                    class="px-4 py-2.5 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-50 font-medium"
                >
                    Batal
                </button>
                <button 
                    type="submit" 
                    class="px-6 py-2.5 rounded-xl bg-[#F59E0B] hover:bg-[#D97706] text-white font-bold shadow-md shadow-amber-500/20 transition active:scale-95"
                >
                    Lihat Rekomendasi
                </button>
            </div>

        </form>

    </div>
</div>


<!-- JAVASCRIPT LOGIC UNTUK ASESMEN MINAT -->
<script>
    function bukaAsesmenModal() {
        document.getElementById('asesmenModal').style.display = 'flex';
    }

    function tutupAsesmenModal() {
        document.getElementById('asesmenModal').style.display = 'none';
    }

    function hitungHasilAsesmen(event) {
        event.preventDefault();
        
        const q1 = document.getElementById('tanya1').value;
        const q2 = document.getElementById('tanya2').value;
        const q3 = document.getElementById('tanya3').value;

        let skor = { datascience: 0, software: 0, governance: 0 };
        skor[q1]++;
        skor[q2]++;
        skor[q3]++;

        let minatTeratas = 'datascience';
        let namaBidang = 'Data science';
        let persentase = '85%';

        if (skor.software > skor.datascience && skor.software >= skor.governance) {
            minatTeratas = 'software';
            namaBidang = 'Software engineering';
            persentase = '85%';
        } else if (skor.governance > skor.datascience && skor.governance > skor.software) {
            minatTeratas = 'governance';
            namaBidang = 'IT Governance & Audit';
            persentase = '80%';
        } else {
            persentase = '85%';
            namaBidang = 'Data science';
        }

        document.getElementById('hasilPersenText').innerText = persentase;
        document.getElementById('hasilBidangText').innerText = namaBidang;

        tutupAsesmenModal();

        // Scroll halus ke bagian hasil asesmen
        const section = document.getElementById('hasil-asesmen-section');
        if (section) {
            section.scrollIntoView({ behavior: 'smooth' });
        }
    }

    // Close modal on outside click
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('asesmenModal');
        if (event.target === modal) {
            tutupAsesmenModal();
        }
    });
</script>
@endsection

