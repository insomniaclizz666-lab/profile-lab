<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\ModulPraktikum;
use App\Models\MataKuliahPraktikum;
use App\Models\RuangLab;
use App\Models\Fasilitas;
use App\Models\Event;
use App\Models\Thread;
use App\Models\PengajuanLayanan;
use App\Models\Dosen;
use App\Models\StatistikUmum;
use App\Models\ProfilLaboratorium;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminDashboardController extends Controller
{
    /**
     * Tampilan utama dashboard overview.
     */
    public function index(): View
    {
        $stats = [
            'pending_peminjaman' => Peminjaman::where('status', 'Pending')->count(),
            'total_peminjaman'   => Peminjaman::count(),
            'total_modul'        => ModulPraktikum::count(),
            'total_events'       => Event::count(),
            'total_threads'      => Thread::count(),
            'pending_pengajuan'  => PengajuanLayanan::where('status', 'pending')->count(),
            'total_users'        => User::count(),
            'total_fasilitas'    => Fasilitas::count(),
        ];

        $recentPeminjaman = Peminjaman::with('user', 'fasilitas')->latest()->take(5)->get();
        $upcomingEvents   = Event::where('status', 'Akan Datang')->orderBy('tanggal')->take(4)->get();
        $recentThreads    = Thread::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentPeminjaman', 'upcomingEvents', 'recentThreads'));
    }

    /**
     * MODUL PEMINJAMAN (Kelola peminjaman alat & ruang - Laboran & Superadmin).
     */
    public function peminjaman(Request $request): View
    {
        $query = Peminjaman::with('user', 'fasilitas')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $peminjaman = $query->paginate(15);
        return view('admin.peminjaman.index', compact('peminjaman'));
    }

    public function updateStatusPeminjaman(Request $request, Peminjaman $peminjaman): RedirectResponse
    {
        $validated = $request->validate([
            'status'          => 'required|in:Pending,Disetujui,Ditolak,Selesai',
            'catatan_laboran' => 'nullable|string',
        ]);

        $peminjaman->update($validated);

        return back()->with('success', 'Status peminjaman berhasil diperbarui.');
    }

    /**
     * MODUL MODUL PRAKTIKUM (Kelola berkas modul praktikum - Laboran & Superadmin).
     */
    public function modul(): View
    {
        $modulList = ModulPraktikum::with('mataKuliah.ruangLab')->latest()->paginate(15);
        $mataKuliah = MataKuliahPraktikum::all();

        return view('admin.modul.index', compact('modulList', 'mataKuliah'));
    }

    public function storeModul(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliah_praktikum,id',
            'judul'          => 'required|string|max:255',
            'versi'          => 'nullable|string|max:20',
            'file_modul'     => 'required|file|mimes:pdf,zip,rar,doc,docx|max:20480', // max 20MB
        ]);

        $filePath = $request->file('file_modul')->store('modul_praktikum', 'public');

        ModulPraktikum::create([
            'mata_kuliah_id' => $validated['mata_kuliah_id'],
            'judul'          => $validated['judul'],
            'versi'          => $validated['versi'] ?? '1.0',
            'file_path'      => $filePath,
            'published_at'   => now(),
        ]);

        return back()->with('success', 'Modul praktikum berhasil diunggah.');
    }

    public function destroyModul(ModulPraktikum $modul): RedirectResponse
    {
        if ($modul->file_path && Storage::disk('public')->exists($modul->file_path)) {
            Storage::disk('public')->delete($modul->file_path);
        }
        $modul->delete();

        return back()->with('success', 'Modul praktikum berhasil dihapus.');
    }

    public function updateModul(Request $request, ModulPraktikum $modul): RedirectResponse
    {
        $validated = $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliah_praktikum,id',
            'judul'          => 'required|string|max:255',
            'versi'          => 'nullable|string|max:20',
            'file_modul'     => 'nullable|file|mimes:pdf,zip,rar,doc,docx|max:20480',
        ]);

        if ($request->hasFile('file_modul')) {
            if ($modul->file_path && Storage::disk('public')->exists($modul->file_path)) {
                Storage::disk('public')->delete($modul->file_path);
            }
            $modul->file_path = $request->file('file_modul')->store('modul_praktikum', 'public');
        }

        $modul->mata_kuliah_id = $validated['mata_kuliah_id'];
        $modul->judul          = $validated['judul'];
        $modul->versi          = $validated['versi'] ?? $modul->versi;
        $modul->save();

        return back()->with('success', 'Modul praktikum berhasil diperbarui.');
    }

    /**
     * MODUL FASILITAS (Laboran & Superadmin).
     */
    public function fasilitas(): View
    {
        $fasilitas = Fasilitas::orderBy('urutan')->get();
        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    public function storeFasilitas(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul'               => 'required|string|max:255',
            'kategori'            => 'required|string|max:100',
            'status_ketersediaan' => 'required|in:Tersedia,Dalam Perawatan,Dipinjam',
            'deskripsi_singkat'   => 'nullable|string',
            'sasaran'             => 'required|string|max:50',
            'cakupan'             => 'nullable|string',
            'urutan'              => 'nullable|integer',
        ]);

        $slug = \Illuminate\Support\Str::slug($validated['judul']) . '-' . rand(100, 999);
        $cakupan = null;
        if (!empty($validated['cakupan'])) {
            $cakupan = array_filter(array_map('trim', preg_split('/[\r\n,]+/', $validated['cakupan'])));
        }

        Fasilitas::create([
            'judul'               => $validated['judul'],
            'slug'                => $slug,
            'kategori'            => $validated['kategori'],
            'status_ketersediaan' => $validated['status_ketersediaan'],
            'deskripsi_singkat'   => $validated['deskripsi_singkat'],
            'sasaran'             => $validated['sasaran'],
            'cakupan'             => $cakupan,
            'urutan'              => $validated['urutan'] ?? 0,
            'is_active'           => true,
        ]);

        return back()->with('success', 'Fasilitas baru berhasil ditambahkan.');
    }

    public function updateFasilitas(Request $request, Fasilitas $fasilitas): RedirectResponse
    {
        $validated = $request->validate([
            'judul'               => 'required|string|max:255',
            'kategori'            => 'required|string|max:100',
            'status_ketersediaan' => 'required|in:Tersedia,Dalam Perawatan,Dipinjam',
            'deskripsi_singkat'   => 'nullable|string',
            'sasaran'             => 'required|string|max:50',
            'cakupan'             => 'nullable|string',
            'urutan'              => 'nullable|integer',
        ]);

        $cakupan = null;
        if (!empty($validated['cakupan'])) {
            $cakupan = array_filter(array_map('trim', preg_split('/[\r\n,]+/', $validated['cakupan'])));
        }

        $fasilitas->update([
            'judul'               => $validated['judul'],
            'kategori'            => $validated['kategori'],
            'status_ketersediaan' => $validated['status_ketersediaan'],
            'deskripsi_singkat'   => $validated['deskripsi_singkat'],
            'sasaran'             => $validated['sasaran'],
            'cakupan'             => $cakupan,
            'urutan'              => $validated['urutan'] ?? $fasilitas->urutan,
        ]);

        return back()->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroyFasilitas(Fasilitas $fasilitas): RedirectResponse
    {
        $fasilitas->delete();
        return back()->with('success', 'Fasilitas berhasil dihapus.');
    }

    /**
     * MODUL MANAJEMEN USERS (Superadmin Only).
     */
    public function users(Request $request): View
    {
        $query = User::latest();

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function storeUser(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'nim_nip'  => 'required|string|max:30',
            'role'     => 'required|in:user,admin,superadmin',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'nim_nip'  => $validated['nim_nip'],
            'role'     => $validated['role'],
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Akun pengguna berhasil ditambahkan.');
    }

    public function updateUser(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'nim_nip'  => 'required|string|max:30',
            'role'     => 'required|in:user,admin,superadmin',
            'password' => 'nullable|string|min:8',
        ]);

        $user->name    = $validated['name'];
        $user->email   = $validated['email'];
        $user->nim_nip = $validated['nim_nip'];
        $user->role    = $validated['role'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return back()->with('success', 'Data akun pengguna berhasil diperbarui.');
    }

    public function destroyUser(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();
        return back()->with('success', 'Akun berhasil dihapus.');
    }

    /**
     * MODUL EVENTS & REGISTRASI (Superadmin).
     */
    public function events(): View
    {
        $events = Event::with('registrations')->withCount('registrations')->latest()->paginate(15);
        return view('admin.events.index', compact('events'));
    }

    public function storeEvent(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul'       => 'required|string|max:255',
            'kategori'    => 'required|in:Workshop,Praktikum,Sharing Session',
            'kuota_total' => 'required|integer|min:1',
            'tanggal'     => 'required|date',
            'lokasi'      => 'required|string|max:150',
            'mentor_nama' => 'nullable|string|max:100',
        ]);

        $slug = \Illuminate\Support\Str::slug($validated['judul']) . '-' . rand(100, 999);

        Event::create([
            'judul'             => $validated['judul'],
            'slug'              => $slug,
            'kategori'          => $validated['kategori'],
            'kuota_total'       => $validated['kuota_total'],
            'tanggal'           => $validated['tanggal'],
            'lokasi'            => $validated['lokasi'],
            'mentor_nama'       => $validated['mentor_nama'],
            'status'            => 'Akan Datang',
            'status_registrasi' => 'Open',
        ]);

        return back()->with('success', 'Agenda baru berhasil ditambahkan.');
    }

    public function updateEvent(Request $request, Event $event): RedirectResponse
    {
        $validated = $request->validate([
            'judul'             => 'required|string|max:255',
            'kategori'          => 'required|in:Workshop,Praktikum,Sharing Session',
            'kuota_total'       => 'required|integer|min:1',
            'tanggal'           => 'required|date',
            'lokasi'            => 'required|string|max:150',
            'mentor_nama'       => 'nullable|string|max:100',
            'status_registrasi' => 'required|in:Open,Closed',
            'status'            => 'required|in:Akan Datang,Berlangsung,Selesai',
        ]);

        $event->update($validated);

        return back()->with('success', 'Data agenda event berhasil diperbarui.');
    }

    public function toggleEventRegistration(Event $event): RedirectResponse
    {
        $newStatus = $event->status_registrasi === 'Open' ? 'Closed' : 'Open';
        $event->update(['status_registrasi' => $newStatus]);

        return back()->with('success', 'Status pendaftaran event diubah menjadi: ' . $newStatus);
    }

    public function destroyEvent(Event $event): RedirectResponse
    {
        $event->delete();
        return back()->with('success', 'Event berhasil dihapus.');
    }

    /**
     * MODUL KOMUNITAS & FORUM (Superadmin Moderasi).
     */
    public function komunitas(): View
    {
        $threads = Thread::with('user')->withCount('votes')->latest()->paginate(20);
        return view('admin.komunitas.index', compact('threads'));
    }

    public function toggleSolveThread(Thread $thread): RedirectResponse
    {
        $thread->update(['is_solved' => !$thread->is_solved]);
        return back()->with('success', 'Status solved thread diperbarui.');
    }

    public function destroyThread(Thread $thread): RedirectResponse
    {
        $thread->delete();
        return back()->with('success', 'Thread berhasil dihapus.');
    }

    /**
     * MODUL DOSEN & PENELITI (Superadmin Only).
     */
    public function dosen(): View
    {
        $dosen = Dosen::orderBy('nama')->paginate(15);
        return view('admin.dosen.index', compact('dosen'));
    }

    public function storeDosen(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama'         => 'required|string|max:255',
            'nip'          => 'nullable|string|max:50',
            'prodi'        => 'required|string|max:20',
            'keahlian'     => 'nullable|string|max:255',
            'bidang_minat' => 'nullable|string|max:255',
            'email'        => 'nullable|email|max:100',
            'no_telp'      => 'nullable|string|max:30',
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('dosen', 'public');
        }

        Dosen::create([
            'nama'         => $validated['nama'],
            'nip'          => $validated['nip'],
            'prodi'        => $validated['prodi'],
            'keahlian'     => $validated['keahlian'],
            'bidang_minat' => $validated['bidang_minat'],
            'email'        => $validated['email'],
            'no_telp'      => $validated['no_telp'],
            'foto_path'    => $fotoPath,
            'is_active'    => true,
        ]);

        return back()->with('success', 'Data dosen/peneliti berhasil ditambahkan.');
    }

    public function updateDosen(Request $request, Dosen $dosen): RedirectResponse
    {
        $validated = $request->validate([
            'nama'         => 'required|string|max:255',
            'nip'          => 'nullable|string|max:50',
            'prodi'        => 'required|string|max:20',
            'keahlian'     => 'nullable|string|max:255',
            'bidang_minat' => 'nullable|string|max:255',
            'email'        => 'nullable|email|max:100',
            'no_telp'      => 'nullable|string|max:30',
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('foto')) {
            if ($dosen->foto_path && Storage::disk('public')->exists($dosen->foto_path)) {
                Storage::disk('public')->delete($dosen->foto_path);
            }
            $dosen->foto_path = $request->file('foto')->store('dosen', 'public');
        }

        $dosen->nama         = $validated['nama'];
        $dosen->nip          = $validated['nip'];
        $dosen->prodi        = $validated['prodi'];
        $dosen->keahlian     = $validated['keahlian'];
        $dosen->bidang_minat = $validated['bidang_minat'];
        $dosen->email        = $validated['email'];
        $dosen->no_telp      = $validated['no_telp'];
        $dosen->save();

        return back()->with('success', 'Data dosen/peneliti berhasil diperbarui.');
    }

    public function destroyDosen(Dosen $dosen): RedirectResponse
    {
        if ($dosen->foto_path && Storage::disk('public')->exists($dosen->foto_path)) {
            Storage::disk('public')->delete($dosen->foto_path);
        }
        $dosen->delete();
        return back()->with('success', 'Data dosen berhasil dihapus.');
    }

    /**
     * MODUL PROFIL & STATISTIK LABORATORIUM (Superadmin Only).
     */
    public function profil(): View
    {
        $profils = ProfilLaboratorium::orderBy('urutan')->get();
        $stats   = StatistikUmum::orderBy('urutan')->get();
        return view('admin.profil.index', compact('profils', 'stats'));
    }

    public function updateProfil(Request $request, ProfilLaboratorium $profil): RedirectResponse
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'gelar'     => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('foto')) {
            if ($profil->foto_path && Storage::disk('public')->exists($profil->foto_path)) {
                Storage::disk('public')->delete($profil->foto_path);
            }
            $profil->foto_path = $request->file('foto')->store('profil', 'public');
        }

        $profil->nama      = $validated['nama'];
        $profil->gelar     = $validated['gelar'];
        $profil->deskripsi = $validated['deskripsi'];
        $profil->save();

        return back()->with('success', 'Profil pimpinan laboratorium berhasil diperbarui.');
    }

    public function updateStatistik(Request $request, StatistikUmum $stat): RedirectResponse
    {
        $validated = $request->validate([
            'nilai'  => 'required|string|max:20',
            'satuan' => 'nullable|string|max:30',
        ]);

        $stat->update($validated);
        return back()->with('success', 'Angka statistik berhasil diperbarui.');
    }

    // =========================================================================
    // MODUL BERITA & PENGUMUMAN (Superadmin Only)
    // =========================================================================

    public function berita(): View
    {
        $beritaList = Berita::latest()->paginate(15);
        return view('admin.berita.index', compact('beritaList'));
    }

    public function storeBerita(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul'       => 'required|string|max:255',
            'kategori'    => 'required|in:Berita,Pengumuman,Agenda',
            'ringkasan'   => 'nullable|string|max:500',
            'isi'         => 'required|string',
            'penulis'     => 'nullable|string|max:100',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('berita', 'public');
        }

        $slug = Str::slug($validated['judul']) . '-' . rand(100, 999);

        Berita::create([
            'judul'        => $validated['judul'],
            'slug'         => $slug,
            'kategori'     => $validated['kategori'],
            'ringkasan'    => $validated['ringkasan'],
            'isi'          => $validated['isi'],
            'penulis'      => $validated['penulis'] ?? 'Admin Lab SI',
            'foto_path'    => $fotoPath,
            'published_at' => now(),
            'is_active'    => true,
        ]);

        return back()->with('success', 'Berita/pengumuman berhasil ditambahkan.');
    }

    public function updateBerita(Request $request, Berita $berita): RedirectResponse
    {
        $validated = $request->validate([
            'judul'     => 'required|string|max:255',
            'kategori'  => 'required|in:Berita,Pengumuman,Agenda',
            'ringkasan' => 'nullable|string|max:500',
            'isi'       => 'required|string',
            'penulis'   => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('foto')) {
            if ($berita->foto_path && Storage::disk('public')->exists($berita->foto_path)) {
                Storage::disk('public')->delete($berita->foto_path);
            }
            $berita->foto_path = $request->file('foto')->store('berita', 'public');
        }

        $berita->judul     = $validated['judul'];
        $berita->kategori  = $validated['kategori'];
        $berita->ringkasan = $validated['ringkasan'];
        $berita->isi       = $validated['isi'];
        $berita->penulis   = $validated['penulis'] ?? 'Admin Lab SI';
        $berita->is_active = $request->boolean('is_active', true);
        $berita->save();

        return back()->with('success', 'Berita/pengumuman berhasil diperbarui.');
    }

    public function destroyBerita(Berita $berita): RedirectResponse
    {
        if ($berita->foto_path && Storage::disk('public')->exists($berita->foto_path)) {
            Storage::disk('public')->delete($berita->foto_path);
        }
        $berita->delete();
        return back()->with('success', 'Berita berhasil dihapus.');
    }

    // =========================================================================
    // MODUL GALERI & TESTIMONI (Superadmin Only)
    // =========================================================================

    public function galeriTestimoni(): View
    {
        $galeriList = Galeri::orderBy('urutan')->get();
        $testimoniList = Testimoni::orderBy('urutan')->get();
        return view('admin.galeri.index', compact('galeriList', 'testimoniList'));
    }

    public function storeGaleri(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul'    => 'required|string|max:255',
            'deskripsi'=> 'nullable|string|max:500',
            'kategori' => 'required|in:Praktikum,Workshop,Riset',
            'urutan'   => 'nullable|integer',
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('galeri', 'public');
        }

        Galeri::create([
            'judul'     => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'kategori'  => $validated['kategori'],
            'urutan'    => $validated['urutan'] ?? 0,
            'foto_path' => $fotoPath,
            'is_active' => true,
        ]);

        return back()->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function updateGaleri(Request $request, Galeri $galeri): RedirectResponse
    {
        $validated = $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
            'kategori'  => 'required|in:Praktikum,Workshop,Riset',
            'urutan'    => 'nullable|integer',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('foto')) {
            if ($galeri->foto_path && Storage::disk('public')->exists($galeri->foto_path)) {
                Storage::disk('public')->delete($galeri->foto_path);
            }
            $galeri->foto_path = $request->file('foto')->store('galeri', 'public');
        }

        $galeri->judul     = $validated['judul'];
        $galeri->deskripsi = $validated['deskripsi'];
        $galeri->kategori  = $validated['kategori'];
        $galeri->urutan    = $validated['urutan'] ?? 0;
        $galeri->save();

        return back()->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroyGaleri(Galeri $galeri): RedirectResponse
    {
        if ($galeri->foto_path && Storage::disk('public')->exists($galeri->foto_path)) {
            Storage::disk('public')->delete($galeri->foto_path);
        }
        $galeri->delete();
        return back()->with('success', 'Galeri berhasil dihapus.');
    }

    public function storeTestimoni(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama'    => 'required|string|max:100',
            'role'    => 'required|string|max:100',
            'angkatan'=> 'nullable|string|max:50',
            'kutipan' => 'required|string|max:600',
            'urutan'  => 'nullable|integer',
            'foto'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('testimoni', 'public');
        }

        Testimoni::create([
            'nama'      => $validated['nama'],
            'role'      => $validated['role'],
            'angkatan'  => $validated['angkatan'],
            'kutipan'   => $validated['kutipan'],
            'urutan'    => $validated['urutan'] ?? 0,
            'foto_path' => $fotoPath,
            'is_active' => true,
        ]);

        return back()->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function updateTestimoni(Request $request, Testimoni $testimoni): RedirectResponse
    {
        $validated = $request->validate([
            'nama'    => 'required|string|max:100',
            'role'    => 'required|string|max:100',
            'angkatan'=> 'nullable|string|max:50',
            'kutipan' => 'required|string|max:600',
            'urutan'  => 'nullable|integer',
            'foto'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('foto')) {
            if ($testimoni->foto_path && Storage::disk('public')->exists($testimoni->foto_path)) {
                Storage::disk('public')->delete($testimoni->foto_path);
            }
            $testimoni->foto_path = $request->file('foto')->store('testimoni', 'public');
        }

        $testimoni->nama     = $validated['nama'];
        $testimoni->role     = $validated['role'];
        $testimoni->angkatan = $validated['angkatan'];
        $testimoni->kutipan  = $validated['kutipan'];
        $testimoni->urutan   = $validated['urutan'] ?? 0;
        $testimoni->save();

        return back()->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroyTestimoni(Testimoni $testimoni): RedirectResponse
    {
        if ($testimoni->foto_path && Storage::disk('public')->exists($testimoni->foto_path)) {
            Storage::disk('public')->delete($testimoni->foto_path);
        }
        $testimoni->delete();
        return back()->with('success', 'Testimoni berhasil dihapus.');
    }
}

