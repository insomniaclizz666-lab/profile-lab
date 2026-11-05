@extends('layouts.app')

@section('content')
<main class="w-full min-h-[85vh] bg-gradient-to-b from-blue-50/50 via-white to-white flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white p-8 sm:p-10 rounded-3xl shadow-xl border border-blue-100 relative overflow-hidden">
        
        <!-- Header Branding -->
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-[#EEF5FF] border border-blue-200/80 text-[#1E3A8A] mb-4 shadow-xs">
                <img src="{{ asset('logo_si_ai.jpg') }}" alt="Logo SI UTM" class="w-12 h-12 rounded-xl object-cover">
            </div>
            <span class="inline-block text-[11px] font-bold uppercase tracking-[0.2em] text-[#D97706] mb-1">
                Portal Laboratorium
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#1E3A8A] tracking-tight">
                Login Pengelola
            </h1>
            <p class="mt-2 text-xs sm:text-sm text-slate-500 leading-relaxed max-w-xs mx-auto">
                Khusus laboran dan superadmin untuk operasional inventaris, modul, dan agenda lab.
            </p>
        </div>

        @if(session('error'))
            <div class="mt-6 p-4 rounded-2xl bg-rose-50 text-rose-700 text-xs font-semibold border border-rose-200 flex items-center gap-2">
                <svg class="w-4 h-4 shrink-0 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <form class="mt-6 space-y-4" action="{{ route('login') }}" method="POST">
            @csrf

            <div>
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Email Pengelola <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                    </span>
                    <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                        class="w-full pl-10 pr-4 py-2.5 text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-[#1E3A8A] focus:border-[#1E3A8A] transition text-slate-800 placeholder-slate-400"
                        placeholder="laboran@utm.ac.id">
                </div>
                @error('email')
                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Kata Sandi <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </span>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="w-full pl-10 pr-4 py-2.5 text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-[#1E3A8A] focus:border-[#1E3A8A] transition text-slate-800 placeholder-slate-400"
                        placeholder="••••••••">
                </div>
                @error('password')
                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between text-xs pt-1">
                <label class="flex items-center gap-2 cursor-pointer select-none">
                    <input id="remember" name="remember" type="checkbox"
                        class="w-4 h-4 rounded text-[#1E3A8A] focus:ring-[#1E3A8A] border-slate-300 cursor-pointer">
                    <span class="text-slate-600">Ingat sesi saya</span>
                </label>
                <span class="text-[11px] text-slate-400">Hubungi Superadmin jika lupa akun</span>
            </div>

            <div class="pt-2">
                <button type="submit"
                    class="w-full py-3 px-4 rounded-xl text-xs sm:text-sm font-bold text-white bg-[#1E3A8A] hover:bg-[#1E40AF] shadow-md shadow-blue-900/20 hover:shadow-lg transition-all active:scale-[0.98]">
                    Masuk ke Dashboard
                </button>
            </div>
        </form>

        <!-- Information for regular students / guests -->
        <div class="mt-6 pt-5 border-t border-slate-100 text-center">
            <div class="bg-[#EEF5FF] rounded-2xl p-3.5 border border-blue-100 text-left">
                <p class="text-xs font-bold text-[#1E3A8A] flex items-center gap-1.5 mb-1">
                    <svg class="w-4 h-4 text-[#D97706]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Informasi Mahasiswa & Umum</span>
                </p>
                <p class="text-[11px] text-slate-600 leading-relaxed">
                    Peminjaman alat, pendaftaran workshop, dan unduh modul tidak memerlukan login. Cukup lengkapi data kontak pada formulir di menu masing-masing.
                </p>
            </div>
        </div>

    </div>
</main>
@endsection
