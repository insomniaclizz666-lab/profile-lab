@extends('admin.layout')

@section('title', 'Modul Praktikum')
@section('page_title', 'Kelola & Unggah Berkas Modul Praktikum')

@section('admin_content')
<div class="space-y-6">
    <!-- Upload Box -->
    <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
        <h3 class="text-base font-bold text-slate-900 dark:text-white mb-4">Unggah Modul Praktikum Baru</h3>
        <form action="{{ route('admin.modul.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Mata Kuliah Praktikum</label>
                <select name="mata_kuliah_id" required class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                    <option value="">Pilih Mata Kuliah...</option>
                    @foreach($mataKuliah as $mk)
                        <option value="{{ $mk->id }}">{{ $mk->nama }} (Sem {{ $mk->semester }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Judul / Nama Modul</label>
                <input type="text" name="judul" required placeholder="Contoh: Modul 2 - Relational Database" class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Versi & File PDF</label>
                <div class="flex gap-2">
                    <input type="text" name="versi" value="1.0" class="w-20 px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                    <input type="file" name="file_modul" required class="flex-1 text-xs text-slate-500 file:mr-2 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-800 dark:file:text-slate-300">
                </div>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full py-2.5 px-4 rounded-xl text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition">
                    + Unggah Modul
                </button>
            </div>
        </form>
    </div>

    <!-- Modul Table -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
        <div class="p-5 border-b border-slate-200 dark:border-slate-800">
            <h3 class="text-base font-bold text-slate-900 dark:text-white">Daftar Modul Praktikum Aktif</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/40 text-xs font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-4 px-6">Mata Kuliah & Lab</th>
                        <th class="py-4 px-6">Judul Modul</th>
                        <th class="py-4 px-6">Versi</th>
                        <th class="py-4 px-6">Tanggal Upload</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                    @forelse($modulList as $m)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition">
                            <td class="py-4 px-6">
                                <p class="font-bold text-slate-900 dark:text-white">{{ $m->mataKuliah->nama ?? '-' }}</p>
                                <p class="text-xs text-slate-500">{{ $m->mataKuliah->ruangLab->nama_ruang ?? 'Lab SI' }} (Semester {{ $m->mataKuliah->semester ?? '-' }})</p>
                            </td>
                            <td class="py-4 px-6">
                                <p class="font-semibold text-slate-800 dark:text-slate-200">{{ $m->judul }}</p>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2 py-0.5 rounded-md bg-slate-100 dark:bg-slate-800 text-xs font-mono font-medium text-slate-700 dark:text-slate-300">
                                    v{{ $m->versi }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-xs text-slate-500">
                                {{ $m->created_at ? $m->created_at->format('d M Y, H:i') : '-' }}
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <button type="button"
                                        onclick="bukaModalEditModul({{ json_encode($m) }})"
                                        class="px-2.5 py-1.5 rounded-lg text-xs font-semibold bg-amber-500/10 text-amber-600 hover:bg-amber-500/20 transition">
                                        Edit
                                    </button>
                                    <a href="{{ asset('storage/' . $m->file_path) }}" target="_blank" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700 transition">
                                        Unduh
                                    </a>
                                    <form action="{{ route('admin.modul.destroy', $m) }}" method="POST" onsubmit="return confirm('Hapus modul ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-red-100 hover:bg-red-200 text-red-700 dark:bg-red-900/30 dark:text-red-300 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-sm text-slate-400">
                                Belum ada berkas modul praktikum.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-200 dark:border-slate-800">
            {{ $modulList->links() }}
        </div>
    </div>
</div>

<!-- Modal Edit Modul -->
<div id="modalEditModul" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl max-w-lg w-full border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden">
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
            <h3 class="font-bold text-slate-900 dark:text-white text-sm">Edit Modul Praktikum</h3>
            <button type="button" onclick="document.getElementById('modalEditModul').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>

        <form id="formEditModul" action="" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Mata Kuliah Praktikum</label>
                <select id="edit_modul_mk_id" name="mata_kuliah_id" required class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                    @foreach($mataKuliah as $mk)
                        <option value="{{ $mk->id }}">{{ $mk->nama }} (Sem {{ $mk->semester }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Judul / Nama Modul</label>
                <input type="text" id="edit_modul_judul" name="judul" required class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Versi</label>
                    <input type="text" id="edit_modul_versi" name="versi" class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Ganti Berkas (Opsional)</label>
                    <input type="file" name="file_modul" class="w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-2 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700">
                </div>
            </div>
            <p class="text-[11px] text-slate-400">Biarkan berkas kosong jika hanya memperbarui judul, mata kuliah, atau versi.</p>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="document.getElementById('modalEditModul').classList.add('hidden')"
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
function bukaModalEditModul(modul) {
    const form = document.getElementById('formEditModul');
    form.action = "{{ url('/admin/modul') }}/" + modul.id;
    document.getElementById('edit_modul_mk_id').value = modul.mata_kuliah_id;
    document.getElementById('edit_modul_judul').value = modul.judul || '';
    document.getElementById('edit_modul_versi').value = modul.versi || '1.0';
    document.getElementById('modalEditModul').classList.remove('hidden');
}
</script>
@endsection
