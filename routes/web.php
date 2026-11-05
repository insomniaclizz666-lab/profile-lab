<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Public Routes (Halaman Web Pengunjung)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/fasilitas', [HomeController::class, 'fasilitas'])->name('fasilitas');
Route::get('/inventaris', [HomeController::class, 'fasilitas']);
Route::get('/layanan', [HomeController::class, 'layanan'])->name('layanan');
Route::get('/riset', [HomeController::class, 'riset'])->name('riset');
Route::get('/laboratorium', [HomeController::class, 'laboratorium'])->name('laboratorium');
Route::get('/akademik', [HomeController::class, 'aktifitas'])->name('akademik');
Route::get('/aktifitas', [HomeController::class, 'aktifitas'])->name('aktifitas');
Route::get('/aktivitas', [HomeController::class, 'aktifitas']);
Route::get('/komunitas', [HomeController::class, 'komunitas'])->name('komunitas');

// Forum Komunitas: Post Thread & Vote
Route::post('/komunitas/thread', [HomeController::class, 'storeThread'])->name('komunitas.store');
Route::post('/komunitas/thread/{thread}/vote', [HomeController::class, 'voteThread'])->name('komunitas.vote');

// Formulir Peminjaman Alat/Lab (Akses Publik / User)
Route::post('/peminjaman', [HomeController::class, 'storePeminjaman'])->name('peminjaman.store');

// Registrasi Event / Workshop
Route::post('/events/{event}/daftar', [HomeController::class, 'storeEventRegistration'])->name('events.register');

// Halaman Detail Berita & Pengumuman
Route::get('/berita/{slug}', [HomeController::class, 'detailBerita'])->name('berita.detail');

/*
|--------------------------------------------------------------------------
| Authentication Routes (User, Admin, Superadmin)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Admin & Laboran Panel Routes (Protected by Auth & Role)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'role:admin,superadmin'])->name('admin.')->group(function () {
    // Dashboard Overview (Akses: Laboran & Superadmin)
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Modul Operasional Laboran (Akses: Laboran & Superadmin)
    Route::get('/peminjaman', [AdminDashboardController::class, 'peminjaman'])->name('peminjaman');
    Route::patch('/peminjaman/{peminjaman}/status', [AdminDashboardController::class, 'updateStatusPeminjaman'])->name('peminjaman.updateStatus');

    Route::get('/modul', [AdminDashboardController::class, 'modul'])->name('modul');
    Route::post('/modul', [AdminDashboardController::class, 'storeModul'])->name('modul.store');
    Route::patch('/modul/{modul}', [AdminDashboardController::class, 'updateModul'])->name('modul.update');
    Route::delete('/modul/{modul}', [AdminDashboardController::class, 'destroyModul'])->name('modul.destroy');

    Route::get('/fasilitas', [AdminDashboardController::class, 'fasilitas'])->name('fasilitas');
    Route::post('/fasilitas', [AdminDashboardController::class, 'storeFasilitas'])->name('fasilitas.store');
    Route::patch('/fasilitas/{fasilitas}', [AdminDashboardController::class, 'updateFasilitas'])->name('fasilitas.update');
    Route::delete('/fasilitas/{fasilitas}', [AdminDashboardController::class, 'destroyFasilitas'])->name('fasilitas.destroy');

    // Modul Khusus Super Admin (Akses: Superadmin Only)
    Route::middleware('role:superadmin')->group(function () {
        Route::get('/events', [AdminDashboardController::class, 'events'])->name('events');
        Route::post('/events', [AdminDashboardController::class, 'storeEvent'])->name('events.store');
        Route::patch('/events/{event}', [AdminDashboardController::class, 'updateEvent'])->name('events.update');
        Route::patch('/events/{event}/toggle-reg', [AdminDashboardController::class, 'toggleEventRegistration'])->name('events.toggleReg');
        Route::delete('/events/{event}', [AdminDashboardController::class, 'destroyEvent'])->name('events.destroy');

        Route::get('/komunitas', [AdminDashboardController::class, 'komunitas'])->name('komunitas');
        Route::patch('/komunitas/{thread}/toggle-solve', [AdminDashboardController::class, 'toggleSolveThread'])->name('komunitas.toggleSolve');
        Route::delete('/komunitas/{thread}', [AdminDashboardController::class, 'destroyThread'])->name('komunitas.destroy');

        Route::get('/users', [AdminDashboardController::class, 'users'])->name('users');
        Route::post('/users', [AdminDashboardController::class, 'storeUser'])->name('users.store');
        Route::patch('/users/{user}', [AdminDashboardController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{user}', [AdminDashboardController::class, 'destroyUser'])->name('users.destroy');

        // Manajemen Dosen & Peneliti Riset
        Route::get('/dosen', [AdminDashboardController::class, 'dosen'])->name('dosen');
        Route::post('/dosen', [AdminDashboardController::class, 'storeDosen'])->name('dosen.store');
        Route::patch('/dosen/{dosen}', [AdminDashboardController::class, 'updateDosen'])->name('dosen.update');
        Route::delete('/dosen/{dosen}', [AdminDashboardController::class, 'destroyDosen'])->name('dosen.destroy');

        // Manajemen Profil & Statistik Laboratorium
        Route::get('/profil', [AdminDashboardController::class, 'profil'])->name('profil');
        Route::patch('/profil/{profil}', [AdminDashboardController::class, 'updateProfil'])->name('profil.update');
        Route::patch('/statistik/{stat}', [AdminDashboardController::class, 'updateStatistik'])->name('statistik.update');

        // Manajemen Berita & Pengumuman
        Route::get('/berita', [AdminDashboardController::class, 'berita'])->name('berita');
        Route::post('/berita', [AdminDashboardController::class, 'storeBerita'])->name('berita.store');
        Route::patch('/berita/{berita}', [AdminDashboardController::class, 'updateBerita'])->name('berita.update');
        Route::delete('/berita/{berita}', [AdminDashboardController::class, 'destroyBerita'])->name('berita.destroy');

        // Manajemen Galeri & Testimoni
        Route::get('/galeri-testimoni', [AdminDashboardController::class, 'galeriTestimoni'])->name('galeri-testimoni');
        Route::post('/galeri', [AdminDashboardController::class, 'storeGaleri'])->name('galeri.store');
        Route::patch('/galeri/{galeri}', [AdminDashboardController::class, 'updateGaleri'])->name('galeri.update');
        Route::delete('/galeri/{galeri}', [AdminDashboardController::class, 'destroyGaleri'])->name('galeri.destroy');
        Route::post('/testimoni', [AdminDashboardController::class, 'storeTestimoni'])->name('testimoni.store');
        Route::patch('/testimoni/{testimoni}', [AdminDashboardController::class, 'updateTestimoni'])->name('testimoni.update');
        Route::delete('/testimoni/{testimoni}', [AdminDashboardController::class, 'destroyTestimoni'])->name('testimoni.destroy');
    });
});
