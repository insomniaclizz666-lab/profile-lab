@extends('admin.layout')

@section('title', 'Manajemen Pengguna')
@section('page_title', 'Kelola Akun & Hak Akses Aktor (Superadmin Only)')

@section('admin_content')
<div class="space-y-6">
    <!-- Form Tambah User Admin / Laboran -->
    <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
        <h3 class="text-base font-bold text-slate-900 dark:text-white mb-4">Tambah Akun Baru</h3>
        <form action="{{ route('admin.users.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Nama Lengkap</label>
                <input type="text" name="name" required placeholder="Nama" class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">NIM / NIP</label>
                <input type="text" name="nim_nip" required placeholder="1987... / 2204..." class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Email</label>
                <input type="email" name="email" required placeholder="email@utm.ac.id" class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Role Aktor</label>
                <select name="role" required class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                    <option value="user">User (Mahasiswa / Umum)</option>
                    <option value="admin">Admin / Laboran</option>
                    <option value="superadmin">Super Admin</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Kata Sandi</label>
                <div class="flex gap-2">
                    <input type="password" name="password" required placeholder="Min 8 Karakter" class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                    <button type="submit" class="py-2 px-3 rounded-xl text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 transition">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- User Table -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
        <div class="p-5 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
            <h3 class="text-base font-bold text-slate-900 dark:text-white">Daftar Pengguna Sistem</h3>
            <div class="flex gap-2">
                <a href="{{ route('admin.users') }}" class="px-2.5 py-1 text-xs rounded-lg {{ !request('role') ? 'bg-blue-600 text-white font-semibold' : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300' }}">Semua</a>
                <a href="{{ route('admin.users', ['role' => 'superadmin']) }}" class="px-2.5 py-1 text-xs rounded-lg {{ request('role') === 'superadmin' ? 'bg-blue-600 text-white font-semibold' : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300' }}">Superadmin</a>
                <a href="{{ route('admin.users', ['role' => 'admin']) }}" class="px-2.5 py-1 text-xs rounded-lg {{ request('role') === 'admin' ? 'bg-blue-600 text-white font-semibold' : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300' }}">Admin / Laboran</a>
                <a href="{{ route('admin.users', ['role' => 'user']) }}" class="px-2.5 py-1 text-xs rounded-lg {{ request('role') === 'user' ? 'bg-blue-600 text-white font-semibold' : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300' }}">User Biasa</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/40 text-xs font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-4 px-6">Nama & Email</th>
                        <th class="py-4 px-6">NIM / NIP</th>
                        <th class="py-4 px-6">Role</th>
                        <th class="py-4 px-6">Bergabung</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                    @foreach($users as $u)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition">
                            <td class="py-4 px-6">
                                <p class="font-bold text-slate-900 dark:text-white">{{ $u->name }}</p>
                                <p class="text-xs text-slate-500">{{ $u->email }}</p>
                            </td>
                            <td class="py-4 px-6 font-mono text-xs text-slate-600 dark:text-slate-400">
                                {{ $u->nim_nip ?? '-' }}
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 text-xs font-bold rounded-lg uppercase
                                    {{ $u->role === 'superadmin' ? 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300' : '' }}
                                    {{ $u->role === 'admin' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300' : '' }}
                                    {{ $u->role === 'user' ? 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300' : '' }}">
                                    {{ $u->role }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-xs text-slate-500">
                                {{ $u->created_at ? $u->created_at->format('d M Y') : '-' }}
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <button type="button"
                                        onclick="bukaModalEditUser({{ json_encode($u) }})"
                                        class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-amber-500/10 text-amber-600 hover:bg-amber-500/20 transition">
                                        Edit
                                    </button>
                                    @if($u->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $u) }}" method="POST" onsubmit="return confirm('Hapus akun ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-red-100 hover:bg-red-200 text-red-700 dark:bg-red-900/30 dark:text-red-300 transition">
                                                Hapus
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs text-slate-400 italic px-2">Akun Anda</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-200 dark:border-slate-800">
            {{ $users->links() }}
        </div>
    </div>
</div>

<!-- Modal Edit User -->
<div id="modalEditUser" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl max-w-lg w-full border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden">
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
            <h3 class="font-bold text-slate-900 dark:text-white text-sm">Edit Data Pengguna</h3>
            <button type="button" onclick="document.getElementById('modalEditUser').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>

        <form id="formEditUser" action="" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Nama Lengkap</label>
                <input type="text" id="edit_user_name" name="name" required class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">NIM / NIP</label>
                    <input type="text" id="edit_user_nim_nip" name="nim_nip" required class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Role Aktor</label>
                    <select id="edit_user_role" name="role" required class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                        <option value="user">User (Mahasiswa / Umum)</option>
                        <option value="admin">Admin / Laboran</option>
                        <option value="superadmin">Super Admin</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Email</label>
                <input type="email" id="edit_user_email" name="email" required class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Ganti Password (Opsional)</label>
                <input type="password" name="password" placeholder="Biarkan kosong jika tidak diubah" class="w-full px-3 py-2 text-sm rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                <p class="text-[11px] text-slate-400 mt-1">Minimal 8 karakter jika ingin mengganti.</p>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="document.getElementById('modalEditUser').classList.add('hidden')"
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
function bukaModalEditUser(user) {
    const form = document.getElementById('formEditUser');
    form.action = "{{ url('/admin/users') }}/" + user.id;
    document.getElementById('edit_user_name').value = user.name || '';
    document.getElementById('edit_user_nim_nip').value = user.nim_nip || '';
    document.getElementById('edit_user_email').value = user.email || '';
    document.getElementById('edit_user_role').value = user.role || 'user';
    document.getElementById('modalEditUser').classList.remove('hidden');
}
</script>
@endsection
