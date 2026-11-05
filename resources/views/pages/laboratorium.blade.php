@extends('layouts.app')

@section('content')
    <!-- SECTION LABORATORIUM — Daftar Ruang & Praktikum Aktif -->
    <section id="laboratorium" class="py-20 bg-white">
        <div class="max-w-screen-2xl mx-auto px-8 md:px-16">

            <!-- Section Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                <div>
                    <span class="text-[#1E3A8A] font-semibold text-xs uppercase tracking-widest bg-blue-50 px-3 py-1 rounded-full border border-blue-100">
                        Modul Laboratorium
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-[#1E3A8A] mt-3 tracking-tight">
                        Ruang & Jadwal Laboratorium
                    </h2>
                    <p class="text-slate-600 mt-2 text-sm sm:text-base">
                        Daftar seluruh ruang laboratorium beserta praktikum yang sedang aktif berjalan di semester ini.
                    </p>
                </div>
                <!-- Legend -->
                <div class="flex items-center gap-4 text-xs font-medium text-slate-500 bg-lightbg px-4 py-2 rounded-xl border border-slate-200">
                    <span class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> Aktif
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-slate-400"></span> Selesai
                    </span>
                </div>
            </div>

            <!-- Grid Cards Laboratorium (Dinamis dari Supabase) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($laboratorium as $item)
                <!-- Card Laboratorium -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col group">

                    <!-- Card Color Header -->
                    <div class="relative h-32 bg-linear-to-br from-[#1E3A8A] to-[#1e40af] flex items-center justify-center">
                        <div class="text-white text-center px-4">
                            <div class="text-4xl font-extrabold opacity-20">Lab</div>
                            <div class="text-5xl font-black -mt-4 text-white">{{ $item->ruangLab?->kode ?? 'SI' }}</div>
                        </div>
                        <!-- Badge Status Modul -->
                        <span class="absolute top-3 right-3 inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $item->status === 'aktif' ? 'bg-emerald-100 text-emerald-800 border border-emerald-300' : 'bg-slate-100 text-slate-800 border border-slate-300' }}">
                            @if($item->status === 'aktif')
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                            @endif
                            {{ ucfirst($item->status) }}
                        </span>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="text-xs text-slate-400 uppercase font-semibold mb-1">
                                Semester {{ $item->semester }} &bull; {{ $item->sks }} SKS
                            </div>
                            <h3 class="text-lg font-bold text-[#1E3A8A] group-hover:text-[#D97706] transition-colors">
                                {{ $item->nama }}
                            </h3>

                            <!-- Info Singkat -->
                            <div class="mt-4 space-y-2 text-xs text-slate-600 bg-lightbg p-3.5 rounded-xl border border-slate-100">
                                <div class="flex justify-between">
                                    <span class="text-slate-400">Ruang Lab:</span>
                                    <span class="font-medium text-slate-800">{{ $item->ruangLab?->nama_ruang ?? 'Lab Sistem Informasi' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-400">Lokasi:</span>
                                    <span class="font-medium text-slate-800">{{ $item->ruangLab?->lokasi ?? 'Gedung RKB C' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-400">Modul Tersedia:</span>
                                    <span class="font-semibold text-blue-700">{{ $item->modul->count() }} Berkas</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="mt-6 pt-4 border-t border-slate-100">
                            @php $latestModul = $item->modul->first(); @endphp
                            @if($latestModul)
                                <a href="{{ asset('storage/' . $latestModul->file_path) }}" target="_blank"
                                    class="w-full inline-flex items-center justify-center gap-2 bg-[#F59E0B] hover:bg-[#D97706] text-white font-semibold text-sm py-2.5 px-4 rounded-xl shadow-sm hover:shadow-md transition active:scale-[0.98]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    <span>Unduh Modul (v{{ $latestModul->versi }})</span>
                                </a>
                            @else
                                <button disabled
                                    class="w-full inline-flex items-center justify-center gap-2 bg-slate-200 text-slate-400 font-semibold text-sm py-2.5 px-4 rounded-xl cursor-not-allowed">
                                    <span>Modul Belum Tersedia</span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12 text-slate-400">
                    Belum ada data mata kuliah praktikum di database.
                </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
