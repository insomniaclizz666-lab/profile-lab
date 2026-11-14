@extends('admin.layout')

@section('title', 'Laporan Rekap Kegiatan')
@section('page_title', 'Laporan & Rekapitulasi Kegiatan Laboratorium')

@section('admin_content')
<div class="space-y-6">

    <!-- Top Action & Filter Bar (Screen Only) -->
    <div class="print:hidden bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h3 class="text-base font-bold text-slate-900 dark:text-white">Rekapitulasi Operasional Laboratorium</h3>
            <p class="text-xs text-slate-500 mt-0.5">Filter dan cetak laporan resmi peminjaman, agenda/workshop, dan praktikum laboratorium.</p>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <!-- Filter Form -->
            <form action="{{ route('admin.laporan') }}" method="GET" class="flex flex-wrap items-center gap-2 text-xs">
                <select name="periode" onchange="this.form.submit()" class="px-3 py-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white font-medium focus:ring-2 focus:ring-blue-500">
                    <option value="semua" {{ $periode === 'semua' ? 'selected' : '' }}>Semua Periode</option>
                    <option value="bulan_ini" {{ $periode === 'bulan_ini' ? 'selected' : '' }}>Bulan Ini ({{ now()->translatedFormat('F Y') }})</option>
                    <option value="semester_ganjil" {{ $periode === 'semester_ganjil' ? 'selected' : '' }}>Semester Ganjil 2026/2027</option>
                    <option value="semester_genap" {{ $periode === 'semester_genap' ? 'selected' : '' }}>Semester Genap 2026/2027</option>
                    <option value="custom" {{ $periode === 'custom' ? 'selected' : '' }}>Rentang Kustom</option>
                </select>

                @if($periode === 'custom')
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="px-2.5 py-1.5 rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-xs">
                    <span class="text-slate-400">s/d</span>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="px-2.5 py-1.5 rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-xs">
                    <button type="submit" class="px-3 py-1.5 rounded-xl bg-blue-600 text-white font-semibold">Terapkan</button>
                @endif
            </form>

            <!-- Tombol Cetak / PDF -->
            <button type="button" onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#F59E0B] hover:bg-[#D97706] text-white font-bold text-xs shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Cetak Laporan / PDF</span>
            </button>
        </div>
    </div>

    <!-- KOP SURAT RESMI (HANYA TAMPIL SAAT CETAK / PRINT) -->
    <div class="hidden print:block pb-4 mb-6 border-b-2 border-slate-900 text-center">
        <h4 class="text-xs font-bold tracking-wider uppercase text-slate-800">KEMENTERIAN PENDIDIKAN TINGGI, SAINS, DAN TEKNOLOGI</h4>
        <h3 class="text-sm font-extrabold uppercase text-slate-900">UNIVERSITAS TRUNOJOYO MADURA - FAKULTAS TEKNIK</h3>
        <h2 class="text-base font-black tracking-tight uppercase text-blue-900 mt-0.5">LABORATORIUM PROGRAM STUDI SISTEM INFORMASI</h2>
        <p class="text-[10px] text-slate-600 mt-1">Gedung RKB C Lantai 2 & 3, Jl. Raya Telang PO BOX 2 Kamal, Bangkalan 69162 | Email: wargalab.si@trunojoyo.ac.id</p>
        <div class="mt-4 pt-2 border-t border-slate-400 text-center">
            <h1 class="text-sm font-bold uppercase tracking-wider text-slate-900">LAPORAN REKAPITULASI KEGIATAN & OPERASIONAL LABORATORIUM</h1>
            <p class="text-[11px] text-slate-600 font-medium mt-0.5">
                Periode: 
                @if($startDate && $endDate)
                    {{ $startDate->translatedFormat('d F Y') }} s/d {{ $endDate->translatedFormat('d F Y') }}
                @else
                    Semua Data Tersedia (Tahun Akademik 2026/2027)
                @endif
            </p>
        </div>
    </div>

    <!-- 4 KARTU STATISTIK RINGKASAN (Screen Only) -->
    <div class="print:hidden grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-medium">Peminjaman Selesai/Aktif</p>
                <p class="text-2xl font-black text-slate-900 dark:text-white mt-0.5">{{ $totalPeminjamanSelesai }} <span class="text-xs font-normal text-slate-400">tiket</span></p>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-medium">Agenda & Workshop</p>
                <p class="text-2xl font-black text-slate-900 dark:text-white mt-0.5">{{ $totalEventSelesai }} <span class="text-xs font-normal text-slate-400">kegiatan</span></p>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-medium">Peserta Pelatihan</p>
                <p class="text-2xl font-black text-slate-900 dark:text-white mt-0.5">{{ $totalPesertaEvent }} <span class="text-xs font-normal text-slate-400">mahasiswa</span></p>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-medium">Praktikum Aktif</p>
                <p class="text-2xl font-black text-slate-900 dark:text-white mt-0.5">{{ $totalPraktikumAktif }} <span class="text-xs font-normal text-slate-400">mata kuliah</span></p>
            </div>
        </div>
    </div>

    <!-- 1. TABEL REKAP PEMINJAMAN LABORATORIUM & ALAT -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
        <div class="p-5 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
            <div>
                <h4 class="text-sm font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-blue-600"></span> 1. Rekapitulasi Peminjaman Ruang &amp; Fasilitas Lab
                </h4>
                <p class="text-xs text-slate-500 mt-0.5">Daftar permohonan peminjaman inventaris, perangkat, dan ruangan laboratorium.</p>
            </div>
            <span class="text-xs font-bold px-2.5 py-1 rounded-lg bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
                Total: {{ $peminjamanList->count() }} Data
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 text-[11px] font-bold uppercase text-slate-600 dark:text-slate-300">
                        <th class="py-3 px-4 w-10 text-center">No</th>
                        <th class="py-3 px-4">Nama Peminjam</th>
                        <th class="py-3 px-4">NIM / NIP</th>
                        <th class="py-3 px-4">Ruang / Fasilitas</th>
                        <th class="py-3 px-4">Tanggal &amp; Sesi</th>
                        <th class="py-3 px-4">Keperluan</th>
                        <th class="py-3 px-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($peminjamanList as $idx => $p)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20">
                            <td class="py-3 px-4 text-center text-slate-400 font-semibold">{{ $idx + 1 }}</td>
                            <td class="py-3 px-4 font-bold text-slate-900 dark:text-white">{{ $p->nama_peminjam }}</td>
                            <td class="py-3 px-4 font-mono text-slate-600 dark:text-slate-400">{{ $p->nim_nip }}</td>
                            <td class="py-3 px-4">
                                <span class="font-semibold text-slate-800 dark:text-slate-200">{{ $p->nama_alat_ruang }}</span>
                                @if($p->ruangLab)
                                    <span class="block text-[10px] text-blue-600 dark:text-blue-400">{{ $p->ruangLab->nama_ruang }}</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <p class="font-semibold text-slate-800 dark:text-slate-200">{{ $p->tanggal_mulai ? $p->tanggal_mulai->format('d/m/Y') : '-' }}</p>
                                <p class="text-[10px] text-slate-500">{{ $p->sesi ?? $p->durasi }}</p>
                            </td>
                            <td class="py-3 px-4 max-w-xs text-slate-600 dark:text-slate-300 truncate" title="{{ $p->keperluan }}">
                                {{ $p->keperluan }}
                            </td>
                            <td class="py-3 px-4 text-center">
                                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold
                                    {{ $p->status === 'Disetujui' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                    {{ $p->status === 'Pending' ? 'bg-amber-100 text-amber-800' : '' }}
                                    {{ $p->status === 'Selesai' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $p->status === 'Ditolak' ? 'bg-rose-100 text-rose-800' : '' }}">
                                    {{ $p->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-6 text-center text-slate-400">Tidak ada data peminjaman pada periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- 2. TABEL REKAP AGENDA, PELATIHAN & WORKSHOP -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
        <div class="p-5 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
            <div>
                <h4 class="text-sm font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span> 2. Rekapitulasi Pelatihan, Workshop &amp; Agenda Laboratorium
                </h4>
                <p class="text-xs text-slate-500 mt-0.5">Daftar agenda kegiatan pengembangan kompetensi mahasiswa yang terselenggara.</p>
            </div>
            <span class="text-xs font-bold px-2.5 py-1 rounded-lg bg-amber-50 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300">
                Total: {{ $eventsList->count() }} Kegiatan
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 text-[11px] font-bold uppercase text-slate-600 dark:text-slate-300">
                        <th class="py-3 px-4 w-10 text-center">No</th>
                        <th class="py-3 px-4">Nama Kegiatan / Agenda</th>
                        <th class="py-3 px-4">Kategori</th>
                        <th class="py-3 px-4">Tanggal Pelaksanaan</th>
                        <th class="py-3 px-4">Mentor / Narasumber</th>
                        <th class="py-3 px-4 text-center">Peserta Terdaftar / Kuota</th>
                        <th class="py-3 px-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($eventsList as $idx => $e)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20">
                            <td class="py-3 px-4 text-center text-slate-400 font-semibold">{{ $idx + 1 }}</td>
                            <td class="py-3 px-4 font-bold text-slate-900 dark:text-white">{{ $e->judul }}</td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
                                    {{ $e->kategori }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-slate-700 dark:text-slate-300">
                                {{ \Carbon\Carbon::parse($e->tanggal)->format('d F Y') }}
                            </td>
                            <td class="py-3 px-4 text-slate-600 dark:text-slate-400">
                                {{ $e->mentor_nama ?? 'Tim Laboratorium SI' }}
                            </td>
                            <td class="py-3 px-4 text-center font-bold">
                                <span class="text-blue-600 dark:text-blue-400">{{ $e->registrations_count }}</span>
                                <span class="text-slate-400 font-normal">/ {{ $e->kuota_total }}</span>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold
                                    {{ $e->status === 'Selesai' ? 'bg-emerald-100 text-emerald-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $e->status ?? 'Akan Datang' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-6 text-center text-slate-400">Tidak ada agenda pada periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- 3. TABEL REKAP PRAKTIKUM & JADWAL KELAS -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
        <div class="p-5 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
            <div>
                <h4 class="text-sm font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span> 3. Rekapitulasi Mata Kuliah Praktikum &amp; Penggunaan Ruang
                </h4>
                <p class="text-xs text-slate-500 mt-0.5">Jadwal pelaksanaan praktikum terstruktur dan modul bahan ajar semester aktif.</p>
            </div>
            <span class="text-xs font-bold px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300">
                Total: {{ $praktikumList->count() }} Mata Kuliah
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 text-[11px] font-bold uppercase text-slate-600 dark:text-slate-300">
                        <th class="py-3 px-4 w-10 text-center">No</th>
                        <th class="py-3 px-4">Mata Kuliah Praktikum</th>
                        <th class="py-3 px-4">Ruang Laboratorium</th>
                        <th class="py-3 px-4">Hari &amp; Waktu</th>
                        <th class="py-3 px-4">Dosen Pengampu</th>
                        <th class="py-3 px-4 text-center">Semester / SKS</th>
                        <th class="py-3 px-4 text-center">Modul Bahan Ajar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($praktikumList as $idx => $mk)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20">
                            <td class="py-3 px-4 text-center text-slate-400 font-semibold">{{ $idx + 1 }}</td>
                            <td class="py-3 px-4 font-bold text-slate-900 dark:text-white">
                                {{ $mk->nama }} <span class="text-[10px] font-semibold text-blue-600">(Kelas {{ $mk->kelas ?? 'A' }})</span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="font-semibold text-slate-800 dark:text-slate-200">{{ $mk->ruangLab?->nama_ruang ?? 'Lab Terpadu' }}</span>
                                <span class="block text-[10px] text-slate-400">{{ $mk->ruangLab?->lokasi }}</span>
                            </td>
                            <td class="py-3 px-4 text-slate-700 dark:text-slate-300">
                                <span class="font-bold text-slate-800 dark:text-slate-200">{{ $mk->hari ?? 'Senin' }}</span>
                                <span class="block text-[10px] text-slate-500">
                                    {{ $mk->jam_mulai ? substr($mk->jam_mulai, 0, 5) : '08:00' }} - {{ $mk->jam_selesai ? substr($mk->jam_selesai, 0, 5) : '10:30' }} WIB
                                </span>
                            </td>
                            <td class="py-3 px-4 text-slate-600 dark:text-slate-400">
                                {{ $mk->dosen_pengampu ?? 'Tim Dosen SI' }}
                            </td>
                            <td class="py-3 px-4 text-center">
                                Semester {{ $mk->semester }} ({{ $mk->sks }} SKS)
                            </td>
                            <td class="py-3 px-4 text-center">
                                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                                    {{ $mk->modul_count }} Modul
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-6 text-center text-slate-400">Belum ada data mata kuliah praktikum.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- TANDA TANGAN LEMBAR PENGESAHAN (PRINT ONLY) -->
    <div class="hidden print:block pt-8 mt-10">
        <div class="flex justify-end">
            <div class="text-center w-72 text-xs text-slate-800">
                <p>Bangkalan, {{ now()->translatedFormat('d F Y') }}</p>
                <p class="font-bold mt-1">Kepala Laboratorium Sistem Informasi</p>
                <div class="h-24 flex items-center justify-center">
                    <p class="text-[10px] text-slate-300 italic">[ Tanda Tangan &amp; Stempel Resmi ]</p>
                </div>
                <p class="font-bold text-sm underline text-slate-900">Achmad Jauhari, S.T., M.Kom.</p>
                <p class="text-xs text-slate-600 font-mono">NIP. 197605152002121002</p>
            </div>
        </div>
    </div>

</div>

<!-- STYLES KHUSUS PRINT MODE -->
<style>
@media print {
    body {
        background-color: white !important;
        color: black !important;
        font-size: 11pt !important;
    }
    aside, header, footer, .print\:hidden {
        display: none !important;
    }
    main {
        padding: 0 !important;
        margin: 0 !important;
        overflow: visible !important;
        width: 100% !important;
    }
    table {
        width: 100% !important;
        border-collapse: collapse !important;
    }
    th, td {
        border: 1px solid #cbd5e1 !important;
        padding: 6px 8px !important;
    }
    th {
        background-color: #f1f5f9 !important;
        color: #0f172a !important;
    }
}
</style>
@endsection

