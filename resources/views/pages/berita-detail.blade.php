@extends('components.layout')

@section('title', $berita->judul . ' — Wargalab SI UTM')

@section('content')
<div style="background-color:#F8FAFC; min-height:100vh;">

    {{-- Article Header --}}
    <div style="background: linear-gradient(135deg, #1E3A8A 0%, #1e40af 60%, #172554 100%);" class="pt-28 pb-16 px-6">
        <div class="max-w-3xl mx-auto">
            <div class="flex items-center gap-3 mb-5">
                <a href="/" class="text-blue-200 hover:text-white text-sm font-medium transition">← Beranda</a>
                <span class="text-blue-400">/</span>
                <span class="text-blue-200 text-sm">{{ $berita->kategori }}</span>
            </div>

            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-4
                {{ $berita->kategori === 'Pengumuman' ? 'bg-amber-400/20 text-amber-200 border border-amber-400/30' : 'bg-white/10 text-blue-200 border border-white/20' }}">
                {{ $berita->kategori }}
            </span>

            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white leading-tight mb-5">
                {{ $berita->judul }}
            </h1>

            <div class="flex flex-wrap items-center gap-4 text-sm text-blue-200">
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>{{ $berita->penulis }}</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>{{ $berita->published_at ? $berita->published_at->format('d F Y') : $berita->created_at->format('d F Y') }}</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <span>{{ number_format($berita->views) }} dilihat</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Article Body --}}
    <div class="max-w-3xl mx-auto px-6 py-12">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 md:p-12">

            @if($berita->ringkasan)
                <div class="border-l-4 pl-5 py-3 mb-8 rounded-r-xl" style="border-color:#F59E0B; background-color:#FFFBEB;">
                    <p class="text-sm font-semibold text-amber-800 mb-1 uppercase tracking-wider">Ringkasan</p>
                    <p class="text-slate-700 leading-relaxed">{{ $berita->ringkasan }}</p>
                </div>
            @endif

            <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed text-base space-y-4">
                @foreach(explode("\n\n", $berita->isi) as $paragraph)
                    @if(trim($paragraph))
                        <p>{{ trim($paragraph) }}</p>
                    @endif
                @endforeach
            </div>

            <div class="mt-10 pt-6 border-t border-slate-100 flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <span class="text-xs text-slate-400">Bagikan:</span>
                    <a href="https://wa.me/?text={{ urlencode($berita->judul . ' — ' . url('/berita/' . $berita->slug)) }}" target="_blank" class="p-2 rounded-lg bg-green-50 text-green-700 hover:bg-green-100 transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M11.968 0C5.335 0 0 5.335 0 11.968c0 2.102.549 4.071 1.502 5.785L0 24l6.457-1.479A11.918 11.918 0 0011.968 24C18.601 24 24 18.601 24 11.968 24 5.335 18.601 0 11.968 0zm0 21.818a9.85 9.85 0 01-5.023-1.374l-.36-.214-3.733.855.87-3.642-.234-.374a9.846 9.846 0 01-1.52-5.101c0-5.44 4.427-9.868 9.868-9.868 2.635 0 5.112 1.027 6.973 2.892a9.818 9.818 0 012.895 6.973c-.003 5.44-4.43 9.853-9.736 9.853z"/></svg>
                    </a>
                </div>
                <a href="/" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold transition" style="background-color:#EEF5FF; color:#1E3A8A;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>

        {{-- Artikel Terkait --}}
        @if($beritaTerkait->count() > 0)
            <div class="mt-12">
                <h3 class="text-lg font-bold mb-6" style="color:#1E3A8A;">Berita & Pengumuman Lainnya</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    @foreach($beritaTerkait as $b)
                        <a href="/berita/{{ $b->slug }}" class="block bg-white rounded-xl border border-slate-200 p-5 hover:shadow-md hover:border-blue-200 transition group">
                            <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full mb-2 inline-block
                                {{ $b->kategori === 'Pengumuman' ? 'bg-amber-100 text-amber-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $b->kategori }}
                            </span>
                            <p class="font-bold text-sm text-slate-900 leading-tight group-hover:text-blue-700 transition line-clamp-2 mt-1">{{ $b->judul }}</p>
                            <p class="text-xs text-slate-400 mt-2">{{ $b->published_at ? $b->published_at->format('d M Y') : $b->created_at->format('d M Y') }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

