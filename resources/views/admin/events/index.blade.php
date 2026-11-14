@extends('admin.layout')

@section('title', 'Kelola Agenda & Event')
@section('page_title', 'Kelola Agenda, Workshop & Praktikum (Superadmin)')

@section('admin_content')
<div class="space-y-6">
    <!-- Form Tambah Event Baru -->
    <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
        <h3 class="text-base font-bold text-slate-900 dark:text-white mb-4">Buat Agenda / Pelatihan Baru</h3>
        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            @csrf
            <div class="sm:col-span-2">
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Judul Agenda</label>
                <input type="text" name="judul" required placeholder="Contoh: Workshop Cloud Architecture" class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Kategori</label>
                <select name="kategori" required class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                    <option value="Workshop">Workshop</option>
                    <option value="Praktikum">Praktikum</option>
                    <option value="Sharing Session">Sharing Session</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Kuota Peserta</label>
                <input type="number" name="kuota_total" value="50" required class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Tanggal</label>
                <input type="date" name="tanggal" required class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Lokasi</label>
                <input type="text" name="lokasi" value="Laboratorium SI UTM" required class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Nama Mentor</label>
                <input type="text" name="mentor_nama" placeholder="Nama Narasumber" class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Poster / Banner (Opsional)</label>
                <input type="file" name="thumbnail" accept="image/*" class="w-full px-3 py-1.5 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
            <div class="sm:col-span-2 md:col-span-4 flex justify-end">
                <button type="submit" class="py-2.5 px-6 rounded-xl text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition shadow-sm">
                    + Simpan Event
                </button>
            </div>
        </form>
    </div>

    <!-- Table Events -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
        <div class="p-5 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
            <h3 class="text-base font-bold text-slate-900 dark:text-white">Daftar Agenda & Pelatihan</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/40 text-xs font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-4 px-6">Event & Kategori</th>
                        <th class="py-4 px-6">Tanggal & Waktu</th>
                        <th class="py-4 px-6">Lokasi</th>
                        <th class="py-4 px-6">Pendaftar / Kuota</th>
                        <th class="py-4 px-6">Status Registrasi</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                    @forelse($events as $e)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-14 h-14 rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex-shrink-0 flex items-center justify-center">
                                        @if($e->thumbnail_path)
                                            <img src="{{ str_starts_with($e->thumbnail_path, 'http') ? $e->thumbnail_path : asset('storage/' . $e->thumbnail_path) }}" alt="{{ $e->judul }}" class="w-full h-full object-cover" onerror="this.onerror=null; this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');">
                                            <svg class="w-6 h-6 text-slate-400 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        @else
                                            <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        @endif
                                    </div>
                                    <div>
                                        <span class="text-[11px] font-semibold px-2 py-0.5 rounded-md bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300">
                                            {{ $e->kategori }}
                                        </span>
                                        <p class="font-bold text-slate-900 dark:text-white mt-1">{{ $e->judul }}</p>
                                        <p class="text-xs text-slate-500">Mentor: {{ $e->mentor_nama ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-xs text-slate-600 dark:text-slate-400">
                                <p class="font-semibold text-slate-800 dark:text-slate-200">{{ \Carbon\Carbon::parse($e->tanggal)->format('d F Y') }}</p>
                                <p>{{ $e->jam_mulai ? substr($e->jam_mulai, 0, 5) : '08:00' }} - {{ $e->jam_selesai ? substr($e->jam_selesai, 0, 5) : 'Selesai' }} WIB</p>
                            </td>
                            <td class="py-4 px-6 text-xs text-slate-600 dark:text-slate-400">
                                {{ $e->lokasi }}
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2">
                                    <div>
                                        <span class="font-bold text-slate-900 dark:text-white">{{ $e->registrations_count }}</span>
                                        <span class="text-xs text-slate-400">/ {{ $e->kuota_total }}</span>
                                    </div>
                                    @if($e->registrations_count > 0)
                                        <button type="button" onclick="bukaModalPeserta({{ $e->id }}, '{{ addslashes($e->judul) }}', {{ json_encode($e->registrations) }})"
                                            class="px-2 py-0.5 rounded text-[10px] font-semibold bg-blue-50 text-blue-700 hover:bg-blue-100 dark:bg-blue-900/30 dark:text-blue-300 transition">
                                            Peserta ({{ $e->registrations_count }})
                                        </button>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <form action="{{ route('admin.events.toggleReg', $e) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-2.5 py-1 text-xs font-bold rounded-lg transition {{ $e->status_registrasi === 'Open' ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }}">
                                        {{ $e->status_registrasi }}
                                    </button>
                                </form>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <button type="button"
                                        onclick="bukaModalEditEvent({{ json_encode($e) }})"
                                        class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-amber-500/10 text-amber-600 hover:bg-amber-500/20 transition">
                                        Edit
                                    </button>
                                    <form action="{{ route('admin.events.destroy', $e) }}" method="POST" onsubmit="return confirm('Hapus agenda ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-red-100 hover:bg-red-200 text-red-700 dark:bg-red-900/30 dark:text-red-300 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-sm text-slate-400">
                                Belum ada agenda yang tersimpan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-200 dark:border-slate-800">
            {{ $events->links() }}
        </div>
    </div>
</div>

<!-- Modal Edit Event -->
<div id="modalEditEvent" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl max-w-lg w-full border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden">
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
            <h3 class="font-bold text-slate-900 dark:text-white text-sm">Edit Data Agenda / Event</h3>
            <button type="button" onclick="document.getElementById('modalEditEvent').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>

        <form id="formEditEvent" action="" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Judul Agenda</label>
                <input type="text" id="edit_event_judul" name="judul" required class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Kategori</label>
                    <select id="edit_event_kategori" name="kategori" required class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                        <option value="Workshop">Workshop</option>
                        <option value="Praktikum">Praktikum</option>
                        <option value="Sharing Session">Sharing Session</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Kuota Peserta</label>
                    <input type="number" id="edit_event_kuota" name="kuota_total" required class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Tanggal</label>
                    <input type="date" id="edit_event_tanggal" name="tanggal" required class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Lokasi</label>
                    <input type="text" id="edit_event_lokasi" name="lokasi" required class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Nama Mentor</label>
                <input type="text" id="edit_event_mentor" name="mentor_nama" class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Status Registrasi</label>
                    <select id="edit_event_status_reg" name="status_registrasi" required class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                        <option value="Open">Open</option>
                        <option value="Closed">Closed</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Status Pelaksanaan</label>
                    <select id="edit_event_status" name="status" required class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                        <option value="Akan Datang">Akan Datang</option>
                        <option value="Berlangsung">Berlangsung</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Poster / Banner Agenda</label>
                <div id="edit_event_thumbnail_preview" class="mb-2 hidden">
                    <img id="edit_event_thumbnail_img" src="" alt="Thumbnail" class="w-32 h-20 object-cover rounded-xl border border-slate-200 dark:border-slate-700">
                </div>
                <input type="file" name="thumbnail" accept="image/*" class="w-full px-3 py-1.5 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <p class="text-[11px] text-slate-400 mt-1">Kosongkan jika tidak ingin mengubah poster/banner.</p>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="document.getElementById('modalEditEvent').classList.add('hidden')"
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

<!-- Modal Daftar Peserta Event -->
<div id="modalPeserta" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl max-w-2xl w-full border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden flex flex-col max-h-[85vh]">
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
            <div>
                <h3 class="font-bold text-slate-900 dark:text-white text-sm">Daftar Peserta Terdaftar</h3>
                <p id="modalPesertaSubtitle" class="text-xs text-slate-500 mt-0.5 truncate max-w-md">-</p>
            </div>
            <button type="button" onclick="document.getElementById('modalPeserta').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>

        <div class="p-6 overflow-y-auto flex-1">
            <table class="w-full text-left text-xs text-slate-600 dark:text-slate-300">
                <thead class="bg-slate-50 dark:bg-slate-800/60 text-slate-700 dark:text-slate-200 uppercase text-[10px] font-bold border-b border-slate-200 dark:border-slate-800">
                    <tr>
                        <th class="py-2.5 px-3">No</th>
                        <th class="py-2.5 px-3">Nama Mahasiswa</th>
                        <th class="py-2.5 px-3">NIM</th>
                        <th class="py-2.5 px-3">Email</th>
                        <th class="py-2.5 px-3">Angkatan</th>
                        <th class="py-2.5 px-3">Tgl Daftar</th>
                    </tr>
                </thead>
                <tbody id="modalPesertaBody" class="divide-y divide-slate-100 dark:divide-slate-800">
                    <!-- Populated dynamically via JS -->
                </tbody>
            </table>
        </div>
        <div class="px-6 py-3 bg-slate-50 dark:bg-slate-800/30 border-t border-slate-100 dark:border-slate-800 flex justify-end">
            <button type="button" onclick="document.getElementById('modalPeserta').classList.add('hidden')"
                class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-200 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-300 transition">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
function bukaModalEditEvent(event) {
    const form = document.getElementById('formEditEvent');
    form.action = "{{ url('/admin/events') }}/" + event.id;
    document.getElementById('edit_event_judul').value = event.judul || '';
    document.getElementById('edit_event_kategori').value = event.kategori || 'Workshop';
    document.getElementById('edit_event_kuota').value = event.kuota_total || 50;
    
    // Format date YYYY-MM-DD
    let tgl = '';
    if (event.tanggal) {
        tgl = event.tanggal.substring(0, 10);
    }
    document.getElementById('edit_event_tanggal').value = tgl;
    document.getElementById('edit_event_lokasi').value = event.lokasi || '';
    document.getElementById('edit_event_mentor').value = event.mentor_nama || '';
    document.getElementById('edit_event_status_reg').value = event.status_registrasi || 'Open';
    document.getElementById('edit_event_status').value = event.status || 'Akan Datang';

    const previewBox = document.getElementById('edit_event_thumbnail_preview');
    const previewImg = document.getElementById('edit_event_thumbnail_img');
    if (event.thumbnail_path) {
        previewImg.src = event.thumbnail_path.startsWith('http') ? event.thumbnail_path : "{{ asset('storage') }}/" + event.thumbnail_path;
        previewBox.classList.remove('hidden');
    } else {
        previewBox.classList.add('hidden');
    }

    document.getElementById('modalEditEvent').classList.remove('hidden');
}

function bukaModalPeserta(eventId, judul, registrations) {
    document.getElementById('modalPesertaSubtitle').textContent = judul;
    const tbody = document.getElementById('modalPesertaBody');
    tbody.innerHTML = '';

    if (!registrations || registrations.length === 0) {
        tbody.innerHTML = '<tr><td colspan="6" class="py-6 text-center text-slate-400">Belum ada peserta yang mendaftar.</td></tr>';
    } else {
        registrations.forEach((r, idx) => {
            const tr = document.createElement('tr');
            tr.className = 'hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition';
            const tgl = r.created_at ? new Date(r.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }) : '-';
            tr.innerHTML = `
                <td class="py-2.5 px-3 font-semibold text-slate-500">${idx + 1}</td>
                <td class="py-2.5 px-3 font-bold text-slate-900 dark:text-white">${escapeHtml(r.nama || '-')}</td>
                <td class="py-2.5 px-3 font-mono text-[11px]">${escapeHtml(r.nim || '-')}</td>
                <td class="py-2.5 px-3">${escapeHtml(r.email || '-')}</td>
                <td class="py-2.5 px-3">${escapeHtml(r.angkatan || '-')}</td>
                <td class="py-2.5 px-3 text-[11px] text-slate-400">${tgl}</td>
            `;
            tbody.appendChild(tr);
        });
    }

    document.getElementById('modalPeserta').classList.remove('hidden');
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}
</script>
@endsection
