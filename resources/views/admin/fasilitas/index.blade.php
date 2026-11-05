@extends('admin.layout')

@section('title', 'Katalog Fasilitas')
@section('page_title', 'Katalog Fasilitas & Inventaris Laboratorium')

@section('admin_content')
<div class="space-y-6">

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200/90 shadow-xs">
        <div>
            <h3 class="text-base font-bold text-[#1E3A8A]">Inventaris & Sarana Laboratorium</h3>
            <p class="text-xs text-slate-500 mt-0.5">Kelola data perangkat, hardware, workstation, dan ruangan laboratorium.</p>
        </div>
        <button type="button" onclick="document.getElementById('modalTambahFasilitas').classList.remove('hidden')"
            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#1E3A8A] hover:bg-[#1E40AF] text-white font-semibold text-xs transition shadow-xs">
            <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Fasilitas
        </button>
    </div>

    <!-- Grid Fasilitas Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($fasilitas as $f)
            <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-semibold px-2.5 py-0.5 rounded-md bg-[#EEF5FF] text-[#1E3A8A] border border-blue-200">
                            {{ $f->kategori }}
                        </span>
                        <span class="text-xs font-bold px-2 py-0.5 rounded-md
                            {{ $f->status_ketersediaan === 'Tersedia' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                            {{ $f->status_ketersediaan }}
                        </span>
                    </div>
                    <h4 class="text-base font-bold text-[#1E3A8A] mt-2">{{ $f->judul }}</h4>
                    <p class="text-xs text-slate-500 mt-1 line-clamp-3 leading-relaxed">{{ $f->deskripsi_singkat }}</p>

                    @if(!empty($f->cakupan))
                        <ul class="mt-3 space-y-1">
                            @foreach($f->cakupan as $item)
                                <li class="text-xs text-slate-600 flex items-center gap-1.5">
                                    <span class="text-emerald-500">✓</span> {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div class="mt-5 pt-3 border-t border-slate-100 flex justify-between items-center text-xs text-slate-400">
                    <span class="font-medium text-slate-500">Sasaran: {{ ucfirst($f->sasaran) }}</span>
                    <div class="flex items-center gap-2">
                        <button type="button" onclick='bukaModalEditFasilitas(@json($f))' class="text-xs text-[#1E3A8A] hover:underline font-semibold transition">
                            Edit
                        </button>
                        <span class="text-slate-200">•</span>
                        <form action="{{ route('admin.fasilitas.destroy', $f->id) }}" method="POST" onsubmit="return confirm('Hapus fasilitas {{ addslashes($f->judul) }}?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-rose-500 hover:text-rose-700 font-semibold transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-slate-400">
                Belum ada data fasilitas yang ditambahkan.
            </div>
        @endforelse
    </div>
</div>

<!-- Modal Tambah Fasilitas -->
<div id="modalTambahFasilitas" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm">
    <div class="bg-white rounded-2xl max-w-lg w-full border border-slate-200 shadow-2xl overflow-hidden">
        <div class="px-6 py-4 bg-[#1E3A8A] text-white flex justify-between items-center">
            <h3 class="font-bold text-sm">Tambah Fasilitas / Sarana Baru</h3>
            <button type="button" onclick="document.getElementById('modalTambahFasilitas').classList.add('hidden')" class="text-white/80 hover:text-white">✕</button>
        </div>

        <form action="{{ route('admin.fasilitas.store') }}" method="POST" class="p-6 space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Nama Fasilitas / Sarana <span class="text-rose-500">*</span></label>
                <input type="text" name="judul" required placeholder="Contoh: Workstation PC Core i7 Lab Komputasi"
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-[#1E3A8A]">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Kategori <span class="text-rose-500">*</span></label>
                    <select name="kategori" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300">
                        <option value="Hardware">Hardware / PC</option>
                        <option value="Jaringan">Perangkat Jaringan</option>
                        <option value="Ruang Lab">Ruang Laboratorium</option>
                        <option value="Multimedia">Multimedia / Audio Visual</option>
                        <option value="Software">Lisensi & Perangkat Lunak</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Status Ketersediaan <span class="text-rose-500">*</span></label>
                    <select name="status_ketersediaan" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300">
                        <option value="Tersedia">Tersedia</option>
                        <option value="Dalam Perawatan">Dalam Perawatan</option>
                        <option value="Dipinjam">Dipinjam</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Sasaran Pengguna <span class="text-rose-500">*</span></label>
                    <select name="sasaran" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300">
                        <option value="mahasiswa">Mahasiswa</option>
                        <option value="dosen">Dosen</option>
                        <option value="umum">Umum</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Urutan Tampil</label>
                    <input type="number" name="urutan" value="0" min="0"
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Deskripsi Singkat</label>
                <textarea name="deskripsi_singkat" rows="2" placeholder="Penjelasan singkat spesifikasi atau fungsi alat..."
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Cakupan / Poin Spesifikasi (Pisahkan baris)</label>
                <textarea name="cakupan" rows="3" placeholder="Intel Core i7 Gen 13&#10;RAM 32GB DDR5&#10;GPU RTX 4060"
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300"></textarea>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('modalTambahFasilitas').classList.add('hidden')"
                    class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-[#1E3A8A] hover:bg-[#1E40AF] text-white font-semibold text-xs shadow-xs">
                    Simpan Fasilitas
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Fasilitas -->
<div id="modalEditFasilitas" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm">
    <div class="bg-white rounded-2xl max-w-lg w-full border border-slate-200 shadow-2xl overflow-hidden">
        <div class="px-6 py-4 bg-[#1E3A8A] text-white flex justify-between items-center">
            <h3 class="font-bold text-sm">Edit Fasilitas / Sarana</h3>
            <button type="button" onclick="document.getElementById('modalEditFasilitas').classList.add('hidden')" class="text-white/80 hover:text-white">✕</button>
        </div>

        <form id="formEditFasilitas" action="" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Nama Fasilitas / Sarana <span class="text-rose-500">*</span></label>
                <input type="text" id="editFasilitasJudul" name="judul" required
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-[#1E3A8A]">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Kategori <span class="text-rose-500">*</span></label>
                    <select id="editFasilitasKategori" name="kategori" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300">
                        <option value="Hardware">Hardware / PC</option>
                        <option value="Jaringan">Perangkat Jaringan</option>
                        <option value="Ruang Lab">Ruang Laboratorium</option>
                        <option value="Multimedia">Multimedia / Audio Visual</option>
                        <option value="Software">Lisensi & Perangkat Lunak</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Status Ketersediaan <span class="text-rose-500">*</span></label>
                    <select id="editFasilitasStatus" name="status_ketersediaan" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300">
                        <option value="Tersedia">Tersedia</option>
                        <option value="Dalam Perawatan">Dalam Perawatan</option>
                        <option value="Dipinjam">Dipinjam</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Sasaran Pengguna <span class="text-rose-500">*</span></label>
                    <select id="editFasilitasSasaran" name="sasaran" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300">
                        <option value="mahasiswa">Mahasiswa</option>
                        <option value="dosen">Dosen</option>
                        <option value="umum">Umum</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Urutan Tampil</label>
                    <input type="number" id="editFasilitasUrutan" name="urutan" min="0"
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Deskripsi Singkat</label>
                <textarea id="editFasilitasDeskripsi" name="deskripsi_singkat" rows="2"
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Cakupan / Poin Spesifikasi (Pisahkan baris)</label>
                <textarea id="editFasilitasCakupan" name="cakupan" rows="3"
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300"></textarea>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('modalEditFasilitas').classList.add('hidden')"
                    class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-[#1E3A8A] hover:bg-[#1E40AF] text-white font-semibold text-xs shadow-xs">
                    Perbarui Fasilitas
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function bukaModalEditFasilitas(item) {
    document.getElementById('formEditFasilitas').action = `/admin/fasilitas/${item.id}`;
    document.getElementById('editFasilitasJudul').value = item.judul || '';
    document.getElementById('editFasilitasKategori').value = item.kategori || 'Hardware';
    document.getElementById('editFasilitasStatus').value = item.status_ketersediaan || 'Tersedia';
    document.getElementById('editFasilitasSasaran').value = item.sasaran || 'mahasiswa';
    document.getElementById('editFasilitasUrutan').value = item.urutan || 0;
    document.getElementById('editFasilitasDeskripsi').value = item.deskripsi_singkat || '';

    if (Array.isArray(item.cakupan)) {
        document.getElementById('editFasilitasCakupan').value = item.cakupan.join('\n');
    } else {
        document.getElementById('editFasilitasCakupan').value = '';
    }

    document.getElementById('modalEditFasilitas').classList.remove('hidden');
}
</script>
@endsection
