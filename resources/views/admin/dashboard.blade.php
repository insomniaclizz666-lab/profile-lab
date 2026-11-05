@extends('admin.layout')

@section('title', 'Dashboard Overview')
@section('page_title', 'Ringkasan & Aktivitas Laboratorium')

@section('admin_content')
<div class="space-y-6">
    <!-- Stat Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Peminjaman Pending</p>
                    <p class="text-3xl font-extrabold text-amber-500 mt-1">{{ $stats['pending_peminjaman'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-500 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <p class="mt-3 text-xs text-slate-400">Total tiket: {{ $stats['total_peminjaman'] }} peminjaman</p>
        </div>

        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Modul Praktikum</p>
                    <p class="text-3xl font-extrabold text-blue-600 dark:text-blue-400 mt-1">{{ $stats['total_modul'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-600/10 text-blue-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
            </div>
            <p class="mt-3 text-xs text-slate-400">File modul praktikum aktif</p>
        </div>

        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Agenda / Event</p>
                    <p class="text-3xl font-extrabold text-emerald-500 mt-1">{{ $stats['total_events'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
            </div>
            <p class="mt-3 text-xs text-slate-400">Workshop & praktikum terdaftar</p>
        </div>

        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Total Akun</p>
                    <p class="text-3xl font-extrabold text-purple-500 mt-1">{{ $stats['total_users'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-purple-500/10 text-purple-500 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
            </div>
            <p class="mt-3 text-xs text-slate-400">Mahasiswa, Laboran, & Admin</p>
        </div>
    </div>

    <!-- Tables & Feeds -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Peminjaman Terbaru -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-5 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-bold text-slate-900 dark:text-white">Permohonan Peminjaman Terbaru</h3>
                <a href="{{ route('admin.peminjaman') }}" class="text-xs text-blue-600 hover:underline">Lihat Semua →</a>
            </div>

            <div class="space-y-3">
                @forelse($recentPeminjaman as $p)
                    <div class="p-3.5 rounded-xl border border-slate-100 dark:border-slate-800/80 bg-slate-50/50 dark:bg-slate-800/30 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $p->nama_alat_ruang }}</p>
                            <p class="text-xs text-slate-500">{{ $p->nama_peminjam }} (NIM: {{ $p->nim_nip }})</p>
                        </div>
                        <div>
                            <span class="px-2.5 py-1 text-[11px] font-bold rounded-lg
                                {{ $p->status === 'Pending' ? 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300' : '' }}
                                {{ $p->status === 'Disetujui' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300' : '' }}
                                {{ $p->status === 'Ditolak' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' : '' }}
                                {{ $p->status === 'Selesai' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' : '' }}">
                                {{ $p->status }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-400 py-4 text-center">Belum ada peminjaman yang masuk.</p>
                @endforelse
            </div>
        </div>

        <!-- Event Terdekat -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-5 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-bold text-slate-900 dark:text-white">Agenda & Event Mendatang</h3>
                @if(auth()->user()->role === 'superadmin')
                    <a href="{{ route('admin.events') }}" class="text-xs text-blue-600 hover:underline">Kelola Agenda →</a>
                @endif
            </div>

            <div class="space-y-3">
                @forelse($upcomingEvents as $e)
                    <div class="p-3.5 rounded-xl border border-slate-100 dark:border-slate-800/80 bg-slate-50/50 dark:bg-slate-800/30">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-semibold px-2 py-0.5 rounded-md bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300">
                                {{ $e->kategori }}
                            </span>
                            <span class="text-xs text-slate-500 font-medium">
                                {{ \Carbon\Carbon::parse($e->tanggal)->format('d M Y') }}
                            </span>
                        </div>
                        <p class="text-sm font-semibold text-slate-900 dark:text-white mt-2">{{ $e->judul }}</p>
                        <p class="text-xs text-slate-500 mt-1">Mentor: {{ $e->mentor_nama ?? '-' }} • Lokasi: {{ $e->lokasi }}</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-400 py-4 text-center">Belum ada agenda terdekat.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

