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

    @php
        $daftarRuangLab = \App\Models\RuangLab::where('is_active', true)->orderBy('kode')->get();
    @endphp

    <!-- MODAL: FORM PEMINJAMAN ALAT & RUANG LAB (ANTI-BENTROK JADWAL KELAS) -->
    <div id="pinjamModal" class="fixed inset-0 z-50 bg-slate-900/70 backdrop-blur-sm items-center justify-center p-4" style="display:none;">
        <div class="bg-white rounded-2xl max-w-xl w-full shadow-2xl overflow-hidden border border-slate-200 flex flex-col max-h-[92vh]">
            <div class="bg-[#1E3A8A] p-5 text-white flex items-center justify-between shrink-0">
                <div>
                    <h3 class="text-base sm:text-lg font-bold">Formulir Peminjaman Fasilitas & Ruang Lab</h3>
                    <p class="text-xs text-blue-100 mt-0.5" id="pinjamToolName">Pilih Ruang / Fasilitas Laboratorium</p>
                </div>
                <button onclick="closePinjamModal()" class="text-white/80 hover:text-white p-1 rounded-lg hover:bg-white/10 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('peminjaman.store') }}" method="POST" id="formPeminjaman" class="p-6 space-y-4 text-xs sm:text-sm overflow-y-auto flex-1">
                @csrf
                <input type="hidden" name="nama_alat_ruang" id="inputNamaAlat" value="" />

                <!-- Pilihan Ruang Lab (Untuk Validasi Jadwal Kelas) -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">
                        Pilih Ruang Laboratorium <span class="text-xs text-slate-400 font-normal">(Wajib jika meminjam ruangan)</span>
                    </label>
                    <select name="ruang_lab_id" id="inputRuangLabId" onchange="cekKetersediaanJadwal()" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:outline-none bg-white text-slate-800">
                        <option value="">-- Peminjaman Alat / Fasilitas Non-Ruang --</option>
                        @foreach($daftarRuangLab as $rl)
                            <option value="{{ $rl->id }}" data-kode="{{ $rl->kode }}" data-nama="{{ $rl->nama_ruang }}">
                                {{ $rl->nama_ruang }} ({{ $rl->lokasi }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal & Sesi Peminjaman -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Tanggal Peminjaman <span class="text-rose-500">*</span></label>
                        <input type="date" name="tanggal_mulai" id="inputTanggalPinjam" required
                               value="{{ now()->addDay()->format('Y-m-d') }}"
                               min="{{ now()->format('Y-m-d') }}"
                               onchange="cekKetersediaanJadwal()"
                               class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:outline-none text-slate-800" />
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Sesi Waktu <span class="text-rose-500">*</span></label>
                        <select name="sesi" id="inputSesiPinjam" onchange="cekKetersediaanJadwal()" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:outline-none bg-white text-slate-800">
                            <option value="Pagi (08:00 - 12:00)">Pagi (08:00 - 12:00 WIB)</option>
                            <option value="Siang (13:00 - 17:00)">Siang (13:00 - 17:00 WIB)</option>
                            <option value="Malam (18:30 - 21:00)">Malam (18:30 - 21:00 WIB)</option>
                            <option value="Full Day (08:00 - 17:00)">Full Day (08:00 - 17:00 WIB)</option>
                        </select>
                    </div>
                </div>

                <!-- BOX STATUS KETERSEDIAAN JADWAL (LIVE AVAILABILITY CHECKER) -->
                <div id="availabilityBox" class="p-3.5 rounded-xl border transition-all text-xs flex flex-col gap-2 bg-slate-50 border-slate-200">
                    <div class="flex items-center justify-between">
                        <span class="font-bold flex items-center gap-1.5" id="availabilityTitle">
                            <span class="w-2 h-2 rounded-full bg-slate-400"></span> Status Ketersediaan: Menunggu Pilihan
                        </span>
                        <button type="button" onclick="toggleJadwalDetail()" id="btnToggleJadwal" class="text-[11px] font-semibold text-[#1E3A8A] hover:underline hidden">
                            Lihat Agenda Hari Ini ▾
                        </button>
                    </div>
                    <p id="availabilityDesc" class="text-slate-600 leading-relaxed">
                        Pilih ruangan lab, tanggal, dan sesi untuk memverifikasi ketersediaan jadwal agar tidak bentrok dengan jadwal kelas praktikum.
                    </p>
                    <!-- Detail Jadwal Kegiatan Hari Tersebut -->
                    <div id="jadwalDetailList" class="mt-2 pt-2 border-t border-slate-200 space-y-1.5 hidden">
                        <!-- Populated by JS -->
                    </div>
                </div>

                <!-- Data Peminjam -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Mahasiswa / Dosen Peminjam <span class="text-rose-500">*</span></label>
                    <input type="text" name="nama_peminjam" required value="{{ auth()->user()?->name }}" placeholder="Nama Lengkap" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:outline-none" />
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">NIM / NIP <span class="text-rose-500">*</span></label>
                        <input type="text" name="nim_nip" required value="{{ auth()->user()?->nim_nip }}" placeholder="Contoh: 230411100..." class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:outline-none" />
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">No. WhatsApp <span class="text-rose-500">*</span></label>
                        <input type="text" name="no_telp" required value="{{ auth()->user()?->no_telp }}" placeholder="08xxxxxxxxxx" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:outline-none" />
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Email Pengguna (Untuk Notifikasi Status) <span class="text-rose-500">*</span></label>
                    <input type="email" name="email" required value="{{ auth()->user()?->email }}" placeholder="nama@student.trunojoyo.ac.id" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:outline-none" />
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Keperluan Peminjaman & Keterangan <span class="text-rose-500">*</span></label>
                    <textarea name="keperluan" rows="3" required placeholder="Jelaskan tujuan peminjaman (misal: Praktikum mandiri tugas besar Web, kegiatan UKM, riset skripsi, dll)..." class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:outline-none"></textarea>
                </div>

                <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100 shrink-0">
                    <button type="button" onclick="closePinjamModal()" class="px-4 py-2 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-50 font-medium">Batal</button>
                    <button type="submit" id="btnSubmitPeminjaman" class="px-5 py-2 rounded-xl bg-[#F59E0B] text-white font-bold hover:bg-[#D97706] shadow-md shadow-amber-500/20 transition flex items-center gap-2">
                        <span>Kirim Permohonan</span>
                    </button>
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

            // Auto-select ruang lab jika nama alat mengandung nama Lab
            const selectRuang = document.getElementById('inputRuangLabId');
            if (selectRuang) {
                const lowerName = toolName.toLowerCase();
                let matched = false;
                for (let i = 0; i < selectRuang.options.length; i++) {
                    const opt = selectRuang.options[i];
                    const optText = opt.text.toLowerCase();
                    const optKode = (opt.getAttribute('data-kode') || '').toLowerCase();
                    if (optKode && (lowerName.includes('lab ' + optKode) || optText.includes(lowerName))) {
                        selectRuang.selectedIndex = i;
                        matched = true;
                        break;
                    }
                }
                if (!matched && lowerName.includes('ruang')) {
                    selectRuang.selectedIndex = 1; // Default ke ruang pertama jika umum
                }
            }

            document.getElementById('pinjamModal').style.display = 'flex';
            cekKetersediaanJadwal();
        }

        function closePinjamModal() {
            document.getElementById('pinjamModal').style.display = 'none';
        }

        // Live Availability Checker Function (Anti-Bentrok Jadwal Kelas)
        let debounceCheckTimer = null;
        function cekKetersediaanJadwal() {
            clearTimeout(debounceCheckTimer);
            debounceCheckTimer = setTimeout(() => {
                const ruangSelect = document.getElementById('inputRuangLabId');
                const tanggalInput = document.getElementById('inputTanggalPinjam');
                const sesiSelect = document.getElementById('inputSesiPinjam');
                const box = document.getElementById('availabilityBox');
                const title = document.getElementById('availabilityTitle');
                const desc = document.getElementById('availabilityDesc');
                const btnSubmit = document.getElementById('btnSubmitPeminjaman');
                const btnToggle = document.getElementById('btnToggleJadwal');
                const listDetail = document.getElementById('jadwalDetailList');

                const ruangId = ruangSelect ? ruangSelect.value : '';
                const tanggal = tanggalInput ? tanggalInput.value : '';
                const sesi = sesiSelect ? sesiSelect.value : 'Pagi (08:00 - 12:00)';

                if (!ruangId) {
                    box.className = 'p-3.5 rounded-xl border transition-all text-xs flex flex-col gap-2 bg-blue-50/70 border-blue-200 text-blue-900';
                    title.innerHTML = '<span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span> Mode Peminjaman Alat / Fasilitas Non-Ruang';
                    desc.textContent = 'Peminjaman alat atau hardware portabel dapat diajukan tanpa reservasi ruangan khusus. Silakan lanjutkan.';
                    btnSubmit.disabled = false;
                    btnSubmit.className = 'px-5 py-2 rounded-xl bg-[#F59E0B] text-white font-bold hover:bg-[#D97706] shadow-md shadow-amber-500/20 transition cursor-pointer';
                    btnSubmit.innerHTML = '<span>Kirim Permohonan</span>';
                    btnToggle.classList.add('hidden');
                    listDetail.classList.add('hidden');
                    return;
                }

                if (!tanggal) {
                    box.className = 'p-3.5 rounded-xl border transition-all text-xs flex flex-col gap-2 bg-slate-50 border-slate-200 text-slate-600';
                    title.innerHTML = '<span class="w-2.5 h-2.5 rounded-full bg-slate-400"></span> Silakan Pilih Tanggal Peminjaman';
                    desc.textContent = 'Tentukan tanggal penggunaan untuk memverifikasi ketersediaan ruang laboratorium.';
                    btnToggle.classList.add('hidden');
                    return;
                }

                // Show loading status
                title.innerHTML = '<svg class="animate-spin h-3.5 w-3.5 text-blue-600 inline mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg> Memverifikasi Ketersediaan Jadwal...';
                desc.textContent = 'Memeriksa sinkronisasi jadwal praktikum perkuliahan & peminjaman lain...';

                fetch(`/api/cek-ketersediaan-lab?ruang_lab_id=${ruangId}&tanggal=${encodeURIComponent(tanggal)}&sesi=${encodeURIComponent(sesi)}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.available) {
                            box.className = 'p-3.5 rounded-xl border transition-all text-xs flex flex-col gap-2 bg-emerald-50 border-emerald-300 text-emerald-950 shadow-xs';
                            title.innerHTML = '<span class="w-2.5 h-2.5 rounded-full bg-emerald-500 shrink-0"></span> <span class="font-bold text-emerald-800">Jadwal TERSEDIA (AVAILABLE)</span>';
                            desc.innerHTML = `<span class="font-medium">${data.message}</span>`;
                            btnSubmit.disabled = false;
                            btnSubmit.className = 'px-5 py-2 rounded-xl bg-emerald-600 text-white font-bold hover:bg-emerald-700 shadow-md shadow-emerald-600/25 transition cursor-pointer flex items-center gap-1.5';
                            btnSubmit.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> <span>Kirim Permohonan (Aman)</span>';
                        } else {
                            box.className = 'p-3.5 rounded-xl border transition-all text-xs flex flex-col gap-2 bg-rose-50 border-rose-300 text-rose-950 shadow-xs';
                            title.innerHTML = `<span class="w-2.5 h-2.5 rounded-full bg-rose-500 shrink-0"></span> <span class="font-bold text-rose-800">${data.conflict_title || 'TIDAK TERSEDIA (BENTROK)'}</span>`;
                            desc.innerHTML = `<span class="font-medium">${data.message}</span>`;
                            btnSubmit.disabled = true;
                            btnSubmit.className = 'px-5 py-2 rounded-xl bg-slate-300 text-slate-500 font-bold cursor-not-allowed transition flex items-center gap-1.5 opacity-80';
                            btnSubmit.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg> <span>Jadwal Bentrok - Pilih Sesi Lain</span>';
                        }

                        // Render jadwal hari ini jika ada
                        if (data.jadwal_hari_ini && data.jadwal_hari_ini.length > 0) {
                            btnToggle.classList.remove('hidden');
                            btnToggle.textContent = `Agenda Ruangan Hari ${data.hari} (${data.jadwal_hari_ini.length}) ▾`;
                            let html = '<div class="text-[11px] font-bold text-slate-700 mb-1">Daftar Penggunaan Ruangan Pada Tanggal Terpilih:</div>';
                            data.jadwal_hari_ini.forEach(j => {
                                html += `
                                    <div class="flex items-center justify-between p-2 rounded-lg bg-white border border-slate-200 shadow-2xs text-[11px]">
                                        <div>
                                            <p class="font-bold text-slate-800">${escapeHtml(j.judul)}</p>
                                            <p class="text-slate-500 text-[10px]">${j.dosen ? 'Dosen: ' + escapeHtml(j.dosen) : (j.peminjam ? 'Peminjam: ' + escapeHtml(j.peminjam) : '')}</p>
                                        </div>
                                        <div class="text-right shrink-0">
                                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-semibold border ${j.badge}">${j.jam}</span>
                                        </div>
                                    </div>
                                `;
                            });
                            listDetail.innerHTML = html;
                        } else {
                            btnToggle.classList.add('hidden');
                            listDetail.classList.add('hidden');
                        }
                    })
                    .catch(err => {
                        console.error('Gagal mengecek ketersediaan lab:', err);
                        title.innerHTML = '<span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span> Gagal Menghubungi Server';
                        desc.textContent = 'Tidak dapat memverifikasi jadwal saat ini. Anda tetap dapat mengirim permohonan untuk ditinjau manual oleh Laboran.';
                        btnSubmit.disabled = false;
                    });
            }, 250);
        }

        function toggleJadwalDetail() {
            const list = document.getElementById('jadwalDetailList');
            if (list) {
                list.classList.toggle('hidden');
            }
        }

        function escapeHtml(text) {
            if (!text) return '';
            const map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' };
            return text.replace(/[&<>"']/g, m => map[m]);
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
