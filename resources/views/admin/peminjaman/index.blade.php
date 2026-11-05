@extends('admin.layout')

@section('title', 'Peminjaman Fasilitas & Alat')
@section('page_title', 'Kelola Tiket Peminjaman Laboran')

@section('admin_content')
<div class="space-y-6">
    <!-- Filter Bar -->
    <div class="flex flex-wrap items-center justify-between gap-4 bg-white dark:bg-slate-900 p-4 rounded-2xl border border-slate-200 dark:border-slate-800">
        <div class="flex items-center gap-2">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Filter Status:</span>
            <a href="{{ route('admin.peminjaman') }}" class="px-3 py-1.5 rounded-lg text-xs font-medium {{ !request('status') ? 'bg-blue-600 text-white' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300' }}">Semua</a>
            <a href="{{ route('admin.peminjaman', ['status' => 'Pending']) }}" class="px-3 py-1.5 rounded-lg text-xs font-medium {{ request('status') === 'Pending' ? 'bg-amber-500 text-white' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300' }}">Pending</a>
            <a href="{{ route('admin.peminjaman', ['status' => 'Disetujui']) }}" class="px-3 py-1.5 rounded-lg text-xs font-medium {{ request('status') === 'Disetujui' ? 'bg-emerald-600 text-white' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300' }}">Disetujui</a>
            <a href="{{ route('admin.peminjaman', ['status' => 'Selesai']) }}" class="px-3 py-1.5 rounded-lg text-xs font-medium {{ request('status') === 'Selesai' ? 'bg-blue-600 text-white' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300' }}">Selesai</a>
            <a href="{{ route('admin.peminjaman', ['status' => 'Ditolak']) }}" class="px-3 py-1.5 rounded-lg text-xs font-medium {{ request('status') === 'Ditolak' ? 'bg-red-600 text-white' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300' }}">Ditolak</a>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/40 text-xs font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-4 px-6">Peminjam</th>
                        <th class="py-4 px-6">Alat / Ruang</th>
                        <th class="py-4 px-6">Durasi & Keperluan</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Aksi Laboran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                    @forelse($peminjaman as $p)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition">
                            <td class="py-4 px-6">
                                <p class="font-bold text-slate-900 dark:text-white">{{ $p->nama_peminjam }}</p>
                                <p class="text-xs text-slate-500 font-mono">{{ $p->nim_nip }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $p->no_telp ?? $p->email ?? '-' }}</p>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-semibold text-slate-800 dark:text-slate-200">{{ $p->nama_alat_ruang }}</span>
                            </td>
                            <td class="py-4 px-6 max-w-xs">
                                <p class="text-xs font-semibold text-slate-700 dark:text-slate-300">{{ $p->durasi ?? 'Sesuai kesepakatan' }}</p>
                                <p class="text-xs text-slate-500 truncate" title="{{ $p->keperluan }}">{{ $p->keperluan }}</p>
                                @if($p->catatan_laboran)
                                    <p class="text-[11px] text-amber-600 dark:text-amber-400 mt-1 italic">Catatan: {{ $p->catatan_laboran }}</p>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 text-xs font-bold rounded-lg inline-block
                                    {{ $p->status === 'Pending' ? 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300' : '' }}
                                    {{ $p->status === 'Disetujui' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300' : '' }}
                                    {{ $p->status === 'Ditolak' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' : '' }}
                                    {{ $p->status === 'Selesai' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' : '' }}">
                                    {{ $p->status }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <form action="{{ route('admin.peminjaman.updateStatus', $p) }}" method="POST" class="inline-flex items-center gap-1.5">
                                    @csrf
                                    @method('PATCH')
                                    @if($p->status === 'Pending')
                                        <button name="status" value="Disetujui" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-emerald-600 hover:bg-emerald-700 text-white transition shadow-sm">
                                            Setujui
                                        </button>
                                        <button name="status" value="Ditolak" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-red-600 hover:bg-red-700 text-white transition shadow-sm">
                                            Tolak
                                        </button>
                                    @elseif($p->status === 'Disetujui')
                                        <button name="status" value="Selesai" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-blue-600 hover:bg-blue-700 text-white transition shadow-sm">
                                            Tandai Selesai
                                        </button>
                                    @else
                                        <span class="text-xs text-slate-400">Final</span>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-sm text-slate-400">
                                Tidak ada data peminjaman yang cocok.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-200 dark:border-slate-800">
            {{ $peminjaman->links() }}
        </div>
    </div>
</div>
@endsection

