@extends('admin.layout')

@section('title', 'Galeri & Testimoni Lab')
@section('page_title', 'Kelola Dokumentasi Galeri & Testimoni')

@section('admin_content')
<div class="space-y-10">

    <!-- ========================================== -->
    <!-- BAGIAN 1: GALERI KEGIATAN PRAKTIKUM        -->
    <!-- ========================================== -->
    <div class="space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
            <div>
                <h3 class="text-base font-bold text-slate-900 dark:text-white">Galeri Foto Kegiatan & Praktikum</h3>
                <p class="text-xs text-slate-500 mt-0.5">Dokumentasi visual kegiatan praktikum, riset, dan workshop yang tampil pada section Galeri di beranda.</p>
            </div>
            <button type="button" onclick="document.getElementById('modalTambahGaleri').classList.remove('hidden')"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Foto Galeri
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($galeriList as $g)
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm flex flex-col justify-between">
                    <div>
                        <!-- Thumbnail Box -->
                        <div class="relative w-full h-40 overflow-hidden"
                             style="background: linear-gradient(135deg, {{ $g->kategori === 'Workshop' ? '#FEF3C7, #FDE68A' : ($g->kategori === 'Riset' ? '#E0E7FF, #C7D2FE' : '#DBEAFE, #BFDBFE') }});">
                            @if($g->foto_path)
                                <img src="{{ asset('storage/' . $g->foto_path) }}" alt="{{ $g->judul }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center">
                                    <svg class="w-10 h-10 opacity-40 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                            <span class="absolute top-2.5 left-2.5 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider
                                {{ $g->kategori === 'Workshop' ? 'bg-amber-100 text-amber-800' : ($g->kategori === 'Riset' ? 'bg-indigo-100 text-indigo-800' : 'bg-blue-100 text-blue-800') }}">
                                {{ $g->kategori }}
                            </span>
                            <span class="absolute top-2.5 right-2.5 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-900/60 text-white backdrop-blur-sm">
                                Urutan: {{ $g->urutan }}
                            </span>
                        </div>

                        <!-- Card Info -->
                        <div class="p-4">
                            <h4 class="font-bold text-sm text-slate-900 dark:text-white leading-snug line-clamp-2">{{ $g->judul }}</h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 line-clamp-2">{{ $g->deskripsi ?? 'Tanpa deskripsi tambahan' }}</p>
                        </div>
                    </div>

                    <!-- Card Actions -->
                    <div class="px-4 py-3 bg-slate-50 dark:bg-slate-800/40 border-t border-slate-100 dark:border-slate-800 flex items-center justify-end gap-2">
                        <button type="button"
                            onclick="bukaModalEditGaleri({{ json_encode($g) }})"
                            class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-amber-500/10 text-amber-600 hover:bg-amber-500/20 transition">
                            Edit
                        </button>
                        <form action="{{ route('admin.galeri.destroy', $g->id) }}" method="POST" onsubmit="return confirm('Hapus item galeri {{ addslashes($g->judul) }}?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-red-500/10 text-red-600 hover:bg-red-500/20 transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-8 text-center text-slate-400 text-xs">Belum ada item galeri.</div>
            @endforelse
        </div>
    </div>

    <!-- ========================================== -->
    <!-- BAGIAN 2: TESTIMONI ASISTEN & MAHASISWA   -->
    <!-- ========================================== -->
    <div class="space-y-4 pt-6 border-t border-slate-200 dark:border-slate-800">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
            <div>
                <h3 class="text-base font-bold text-slate-900 dark:text-white">Testimoni Asisten & Mahasiswa</h3>
                <p class="text-xs text-slate-500 mt-0.5">Kutipan pengalaman asisten lab, mahasiswa berprestasi, dan alumni yang tampil pada section Suara Mereka.</p>
            </div>
            <button type="button" onclick="document.getElementById('modalTambahTestimoni').classList.remove('hidden')"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Testimoni
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @forelse($testimoniList as $t)
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-5 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-3 mb-3 pb-3 border-b border-slate-100 dark:border-slate-800">
                            @if($t->foto_path)
                                <img src="{{ asset('storage/' . $t->foto_path) }}" alt="{{ $t->nama }}" class="w-12 h-12 rounded-full object-cover shrink-0 border border-slate-200">
                            @else
                                <div class="w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 font-bold text-base flex items-center justify-center shrink-0">
                                    {{ strtoupper(substr($t->nama, 0, 1)) }}
                                </div>
                            @endif
                            <div class="min-w-0">
                                <h4 class="font-bold text-sm text-slate-900 dark:text-white truncate">{{ $t->nama }}</h4>
                                <p class="text-[11px] font-semibold text-amber-600 dark:text-amber-400 truncate">{{ $t->role }}</p>
                                <p class="text-[10px] text-slate-400">{{ $t->angkatan ?? '-' }}</p>
                            </div>
                        </div>

                        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed italic line-clamp-4">
                            &ldquo;{{ $t->kutipan }}&rdquo;
                        </p>
                    </div>

                    <div class="pt-4 mt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                        <span class="text-[10px] text-slate-400">Urutan: {{ $t->urutan }}</span>
                        <div class="inline-flex items-center gap-2">
                            <button type="button"
                                onclick="bukaModalEditTestimoni({{ json_encode($t) }})"
                                class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-amber-500/10 text-amber-600 hover:bg-amber-500/20 transition">
                                Edit
                            </button>
                            <form action="{{ route('admin.testimoni.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Hapus testimoni dari {{ addslashes($t->nama) }}?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-red-500/10 text-red-600 hover:bg-red-500/20 transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-8 text-center text-slate-400 text-xs">Belum ada testimoni.</div>
            @endforelse
        </div>
    </div>

