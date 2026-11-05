@extends('layouts.app')

@section('content')
    <!-- 2. HERO SECTION (Front-End / Landing Page) -->
    <section id="beranda" class="relative w-full h-screen min-h-[600px] flex items-center overflow-hidden">

        <!-- Video Background: mengisi penuh section secara cover -->
        <div class="absolute inset-0 z-0">
            <video
                class="w-full h-full object-cover object-center"
                autoplay loop muted playsinline
                src="{{ asset('video_profil.mp4') }}">
            </video>
            <!-- Gradient Overlay: kuat di kiri (area teks), memudar ke kanan -->
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-transparent"></div>
        </div>

        <!-- Konten Teks: z-10 agar berada di atas video -->
        <div class="z-10 w-full max-w-screen-2xl mx-auto px-8 md:px-16 py-20">
            <div class="max-w-2xl">

                <!-- Main Headline -->
                <h1 class="text-4xl sm:text-7xl lg:text-7xl font-extrabold tracking-tight leading-tight sm:leading-none text-white mb-6">
                    Laboratorium <span style="color:#1E3A8A;">Sistem</span> <span style="color:#1E3A8A;">Informasi</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-lg sm:text-xl text-slate-200 font-normal leading-relaxed mb-8">
                    Fakultas Teknik, Universitas Trunojoyo Madura. Pusat kegiatan praktikum, riset terapan, dan inovasi teknologi bagi mahasiswa dan dosen.
                </p>

                <!-- Quick Stats Strip (Dinamis dari Supabase) -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-12 pt-8 border-t border-white/20">
                    @forelse($stats as $s)
                        <div>
                            <div class="text-2xl sm:text-3xl font-bold" style="color:#F59E0B;">{{ $s->nilai }}{{ $s->satuan }}</div>
                            <div class="text-xs text-slate-300">{{ $s->label }}</div>
                        </div>
                    @empty
                        <div>
                            <div class="text-2xl sm:text-3xl font-bold" style="color:#F59E0B;">4 Lab</div>
                            <div class="text-xs text-slate-300">Spesialisasi Riset</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-bold" style="color:#F59E0B;">120+</div>
                            <div class="text-xs text-slate-300">High-End PC Ready</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-bold" style="color:#F59E0B;">18+</div>
                            <div class="text-xs text-slate-300">Asisten Laboran Aktif</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-bold" style="color:#F59E0B;">100%</div>
                            <div class="text-xs text-slate-300">Terintegrasi Online</div>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </section>

    <!-- 3. SECTION PROFIL & SOP LABORATORIUM -->
    <section id="profil" class="py-20 border-b border-slate-200" style="background-color:#F3F4F6;">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16">
            
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold mt-3 tracking-tight" style="color:#1E3A8A;">
                    Profil Laboratorium Sistem Informasi
                </h2>
                <p class="text-slate-600 mt-3 text-base">
                    Mendukung Tridharma Perguruan Tinggi dengan standar fasilitas komputasi berkelas dan tata kelola berintegritas tinggi.
                </p>
            </div>

            <!-- Profil Pimpinan Dinamis dari Supabase -->
            <div class="space-y-6 mb-12">
                @php
                    $kaprodi = $profils->firstWhere('jabatan', 'kaprodi');
                    $kepalaLab = $profils->firstWhere('jabatan', 'kepala_lab');
                @endphp

                <!-- Profil Kaprodi (Foto Kiri, Teks Kanan) -->
                <div class="flex flex-col md:flex-row items-center gap-6 bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                    <div class="w-32 h-32 md:w-40 md:h-40 shrink-0">
                        <img src="{{ asset($kaprodi?->foto_path ?? 'doniii-294x300.png') }}" alt="Foto Kaprodi" class="w-full h-full object-cover rounded-full shadow-md border-4 border-gray-50">
                    </div>
                    <div class="flex-1 text-left">
                        <h2 class="text-xl font-bold" style="color:#1E3A8A;">{{ $kaprodi?->nama ?? 'Dr. Firman Arifin, S.T., M.T.' }}</h2>
                        <p class="text-xs font-semibold text-amber-600 mb-2">{{ $kaprodi?->gelar ?? 'Koordinator Program Studi Sistem Informasi' }}</p>
                        <p class="text-gray-600 leading-relaxed text-sm">
                            {{ $kaprodi?->deskripsi ?? 'Memimpin dan mengkoordinasikan seluruh kegiatan akademik di lingkungan program studi Sistem Informasi UTM.' }}
                        </p>
                    </div>
                </div>

                <!-- Profil Kepala Lab (Teks Kiri, Foto Kanan) -->
                <div class="flex flex-col md:flex-row items-center gap-6 bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                    <div class="flex-1 text-left order-2 md:order-1">
                        <h2 class="text-xl font-bold" style="color:#1E3A8A;">{{ $kepalaLab?->nama ?? 'Achmad Jauhari, S.T., M.Kom.' }}</h2>
                        <p class="text-xs font-semibold text-amber-600 mb-2">{{ $kepalaLab?->gelar ?? 'Kepala Laboratorium Sistem Informasi' }}</p>
                        <p class="text-gray-600 leading-relaxed text-sm">
                            {{ $kepalaLab?->deskripsi ?? 'Memfasilitasi kegiatan praktikum berkualitas tinggi, riset mahasiswa, serta pengembangan soft skill dan hard skill berbasis teknologi mutakhir.' }}
                        </p>
                    </div>
                    <div class="w-32 h-32 md:w-40 md:h-40 shrink-0 order-1 md:order-2">
                        <img src="{{ asset($kepalaLab?->foto_path ?? 'wahyudi-290x300.png') }}" alt="Foto Kepala Laboratorium" class="w-full h-full object-cover rounded-full shadow-md border-4 border-gray-50">
                    </div>
                </div>
            </div>


            <!-- 2-Column Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-stretch">
                
                <!-- Kolom 1: Profil & Sejarah Wargalab -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-6" style="background-color:#EFF6FF; color:#1E3A8A;">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-dark mb-4">Profil & Peran Laboratorium</h3>
                        
                        <p class="text-slate-600 leading-relaxed text-sm sm:text-base mb-4">
                            <strong>Wargalab SI UTM</strong> merupakan wadah ekosistem teknologi di bawah naungan Program Studi Sistem Informasi, Jurusan Teknik Informatika, Fakultas Teknik, Universitas Trunojoyo Madura. Didirikan sebagai sarana akselerasi kompetensi praktis mahasiswa dalam bidang rekayasa perangkat lunak, data intelligence, jaringan komputer, serta audit sistem informasi.
                        </p>
                        
                        <p class="text-slate-600 leading-relaxed text-sm sm:text-base mb-6">
                            Laboratorium ini tidak hanya difungsikan untuk jadwal praktikum perkuliahan reguler, melainkan juga berfungsi sebagai laboratorium riset terapan dosen, sarana pelatihan sertifikasi profesi, dan pengabdian masyarakat.
                        </p>

                        <!-- Role CO Praktikum (Highlight Box) -->
                        <div class="rounded-xl p-5 border-l-4 mb-6" style="background-color:#EFF6FF; border-color:#1E3A8A;">
                            <h4 class="font-bold text-sm flex items-center gap-2 mb-1.5" style="color:#1E3A8A;">
                                <svg class="w-4 h-4" style="color:#1E3A8A;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                Peran Asisten Laboratorium (CO Praktikum)
                            </h4>
                            <p class="text-xs sm:text-sm text-slate-600">
                                Asisten Laboratorium (CO Praktikum) diseleksi secara ketat dari mahasiswa berprestasi untuk membimbing praktikan, mengevaluasi modul praktikum mingguan, memastikan kedisiplinan lab, serta mengawal transfer pengetahuan akademis secara interaktif.
                            </p>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                        <span>Gedung Fakultas Teknik Lantai 2, Kampus UTM</span>
                        <span class="font-semibold" style="color:#1E3A8A;">Status: Terakreditasi Unggul</span>
                    </div>
                </div>

                <!-- Kolom 1: Profil & Sejarah Wargalab 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-6" style="background-color:#EFF6FF; color:#1E3A8A;">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-dark mb-4">Profil & Peran Laboratorium</h3>
                        
                        <p class="text-slate-600 leading-relaxed text-sm sm:text-base mb-4">
                            <strong>Wargalab SI UTM</strong> merupakan wadah ekosistem teknologi di bawah naungan Program Studi Sistem Informasi, Jurusan Teknik Informatika, Fakultas Teknik, Universitas Trunojoyo Madura. Didirikan sebagai sarana akselerasi kompetensi praktis mahasiswa dalam bidang rekayasa perangkat lunak, data intelligence, jaringan komputer, serta audit sistem informasi.
                        </p>
                        
                        <p class="text-slate-600 leading-relaxed text-sm sm:text-base mb-6">
                            Laboratorium ini tidak hanya difungsikan untuk jadwal praktikum perkuliahan reguler, melainkan juga berfungsi sebagai laboratorium riset terapan dosen, sarana pelatihan sertifikasi profesi, dan pengabdian masyarakat.
                        </p>

                        <!-- Role CO Praktikum (Highlight Box) -->
                        <div class="rounded-xl p-5 border-l-4 mb-6" style="background-color:#EFF6FF; border-color:#1E3A8A;">
                            <h4 class="font-bold text-sm flex items-center gap-2 mb-1.5" style="color:#1E3A8A;">
                                <svg class="w-4 h-4" style="color:#1E3A8A;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                Peran Asisten Laboratorium (CO Praktikum)
                            </h4>
                            <p class="text-xs sm:text-sm text-slate-600">
                                Asisten Laboratorium (CO Praktikum) diseleksi secara ketat dari mahasiswa berprestasi untuk membimbing praktikan, mengevaluasi modul praktikum mingguan, memastikan kedisiplinan lab, serta mengawal transfer pengetahuan akademis secara interaktif.
                            </p>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                        <span>Gedung Fakultas Teknik Lantai 2, Kampus UTM</span>
                        <span class="font-semibold" style="color:#1E3A8A;">Status: Terakreditasi Unggul</span>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- 4. SECTION BERITA & PENGUMUMAN TERBARU -->
    <section id="berita" class="py-20 border-b border-slate-200" style="background-color:#FFFFFF;">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16">

            {{-- Section Header --}}
            <div class="text-center max-w-2xl mx-auto mb-12">
                <p class="text-xs font-semibold uppercase tracking-widest mb-2" style="color:#D97706;">Informasi Terkini</p>
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight" style="color:#1E3A8A;">
                    Berita &amp; Pengumuman Terbaru
                </h2>
                <p class="mt-3 text-slate-500 text-base">
                    Ikuti perkembangan terkini dari Laboratorium Sistem Informasi UTM — mulai dari pengumuman akademik, kegiatan, hingga rekrutmen asisten.
                </p>
            </div>

            {{-- Grid 3 Kolom Card Berita dari Database --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($beritaList as $b)
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden flex flex-col hover:shadow-md transition-shadow duration-200">
                        {{-- Thumbnail / Badge Kategori --}}
                        <div class="relative w-full h-48 shrink-0 overflow-hidden" style="background: linear-gradient(135deg, #EEF5FF 0%, #DBEAFE 100%);">
                            <div class="absolute inset-0 flex flex-col items-center justify-center gap-2">
                                @if($b->kategori === 'Pengumuman')
                                    <svg class="w-10 h-10" style="color:#F59E0B;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                                @else
                                    <svg class="w-10 h-10" style="color:#1E3A8A;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                @endif
                            </div>
                            <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider
                                {{ $b->kategori === 'Pengumuman' ? 'bg-amber-100 text-amber-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $b->kategori }}
                            </span>
                        </div>
                        {{-- Konten Card --}}
                        <div class="p-6 flex flex-col flex-1">
                            <h3 class="text-base font-bold text-gray-800 mb-1 leading-snug line-clamp-2">
                                {{ $b->judul }}
                            </h3>
                            <p class="text-xs text-slate-400 mb-3">
                                {{ $b->published_at ? $b->published_at->format('d F Y') : $b->created_at->format('d F Y') }}
                                &bull; {{ $b->penulis }}
                            </p>
                            <p class="text-sm text-slate-600 leading-relaxed line-clamp-2 flex-1">
                                {{ $b->ringkasan }}
                            </p>
                            <div class="mt-5">
                                <a href="/berita/{{ $b->slug }}" class="inline-flex items-center gap-1 text-sm font-semibold hover:underline transition-colors duration-200" style="color:#D97706;">
                                    Baca Selengkapnya
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-slate-400">Belum ada berita atau pengumuman.</div>
                @endforelse
            </div>{{-- /grid berita --}}
        </div>
    </section>


    <!-- 5. SECTION GALERI KEGIATAN PRAKTIKUM -->
    <section id="galeri" class="py-20 border-b border-slate-200" style="background-color:#EEF5FF;">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16">

            {{-- Section Header --}}
            <div class="text-center max-w-2xl mx-auto mb-12">
                <p class="text-xs font-semibold uppercase tracking-widest mb-2" style="color:#D97706;">Dokumentasi Kegiatan</p>
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight" style="color:#1E3A8A;">
                    Galeri Kegiatan Praktikum
                </h2>
                <p class="mt-3 text-slate-500 text-base">
                    Sekilas dokumentasi kegiatan praktikum, workshop, dan riset kolaboratif yang telah berlangsung di Laboratorium SI UTM.
                </p>
            </div>

            {{-- Grid Galeri dari Database --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse($galeriList as $g)
                    <div class="group relative rounded-2xl overflow-hidden shadow-sm border border-slate-200 bg-white" style="padding-top: 65%;">
                        <div class="absolute inset-0 flex flex-col items-center justify-center"
                             style="background: linear-gradient(135deg, {{ $g->kategori === 'Workshop' ? '#FEF3C7, #FDE68A' : ($g->kategori === 'Riset' ? '#E0E7FF, #C7D2FE' : '#DBEAFE, #BFDBFE') }});">
                            @if($g->kategori === 'Workshop')
                                <svg class="w-12 h-12 mb-2 opacity-40" style="color:#D97706;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            @elseif($g->kategori === 'Riset')
                                <svg class="w-12 h-12 mb-2 opacity-40" style="color:#4F46E5;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                            @else
                                <svg class="w-12 h-12 mb-2 opacity-40" style="color:#1E3A8A;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            @endif
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-amber-300 mb-1">{{ $g->kategori }}</span>
                            <p class="text-sm font-bold text-white leading-tight">{{ $g->judul }}</p>
                            @if($g->deskripsi)
                                <p class="text-xs text-slate-300 mt-1 line-clamp-2">{{ $g->deskripsi }}</p>
                            @endif
                        </div>
                        <span class="absolute top-3 left-3 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider
                            {{ $g->kategori === 'Workshop' ? 'bg-amber-100 text-amber-800' : ($g->kategori === 'Riset' ? 'bg-indigo-100 text-indigo-800' : 'bg-blue-100 text-blue-800') }}">
                            {{ $g->kategori }}
                        </span>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-slate-400">Belum ada galeri kegiatan.</div>
                @endforelse
            </div>{{-- /grid galeri --}}
        </div>
    </section>


    <!-- 6. SECTION TESTIMONI ASISTEN / MAHASISWA -->
    <section id="testimoni" class="py-20 border-b border-slate-200" style="background-color:#FFFFFF;">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16">

            {{-- Section Header --}}
            <div class="text-center max-w-2xl mx-auto mb-12">
                <p class="text-xs font-semibold uppercase tracking-widest mb-2" style="color:#D97706;">Suara Mereka</p>
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight" style="color:#1E3A8A;">
                    Testimoni Asisten &amp; Mahasiswa
                </h2>
                <p class="mt-3 text-slate-500 text-base">
                    Kisah nyata dari para mahasiswa, asisten, dan alumni yang telah merasakan manfaat langsung dari ekosistem laboratorium SI UTM.
                </p>
            </div>

            {{-- Grid Testimoni dari Database --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($testimoni as $t)
                    <div class="bg-slate-50 rounded-2xl border border-slate-200 p-8 flex flex-col items-center text-center shadow-sm hover:shadow-md transition-shadow">
                        {{-- Avatar --}}
                        @if($t->foto_path)
                            <img src="{{ asset('storage/' . $t->foto_path) }}" alt="{{ $t->nama }}" class="w-16 h-16 rounded-full object-cover mb-4 border-2 border-slate-200 shrink-0">
                        @else
                            <div class="w-16 h-16 rounded-full flex items-center justify-center mb-4 shrink-0 font-extrabold text-xl" style="background-color:#EEF5FF; color:#1E3A8A;">
                                {{ strtoupper(substr($t->nama, 0, 1)) }}
                            </div>
                        @endif
                        <h4 class="text-base font-bold" style="color:#1E3A8A;">{{ $t->nama }}</h4>
                        <p class="text-xs font-medium mb-1" style="color:#D97706;">{{ $t->role }}</p>
                        @if($t->angkatan)
                            <p class="text-[11px] text-slate-400 mb-4">{{ $t->angkatan }}</p>
                        @else
                            <div class="mb-4"></div>
                        @endif
                        <p class="text-sm text-slate-600 leading-relaxed">
                            &ldquo;{{ $t->kutipan }}&rdquo;
                        </p>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-slate-400">Belum ada testimoni.</div>
                @endforelse
            </div>{{-- /grid testimoni --}}
        </div>
    </section>


    <!-- 7. SECTION FREQUENTLY ASKED QUESTIONS (FAQ) -->
    <section id="faq" class="py-20 border-b border-slate-200" style="background-color:#F3F4F6;">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16">

            {{-- Section Header --}}
            <div class="text-center max-w-2xl mx-auto mb-12">
                <p class="text-xs font-semibold uppercase tracking-widest mb-2" style="color:#D97706;">Pertanyaan Umum</p>
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight" style="color:#1E3A8A;">
                    Frequently Asked Questions
                </h2>
                <p class="mt-3 text-slate-500 text-base">
                    Temukan jawaban atas pertanyaan yang paling sering diajukan seputar kegiatan, fasilitas, dan layanan Laboratorium SI UTM.
                </p>
            </div>

            {{-- List FAQ Akordion dari Database --}}
            <div class="max-w-3xl mx-auto space-y-3">
                @forelse($faqList as $idx => $faq)
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                        <button type="button"
                            onclick="toggleFaq('faq-{{ $faq->id }}')"
                            class="w-full flex items-center justify-between px-6 py-4 text-left focus:outline-none group">
                            <span class="text-sm sm:text-base font-semibold pr-4" style="color:#1E3A8A;">
                                {{ $faq->pertanyaan }}
                            </span>
                            <svg id="faq-icon-{{ $faq->id }}" class="w-5 h-5 shrink-0 transition-transform duration-200" style="color:#D97706;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div id="faq-{{ $faq->id }}" class="hidden px-6 pb-5">
                            <p class="text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-4">
                                {{ $faq->jawaban }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-slate-400 py-8">Belum ada FAQ tersedia.</p>
                @endforelse
            </div>{{-- /list faq --}}
        </div>
    </section>

    <script>
    function toggleFaq(id) {
        const el = document.getElementById(id);
        const icon = document.getElementById('faq-icon-' + id.replace('faq-', ''));
        if (el.classList.contains('hidden')) {
            el.classList.remove('hidden');
            icon.style.transform = 'rotate(180deg)';
        } else {
            el.classList.add('hidden');
            icon.style.transform = 'rotate(0deg)';
        }
    }
    </script>


    <!-- 8. SECTION KEMITRAAN & KOLABORASI -->
    <section id="kemitraan" class="py-16" style="background-color:#FFFFFF;">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16">

            {{-- Section Header (kecil) --}}
            <div class="text-center mb-10">
                <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color:#D97706;">Jaringan Kami</p>
                <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight" style="color:#1E3A8A;">
                    Kemitraan &amp; Kolaborasi
                </h2>
            </div>

            {{-- Baris Logo Mitra (5 placeholder, rata tengah) --}}
            <div class="flex flex-wrap items-center justify-center gap-8">

                {{-- Logo Mitra 1 --}}
                <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center shrink-0">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>

                {{-- Logo Mitra 2 --}}
                <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center shrink-0">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>

                {{-- Logo Mitra 3 --}}
                <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center shrink-0">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                {{-- Logo Mitra 4 --}}
                <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center shrink-0">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                    </svg>
                </div>

                {{-- Logo Mitra 5 --}}
                <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center shrink-0">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>

            </div>{{-- /baris logo mitra --}}
        </div>
    </section>

@endsection
