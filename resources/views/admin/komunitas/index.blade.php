@extends('admin.layout')

@section('title', 'Moderasi Komunitas')
@section('page_title', 'Moderasi Forum & Diskusi Mahasiswa (Superadmin)')

@section('admin_content')
<div class="space-y-6">
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
        <div class="p-5 border-b border-slate-200 dark:border-slate-800">
            <h3 class="text-base font-bold text-slate-900 dark:text-white">Daftar Diskusi Komunitas</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/40 text-xs font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-4 px-6">Topik Diskusi</th>
                        <th class="py-4 px-6">Penulis</th>
                        <th class="py-4 px-6">Status Solved</th>
                        <th class="py-4 px-6">Votes / Views</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                    @forelse($threads as $t)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition">
                            <td class="py-4 px-6 max-w-md">
                                <span class="text-[11px] font-semibold px-2 py-0.5 rounded-md bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300">
                                    {{ $t->kategori }}
                                </span>
                                <p class="font-bold text-slate-900 dark:text-white mt-1">{{ $t->judul }}</p>
                                <p class="text-xs text-slate-500 truncate mt-0.5">{{ $t->body }}</p>
                            </td>
                            <td class="py-4 px-6 text-xs text-slate-600 dark:text-slate-400">
                                <p class="font-semibold text-slate-800 dark:text-slate-200">{{ $t->author_nama }}</p>
                                <p>{{ $t->author_role }}</p>
                            </td>
                            <td class="py-4 px-6">
                                <form action="{{ route('admin.komunitas.toggleSolve', $t) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-2.5 py-1 text-xs font-bold rounded-lg transition {{ $t->is_solved ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                                        {{ $t->is_solved ? '✓ Solved' : '○ Unsolved' }}
                                    </button>
                                </form>
                            </td>
                            <td class="py-4 px-6 text-xs text-slate-500">
                                {{ $t->votes_count }} Votes • {{ $t->views_count }} Views
                            </td>
                            <td class="py-4 px-6 text-right">
                                <form action="{{ route('admin.komunitas.destroy', $t) }}" method="POST" onsubmit="return confirm('Hapus topik ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-red-100 hover:bg-red-200 text-red-700 dark:bg-red-900/30 dark:text-red-300 transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-sm text-slate-400">
                                Belum ada topik diskusi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-200 dark:border-slate-800">
            {{ $threads->links() }}
        </div>
    </div>
</div>
@endsection