</div>

<!-- Modal Tambah Galeri -->
<div id="modalTambahGaleri" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl max-w-lg w-full border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden">
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
            <h3 class="font-bold text-slate-900 dark:text-white text-sm">Tambah Foto Galeri</h3>
            <button type="button" onclick="document.getElementById('modalTambahGaleri').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>
        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Judul Kegiatan <span class="text-red-500">*</span></label>
                <input type="text" name="judul" required placeholder="Contoh: Praktikum Jaringan Komputer di Lab B"
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Kategori <span class="text-red-500">*</span></label>
                    <select name="kategori" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                        <option value="Praktikum">Praktikum</option>
                        <option value="Workshop">Workshop</option>
                        <option value="Riset">Riset</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nomor Urutan Tampil</label>
                    <input type="number" name="urutan" value="1"
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Deskripsi Singkat</label>
                <textarea name="deskripsi" rows="2" placeholder="Keterangan singkat momen kegiatan..."
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white"></textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Unggah Foto (Opsional)</label>
                <input type="file" name="foto" accept="image/jpeg,image/png,image/jpg,image/webp"
                    class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-800 dark:file:text-slate-300">
            </div>
            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="document.getElementById('modalTambahGaleri').classList.add('hidden')"
                    class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs shadow-sm">
                    Simpan Galeri
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Galeri -->
<div id="modalEditGaleri" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl max-w-lg w-full border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden">
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
            <h3 class="font-bold text-slate-900 dark:text-white text-sm">Edit Data Galeri</h3>
            <button type="button" onclick="document.getElementById('modalEditGaleri').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>
        <form id="formEditGaleri" action="" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            @method('PATCH')
            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Judul Kegiatan <span class="text-red-500">*</span></label>
                <input type="text" id="edit_galeri_judul" name="judul" required
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Kategori <span class="text-red-500">*</span></label>
                    <select id="edit_galeri_kategori" name="kategori" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                        <option value="Praktikum">Praktikum</option>
                        <option value="Workshop">Workshop</option>
                        <option value="Riset">Riset</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nomor Urutan Tampil</label>
                    <input type="number" id="edit_galeri_urutan" name="urutan"
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Deskripsi Singkat</label>
                <textarea id="edit_galeri_deskripsi" name="deskripsi" rows="2"
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white"></textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Ganti Foto (Opsional)</label>
                <div id="previewFotoGaleriContainer" class="hidden mb-2 items-center gap-3 p-2 rounded-xl bg-slate-50 dark:bg-slate-800">
                    <img id="previewFotoGaleri" src="" alt="Foto saat ini" class="w-16 h-12 rounded-lg object-cover">
                    <span class="text-[11px] text-slate-500">Foto saat ini</span>
                </div>
                <input type="file" name="foto" accept="image/jpeg,image/png,image/jpg,image/webp"
                    class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-800 dark:file:text-slate-300">
            </div>
            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="document.getElementById('modalEditGaleri').classList.add('hidden')"
                    class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs shadow-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Tambah Testimoni -->
