@extends('admin.layout')

@section('title', 'Profil & Statistik Lab')
@section('page_title', 'Profil Pimpinan & Statistik Laboratorium')

@section('admin_content')
<div class="space-y-8">

    <!-- BAGIAN 1: STATISTIK HERO SECTION -->
    <div class="space-y-4">
        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
            <h3 class="text-base font-bold text-slate-900 dark:text-white">Angka Statistik Laboratorium</h3>
            <p class="text-xs text-slate-500 mt-0.5">Statistik ini ditampilkan di bagian Hero halaman depan (Home) untuk mencerminkan capaian laboratorium.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @forelse($stats as $st)
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-5 shadow-sm">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">{{ $st->key }}</span>
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    </div>

                    <form action="{{ route('admin.statistik.update', $st->id) }}" method="POST" class="space-y-3">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label class="block text-[11px] font-medium text-slate-500 mb-1">{{ $st->label }}</label>
                            <div class="flex gap-2">
                                <input type="text" name="nilai" value="{{ $st->nilai }}" required
                                    class="w-2/3 px-3 py-1.5 text-base font-bold text-[#1E3A8A] dark:text-blue-400 rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800">
                                <input type="text" name="satuan" value="{{ $st->satuan }}" placeholder="Satuan"
                                    class="w-1/3 px-2 py-1.5 text-xs text-slate-600 dark:text-slate-300 rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800">
                            </div>
                        </div>

                        <button type="submit" class="w-full py-1.5 rounded-xl bg-slate-100 hover:bg-blue-50 text-slate-700 hover:text-blue-700 dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-slate-300 text-xs font-semibold transition">
                            Perbarui Nilai
                        </button>
                    </form>
                </div>
            @empty
                <div class="col-span-full py-6 text-center text-slate-400 text-xs">Belum ada data statistik.</div>
            @endforelse
        </div>
    </div>

    <!-- BAGIAN 2: PROFIL STRUKTURAL & PIMPINAN -->
    <div class="space-y-4">
        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
            <h3 class="text-base font-bold text-slate-900 dark:text-white">Profil Pimpinan & Pengelola Lab</h3>
            <p class="text-xs text-slate-500 mt-0.5">Informasi pimpinan (Kaprodi, Kepala Lab, Laboran) yang ditampilkan pada kartu profil di halaman depan.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($profils as $p)
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-3 mb-4 pb-3 border-b border-slate-100 dark:border-slate-800">
                            @if($p->foto_path)
                                <img src="{{ asset('storage/' . $p->foto_path) }}" alt="{{ $p->nama }}" class="w-14 h-14 rounded-2xl object-cover shrink-0 border border-slate-200 dark:border-slate-700 shadow-sm">
                            @else
                                <div class="w-14 h-14 rounded-2xl bg-blue-100 dark:bg-blue-900/40 text-[#1E3A8A] dark:text-blue-300 font-extrabold text-lg flex items-center justify-center shrink-0">
                                    {{ strtoupper(substr($p->nama, 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-blue-50 text-[#1E3A8A] dark:bg-blue-900/30 dark:text-blue-300">
                                    {{ strtoupper(str_replace('_', ' ', $p->jabatan)) }}
                                </span>
                                <h4 class="font-bold text-slate-900 dark:text-white text-sm mt-0.5">{{ $p->nama }}</h4>
                                @if($p->gelar)
                                    <p class="text-xs text-slate-400">{{ $p->gelar }}</p>
                                @endif
                            </div>
                        </div>

                        <form action="{{ route('admin.profil.update', $p->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            @csrf
                            @method('PATCH')

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nama Pejabat / Pimpinan</label>
                                <input type="text" name="nama" value="{{ $p->nama }}" required
                                    class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Gelar Akademik / Gelar Tambahan</label>
                                <input type="text" name="gelar" value="{{ $p->gelar }}" placeholder="Contoh: S.Kom., M.Kom."
                                    class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Ganti Foto Profil</label>
                                <input type="file" name="foto" accept="image/jpeg,image/png,image/jpg,image/webp"
                                    class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-800 dark:file:text-slate-300">
                                <p class="text-[10px] text-slate-400 mt-0.5">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, PNG, WEBP (maks 5MB).</p>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Deskripsi / Kata Sambutan Singkat</label>
                                <textarea name="deskripsi" rows="3"
                                    class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">{{ $p->deskripsi }}</textarea>
                            </div>

                            <div class="flex justify-end pt-2">
                                <button type="submit" class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs shadow-sm transition">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-8 text-center text-slate-400 text-xs">Belum ada data pimpinan lab.</div>
            @endforelse
        </div>
    </div>

</div>
@endsection
