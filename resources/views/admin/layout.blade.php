<!DOCTYPE html>
<html lang="id" class="h-full bg-[#F8FAFC]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Laboratorium Sistem Informasi UTM</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1E3A8A',
                        primaryHover: '#1E40AF',
                        accent: '#F59E0B',
                        accentHover: '#D97706',
                        softBlue: '#EEF5FF',
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        /* Sleek subtle scrollbars */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="h-full text-slate-800 antialiased overflow-hidden">
    <div class="flex h-screen overflow-hidden bg-[#F8FAFC]">
        
        <!-- Sidebar: Tema Navy UTM (#1E3A8A) Senada dengan Header Publik -->
        <aside class="w-64 bg-[#1E3A8A] text-white flex flex-col flex-shrink-0 shadow-xl z-20">
            <!-- Brand Header -->
            <div class="h-20 flex items-center px-6 border-b border-blue-900/60 gap-3 bg-[#172554]">
                <div class="w-10 h-10 rounded-xl bg-white p-0.5 flex items-center justify-center shrink-0 shadow-md">
                    <img src="{{ asset('logo_si_ai.jpg') }}" alt="Logo SI UTM" class="w-full h-full rounded-lg object-cover">
                </div>
                <div class="min-w-0">
                    <h1 class="text-sm font-extrabold text-white tracking-wide truncate">Laboratorium SI</h1>
                    <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-amber-400 text-slate-950 mt-0.5">
                        {{ auth()->user()->role === 'superadmin' ? 'Superadmin' : 'Laboran' }}
                    </span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-3.5 py-5 space-y-1 overflow-y-auto">
                <div class="px-2.5 pb-2 text-[10px] font-bold uppercase tracking-[0.15em] text-blue-200/70">Menu Utama</div>

                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#F59E0B] text-slate-950 shadow-sm font-bold' : 'hover:bg-white/10 text-blue-100 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Overview Ringkasan</span>
                </a>

                <!-- Modul Laboran & Superadmin -->
                <div class="pt-4 px-2.5 pb-2 text-[10px] font-bold uppercase tracking-[0.15em] text-blue-200/70">Operasional Lab</div>

                <a href="{{ route('admin.peminjaman') }}"
                   class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.peminjaman*') ? 'bg-[#F59E0B] text-slate-950 shadow-sm font-bold' : 'hover:bg-white/10 text-blue-100 hover:text-white' }}">
                    <span class="flex items-center gap-3 min-w-0">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        <span class="truncate">Peminjaman Alat & Lab</span>
                    </span>
                    @php $pendingCount = \App\Models\Peminjaman::where('status', 'Pending')->count(); @endphp
                    @if($pendingCount > 0)
                        <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-rose-500 text-white shrink-0">{{ $pendingCount }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.modul') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.modul*') ? 'bg-[#F59E0B] text-slate-950 shadow-sm font-bold' : 'hover:bg-white/10 text-blue-100 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <span>Modul Praktikum</span>
                </a>

                <a href="{{ route('admin.fasilitas') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.fasilitas*') ? 'bg-[#F59E0B] text-slate-950 shadow-sm font-bold' : 'hover:bg-white/10 text-blue-100 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <span>Katalog Fasilitas</span>
                </a>

                <!-- Modul Khusus Superadmin -->
                @if(auth()->user()->role === 'superadmin')
                    <div class="pt-4 px-2.5 pb-2 text-[10px] font-bold uppercase tracking-[0.15em] text-amber-300">Khusus Superadmin</div>

                    <a href="{{ route('admin.events') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.events*') ? 'bg-[#F59E0B] text-slate-950 shadow-sm font-bold' : 'hover:bg-white/10 text-blue-100 hover:text-white' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>Agenda & Event</span>
                    </a>

                    <a href="{{ route('admin.komunitas') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.komunitas*') ? 'bg-[#F59E0B] text-slate-950 shadow-sm font-bold' : 'hover:bg-white/10 text-blue-100 hover:text-white' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
                        <span>Moderasi Forum</span>
                    </a>

                    <a href="{{ route('admin.dosen') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.dosen*') ? 'bg-[#F59E0B] text-slate-950 shadow-sm font-bold' : 'hover:bg-white/10 text-blue-100 hover:text-white' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        <span>Dosen & Peneliti</span>
                    </a>

                    <a href="{{ route('admin.profil') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.profil*') ? 'bg-[#F59E0B] text-slate-950 shadow-sm font-bold' : 'hover:bg-white/10 text-blue-100 hover:text-white' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>Profil & Statistik Lab</span>
                    </a>

                    @if(Route::has('admin.berita'))
                    <a href="{{ route('admin.berita') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.berita*') ? 'bg-[#F59E0B] text-slate-950 shadow-sm font-bold' : 'hover:bg-white/10 text-blue-100 hover:text-white' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        <span>Berita & Pengumuman</span>
                    </a>
                    @endif

                    <a href="{{ route('admin.users') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.users*') ? 'bg-[#F59E0B] text-slate-950 shadow-sm font-bold' : 'hover:bg-white/10 text-blue-100 hover:text-white' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <span>Manajemen User & Role</span>
                    </a>
                @endif
            </nav>

            <!-- Bottom User Profile Card -->
            <div class="p-3.5 border-t border-blue-900/60 bg-[#172554]">
                <div class="flex items-center gap-2.5 mb-2.5">
                    <div class="w-9 h-9 rounded-xl bg-amber-400 text-slate-950 flex items-center justify-center font-extrabold text-sm shrink-0 shadow-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-bold text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-blue-200 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('home') }}" target="_blank"
                       class="flex-1 text-center py-1.5 px-2 text-[11px] font-semibold rounded-lg bg-white/10 hover:bg-white/20 text-white transition">
                        Lihat Web ↗
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="py-1.5 px-3 text-[11px] font-semibold rounded-lg bg-rose-500/20 hover:bg-rose-500 text-rose-200 hover:text-white transition">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area: Single Clean Scrollbar -->
        <main class="flex-1 flex flex-col min-w-0 h-full overflow-y-auto">
            <!-- Topbar Header -->
            <header class="h-16 bg-white border-b border-slate-200/80 px-6 sm:px-8 flex items-center justify-between sticky top-0 z-10 shadow-2xs">
                <div>
                    <h2 class="text-base sm:text-lg font-bold text-[#1E3A8A]">@yield('page_title', 'Dashboard')</h2>
                </div>
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-[#EEF5FF] text-[#1E3A8A] border border-blue-200">
                        ● Role: {{ strtoupper(auth()->user()->role) }}
                    </span>
                    <a href="{{ route('home') }}" class="text-xs font-medium text-slate-500 hover:text-[#1E3A8A] transition flex items-center gap-1">
                        <span>Ke Halaman Depan</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            </header>

            <!-- Page Body Content -->
            <div class="p-6 sm:p-8 flex-1">
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-2xl bg-emerald-50 text-emerald-800 text-xs sm:text-sm font-semibold border border-emerald-200 shadow-2xs flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 rounded-2xl bg-rose-50 text-rose-800 text-xs sm:text-sm font-semibold border border-rose-200 shadow-2xs flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            <span>{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                @yield('admin_content')
            </div>
        </main>
    </div>
</body>
</html>