<div id="modalTambahTestimoni" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl max-w-lg w-full border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden">
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
            <h3 class="font-bold text-slate-900 dark:text-white text-sm">Tambah Testimoni</h3>
            <button type="button" onclick="document.getElementById('modalTambahTestimoni').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>
        <form action="{{ route('admin.testimoni.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nama Mahasiswa / Asisten <span class="text-red-500">*</span></label>
                <input type="text" name="nama" required placeholder="Contoh: Rizky Maulana"
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Peran / Jabatan <span class="text-red-500">*</span></label>
                    <input type="text" name="role" required placeholder="Contoh: Asisten Lab Basis Data"
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Angkatan / Status</label>
                    <input type="text" name="angkatan" placeholder="Contoh: Angkatan 2022"
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Kutipan Testimoni <span class="text-red-500">*</span></label>
                <textarea name="kutipan" rows="3" required placeholder="Tuliskan pengalaman berkesan selama beraktivitas di laboratorium..."
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white"></textarea>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nomor Urutan Tampil</label>
                    <input type="number" name="urutan" value="1"
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Foto Profil (Opsional)</label>
                    <input type="file" name="foto" accept="image/jpeg,image/png,image/jpg,image/webp"
                        class="w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-2 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700">
                </div>
            </div>
            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="document.getElementById('modalTambahTestimoni').classList.add('hidden')"
                    class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs shadow-sm">
                    Simpan Testimoni
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Testimoni -->
<div id="modalEditTestimoni" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl max-w-lg w-full border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden">
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
            <h3 class="font-bold text-slate-900 dark:text-white text-sm">Edit Testimoni</h3>
            <button type="button" onclick="document.getElementById('modalEditTestimoni').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>
        <form id="formEditTestimoni" action="" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            @method('PATCH')
            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nama Mahasiswa / Asisten <span class="text-red-500">*</span></label>
                <input type="text" id="edit_testimoni_nama" name="nama" required
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Peran / Jabatan <span class="text-red-500">*</span></label>
                    <input type="text" id="edit_testimoni_role" name="role" required
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Angkatan / Status</label>
                    <input type="text" id="edit_testimoni_angkatan" name="angkatan"
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Kutipan Testimoni <span class="text-red-500">*</span></label>
                <textarea id="edit_testimoni_kutipan" name="kutipan" rows="3" required
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white"></textarea>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nomor Urutan Tampil</label>
                    <input type="number" id="edit_testimoni_urutan" name="urutan"
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Ganti Foto (Opsional)</label>
                    <input type="file" name="foto" accept="image/jpeg,image/png,image/jpg,image/webp"
                        class="w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-2 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700">
                </div>
            </div>
            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="document.getElementById('modalEditTestimoni').classList.add('hidden')"
                    class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs shadow-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function bukaModalEditGaleri(galeri) {
    const form = document.getElementById('formEditGaleri');
    form.action = "{{ url('/admin/galeri') }}/" + galeri.id;
    document.getElementById('edit_galeri_judul').value = galeri.judul || '';
    document.getElementById('edit_galeri_kategori').value = galeri.kategori || 'Praktikum';
    document.getElementById('edit_galeri_urutan').value = galeri.urutan || 0;
    document.getElementById('edit_galeri_deskripsi').value = galeri.deskripsi || '';

    const previewContainer = document.getElementById('previewFotoGaleriContainer');
    const previewImg = document.getElementById('previewFotoGaleri');
    if (galeri.foto_path) {
        previewImg.src = "{{ asset('storage') }}/" + galeri.foto_path;
        previewContainer.classList.remove('hidden');
        previewContainer.classList.add('flex');
    } else {
        previewContainer.classList.add('hidden');
        previewContainer.classList.remove('flex');
    }

    document.getElementById('modalEditGaleri').classList.remove('hidden');
}

function bukaModalEditTestimoni(testimoni) {
    const form = document.getElementById('formEditTestimoni');
    form.action = "{{ url('/admin/testimoni') }}/" + testimoni.id;
    document.getElementById('edit_testimoni_nama').value = testimoni.nama || '';
    document.getElementById('edit_testimoni_role').value = testimoni.role || '';
    document.getElementById('edit_testimoni_angkatan').value = testimoni.angkatan || '';
    document.getElementById('edit_testimoni_kutipan').value = testimoni.kutipan || '';
    document.getElementById('edit_testimoni_urutan').value = testimoni.urutan || 0;

    document.getElementById('modalEditTestimoni').classList.remove('hidden');
}
</script>
@endsection

