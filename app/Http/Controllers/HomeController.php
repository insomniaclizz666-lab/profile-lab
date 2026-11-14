<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Peminjaman;
use App\Models\RuangLab;
use App\Models\MataKuliahPraktikum;
use App\Models\Dosen;
use App\Models\Layanan;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Thread;
use App\Models\ThreadVote;
use App\Models\StatistikUmum;
use App\Models\ProfilLaboratorium;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Testimoni;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama (Landing Page).
     */
    public function index(): View
    {
        $fasilitas  = Fasilitas::where('is_active', true)->orderBy('urutan')->get();
        $layanan    = Layanan::where('is_active', true)->orderBy('urutan')->get();
        $praktikum  = MataKuliahPraktikum::with('ruangLab')->get();
        $dosen      = Dosen::where('is_active', true)->get();
        $stats      = StatistikUmum::where('is_active', true)->orderBy('urutan')->get();
        $profils    = ProfilLaboratorium::where('is_active', true)->orderBy('urutan')->get();
        $beritaList = Berita::where('is_active', true)->latest('published_at')->take(3)->get();
        $galeriList = Galeri::where('is_active', true)->orderBy('urutan')->get();
        $testimoni  = Testimoni::where('is_active', true)->orderBy('urutan')->get();
        $faqList    = Faq::where('is_active', true)->orderBy('urutan')->get();

        return view('pages.home', compact(
            'fasilitas', 'layanan', 'praktikum', 'dosen', 'stats', 'profils',
            'beritaList', 'galeriList', 'testimoni', 'faqList'
        ));
    }

    /**
     * Halaman detail berita/pengumuman.
     */
    public function detailBerita(string $slug): View
    {
        $berita = Berita::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $berita->increment('views');
        $beritaTerkait = Berita::where('is_active', true)
            ->where('id', '!=', $berita->id)
            ->latest('published_at')
            ->take(3)
            ->get();
        return view('pages.berita-detail', compact('berita', 'beritaTerkait'));
    }

    /**
     * Menampilkan halaman daftar riset & dosen.
     */
    public function riset(): View
    {
        $dosen = Dosen::where('is_active', true)->get();
        return view('pages.riset', compact('dosen'));
    }

    /**
     * Menampilkan halaman daftar fasilitas.
     */
    public function fasilitas(): View
    {
        $fasilitas = Fasilitas::where('is_active', true)->orderBy('urutan')->get();
        return view('pages.fasilitas', compact('fasilitas'));
    }

    /**
     * Menampilkan halaman layanan laboratorium.
     */
    public function layanan(): View
    {
        $layanan   = Layanan::where('is_active', true)->orderBy('urutan')->get();
        $fasilitas = Fasilitas::where('is_active', true)->orderBy('urutan')->get();

        return view('pages.layanan', compact('layanan', 'fasilitas'));
    }

    /**
     * Menampilkan halaman laboratorium & modul praktikum.
     */
    public function laboratorium(): View
    {
        $ruangLab     = RuangLab::with(['mataKuliah.modul'])->where('is_active', true)->get();
        $laboratorium = MataKuliahPraktikum::with(['ruangLab', 'modul'])->get();

        return view('pages.laboratorium', compact('ruangLab', 'laboratorium'));
    }

    /**
     * Menampilkan halaman aktivitas / agenda akademik laboratorium.
     * Mengonversi Eloquent collection ke array yang kompatibel dengan view.
     */
    public function aktifitas(): View
    {
        $dbEvents = Event::with('materials')->where('is_active', true)->orderBy('tanggal')->get();

        if ($dbEvents->isNotEmpty()) {
            $events = $dbEvents->map(function ($e) {
                $filledQuota = $e->filled_quota;
                $totalQuota  = $e->kuota_total ?? 50;

                // Format tanggal ke bahasa Indonesia
                $tanggalFormatted = $e->tanggal
                    ? \Carbon\Carbon::parse($e->tanggal)->locale('id')->isoFormat('D MMM YYYY')
                    : '-';

                // Format jam
                $jam = '';
                if ($e->jam_mulai) {
                    $jam = substr($e->jam_mulai, 0, 5);
                    if ($e->jam_selesai) {
                        $jam .= ' - ' . substr($e->jam_selesai, 0, 5) . ' WIB';
                    } else {
                        $jam .= ' WIB';
                    }
                }

                return [
                    'id'                  => $e->id,
                    'title'               => $e->judul,
                    'slug'                => $e->slug,
                    'category'            => $e->kategori,
                    'status'              => $e->status,
                    'registration_status' => $e->status_registrasi,
                    'date'                => $e->tanggal ? $e->tanggal->format('Y-m-d') : '',
                    'date_formatted'      => $tanggalFormatted,
                    'time'                => $jam,
                    'location'            => $e->lokasi,
                    'description'         => $e->deskripsi,
                    'thumbnail'           => $e->thumbnail_path
                        ? (str_starts_with($e->thumbnail_path, 'http') ? $e->thumbnail_path : asset('storage/' . $e->thumbnail_path))
                        : 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=800&q=80',
                    'mentor'              => [
                        'name'   => $e->mentor_nama ?? 'Tim Lab SI',
                        'role'   => $e->mentor_role ?? 'Laboran',
                        'avatar' => $e->mentor_avatar_path
                            ? (str_starts_with($e->mentor_avatar_path, 'http') ? $e->mentor_avatar_path : asset('storage/' . $e->mentor_avatar_path))
                            : 'https://ui-avatars.com/api/?name=' . urlencode($e->mentor_nama ?? 'Lab') . '&background=1E3A8A&color=fff',
                    ],
                    'quota_filled'        => $filledQuota,
                    'quota_total'         => $totalQuota,
                ];
            })->toArray();
        } else {
            $events = null; // view akan pakai fallback dummy
        }

        return view('pages.aktifitas', compact('events'));
    }

    /**
     * Alias untuk akademik.
     */
    public function akademik(): View
    {
        return $this->aktifitas();
    }

    /**
     * Menampilkan forum komunitas laboratorium.
     */
    public function komunitas(): View
    {
        $dbThreads = Thread::with(['user', 'tags'])->withCount('votes')->latest()->get();

        if ($dbThreads->isNotEmpty()) {
            $threads = $dbThreads->map(function ($t) {
                return [
                    'id'            => $t->id,
                    'title'         => $t->judul,
                    'slug'          => $t->slug,
                    'body'          => $t->body,
                    'author'        => [
                        'name'   => $t->author_nama ?? ($t->user?->name ?? 'Anonim SI'),
                        'role'   => $t->author_role ?? ($t->user?->role === 'superadmin' ? 'Admin Lab' : 'Mahasiswa'),
                        'avatar' => $t->author_avatar_path ?? 'https://ui-avatars.com/api/?name=' . urlencode($t->author_nama ?? 'User') . '&background=1e3a8a&color=fff',
                    ],
                    'created_at'    => $t->created_at ? $t->created_at->toDateTimeString() : now()->toDateTimeString(),
                    'time_relative' => $t->created_at ? $t->created_at->diffForHumans() : 'Baru saja',
                    'votes_count'   => $t->votes_count,
                    'replies_count' => 0,
                    'views_count'   => $t->views_count,
                    'is_solved'     => (bool) $t->is_solved,
                    'category'      => $t->kategori ?? 'Lainnya',
                    'tags'          => $t->tags->pluck('tag')->toArray(),
                    'code_snippet'  => $t->code_content ? [
                        'language' => $t->code_language ?? 'php',
                        'code'     => $t->code_content,
                    ] : null,
                ];
            })->toArray();
        } else {
            $threads = null;
        }

        return view('pages.komunitas', compact('threads'));
    }

    /**
     * Membuat topik diskusi baru di forum komunitas.
     * Menerima field: judul (atau title), kategori (atau category), body, code_language, code_content, tags
     */
    public function storeThread(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul'         => 'nullable|string|max:255',
            'title'         => 'nullable|string|max:255',  // alias dari form
            'kategori'      => 'nullable|string|max:50',
            'category'      => 'nullable|string|max:50',   // alias dari form
            'body'          => 'required|string',
            'code_language' => 'nullable|string|max:30',
            'code_content'  => 'nullable|string',
            'tags'          => 'nullable|string',
        ]);

        // Normalisasi nama field (form kirim 'title'/'category', DB pakai 'judul'/'kategori')
        $judul    = $validated['judul']    ?? $validated['title']    ?? 'Tanpa Judul';
        $kategori = $validated['kategori'] ?? $validated['category'] ?? 'Lainnya';

        if (empty($judul)) {
            return back()->withErrors(['judul' => 'Judul diskusi wajib diisi.'])->withInput();
        }

        $user = Auth::user();
        $slug = \Illuminate\Support\Str::slug($judul) . '-' . rand(100, 999);

        $thread = Thread::create([
            'user_id'            => $user?->id,
            'author_nama'        => $user?->name ?? 'Mahasiswa SI',
            'author_role'        => $user ? ($user->role === 'superadmin' ? 'Superadmin' : ($user->role === 'admin' ? 'Laboran' : 'Mahasiswa')) : 'Mahasiswa',
            'author_avatar_path' => $user?->avatar,
            'judul'              => $judul,
            'slug'               => $slug,
            'body'               => $validated['body'],
            'kategori'           => $kategori,
            'code_language'      => $validated['code_language'] ?? null,
            'code_content'       => $validated['code_content'] ?? null,
            'is_solved'          => false,
            'views_count'        => 1,
        ]);

        if (!empty($validated['tags'])) {
            $tagList = explode(',', $validated['tags']);
            foreach ($tagList as $tagItem) {
                $trimmed = trim($tagItem);
                if (!empty($trimmed)) {
                    \App\Models\ThreadTag::create([
                        'thread_id' => $thread->id,
                        'tag'       => $trimmed,
                    ]);
                }
            }
        }

        return back()->with('success', 'Topik diskusi baru Anda berhasil dipublikasikan ke Komunitas Wargalab SI!');
    }

    /**
     * Memproses voting upvote / downvote thread.
     */
    public function voteThread(Request $request, Thread $thread)
    {
        $validated = $request->validate([
            'type' => 'required|in:up,down',
        ]);

        $ip = $request->ip();
        $userId = Auth::id();

        // Cari apakah IP/User sudah pernah vote
        $existingVote = ThreadVote::where('thread_id', $thread->id)
            ->where(function ($q) use ($ip, $userId) {
                if ($userId) {
                    $q->where('user_id', $userId);
                } else {
                    $q->where('voter_ip', $ip);
                }
            })
            ->first();

        if ($existingVote) {
            if ($existingVote->tipe === $validated['type']) {
                $existingVote->delete(); // batalkan vote
                $status = 'unvoted';
            } else {
                $existingVote->update(['tipe' => $validated['type']]);
                $status = 'updated';
            }
        } else {
            ThreadVote::create([
                'thread_id' => $thread->id,
                'user_id'   => $userId,
                'voter_ip'  => $ip,
                'tipe'      => $validated['type'],
            ]);
            $status = 'voted';
        }

        $newScore = $thread->score;

        if ($request->wantsJson()) {
            return response()->json([
                'status'   => $status,
                'score'    => $newScore,
            ]);
        }

        return back()->with('success', 'Vote Anda berhasil dicatat.');
    }

    /**
     * Memproses registrasi pendaftaran event/workshop oleh pengguna/mahasiswa.
     */
    public function storeEventRegistration(Request $request, Event $event): RedirectResponse
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:100',
            'nim'      => 'required|string|max:30',
            'email'    => 'required|email|max:100',
            'angkatan' => 'nullable|string|max:10',
        ]);

        // Cek kuota
        if ($event->status_registrasi !== 'Open' || $event->filled_quota >= $event->kuota_total) {
            return back()->with('error', 'Mohon maaf, kuota pendaftaran untuk agenda ini sudah penuh.');
        }

        // Cek apakah NIM sudah terdaftar pada event ini
        $alreadyRegistered = EventRegistration::where('event_id', $event->id)
            ->where('nim', $validated['nim'])
            ->exists();

        if ($alreadyRegistered) {
            return back()->with('error', 'NIM ini sudah terdaftar pada agenda tersebut sebelumnya.');
        }

        EventRegistration::create([
            'event_id'      => $event->id,
            'user_id'       => Auth::id(),
            'nama'          => $validated['nama'],
            'nim'           => $validated['nim'],
            'email'         => $validated['email'],
            'angkatan'      => $validated['angkatan'],
            'status'        => 'confirmed',
            'registered_at' => now(),
        ]);

        return back()->with('success', 'Selamat! Pendaftaran Anda berhasil tercatat untuk agenda: ' . $event->judul);
    }

    /**
     * Mengecek ketersediaan ruang lab / jadwal peminjaman agar tidak tabrakan dengan jadwal kelas.
     */
    public function cekKetersediaanLab(Request $request): \Illuminate\Http\JsonResponse
    {
        $ruangLabId = $request->input('ruang_lab_id');
        $tanggalStr = $request->input('tanggal');
        $sesi       = $request->input('sesi', 'Pagi (08:00 - 12:00)');

        if (!$ruangLabId || !$tanggalStr) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'Silakan pilih ruang laboratorium dan tanggal peminjaman.',
                'available' => false,
            ]);
        }

        try {
            $tanggal = \Carbon\Carbon::parse($tanggalStr);
        } catch (\Throwable $e) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'Format tanggal tidak valid.',
                'available' => false,
            ]);
        }

        $ruang = \App\Models\RuangLab::find($ruangLabId);
        if (!$ruang) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'Ruang laboratorium tidak ditemukan.',
                'available' => false,
            ]);
        }

        $daysMap = [
            0 => 'Minggu',
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        ];
        $hari = $daysMap[$tanggal->dayOfWeek] ?? 'Senin';

        $sesiMap = [
            'Pagi (08:00 - 12:00)'     => ['start' => '08:00:00', 'end' => '12:00:00'],
            'Siang (13:00 - 17:00)'    => ['start' => '13:00:00', 'end' => '17:00:00'],
            'Malam (18:30 - 21:00)'    => ['start' => '18:30:00', 'end' => '21:00:00'],
            'Full Day (08:00 - 17:00)' => ['start' => '08:00:00', 'end' => '17:00:00'],
        ];
        $currentSesi = $sesiMap[$sesi] ?? ['start' => '08:00:00', 'end' => '17:00:00'];

        // 1. Cek bentrok dengan Jadwal Kelas Praktikum Rutin
        $kelasSchedules = \App\Models\MataKuliahPraktikum::where('ruang_lab_id', $ruangLabId)
            ->where('hari', $hari)
            ->where('status', 'aktif')
            ->get();

        $bentrokKelas = null;
        $jadwalHariIni = [];

        foreach ($kelasSchedules as $mk) {
            $mkStart = $mk->jam_mulai ? substr($mk->jam_mulai, 0, 8) : '08:00:00';
            $mkEnd   = $mk->jam_selesai ? substr($mk->jam_selesai, 0, 8) : '10:30:00';

            $jadwalHariIni[] = [
                'tipe'       => 'Kelas Praktikum',
                'judul'      => $mk->nama . ' (Kelas ' . ($mk->kelas ?? 'A') . ')',
                'dosen'      => $mk->dosen_pengampu ?? 'Dosen Pengampu',
                'jam'        => substr($mkStart, 0, 5) . ' - ' . substr($mkEnd, 0, 5) . ' WIB',
                'status'     => 'Terpakai Perkuliahan',
                'badge'      => 'bg-rose-100 text-rose-800 border-rose-200',
            ];

            // Overlap check: start1 < end2 && end1 > start2
            if ($currentSesi['start'] < $mkEnd && $currentSesi['end'] > $mkStart) {
                $bentrokKelas = $mk;
            }
        }

        // 2. Cek bentrok dengan peminjaman lain yang disetujui / pending
        $peminjamanExisting = \App\Models\Peminjaman::where('ruang_lab_id', $ruangLabId)
            ->where('tanggal_mulai', $tanggal->toDateString())
            ->whereIn('status', ['Disetujui', 'Pending'])
            ->get();

        $bentrokPeminjaman = null;
        foreach ($peminjamanExisting as $p) {
            $pStart = '08:00:00';
            $pEnd   = '17:00:00';
            if (!empty($p->sesi) && isset($sesiMap[$p->sesi])) {
                $pStart = $sesiMap[$p->sesi]['start'];
                $pEnd   = $sesiMap[$p->sesi]['end'];
            }

            $jadwalHariIni[] = [
                'tipe'       => 'Peminjaman Lab',
                'judul'      => $p->keperluan,
                'peminjam'   => $p->nama_peminjam . ' (' . $p->nim_nip . ')',
                'jam'        => $p->sesi ?? (substr($pStart, 0, 5) . ' - ' . substr($pEnd, 0, 5) . ' WIB'),
                'status'     => $p->status === 'Disetujui' ? 'Sudah Dipesan (Approved)' : 'Menunggu Konfirmasi',
                'badge'      => $p->status === 'Disetujui' ? 'bg-amber-100 text-amber-800 border-amber-200' : 'bg-blue-100 text-blue-800 border-blue-200',
            ];

            if ($currentSesi['start'] < $pEnd && $currentSesi['end'] > $pStart) {
                $bentrokPeminjaman = $p;
            }
        }

        if ($bentrokKelas) {
            $jamStr = substr($bentrokKelas->jam_mulai, 0, 5) . ' - ' . substr($bentrokKelas->jam_selesai, 0, 5) . ' WIB';
            return response()->json([
                'available'       => false,
                'status'          => 'bentrok_kelas',
                'conflict_title'  => 'Jadwal Bentrok dengan Kelas Praktikum',
                'message'         => "Ruangan {$ruang->nama_ruang} pada hari {$hari} sesi {$sesi} sedang digunakan untuk kelas \"{$bentrokKelas->nama}\" ({$jamStr}). Silakan pilih sesi atau hari lain.",
                'jadwal_hari_ini' => $jadwalHariIni,
                'ruang'           => $ruang->nama_ruang,
                'hari'            => $hari,
                'tanggal'         => $tanggal->translatedFormat('d F Y'),
            ]);
        }

        if ($bentrokPeminjaman) {
            return response()->json([
                'available'       => false,
                'status'          => 'bentrok_peminjaman',
                'conflict_title'  => 'Jadwal Sudah Dipesan',
                'message'         => "Ruangan {$ruang->nama_ruang} pada tanggal {$tanggal->format('d/m/Y')} sesi {$sesi} sudah diajukan oleh peminjam lain ({$bentrokPeminjaman->nama_peminjam}). Silakan pilih sesi atau tanggal lain.",
                'jadwal_hari_ini' => $jadwalHariIni,
                'ruang'           => $ruang->nama_ruang,
                'hari'            => $hari,
                'tanggal'         => $tanggal->translatedFormat('d F Y'),
            ]);
        }

        return response()->json([
            'available'       => true,
            'status'          => 'available',
            'conflict_title'  => null,
            'message'         => "Jadwal TERSEDIA (AVAILABLE). {$ruang->nama_ruang} dapat digunakan pada hari {$hari}, {$tanggal->format('d/m/Y')} untuk sesi {$sesi}.",
            'jadwal_hari_ini' => $jadwalHariIni,
            'ruang'           => $ruang->nama_ruang,
            'hari'            => $hari,
            'tanggal'         => $tanggal->translatedFormat('d F Y'),
        ]);
    }

    /**
     * Memproses permohonan peminjaman alat/ruang dari formulir.
     */
    public function storePeminjaman(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_alat_ruang' => 'required|string|max:255',
            'nama_peminjam'   => 'required|string|max:255',
            'nim_nip'         => 'required|string|max:50',
            'email'           => 'required|email|max:100',
            'no_telp'         => 'required|string|max:30',
            'tanggal_mulai'   => 'nullable|date',
            'sesi'            => 'nullable|string|max:50',
            'durasi'          => 'nullable|string|max:100',
            'keperluan'       => 'required|string',
            'ruang_lab_id'    => 'nullable|exists:ruang_lab,id',
        ]);

        $tanggalPinjam = $validated['tanggal_mulai'] ? \Carbon\Carbon::parse($validated['tanggal_mulai']) : now()->addDay();
        $sesi = $validated['sesi'] ?? 'Pagi (08:00 - 12:00)';
        $ruangId = $validated['ruang_lab_id'] ?? null;

        // Validasi Anti-Bentrok sisi Server jika memilih ruang lab
        if ($ruangId) {
            $daysMap = [0 => 'Minggu', 1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu'];
            $hari = $daysMap[$tanggalPinjam->dayOfWeek] ?? 'Senin';

            $sesiMap = [
                'Pagi (08:00 - 12:00)'     => ['start' => '08:00:00', 'end' => '12:00:00'],
                'Siang (13:00 - 17:00)'    => ['start' => '13:00:00', 'end' => '17:00:00'],
                'Malam (18:30 - 21:00)'    => ['start' => '18:30:00', 'end' => '21:00:00'],
                'Full Day (08:00 - 17:00)' => ['start' => '08:00:00', 'end' => '17:00:00'],
            ];
            $currentSesi = $sesiMap[$sesi] ?? ['start' => '08:00:00', 'end' => '17:00:00'];

            // Cek kelas
            $bentrokKelas = \App\Models\MataKuliahPraktikum::where('ruang_lab_id', $ruangId)
                ->where('hari', $hari)
                ->where('status', 'aktif')
                ->where('jam_mulai', '<', $currentSesi['end'])
                ->where('jam_selesai', '>', $currentSesi['start'])
                ->first();

            if ($bentrokKelas) {
                return redirect()->back()->withInput()->with(
                    'error',
                    "Permohonan Ditolak: Jadwal bertabrakan dengan perkuliahan/praktikum \"{$bentrokKelas->nama}\" di hari {$hari} ({$bentrokKelas->jam_mulai} - {$bentrokKelas->jam_selesai}). Silakan pilih sesi atau tanggal lain."
                );
            }

            // Cek peminjaman yang sudah ada
            $bentrokPinjam = \App\Models\Peminjaman::where('ruang_lab_id', $ruangId)
                ->where('tanggal_mulai', $tanggalPinjam->toDateString())
                ->whereIn('status', ['Disetujui'])
                ->where(function ($q) use ($sesi) {
                    $q->where('sesi', $sesi)->orWhere('sesi', 'Full Day (08:00 - 17:00)');
                })
                ->first();

            if ($bentrokPinjam) {
                return redirect()->back()->withInput()->with(
                    'error',
                    "Permohonan Ditolak: Ruang laboratorium pada tanggal {$tanggalPinjam->format('d/m/Y')} sesi {$sesi} sudah disetujui untuk peminjam lain. Silakan pilih sesi lain."
                );
            }
        }

        // Tentukan jam mulai dan selesai berdasarkan sesi
        $jamMulai = '08:00';
        $jamSelesai = '12:00';
        if (str_contains($sesi, '13:00')) {
            $jamMulai = '13:00';
            $jamSelesai = '17:00';
        } elseif (str_contains($sesi, '18:30')) {
            $jamMulai = '18:30';
            $jamSelesai = '21:00';
        } elseif (str_contains($sesi, 'Full Day')) {
            $jamMulai = '08:00';
            $jamSelesai = '17:00';
        }

        Peminjaman::create([
            'user_id'         => Auth::id(),
            'ruang_lab_id'    => $ruangId,
            'nama_alat_ruang' => $validated['nama_alat_ruang'],
            'nama_peminjam'   => $validated['nama_peminjam'],
            'nim_nip'         => $validated['nim_nip'],
            'email'           => $validated['email'] ?? (Auth::user()?->email),
            'no_telp'         => $validated['no_telp'] ?? (Auth::user()?->no_telp),
            'tanggal_mulai'   => $tanggalPinjam->toDateString(),
            'tanggal_selesai' => $tanggalPinjam->toDateString(),
            'jam_mulai'       => $jamMulai,
            'jam_selesai'     => $jamSelesai,
            'sesi'            => $sesi,
            'durasi'          => $validated['durasi'] ?? $sesi,
            'keperluan'       => $validated['keperluan'],
            'status'          => 'Pending',
        ]);

        return redirect()->back()->with(
            'success',
            'Permohonan peminjaman berhasil dikirim! Jadwal telah terverifikasi AVAILABLE (tidak bentrok dengan jadwal kelas praktikum). Silakan tunggu konfirmasi laboran.'
        );
    }
}
