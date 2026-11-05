@extends('admin.layout')

@section('title', 'Dosen & Peneliti')
@section('page_title', 'Manajemen Dosen Pembina & Peneliti Lab')

@section('admin_content')
<div class="space-y-6">

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
        <div>
            <h3 class="text-base font-bold text-slate-900 dark:text-white">Daftar Dosen Pembina & Peneliti</h3>
            <p class="text-xs text-slate-500 mt-0.5">Kelola data dosen pengampu praktikum dan grup riset laboratorium SI.</p>
        </div>
        <button type="button" onclick="document.getElementById('modalTambahDosen').classList.remove('hidden')"
            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Dosen
        </button>
    </div>

    <!-- Table Dosen -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600 dark:text-slate-300">
                <thead class="bg-slate-50 dark:bg-slate-800/60 text-slate-700 dark:text-slate-200 uppercase text-[11px] font-bold border-b border-slate-200 dark:border-slate-800">
                    <tr>
                        <th class="py-3.5 px-4">Dosen / Peneliti</th>
                        <th class="py-3.5 px-4">NIP</th>
                        <th class="py-3.5 px-4">Prodi</th>
                        <th class="py-3.5 px-4">Keahlian & Minat</th>
                        <th class="py-3.5 px-4">Kontak</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($dosen as $d)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition">
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-3">
                                    @if($d->foto_path)
                                        <img src="{{ asset('storage/' . $d->foto_path) }}" alt="{{ $d->nama }}" class="w-10 h-10 rounded-full object-cover shrink-0 border border-slate-200 dark:border-slate-700">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 flex items-center justify-center font-bold text-xs shrink-0">
                                            {{ strtoupper(substr($d->nama, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-bold text-slate-900 dark:text-white">{{ $d->nama }}</p>
                                        <p class="text-[10px] text-slate-400">{{ $d->keahlian ?? 'Dosen Sistem Informasi' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 font-mono text-[11px]">{{ $d->nip ?? '-' }}</td>
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300">
                                    {{ $d->prodi }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
                                    {{ $d->bidang_minat ?? 'General SI' }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 space-y-0.5">
                                <p class="text-[11px] text-slate-500">{{ $d->email ?? '-' }}</p>
                                <p class="text-[10px] text-slate-400">{{ $d->no_telp ?? '' }}</p>
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <button type="button"
                                        onclick="bukaModalEditDosen({{ json_encode($d) }})"
                                        class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-amber-500/10 text-amber-600 hover:bg-amber-500/20 transition">
                                        Edit
                                    </button>
                                    <form action="{{ route('admin.dosen.destroy', $d->id) }}" method="POST" onsubmit="return confirm('Hapus data dosen {{ addslashes($d->nama) }}?')" class="inline">
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
                                Belum ada data dosen/peneliti.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($dosen->hasPages())
            <div class="p-4 border-t border-slate-100 dark:border-slate-800">
                {{ $dosen->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Modal Tambah Dosen -->
<div id="modalTambahDosen" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl max-w-lg w-full border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
            <h3 class="font-bold text-slate-900 dark:text-white text-sm">Tambah Dosen / Peneliti Baru</h3>
            <button type="button" onclick="document.getElementById('modalTambahDosen').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>

        <form action="{{ route('admin.dosen.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 overflow-y-auto">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nama Lengkap & Gelar <span class="text-red-500">*</span></label>
                <input type="text" name="nama" required placeholder="Contoh: Dr. Aris Sugiharto, S.Kom., M.Kom."
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">NIP / NIDN</label>
                    <input type="text" name="nip" placeholder="Contoh: 198205122008121001"
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Jenjang Homebase Prodi <span class="text-red-500">*</span></label>
                    <select name="prodi" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                        <option value="S1">S1 Sistem Informasi</option>
                        <option value="S2">S2 Magister</option>
                        <option value="S1,S2">S1 & S2</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Bidang Minat Riset</label>
                    <select name="bidang_minat" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                        <option value="software">Software Engineering</option>
                        <option value="datascience">Data Science & AI</option>
                        <option value="governance">IT Governance & Enterprise</option>
                        <option value="network">Cybersecurity & Network</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Keahlian Spesifik</label>
                    <input type="text" name="keahlian" placeholder="Contoh: Machine Learning, Cloud"
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Email</label>
                    <input type="email" name="email" placeholder="nama@trunojoyo.ac.id"
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nomor WhatsApp/Telepon</label>
                    <input type="text" name="no_telp" placeholder="08123456789"
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Foto Profil Dosen (Opsional)</label>
                <input type="file" name="foto" accept="image/jpeg,image/png,image/jpg,image/webp"
                    class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-800 dark:file:text-slate-300">
                <p class="text-[10px] text-slate-400 mt-1">Format: JPG, PNG, WEBP. Maks 5MB.</p>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="document.getElementById('modalTambahDosen').classList.add('hidden')"
                    class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs shadow-sm">
                    Simpan Dosen
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Dosen -->
<div id="modalEditDosen" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl max-w-lg w-full border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
            <h3 class="font-bold text-slate-900 dark:text-white text-sm">Edit Data Dosen / Peneliti</h3>
            <button type="button" onclick="document.getElementById('modalEditDosen').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>

        <form id="formEditDosen" action="" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 overflow-y-auto">
            @csrf
            @method('PATCH')

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nama Lengkap & Gelar <span class="text-red-500">*</span></label>
                <input type="text" id="edit_dosen_nama" name="nama" required
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">NIP / NIDN</label>
                    <input type="text" id="edit_dosen_nip" name="nip"
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Jenjang Homebase Prodi <span class="text-red-500">*</span></label>
                    <select id="edit_dosen_prodi" name="prodi" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                        <option value="S1">S1 Sistem Informasi</option>
                        <option value="S2">S2 Magister</option>
                        <option value="S1,S2">S1 & S2</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Bidang Minat Riset</label>
                    <select id="edit_dosen_bidang_minat" name="bidang_minat" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                        <option value="software">Software Engineering</option>
                        <option value="datascience">Data Science & AI</option>
                        <option value="governance">IT Governance & Enterprise</option>
                        <option value="network">Cybersecurity & Network</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Keahlian Spesifik</label>
                    <input type="text" id="edit_dosen_keahlian" name="keahlian"
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Email</label>
                    <input type="email" id="edit_dosen_email" name="email"
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nomor WhatsApp/Telepon</label>
                    <input type="text" id="edit_dosen_no_telp" name="no_telp"
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Ganti Foto Profil (Biarkan kosong jika tidak diubah)</label>
                <div id="previewFotoDosenContainer" class="hidden mb-2 items-center gap-3 p-2 rounded-xl bg-slate-50 dark:bg-slate-800">
                    <img id="previewFotoDosen" src="" alt="Foto saat ini" class="w-12 h-12 rounded-full object-cover">
                    <span class="text-[11px] text-slate-500">Foto profil saat ini</span>
                </div>
                <input type="file" name="foto" accept="image/jpeg,image/png,image/jpg,image/webp"
                    class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-800 dark:file:text-slate-300">
                <p class="text-[10px] text-slate-400 mt-1">Format: JPG, PNG, WEBP. Maks 5MB.</p>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="document.getElementById('modalEditDosen').classList.add('hidden')"
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
function bukaModalEditDosen(dosen) {
    const form = document.getElementById('formEditDosen');
    form.action = "{{ url('/admin/dosen') }}/" + dosen.id;
    
    document.getElementById('edit_dosen_nama').value = dosen.nama || '';
    document.getElementById('edit_dosen_nip').value = dosen.nip || '';
    document.getElementById('edit_dosen_prodi').value = dosen.prodi || 'S1';
    document.getElementById('edit_dosen_bidang_minat').value = dosen.bidang_minat || 'software';
    document.getElementById('edit_dosen_keahlian').value = dosen.keahlian || '';
    document.getElementById('edit_dosen_email').value = dosen.email || '';
    document.getElementById('edit_dosen_no_telp').value = dosen.no_telp || '';

    const previewContainer = document.getElementById('previewFotoDosenContainer');
    const previewImg = document.getElementById('previewFotoDosen');
    if (dosen.foto_path) {
        previewImg.src = "{{ asset('storage') }}/" + dosen.foto_path;
        previewContainer.classList.remove('hidden');
        previewContainer.classList.add('flex');
    } else {
        previewContainer.classList.add('hidden');
        previewContainer.classList.remove('flex');
    }

    document.getElementById('modalEditDosen').classList.remove('hidden');
}
</script>
@endsection
