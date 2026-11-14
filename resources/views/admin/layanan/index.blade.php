@extends('admin.layout')

@section('title', 'Katalog Layanan')
@section('page_title', 'Katalog Layanan Laboratorium SI')

@section('admin_content')
<div class="space-y-6">

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
        <div>
            <h3 class="text-base font-bold text-slate-900 dark:text-white">Daftar Layanan Laboratorium</h3>
            <p class="text-xs text-slate-500 mt-0.5">Kelola jenis layanan praktikum, riset, uji kompetensi, dan pelatihan yang tampil pada halaman Layanan.</p>
        </div>
        <button type="button" onclick="document.getElementById('modalTambahLayanan').classList.remove('hidden')"
            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs transition shadow-sm">
            <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            + Tambah Layanan Baru
        </button>
    </div>

    <!-- Grid Layanan Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($layananList as $item)
            @php
                $imgUrl = null;
                if (!empty($item->foto_path)) {
                    $imgUrl = str_starts_with($item->foto_path, 'http') ? $item->foto_path : asset('storage/' . $item->foto_path);
                } else {
                    $imgUrl = 'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=700&q=80';
                }
            @endphp
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-5 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <!-- Thumbnail Box -->
                    <div class="relative w-full h-44 rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-800 mb-4 border border-slate-100 dark:border-slate-700">
                        <img src="{{ $imgUrl }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
                        <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-md text-[11px] font-bold uppercase tracking-wider
                            {{ $item->sasaran === 'mahasiswa' ? 'bg-blue-100 text-blue-800' : ($item->sasaran === 'dosen' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800') }}">
                            Sasaran: {{ ucfirst($item->sasaran) }}
                        </span>
                        <span class="absolute top-2.5 right-2.5 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-900/60 text-white backdrop-blur-sm">
                            Urutan: {{ $item->urutan }}
                        </span>
                    </div>

                    <h4 class="text-base font-bold text-slate-900 dark:text-white">{{ $item->judul }}</h4>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 line-clamp-3 leading-relaxed">{{ $item->deskripsi_singkat }}</p>

                    @if(!empty($item->cakupan) && is_array($item->cakupan))
                        <div class="mt-3 space-y-1">
                            <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Cakupan Layanan:</p>
                            <ul class="text-xs text-slate-600 dark:text-slate-300 space-y-0.5">
                                @foreach(array_slice($item->cakupan, 0, 3) as $point)
                                    <li class="flex items-center gap-1.5 truncate">
                                        <span class="text-amber-500 font-bold">•</span>
                                        <span class="truncate">{{ $point }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <!-- Actions -->
                <div class="pt-4 mt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <span class="text-[11px] text-slate-400">Slug: {{ $item->slug }}</span>
                    <div class="inline-flex items-center gap-2">
                        <button type="button"
                            onclick="bukaModalEditLayanan({{ json_encode($item) }})"
                            class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-amber-500/10 text-amber-600 hover:bg-amber-500/20 transition">
                            Edit
                        </button>
                        <form action="{{ route('admin.layanan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus layanan: {{ addslashes($item->judul) }}?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-500/10 text-red-600 hover:bg-red-500/20 transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-slate-400 text-sm">
                Belum ada data katalog layanan. Klik tombol <strong>+ Tambah Layanan Baru</strong> di atas.
            </div>
        @endforelse
    </div>

    @if($layananList->hasPages())
        <div class="p-4 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800">
            {{ $layananList->links() }}
        </div>
    @endif

</div>

<!-- Modal Tambah Layanan -->
<div id="modalTambahLayanan" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl max-w-xl w-full border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
            <h3 class="font-bold text-slate-900 dark:text-white text-sm">Tambah Layanan Laboratorium Baru</h3>
            <button type="button" onclick="document.getElementById('modalTambahLayanan').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>

        <form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 overflow-y-auto">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nama Layanan <span class="text-red-500">*</span></label>
                <input type="text" name="judul" required placeholder="Contoh: Praktikum Terjadwal & Asistensi Lab"
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Sasaran Pengguna <span class="text-red-500">*</span></label>
                    <select name="sasaran" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                        <option value="mahasiswa">Mahasiswa</option>
                        <option value="dosen">Dosen / Peneliti</option>
                        <option value="umum">Umum / Mitra Industri</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nomor Urutan</label>
                    <input type="number" name="urutan" value="1"
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Deskripsi Singkat <span class="text-red-500">*</span></label>
                <textarea name="deskripsi_singkat" rows="2" required placeholder="Ringkasan layanan yang tampil pada kartu katalog..."
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white"></textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Deskripsi Lengkap (Untuk Modal Detail)</label>
                <textarea name="deskripsi_lengkap" rows="3" placeholder="Penjelasan rinci mengenai alur dan fasilitas layanan..."
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white"></textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Poin Cakupan Layanan (Pisahkan dengan koma atau baris baru)</label>
                <textarea name="cakupan" rows="3" placeholder="Contoh:&#10;Pelaksanaan sesi praktikum mingguan&#10;Pendampingan asisten laboratorium&#10;Evaluasi kuis & modul praktikum"
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white font-mono"></textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Foto / Gambar Ilustrasi Layanan</label>
                <input type="file" name="foto" accept="image/jpeg,image/png,image/jpg,image/webp"
                    class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-800 dark:file:text-slate-300">
                <p class="text-[10px] text-slate-400 mt-1">Format: JPG, PNG, WEBP (maks 5MB).</p>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="document.getElementById('modalTambahLayanan').classList.add('hidden')"
                    class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs shadow-sm">
                    Simpan Layanan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Layanan -->
<div id="modalEditLayanan" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl max-w-xl w-full border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
            <h3 class="font-bold text-slate-900 dark:text-white text-sm">Edit Data Layanan</h3>
            <button type="button" onclick="document.getElementById('modalEditLayanan').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>

        <form id="formEditLayanan" action="" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 overflow-y-auto">
            @csrf
            @method('PATCH')

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nama Layanan <span class="text-red-500">*</span></label>
                <input type="text" id="edit_layanan_judul" name="judul" required
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Sasaran Pengguna <span class="text-red-500">*</span></label>
                    <select id="edit_layanan_sasaran" name="sasaran" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                        <option value="mahasiswa">Mahasiswa</option>
                        <option value="dosen">Dosen / Peneliti</option>
                        <option value="umum">Umum / Mitra Industri</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nomor Urutan</label>
                    <input type="number" id="edit_layanan_urutan" name="urutan"
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Deskripsi Singkat <span class="text-red-500">*</span></label>
                <textarea id="edit_layanan_deskripsi_singkat" name="deskripsi_singkat" rows="2" required
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white"></textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Deskripsi Lengkap</label>
                <textarea id="edit_layanan_deskripsi_lengkap" name="deskripsi_lengkap" rows="3"
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white"></textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Poin Cakupan Layanan (Pisahkan dengan koma atau baris baru)</label>
                <textarea id="edit_layanan_cakupan" name="cakupan" rows="3"
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white font-mono"></textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Ganti Foto / Gambar Layanan</label>
                <div id="previewFotoLayananContainer" class="hidden mb-2 items-center gap-3 p-2 rounded-xl bg-slate-50 dark:bg-slate-800">
                    <img id="previewFotoLayanan" src="" alt="Foto saat ini" class="w-16 h-12 rounded-lg object-cover">
                    <span class="text-[11px] text-slate-500">Gambar saat ini</span>
                </div>
                <input type="file" name="foto" accept="image/jpeg,image/png,image/jpg,image/webp"
                    class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-800 dark:file:text-slate-300">
                <p class="text-[10px] text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="document.getElementById('modalEditLayanan').classList.add('hidden')"
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
function bukaModalEditLayanan(item) {
    const form = document.getElementById('formEditLayanan');
    form.action = "{{ url('/admin/layanan') }}/" + item.id;

    document.getElementById('edit_layanan_judul').value = item.judul || '';
    document.getElementById('edit_layanan_sasaran').value = item.sasaran || 'mahasiswa';
    document.getElementById('edit_layanan_urutan').value = item.urutan || 0;
    document.getElementById('edit_layanan_deskripsi_singkat').value = item.deskripsi_singkat || '';
    document.getElementById('edit_layanan_deskripsi_lengkap').value = item.deskripsi_lengkap || '';

    let cakupanText = '';
    if (Array.isArray(item.cakupan)) {
        cakupanText = item.cakupan.join("\n");
    } else if (typeof item.cakupan === 'string') {
        cakupanText = item.cakupan;
    }
    document.getElementById('edit_layanan_cakupan').value = cakupanText;

    const previewContainer = document.getElementById('previewFotoLayananContainer');
    const previewImg = document.getElementById('previewFotoLayanan');
    if (item.foto_path) {
        previewImg.src = item.foto_path.startsWith('http') ? item.foto_path : ("{{ asset('storage') }}/" + item.foto_path);
        previewContainer.classList.remove('hidden');
        previewContainer.classList.add('flex');
    } else {
        previewContainer.classList.add('hidden');
        previewContainer.classList.remove('flex');
    }

    document.getElementById('modalEditLayanan').classList.remove('hidden');
}
</script>
@endsection

