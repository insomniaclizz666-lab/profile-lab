@extends('admin.layout')

@section('title', 'Manajemen Berita & Pengumuman')
@section('page_title', 'Kelola Berita & Pengumuman Laboratorium')

@section('admin_content')
<div class="space-y-6">

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
        <div>
            <h3 class="text-base font-bold text-slate-900 dark:text-white">Daftar Berita & Pengumuman</h3>
            <p class="text-xs text-slate-500 mt-0.5">Kelola artikel berita, rilis kegiatan, dan pengumuman resmi yang tampil di halaman beranda.</p>
        </div>
        <button type="button" onclick="document.getElementById('modalTambahBerita').classList.remove('hidden')"
            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Berita / Pengumuman
        </button>
    </div>

    <!-- Table Berita -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600 dark:text-slate-300">
                <thead class="bg-slate-50 dark:bg-slate-800/60 text-slate-700 dark:text-slate-200 uppercase text-[11px] font-bold border-b border-slate-200 dark:border-slate-800">
                    <tr>
                        <th class="py-3.5 px-4">Judul & Kategori</th>
                        <th class="py-3.5 px-4">Penulis</th>
                        <th class="py-3.5 px-4">Tanggal Rilis</th>
                        <th class="py-3.5 px-4">Dilihat</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($beritaList as $b)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition">
                            <td class="py-3.5 px-4 max-w-sm">
                                <div class="flex items-center gap-3">
                                    @php
                                        $adminBeritaImg = null;
                                        if (!empty($b->foto_path)) {
                                            $adminBeritaImg = str_starts_with($b->foto_path, 'http') ? $b->foto_path : asset('storage/' . $b->foto_path);
                                        }
                                    @endphp
                                    <div class="w-14 h-14 rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shrink-0 flex items-center justify-center">
                                        @if($adminBeritaImg)
                                            <img src="{{ $adminBeritaImg }}" alt="{{ $b->judul }}" class="w-full h-full object-cover" onerror="this.onerror=null; this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');">
                                            <span class="text-[9px] font-bold text-slate-400 hidden">NO IMG</span>
                                        @else
                                            <span class="text-[9px] font-bold text-slate-400">NO IMG</span>
                                        @endif
                                    </div>
                                    <div>
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold shrink-0 mb-1 inline-block
                                            {{ $b->kategori === 'Pengumuman' ? 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300' : 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' }}">
                                            {{ $b->kategori }}
                                        </span>
                                        <a href="/berita/{{ $b->slug }}" target="_blank" class="block font-bold text-slate-900 dark:text-white hover:text-blue-600 transition leading-snug">
                                            {{ $b->judul }}
                                        </a>
                                        <p class="text-[11px] text-slate-400 line-clamp-1 mt-0.5">{{ $b->ringkasan }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 font-medium text-slate-700 dark:text-slate-300">
                                {{ $b->penulis ?? 'Admin Lab SI' }}
                            </td>
                            <td class="py-3.5 px-4 text-slate-500">
                                {{ $b->published_at ? $b->published_at->format('d M Y') : $b->created_at->format('d M Y') }}
                            </td>
                            <td class="py-3.5 px-4 font-mono text-slate-600 dark:text-slate-400">
                                {{ number_format($b->views) }}x
                            </td>
                            <td class="py-3.5 px-4">
                                @if($b->is_active)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="/berita/{{ $b->slug }}" target="_blank"
                                        class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-300 transition">
                                        Lihat
                                    </a>
                                    <button type="button"
                                        onclick="bukaModalEditBerita({{ json_encode($b) }})"
                                        class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-amber-500/10 text-amber-600 hover:bg-amber-500/20 transition">
                                        Edit
                                    </button>
                                    <form action="{{ route('admin.berita.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Hapus berita: {{ addslashes($b->judul) }}?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-red-500/10 text-red-600 hover:bg-red-500/20 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400">
                                Belum ada berita atau pengumuman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($beritaList->hasPages())
            <div class="p-4 border-t border-slate-100 dark:border-slate-800">
                {{ $beritaList->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Modal Tambah Berita -->
<div id="modalTambahBerita" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl max-w-2xl w-full border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
            <h3 class="font-bold text-slate-900 dark:text-white text-sm">Tambah Berita / Pengumuman Baru</h3>
            <button type="button" onclick="document.getElementById('modalTambahBerita').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>

        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 overflow-y-auto">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Judul Berita / Pengumuman <span class="text-red-500">*</span></label>
                <input type="text" name="judul" required placeholder="Contoh: Pendaftaran Asisten Lab Semester Genap Resmi Dibuka"
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Kategori <span class="text-red-500">*</span></label>
                    <select name="kategori" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                        <option value="Berita">Berita</option>
                        <option value="Pengumuman">Pengumuman</option>
                        <option value="Agenda">Agenda</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nama Penulis / Tim Rilis</label>
                    <input type="text" name="penulis" value="Admin Lab SI" placeholder="Admin Lab SI"
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Ringkasan Singkat (Lead Paragraph)</label>
                <textarea name="ringkasan" rows="2" placeholder="Satu-dua kalimat ringkasan inti informasi..."
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white"></textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Isi Lengkap Artikel <span class="text-red-500">*</span></label>
                <textarea name="isi" rows="6" required placeholder="Tuliskan isi berita atau pengumuman secara rinci..."
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white"></textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Unggah Foto / Banner (Opsional)</label>
                <input type="file" name="foto" accept="image/jpeg,image/png,image/jpg,image/webp"
                    class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-800 dark:file:text-slate-300">
                <p class="text-[10px] text-slate-400 mt-1">Format: JPG, PNG, WEBP (maks 5MB).</p>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="document.getElementById('modalTambahBerita').classList.add('hidden')"
                    class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs shadow-sm">
                    Terbitkan Berita
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Berita -->
<div id="modalEditBerita" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl max-w-2xl w-full border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
            <h3 class="font-bold text-slate-900 dark:text-white text-sm">Edit Berita / Pengumuman</h3>
            <button type="button" onclick="document.getElementById('modalEditBerita').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>

        <form id="formEditBerita" action="" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 overflow-y-auto">
            @csrf
            @method('PATCH')

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Judul Berita / Pengumuman <span class="text-red-500">*</span></label>
                <input type="text" id="edit_berita_judul" name="judul" required
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Kategori <span class="text-red-500">*</span></label>
                    <select id="edit_berita_kategori" name="kategori" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                        <option value="Berita">Berita</option>
                        <option value="Pengumuman">Pengumuman</option>
                        <option value="Agenda">Agenda</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nama Penulis</label>
                    <input type="text" id="edit_berita_penulis" name="penulis"
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Ringkasan Singkat</label>
                <textarea id="edit_berita_ringkasan" name="ringkasan" rows="2"
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white"></textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Isi Lengkap Artikel <span class="text-red-500">*</span></label>
                <textarea id="edit_berita_isi" name="isi" rows="6" required
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white"></textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Ganti Foto / Banner (Biarkan kosong jika tidak diubah)</label>
                <div id="previewFotoBeritaContainer" class="hidden mb-2 items-center gap-3 p-2 rounded-xl bg-slate-50 dark:bg-slate-800">
                    <img id="previewFotoBerita" src="" alt="Banner saat ini" class="w-16 h-12 rounded-lg object-cover">
                    <span class="text-[11px] text-slate-500">Banner saat ini</span>
                </div>
                <input type="file" name="foto" accept="image/jpeg,image/png,image/jpg,image/webp"
                    class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-800 dark:file:text-slate-300">
            </div>

            <div class="flex items-center gap-2 pt-1">
                <input type="checkbox" id="edit_berita_is_active" name="is_active" value="1" class="rounded text-blue-600 focus:ring-blue-500">
                <label for="edit_berita_is_active" class="text-xs font-medium text-slate-700 dark:text-slate-300">Publikasikan artikel (Aktif dan tampil di website)</label>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="document.getElementById('modalEditBerita').classList.add('hidden')"
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
function bukaModalEditBerita(berita) {
    const form = document.getElementById('formEditBerita');
    form.action = "{{ url('/admin/berita') }}/" + berita.id;

    document.getElementById('edit_berita_judul').value = berita.judul || '';
    document.getElementById('edit_berita_kategori').value = berita.kategori || 'Berita';
    document.getElementById('edit_berita_penulis').value = berita.penulis || 'Admin Lab SI';
    document.getElementById('edit_berita_ringkasan').value = berita.ringkasan || '';
    document.getElementById('edit_berita_isi').value = berita.isi || '';
    document.getElementById('edit_berita_is_active').checked = berita.is_active ? true : false;

    const previewContainer = document.getElementById('previewFotoBeritaContainer');
    const previewImg = document.getElementById('previewFotoBerita');
    if (berita.foto_path) {
        previewImg.src = berita.foto_path.startsWith('http') ? berita.foto_path : ("{{ asset('storage') }}/" + berita.foto_path);
        previewContainer.classList.remove('hidden');
        previewContainer.classList.add('flex');
    } else {
        previewContainer.classList.add('hidden');
        previewContainer.classList.remove('flex');
    }

    document.getElementById('modalEditBerita').classList.remove('hidden');
}
</script>
@endsection

