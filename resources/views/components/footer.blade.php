    <!-- 7. FOOTER -->
    <footer class="bg-[#1E3A8A] text-white pt-16 pb-12 border-t border-blue-950">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
                
                <!-- Kolom 1: Profil Brand Footer -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#F59E0B] flex items-center justify-center text-slate-900 shadow-md">
                            <svg class="w-5 h-5 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-lg font-bold">Wargalab SI</span>
                            <span class="block text-xs text-blue-200">Universitas Trunojoyo Madura</span>
                        </div>
                    </div>
                    <p class="text-xs text-blue-100 leading-relaxed">
                        Pusat keunggulan komputasi, praktikum, dan riset terapan Program Studi Sistem Informasi, Fakultas Teknik UTM. Membentuk talenta digital yang kompeten dan siap kerja.
                    </p>
                    <div class="flex items-center gap-3 text-slate-300 pt-2">
                        <span class="text-xs font-medium text-blue-200">Akreditasi:</span>
                        <span class="text-xs px-2 py-0.5 bg-white/10 rounded text-[#F59E0B] font-semibold">Unggul (LAM INFOKOM)</span>
                    </div>
                </div>

                <!-- Kolom 2: Navigasi Cepat -->
                <div>
                    <h4 class="text-sm font-bold tracking-wider uppercase text-white mb-4">Navigasi Halaman</h4>
                    <ul class="space-y-2.5 text-xs text-blue-100">
                        <li><a href="{{ route('home') }}" class="hover:text-[#F59E0B] transition">Beranda Utama</a></li>
                        <li><a href="{{ route('fasilitas') }}" class="hover:text-[#F59E0B] transition">Katalog Fasilitas</a></li>
                        <li><a href="{{ route('layanan') }}" class="hover:text-[#F59E0B] transition">Layanan Laboratorium</a></li>
                        <li><a href="{{ route('riset') }}" class="hover:text-[#F59E0B] transition">Riset & Keahlian Dosen</a></li>
                        <li><a href="{{ route('home') }}#profil" class="hover:text-[#F59E0B] transition">Profil & SOP Laboratorium</a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Layanan Mahasiswa & SOP -->
                <div>
                    <h4 class="text-sm font-bold tracking-wider uppercase text-white mb-4">Layanan & Dokumen</h4>
                    <ul class="space-y-2.5 text-xs text-blue-100">
                        <li><a href="javascript:void(0)" onclick="openLoginModal()" class="hover:text-[#F59E0B] transition">Portal Login Multi-Peran</a></li>
                        <li><a href="#fasilitas" class="hover:text-[#F59E0B] transition">Formulir Peminjaman Perangkat</a></li>
                        <li><a href="#profil" class="hover:text-[#F59E0B] transition">Buku Pedoman Tata Tertib Lab</a></li>
                        <li><a href="#akademik" class="hover:text-[#F59E0B] transition">Repository Modul Praktikum</a></li>
                        <li><a href="javascript:void(0)" onclick="alert('Layanan Bebas Lab Skripsi dapat diakses saat menjelang wisuda periode terdaftar.')" class="hover:text-[#F59E0B] transition">Surat Keterangan Bebas Lab</a></li>
                    </ul>
                </div>

                <!-- Kolom 4: Alamat & Kontak Resmi -->
                <div>
                    <h4 class="text-sm font-bold tracking-wider uppercase text-white mb-4">Kontak & Lokasi</h4>
                    <div class="space-y-3 text-xs text-slate-400">
                        <p class="leading-relaxed">
                            <strong class="text-slate-200">Gedung Fakultas Teknik</strong><br>
                            Universitas Trunojoyo Madura<br>
                            Jl. Raya Telang, Kamal, Bangkalan, Jawa Timur 69162
                        </p>
                        <p>
                            <span class="block text-slate-200 font-semibold">Email Resmi:</span>
                            wargalab.si@trunojoyo.ac.id
                        </p>
                        <p>
                            <span class="block text-slate-200 font-semibold">Jam Operasional:</span>
                            Senin - Jumat: 07.30 - 16.30 WIB
                        </p>
                    </div>
                </div>

            </div>

            <!-- Bottom Copyright Strip -->
            <div class="pt-8 border-t border-slate-800 text-xs text-slate-500 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p>&copy; 2026 Wargalab Sistem Informasi UTM. All Rights Reserved.</p>
                <div class="flex items-center gap-6">
                    <a href="javascript:void(0)" class="hover:text-slate-400 transition">Kebijakan Privasi</a>
                    <span>•</span>
                    <a href="javascript:void(0)" class="hover:text-slate-400 transition">Syarat & Ketentuan</a>
                    <span>•</span>
                    <a href="javascript:void(0)" class="hover:text-slate-400 transition">Fakultas Teknik UTM</a>
                </div>
            </div>
        </div>
    </footer>
