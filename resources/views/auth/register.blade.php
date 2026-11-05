@extends('layouts.app')

@section('content')
<div class="min-h-[85vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white dark:bg-slate-900 p-8 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-800">
        <div>
            <div class="flex justify-center">
                <span class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-emerald-600/10 text-emerald-600 dark:text-emerald-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </span>
            </div>
            <h2 class="mt-4 text-center text-3xl font-extrabold text-slate-900 dark:text-white">
                Daftar Akun Baru
            </h2>
            <p class="mt-2 text-center text-sm text-slate-600 dark:text-slate-400">
                Buat akun untuk mengajukan peminjaman, registrasi event, & diskusi forum
            </p>
        </div>

        <form class="mt-8 space-y-4" action="{{ route('register') }}" method="POST">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Nama Lengkap</label>
                <input id="name" name="name" type="text" required value="{{ old('name') }}"
                    class="mt-1 block w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    placeholder="Contoh: Budi Santoso">
                @error('name')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="nim_nip" class="block text-sm font-medium text-slate-700 dark:text-slate-300">NIM / NIP</label>
                    <input id="nim_nip" name="nim_nip" type="text" required value="{{ old('nim_nip') }}"
                        class="mt-1 block w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        placeholder="220441100xxx">
                    @error('nim_nip')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="no_telp" class="block text-sm font-medium text-slate-700 dark:text-slate-300">No. WhatsApp</label>
                    <input id="no_telp" name="no_telp" type="text" value="{{ old('no_telp') }}"
                        class="mt-1 block w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        placeholder="08xxxxxxxxxx">
                    @error('no_telp')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Email Kampus / Pribadi</label>
                <input id="email" name="email" type="email" required value="{{ old('email') }}"
                    class="mt-1 block w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    placeholder="nama@student.trunojoyo.ac.id">
                @error('email')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Kata Sandi</label>
                    <input id="password" name="password" type="password" required
                        class="mt-1 block w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        placeholder="Min. 8 karakter">
                    @error('password')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Konfirmasi Sandi</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="mt-1 block w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        placeholder="Ulangi sandi">
                </div>
            </div>

            <div class="pt-2">
                <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-md text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition">
                    Daftar Sekarang
                </button>
            </div>
        </form>

        <div class="pt-4 border-t border-slate-200 dark:border-slate-800 text-center text-sm text-slate-600 dark:text-slate-400">
            Sudah memiliki akun?
            <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500 underline ml-1">
                Masuk di sini
            </a>
        </div>
    </div>
</div>
@endsection

