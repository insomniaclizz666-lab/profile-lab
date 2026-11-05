    <!-- FLASH MESSAGE NOTIFIKASI SUCCESS -->
    @if(session('success'))
    <div id="flashSuccess" class="fixed top-24 right-5 z-50 bg-emerald-600 text-white px-5 py-4 rounded-xl shadow-xl flex items-center gap-3 animate-fade-in">
        <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span class="text-sm font-semibold">{{ session('success') }}</span>
        <button onclick="document.getElementById('flashSuccess').remove()" class="text-white/80 hover:text-white ml-2 text-lg font-bold">&times;</button>
    </div>
    @endif

    <!-- MODAL: LOGIN SISTEM (Role-Based Access Preparation) -->
    <div id="loginModal" class="fixed inset-0 z-50 bg-dark/70 backdrop-blur-sm items-center justify-center p-4" style="display:none;">
        <div class="bg-white rounded-2xl max-w-md w-full shadow-2xl overflow-hidden animate-fade-in border border-slate-200">
            <!-- Modal Header -->
            <div class="bg-linear-to-r from-[#1E3A8A] to-[#1e40af] p-6 text-white flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold">Login Sistem Wargalab SI</h3>
                    <p class="text-xs text-blue-100 mt-1">Pintu Masuk Terpadu Civitas Akademika UTM</p>
                </div>
                <button onclick="closeLoginModal()" class="text-white/80 hover:text-white p-1 rounded-lg hover:bg-white/10 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Content & Form -->
            <div class="p-6">
                <!-- Role Selector Tabs -->
                <div class="mb-5">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Pilih Peran Pengguna</label>
                    <div class="grid grid-cols-4 gap-1 p-1 bg-lightbg rounded-xl border border-slate-200 text-xs font-semibold">
                        <button type="button" onclick="setRole('Mahasiswa')" id="roleBtn-Mahasiswa" class="py-1.5 rounded-lg bg-primary text-white shadow-sm transition">Mhs</button>
                        <button type="button" onclick="setRole('Dosen')" id="roleBtn-Dosen" class="py-1.5 rounded-lg text-slate-600 hover:text-[#1E3A8A] transition">Dosen</button>
                        <button type="button" onclick="setRole('Laboran')" id="roleBtn-Laboran" class="py-1.5 rounded-lg text-slate-600 hover:text-[#1E3A8A] transition">Laboran</button>
                        <button type="button" onclick="setRole('Admin')" id="roleBtn-Admin" class="py-1.5 rounded-lg text-slate-600 hover:text-[#1E3A8A] transition">Admin</button>
                    </div>
                </div>

                <form onsubmit="handleLoginSubmit(event)" class="space-y-4">
                    <div>
                        <label id="identityLabel" class="block text-xs font-semibold text-slate-700 mb-1">Nomor Induk Mahasiswa (NIM)</label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="identityInput"
                                required 
                                placeholder="Contoh: 230411100001" 
                                class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition"
                            />
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label class="block text-xs font-semibold text-slate-700">Kata Sandi / PIN</label>
                            <a href="javascript:void(0)" onclick="alert('Silakan hubungi admin laboratorium via helpdesk untuk reset kata sandi.')" class="text-[11px] text-[#D97706] hover:underline font-medium">Lupa Sandi?</a>
                        </div>
                        <input 
                             type="password" 
                            required 
                            placeholder="••••••••" 
                            class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition"
                        />
                    </div>

                    <div class="flex items-center justify-between text-xs text-slate-600">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" class="rounded text-[#1E3A8A] focus:ring-[#1E3A8A]">
                            <span>Ingat sesi saya</span>
                        </label>
                        <span id="roleIndicator" class="font-medium text-[#1E3A8A]">Login sebagai: Mahasiswa</span>
                    </div>

                    <button type="submit" class="w-full py-3 bg-[#F59E0B] hover:bg-[#D97706] text-white font-bold rounded-xl shadow-md shadow-amber-500/20 transition active:scale-95 text-sm">
                        Masuk ke Dashboard
                    </button>
                </form>

                <div class="mt-4 pt-4 border-t border-slate-100 text-center text-xs text-slate-400">
                    Akses dilindungi SSO & enkripsi kampus Universitas Trunojoyo Madura.
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL: FORM PEMINJAMAN ALAT INTERAKTIF -->
    <div id="pinjamModal" class="fixed inset-0 z-50 bg-slate-900/70 backdrop-blur-sm items-center justify-center p-4" style="display:none;">
        <div class="bg-white rounded-2xl max-w-lg w-full shadow-2xl overflow-hidden border border-slate-200">
            <div class="bg-[#1E3A8A] p-5 text-white flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold">Formulir Peminjaman Fasilitas</h3>
                    <p class="text-xs text-blue-100" id="pinjamToolName">Nama Alat</p>
                </div>
                <button onclick="closePinjamModal()" class="text-white/80 hover:text-white p-1 rounded-lg hover:bg-white/10 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form action="{{ route('peminjaman.store') }}" method="POST" class="p-6 space-y-4 text-xs sm:text-sm">
                @csrf
                <input type="hidden" name="nama_alat_ruang" id="inputNamaAlat" value="" />
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Mahasiswa / Dosen Peminjam</label>
                    <input type="text" name="nama_peminjam" required value="{{ auth()->user()?->name }}" placeholder="Nama Lengkap" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:outline-none" />
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">NIM / NIP</label>
                        <input type="text" name="nim_nip" required value="{{ auth()->user()?->nim_nip }}" placeholder="Contoh: 230411100..." class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:outline-none" />
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">No. WhatsApp</label>
                        <input type="text" name="no_telp" required value="{{ auth()->user()?->no_telp }}" placeholder="08xxxxxxxxxx" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:outline-none" />
                    </div>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Email Pengguna (Sebagai Log Kontak & Akun)</label>
                    <input type="email" name="email" required value="{{ auth()->user()?->email }}" placeholder="nama@student.trunojoyo.ac.id" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:outline-none" />
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Durasi Peminjaman</label>
                    <select name="durasi" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:outline-none">
                        <option value="1 Hari (Praktikum Mandiri)">1 Hari (Praktikum Mandiri)</option>
                        <option value="3 Hari (Tugas Besar)">3 Hari (Tugas Besar)</option>
                        <option value="7 Hari (Riset Skripsi/Dosen)">7 Hari (Riset Skripsi/Dosen)</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Keperluan & Surat Pengantar Dosen</label>
                    <textarea name="keperluan" rows="3" required placeholder="Jelaskan tujuan peminjaman dan nomor surat pengantar (jika ada)..." class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:outline-none"></textarea>
                </div>
                <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                    <button type="button" onclick="closePinjamModal()" class="px-4 py-2 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-50 font-medium">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-[#F59E0B] text-white font-bold hover:bg-[#D97706] shadow-md shadow-amber-500/20">Kirim Permohonan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIC (Interactivity & State Management) -->
    <script>
        // Toggle Mobile Menu
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            const hamburger = document.getElementById('hamburgerIcon');
            const close = document.getElementById('closeIcon');
            menu.classList.toggle('hidden');
            hamburger.classList.toggle('hidden');
            close.classList.toggle('hidden');
        }

        // Modal Login Handlers
        let currentRole = 'Mahasiswa';

        function openLoginModal() {
            document.getElementById('loginModal').style.display = 'flex';
        }

        function closeLoginModal() {
            document.getElementById('loginModal').style.display = 'none';
        }

        function setRole(role) {
            currentRole = role;
            const roles = ['Mahasiswa', 'Dosen', 'Laboran', 'Admin'];
            roles.forEach(r => {
                const btn = document.getElementById(`roleBtn-${r}`);
                if (r === role) {
                    btn.className = 'py-1.5 rounded-lg bg-primary text-white shadow-sm transition';
                } else {
                    btn.className = 'py-1.5 rounded-lg text-slate-600 hover:text-primary transition';
                }
            });

            // Adjust input labels based on role
            const identityLabel = document.getElementById('identityLabel');
            const identityInput = document.getElementById('identityInput');
            const roleIndicator = document.getElementById('roleIndicator');

            roleIndicator.innerText = `Login sebagai: ${role}`;

            if (role === 'Mahasiswa') {
                identityLabel.innerText = 'Nomor Induk Mahasiswa (NIM)';
                identityInput.placeholder = 'Contoh: 230411100001';
            } else if (role === 'Dosen') {
                identityLabel.innerText = 'Nomor Induk Pegawai (NIP)';
                identityInput.placeholder = 'Contoh: 198501012010121001';
            } else if (role === 'Laboran') {
                identityLabel.innerText = 'ID Laboran / NIP';
                identityInput.placeholder = 'Contoh: LAB-SI-02';
            } else {
                identityLabel.innerText = 'Username Administrator';
                identityInput.placeholder = 'admin_labsi';
            }
        }

        function handleLoginSubmit(event) {
            event.preventDefault();
            alert(`Simulasi Otentikasi Berhasil!\n\nPeran: ${currentRole}\nSistem akan mengarahkan Anda ke Dashboard ${currentRole} Wargalab SI UTM.`);
            closeLoginModal();
        }

        // Modal Peminjaman Alat & Ruang
        function openPeminjamanModalWithItem(itemName) {
            handlePinjam(itemName, 'Tersedia');
        }

        function handlePinjam(toolName, status) {
            if (status === 'Sedang Dipinjam') {
                alert(`Perangkat/Ruangan "${toolName}" saat ini sedang dipinjam. Anda dapat mengajukan permohonan reservasi tanggal berikutnya.`);
            }
            document.getElementById('pinjamToolName').innerText = `${toolName} • Status: ${status}`;
            const inputAlat = document.getElementById('inputNamaAlat');
            if (inputAlat) {
                inputAlat.value = toolName;
            }
            document.getElementById('pinjamModal').style.display = 'flex';
        }

        function closePinjamModal() {
            document.getElementById('pinjamModal').style.display = 'none';
        }

        // Action Handlers
        function handleLamarRiset(judul, dosen) {
            const confirmed = confirm(`Konfirmasi Pendaftaran Asisten Riset:\n\nProyek: "${judul}"\nPembimbing: ${dosen}\n\nLanjutkan dengan menyinkronkan profil akademis & transkrip nilai Anda?`);
            if (confirmed) {
                alert('Lamaran asisten riset berhasil dikirim ke Dosen Pembimbing. Pengumuman seleksi berkas akan diumumkan melalui portal akademik ini.');
            }
        }

        function handleDownloadModul() {
            alert('Mengunduh Bundle Modul Praktikum Semester Gasal 2026/2027 (Format ZIP/PDF)...\n\nBerisi: Praktikum Jarkom, Basis Data Lanjut, Rekayasa Web, & Audit SI.');
        }

        function handleDaftarCO() {
            alert('Membuka Formulir Pendaftaran CO / Asisten Laboratorium Baru Semester Gasal 2026/2027.\n\nPastikan Anda telah lulus mata kuliah bersangkutan minimal dengan nilai A- dan memiliki integritas akademik.');
        }

        // Close modal on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeLoginModal();
                closePinjamModal();
            }
        });
    </script>
