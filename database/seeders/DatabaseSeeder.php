<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ProfilLaboratorium;
use App\Models\StatistikUmum;
use App\Models\Dosen;
use App\Models\RuangLab;
use App\Models\MataKuliahPraktikum;
use App\Models\ModulPraktikum;
use App\Models\Layanan;
use App\Models\Fasilitas;
use App\Models\Faq;
use App\Models\SopPoin;
use App\Models\AsesmenPertanyaan;
use App\Models\AsesmenOpsi;
use App\Models\Event;
use App\Models\Thread;
use App\Models\ThreadTag;
use App\Models\Peminjaman;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Aktor & User
        $superadmin = User::firstOrCreate(['email' => 'superadmin@utm.ac.id'], [
            'name' => 'Super Administrator UTM',
            'password' => Hash::make('password123'),
            'role' => 'superadmin',
            'nim_nip' => '198701012015041001',
            'no_telp' => '081234567890',
        ]);

        $laboran = User::firstOrCreate(['email' => 'laboran@utm.ac.id'], [
            'name' => 'Laboran SI UTM (Admin)',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'nim_nip' => '199205122019031002',
            'no_telp' => '082345678901',
        ]);

        $userMhs = User::firstOrCreate(['email' => 'user@utm.ac.id'], [
            'name' => 'Mahasiswa SI Demo',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'nim_nip' => '220441100001',
            'no_telp' => '083456789012',
        ]);

        // 2. Statistik Umum Hero
        $stats = [
            ['key' => 'total_lab', 'label' => 'Laboratorium Khusus', 'nilai' => '4', 'satuan' => 'Lab', 'urutan' => 1],
            ['key' => 'total_pc', 'label' => 'High-End PC Ready', 'nilai' => '120', 'satuan' => '+', 'urutan' => 2],
            ['key' => 'total_asisten', 'label' => 'Asisten Lab Aktif', 'nilai' => '18', 'satuan' => '+', 'urutan' => 3],
            ['key' => 'kepuasan', 'label' => 'Tingkat Kepuasan Mahasiswa', 'nilai' => '100', 'satuan' => '%', 'urutan' => 4],
        ];
        foreach ($stats as $s) {
            StatistikUmum::updateOrCreate(['key' => $s['key']], $s);
        }

        // 3. Profil Pimpinan Lab
        $profils = [
            [
                'jabatan' => 'kaprodi',
                'nama' => 'Dr. Firman Arifin, S.T., M.T.',
                'gelar' => 'Koordinator Program Studi Sistem Informasi',
                'foto_path' => null,
                'deskripsi' => 'Berkomitmen menghasilkan lulusan Sistem Informasi berdaya saing global melalui penguatan kurikulum praktikum dan riset terapan.',
                'urutan' => 1,
            ],
            [
                'jabatan' => 'kepala_lab',
                'nama' => 'Achmad Jauhari, S.T., M.Kom.',
                'gelar' => 'Kepala Laboratorium Sistem Informasi',
                'foto_path' => null,
                'deskripsi' => 'Memfasilitasi kegiatan praktikum berkualitas tinggi, riset mahasiswa, serta pengembangan soft skill dan hard skill berbasis teknologi mutakhir.',
                'urutan' => 2,
            ],
        ];
        foreach ($profils as $p) {
            ProfilLaboratorium::updateOrCreate(['jabatan' => $p['jabatan']], $p);
        }

        // 4. Dosen Riset
        $dosenList = [
            [
                'nama' => 'Achmad Jauhari, S.T., M.Kom.',
                'nip' => '197605152002121002',
                'prodi' => 'S1',
                'keahlian' => 'Data Engineering & Big Data',
                'bidang_minat' => 'datascience',
                'no_telp' => '08123456701',
                'email' => 'achmad.jauhari@utm.ac.id',
            ],
            [
                'nama' => 'Dr. Firman Arifin, S.T., M.T.',
                'nip' => '197503082001121001',
                'prodi' => 'S1,S2',
                'keahlian' => 'Enterprise Architecture & IT Governance',
                'bidang_minat' => 'governance',
                'no_telp' => '08123456702',
                'email' => 'firman.arifin@utm.ac.id',
            ],
            [
                'nama' => 'Fika Hastarita Rachman, S.T., M.Eng.',
                'nip' => '198308202008122003',
                'prodi' => 'S1',
                'keahlian' => 'Web Intelligence & Software Engineering',
                'bidang_minat' => 'software',
                'no_telp' => '08123456703',
                'email' => 'fika.hastarita@utm.ac.id',
            ],
            [
                'nama' => 'Kurniawan Eka Permana, S.Kom., M.Sc.',
                'nip' => '198904122019031011',
                'prodi' => 'S1',
                'keahlian' => 'Artificial Intelligence & Machine Learning',
                'bidang_minat' => 'datascience',
                'no_telp' => '08123456704',
                'email' => 'kurniawan.eka@utm.ac.id',
            ],
        ];
        foreach ($dosenList as $d) {
            Dosen::updateOrCreate(['nama' => $d['nama']], $d);
        }

        // 5. Ruang Lab & MK Praktikum
        $ruangs = [
            ['kode' => 'A', 'nama_ruang' => 'Lab Komputasi Dasar (Lab A)', 'kapasitas_pc' => 30, 'lokasi' => 'Gedung RKB C Lt. 2'],
            ['kode' => 'B', 'nama_ruang' => 'Lab Rekayasa Perangkat Lunak (Lab B)', 'kapasitas_pc' => 30, 'lokasi' => 'Gedung RKB C Lt. 2'],
            ['kode' => 'C', 'nama_ruang' => 'Lab Sistem Cerdas & Data (Lab C)', 'kapasitas_pc' => 30, 'lokasi' => 'Gedung RKB C Lt. 3'],
            ['kode' => 'D', 'nama_ruang' => 'Lab Tata Kelola & Multimedia (Lab D)', 'kapasitas_pc' => 30, 'lokasi' => 'Gedung RKB C Lt. 3'],
        ];

        foreach ($ruangs as $r) {
            $lab = RuangLab::updateOrCreate(['kode' => $r['kode']], $r);

            if ($r['kode'] === 'A') {
                $mk = MataKuliahPraktikum::updateOrCreate(
                    ['nama' => 'Algoritma & Pemrograman'],
                    ['ruang_lab_id' => $lab->id, 'semester' => 1, 'sks' => 3, 'status' => 'aktif']
                );
                ModulPraktikum::firstOrCreate(
                    ['mata_kuliah_id' => $mk->id, 'judul' => 'Modul 1: Pengantar Bahasa Pemrograman & Percabangan'],
                    ['file_path' => 'modul/alpro-modul1.pdf', 'versi' => '1.0', 'published_at' => now()]
                );
            } elseif ($r['kode'] === 'B') {
                $mk = MataKuliahPraktikum::updateOrCreate(
                    ['nama' => 'Pemrograman Berorientasi Objek'],
                    ['ruang_lab_id' => $lab->id, 'semester' => 3, 'sks' => 3, 'status' => 'aktif']
                );
                ModulPraktikum::firstOrCreate(
                    ['mata_kuliah_id' => $mk->id, 'judul' => 'Modul 1: OOP Concept & Class Structure'],
                    ['file_path' => 'modul/pbo-modul1.pdf', 'versi' => '1.0', 'published_at' => now()]
                );
            }
        }

        // 6. Fasilitas
        $fasilitasList = [
            [
                'judul' => 'Workstation PC Core i7 Lab Komputasi',
                'slug' => 'workstation-pc-core-i7',
                'deskripsi_singkat' => 'PC High-End dengan GPU NVIDIA untuk pemrosesan dataset dan machine learning.',
                'kategori' => 'Alat & Hardware',
                'sasaran' => 'mahasiswa',
                'status_ketersediaan' => 'Tersedia',
                'cakupan' => ['Intel Core i7 13th Gen', '32GB RAM DDR5', 'RTX 4060 8GB', 'Dual Monitor Support'],
                'urutan' => 1,
            ],
            [
                'judul' => 'Ruang Riset Kolaboratif Lab C',
                'slug' => 'ruang-riset-kolaboratif-lab-c',
                'deskripsi_singkat' => 'Ruang rapat dan diskusi proyek capstone & riset dosen mahasiswa dilengkapi smart TV.',
                'kategori' => 'Ruangan',
                'sasaran' => 'mahasiswa',
                'status_ketersediaan' => 'Tersedia',
                'cakupan' => ['Kapasitas 10 Orang', 'Smart TV 65 Inch HDMI/Wireless', 'Whiteboard Glassboard', 'Full AC'],
                'urutan' => 2,
            ],
            [
                'judul' => 'Interactive Display Smart Board 75"',
                'slug' => 'interactive-display-smart-board',
                'deskripsi_singkat' => 'Papan interaktif digital untuk presentasi dan workshop teknologi terpadu.',
                'kategori' => 'Inventaris Multimedia',
                'sasaran' => 'dosen',
                'status_ketersediaan' => 'Tersedia',
                'cakupan' => ['Touchscreen 4K', 'Multi-touch Stylus Support', 'Integrated Android & Windows OS'],
                'urutan' => 3,
            ],
        ];
        foreach ($fasilitasList as $f) {
            Fasilitas::updateOrCreate(['slug' => $f['slug']], $f);
        }

        // 7. Layanan
        $layananList = [
            [
                'judul' => 'Praktikum Terjadwal & Asistensi Lab',
                'slug' => 'praktikum-terjadwal-asistensi',
                'deskripsi_singkat' => 'Pelayanan operasional praktikum mata kuliah kurikulum Sistem Informasi secara terjadwal.',
                'sasaran' => 'mahasiswa',
                'cakupan' => ['Pelaksanaan sesi praktikum mingguan', 'Pendampingan asisten laboratorium', 'Evaluasi kuis & modul praktikum'],
                'urutan' => 1,
            ],
            [
                'judul' => 'Peminjaman Ruang & Alat Riset',
                'slug' => 'peminjaman-ruang-alat-riset',
                'deskripsi_singkat' => 'Fasilitasi peminjaman ruang laboratorium dan peralatan IT untuk kegiatan riset dan event.',
                'sasaran' => 'mahasiswa',
                'cakupan' => ['Pengajuan izin online cepat', 'Verifikasi oleh laboran', 'Peminjaman alat komputasi & multimedia'],
                'urutan' => 2,
            ],
            [
                'judul' => 'Uji Kompetensi & Sertifikasi IT',
                'slug' => 'uji-kompetensi-sertifikasi-it',
                'deskripsi_singkat' => 'Penyelenggaraan workshop dan uji kompetensi keahlian software development dan data analysis.',
                'sasaran' => 'umum',
                'cakupan' => ['Sertifikat resmi kompetensi', 'Instruktur praktisi industri', 'Materi relevan kebutuhan pasar kerja'],
                'urutan' => 3,
            ],
        ];
        foreach ($layananList as $l) {
            Layanan::updateOrCreate(['slug' => $l['slug']], $l);
        }

        // 8. Event / Agenda
        Event::updateOrCreate(['slug' => 'workshop-fullstack-laravel-react'], [
            'judul' => 'Workshop Fullstack Web Development: Laravel 11 & React Ecosystem',
            'slug' => 'workshop-fullstack-laravel-react',
            'kategori' => 'Workshop',
            'status' => 'Akan Datang',
            'status_registrasi' => 'Open',
            'tanggal' => now()->addDays(7)->toDateString(),
            'jam_mulai' => '08:30:00',
            'jam_selesai' => '12:00:00',
            'lokasi' => 'Laboratorium Komputasi B (Lab RPL)',
            'deskripsi' => 'Belajar langsung arsitektur fullstack modern menggunakan Laravel 11 sebagai backend API dan React.js untuk reactive UI interaktif.',
            'mentor_nama' => 'Fika Hastarita, M.Eng.',
            'mentor_role' => 'Dosen & Software Architect',
            'kuota_total' => 40,
        ]);

        // 9. Komunitas Forum Demo
        $thread = Thread::updateOrCreate(['slug' => 'tips-integrasi-supabase-di-laravel-11'], [
            'user_id' => $userMhs->id,
            'author_nama' => 'Mahasiswa SI Demo',
            'author_role' => 'Mahasiswa Angkatan 22',
            'judul' => 'Tips & Konfigurasi Supabase PostgreSQL di Laravel 11',
            'slug' => 'tips-integrasi-supabase-di-laravel-11',
            'body' => 'Bagi teman-teman yang ingin menghubungkan Laravel ke database Supabase, pastikan menggunakan Connection Pooler (port 6543) jika ISP lokal kalian belum mendukung direct IPv6!',
            'kategori' => 'Laravel',
            'code_language' => 'env',
            'code_content' => "DB_CONNECTION=pgsql\nDB_HOST=aws-0-ap-northeast-1.pooler.supabase.com\nDB_PORT=6543\nDB_DATABASE=postgres",
            'is_solved' => true,
            'views_count' => 84,
        ]);

        ThreadTag::firstOrCreate(['thread_id' => $thread->id, 'tag' => 'Laravel']);
        ThreadTag::firstOrCreate(['thread_id' => $thread->id, 'tag' => 'Supabase']);
        ThreadTag::firstOrCreate(['thread_id' => $thread->id, 'tag' => 'Database']);

        // 10. Contoh Peminjaman untuk Laboran
        $alat = Fasilitas::where('slug', 'ruang-riset-kolaboratif-lab-c')->first();
        Peminjaman::updateOrCreate(['nim_nip' => '220441100001', 'nama_alat_ruang' => 'Ruang Riset Kolaboratif Lab C'], [
            'user_id' => $userMhs->id,
            'fasilitas_id' => $alat?->id,
            'nama_alat_ruang' => 'Ruang Riset Kolaboratif Lab C',
            'nama_peminjam' => 'Mahasiswa SI Demo',
            'nim_nip' => '220441100001',
            'email' => 'user@utm.ac.id',
            'no_telp' => '083456789012',
            'tanggal_mulai' => now()->addDays(2)->toDateString(),
            'tanggal_selesai' => now()->addDays(2)->toDateString(),
            'durasi' => '3 Jam (13:00 - 16:00)',
            'keperluan' => 'Pengerjaan Proyek Capstone Tim Sistem Informasi Laboratorium',
            'status' => 'Pending',
        ]);
    }
}
