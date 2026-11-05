    <!-- 1. HEADER & NAVIGASI (Sticky with Role-Based Access Preparation) -->
    <header class="sticky top-0 z-40 bg-white backdrop-blur-md border-b border-slate-200/80 transition-all duration-200 shadow-sm">
        <div class=" mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Logo & Brand Identity -->
                <a href="{{ route('home') }}#beranda" class="flex items-center gap-5 group">
                    <div class="w-11 h-11 rounded-xl bg-linear-to-tr from-[#1E3A8A] to-[#2563EB] flex items-center justify-center text-white shadow-md shadow-blue-900/20">
                        <img src="{{ asset('logo_si_ai.jpg') }}" alt="Logo SI UTM" class="rounded-lg object-cover">
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-xl font-bold tracking-tight text-[#1E3A8A] transition-colors">Laboratorium SI</span>
                        </div>
                        <p class="text-xs text-slate-500 font-normal">Sistem Informasi • Universitas Trunojoyo Madura</p>
                    </div>
                </a>

                <!-- Desktop Navigation Menu -->
                <nav class="hidden md:flex gap-7 text-md font-medium">
                    <a href="{{ route('home') }}" class="text-slate-600 hover:text-[#1E3A8A] transition-colors">Home</a>
                    <a href="{{ route('fasilitas') }}" class="text-slate-600 hover:text-[#1E3A8A] transition-colors">Fasilitas</a>
                    <a href="{{ route('layanan') }}" class="text-slate-600 hover:text-[#1E3A8A] transition-colors">Layanan</a>
                    <a href="{{ route('riset') }}" class="text-slate-600 hover:text-[#1E3A8A] transition-colors">Riset</a>
                    <a href="{{ route('akademik') }}" class="text-slate-600 hover:text-[#1E3A8A] transition-colors">Aktifitas</a>
                    <a href="{{ route('komunitas') }}" class="text-slate-600 hover:text-[#1E3A8A] transition-colors">Komunitas</a>
                </nav>

                <!-- Action Button: Login Sistem / User Profile -->
                <div class="hidden md:flex items-center gap-3">
                    @auth
                        <div class="flex items-center gap-2 bg-[#EEF5FF] border border-blue-200/70 py-1 px-2.5 rounded-full shadow-2xs">
                            <div class="w-7 h-7 rounded-full bg-[#1E3A8A] text-white flex items-center justify-center font-bold text-xs shrink-0">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="flex flex-col text-left pr-1">
                                <span class="text-xs font-bold text-[#1E3A8A] leading-tight truncate max-w-[120px]">{{ auth()->user()->name }}</span>
                                <span class="text-[10px] text-[#D97706] font-semibold capitalize">{{ auth()->user()->role === 'superadmin' ? 'Superadmin' : (auth()->user()->role === 'admin' ? 'Laboran' : 'Mahasiswa') }}</span>
                            </div>

                            @if(in_array(auth()->user()->role, ['admin', 'superadmin']))
                                <a href="{{ route('admin.dashboard') }}" title="Ke Panel Dashboard Laboran/Superadmin"
                                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-[#1E3A8A] hover:bg-[#1E40AF] text-white text-xs font-semibold shadow-xs transition active:scale-95">
                                    <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                                    <span>Panel {{ auth()->user()->role === 'superadmin' ? 'Super' : 'Lab' }}</span>
                                </a>
                            @endif

                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" title="Keluar Akun" class="p-1 rounded-full text-slate-400 hover:text-rose-600 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-[#1E3A8A] hover:bg-[#1E40AF] text-white font-semibold text-xs sm:text-sm px-4 py-2 rounded-xl shadow-xs transition active:scale-95">
                            <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            <span>Login Pengelola</span>
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex md:hidden">
                    <button type="button" onclick="toggleMobileMenu()" class="p-2 rounded-lg text-slate-600 hover:text-[#1E3A8A] hover:bg-lightbg focus:outline-none" aria-label="Buka Menu">
                        <svg id="hamburgerIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg id="closeIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation Drawer -->
            <div id="mobileMenu" class="hidden md:hidden pb-6 pt-2 border-t border-slate-100">
                <div class="flex flex-col space-y-3 font-medium text-sm">
                    <a href="{{ route('home') }}" onclick="toggleMobileMenu()" class="text-slate-600 hover:text-[#1E3A8A] py-1">Home</a>
                    <a href="{{ route('fasilitas')}}" onclick="toggleMobileMenu()" class="text-slate-600 hover:text-[#1E3A8A] py-1">Fasilitas</a>
                    <a href="{{ route('layanan')}}" onclick="toggleMobileMenu()" class="text-slate-600 hover:text-[#1E3A8A] py-1">Layanan</a>
                    <a href="{{ route('riset') }}" onclick="toggleMobileMenu()" class="text-slate-600 hover:text-[#1E3A8A] py-1">Riset</a>
                    <a href="{{ route('akademik') }}" onclick="toggleMobileMenu()" class="text-slate-600 hover:text-[#1E3A8A] py-1">Aktifitas</a>
                    <a href="{{ route('komunitas') }}" onclick="toggleMobileMenu()" class="text-slate-600 hover:text-[#1E3A8A] py-1">Komunitas</a>

                    @auth
                        <div class="pt-3 mt-1 border-t border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-[#1E3A8A] text-white text-xs font-bold flex items-center justify-center">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span class="text-xs font-bold text-slate-800">{{ auth()->user()->name }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                @if(in_array(auth()->user()->role, ['admin', 'superadmin']))
                                    <a href="{{ route('admin.dashboard') }}" class="text-xs px-3 py-1.5 bg-[#1E3A8A] text-white rounded-lg font-semibold">Panel Admin</a>
                                @endif
                                <form action="{{ route('logout') }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-xs text-rose-600 font-semibold px-2 py-1">Keluar</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" onclick="toggleMobileMenu()" class="w-full mt-2 inline-flex items-center justify-center gap-2 bg-[#1E3A8A] hover:bg-[#1E40AF] text-white font-semibold py-2.5 rounded-xl shadow-sm text-xs">
                            <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            <span>Login Pengelola Lab</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>
