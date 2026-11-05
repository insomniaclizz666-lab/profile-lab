<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Testimoni;
use App\Models\Faq;

class BeritaGaleriTestimoniSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Berita & Pengumuman
        $beritaList = [
            [
                'judul' => 'Laboratorium Sistem Informasi Resmikan Ruang Riset AI & Cloud Computing',
                'slug' => 'laboratorium-sistem-informasi-resmikan-ruang-riset-ai-dan-cloud',
                'kategori' => 'Berita',
                'ringkasan' => 'Pengembangan fasilitas workstation berkinerja tinggi guna mendukung capstone project, komputasi terdistribusi, dan penelitian AI terapan civitas akademika.',
                'isi' => "Laboratorium Sistem Informasi Universitas Trunojoyo Madura secara resmi memperkenalkan ruang riset komputasi mutakhir berbasis Artificial Intelligence (AI) dan Cloud Computing. Inisiatif ini digagas untuk merespons meningkatnya kebutuhan komputasi riset mahasiswa dan dosen pengampu.\n\nFasilitas ini dilengkapi dengan workstation high-end spesifikasi terbaru, layar interaktif 75 inci 4K, serta koneksi fiber optik gigabit berkecepatan tinggi yang terhubung langsung ke cluster server lokal lab.\n\nKepala Laboratorium SI, Achmad Jauhari, S.T., M.Kom., menyampaikan bahwa kehadiran ruang baru ini diharapkan dapat mendongkrak luaran publikasi ilmiah, prototipe startup digital, serta persiapan tim mahasiswa menjelang kompetisi nasional seperti GEMASTIK dan KMHE.\n\nMahasiswa yang sedang menempuh tugas akhir atau proyek riset independen dapat mengajukan izin pemanfaatan sarana ini melalui sistem peminjaman website laboratorium.",
                'penulis' => 'Humas Lab SI',
                'foto_path' => null,
                'published_at' => now()->subDays(2),
                'views' => 142,
                'is_active' => true,
            ],
            [
                'judul' => 'Open Recruitment Asisten Praktikum Laboratorium SI Semester Genap 2026/2027',
                'slug' => 'open-recruitment-asisten-praktikum-lab-si-semester-genap-2026',
                'kategori' => 'Pengumuman',
                'ringkasan' => 'Kesempatan bagi mahasiswa aktif angkatan 2023 & 2024 untuk mengembangkan kemampuan kepemimpinan teknis serta mentoring laboratorium.',
                'isi' => "Laboratorium Sistem Informasi membuka pendaftaran asisten praktikum untuk semester mendatang bagi mata kuliah Pemrograman Berorientasi Objek, Basis Data Lanjut, Rekayasa Perangkat Lunak, dan Jaringan Komputer.\n\nKualifikasi Pendaftar:\n1. Mahasiswa aktif Program Studi Sistem Informasi minimal Semester 3.\n2. Telah menempuh mata kuliah yang dilamar dengan nilai minimal B+.\n3. Memiliki komitmen tinggi, tanggung jawab, dan komunikasi yang baik.\n4. Siap mematuhi tata tertib dan SOP laboratorium.\n\nJadwal Seleksi:\n- Pengisian Berkas: 10 - 20 November 2026\n- Seleksi Kompetensi Koding & Asesmen: 22 November 2026\n- Wawancara Dosen Pembina: 25 November 2026\n- Pengumuman Akhir: 28 November 2026\n\nBagi calon asisten yang berminat, silakan mengunduh format silabus dan mendaftar melalui formulir yang tersedia di bagian layanan laboratorium.",
                'penulis' => 'Koordinator Asisten Lab',
                'foto_path' => null,
                'published_at' => now()->subDays(5),
                'views' => 380,
                'is_active' => true,
            ],
            [
                'judul' => 'Jadwal Pelaksanaan Ujian Akhir Praktikum (UAP) Semester Ganjil 2026',
                'slug' => 'jadwal-pelaksanaan-ujian-akhir-praktikum-uap-semester-ganjil-2026',
                'kategori' => 'Pengumuman',
                'ringkasan' => 'Seluruh praktikan diwajibkan memeriksa jadwal sesi koding mandiri, verifikasi modul, dan presensi minimum 80%.',
                'isi' => "Diberitahukan kepada seluruh praktikan Laboratorium Sistem Informasi bahwa Ujian Akhir Praktikum (UAP) Semester Ganjil akan diselenggarakan serentak mulai tanggal 15 hingga 19 Desember 2026 di Ruang Lab A dan Lab B.\n\nKetentuan Peserta UAP:\n1. Wajib hadir 15 menit sebelum sesi dimulai dengan mengenakan pakaian formal berkerah dan jas almamater.\n2. Membawa Kartu Tanda Mahasiswa (KTM) atau KRS resmi.\n3. Telah menuntaskan seluruh modul dan tugas asistensi mingguan.\n4. Tingkat kehadiran minimal praktikum adalah 80% dari total pertemuan tatap muka.\n\nPraktikan yang mengalami bentrok jadwal kuliah diwajibkan segera melapor ke laboran paling lambat H-3 sebelum ujian berlangsung.",
                'penulis' => 'Admin Akademik Lab',
                'foto_path' => null,
                'published_at' => now()->subDays(8),
                'views' => 256,
                'is_active' => true,
            ],
        ];

        foreach ($beritaList as $b) {
            Berita::updateOrCreate(['slug' => $b['slug']], $b);
        }

        // 2. Galeri Kegiatan
        $galeriList = [
            [
                'judul' => 'Praktikum Algoritma & Pemrograman Berorientasi Objek',
                'deskripsi' => 'Mahasiswa tingkat awal mengimplementasikan design pattern dan debugging kode di Lab Komputasi A.',
                'kategori' => 'Praktikum',
                'foto_path' => null,
                'urutan' => 1,
            ],
            [
                'judul' => 'Workshop DevOps & Containerization Docker',
                'deskripsi' => 'Hands-on konfigurasi container docker dan deployment aplikasi berbasis microservices bersama praktisi.',
                'kategori' => 'Workshop',
                'foto_path' => null,
                'urutan' => 2,
            ],
            [
                'judul' => 'Riset Kolaboratif Machine Learning Mahasiswa & Dosen',
                'deskripsi' => 'Pengujian dataset citra pertanian dan pemrosesan data tabular di Ruang Riset Kolaboratif Lab C.',
                'kategori' => 'Riset',
                'foto_path' => null,
                'urutan' => 3,
            ],
            [
                'judul' => 'Pelatihan Sertifikasi Kompetensi Database Administrator',
                'deskripsi' => 'Peningkatan kompetensi SQL tuning dan perancangan indeks database relasional skala besar.',
                'kategori' => 'Workshop',
                'foto_path' => null,
                'urutan' => 4,
            ],
            [
                'judul' => 'Sesi Asistensi & Mentoring Peer-to-Peer',
                'deskripsi' => 'Asisten lab membimbing kelompok praktikan dalam menyelesaikan proyek capstone terpadu.',
                'kategori' => 'Praktikum',
                'foto_path' => null,
                'urutan' => 5,
            ],
            [
                'judul' => 'Presentasi Akhir Proyek Sistem Informasi Enterprise',
                'deskripsi' => 'Demo prototipe sistem berbasis web dan evaluasi langsung oleh dosen pembina laboratorium.',
                'kategori' => 'Riset',
                'foto_path' => null,
                'urutan' => 6,
            ],
        ];

        foreach ($galeriList as $g) {
            Galeri::updateOrCreate(['judul' => $g['judul']], $g);
        }

        // 3. Testimoni Mahasiswa & Asisten
        $testimoniList = [
            [
                'nama' => 'Rizky Maulana',
                'role' => 'Asisten Lab Basis Data',
                'angkatan' => 'Angkatan 2022',
                'kutipan' => 'Menjadi asisten di Lab SI UTM memberikan pengalaman mentoring nyata dan memperdalam pemahaman arsitektur database modern. Dukungan fasilitas laboratorium sangat membantu saya bertransformasi menjadi software engineer yang kompeten.',
                'foto_path' => null,
                'urutan' => 1,
            ],
            [
                'nama' => 'Siti Rahmawati',
                'role' => 'Mahasiswa Berprestasi',
                'angkatan' => 'Angkatan 2023',
                'kutipan' => 'Fasilitas workstation dan server di lab sangat mumpuni untuk melatih model deep learning capstone project tim kami. Laboran dan dosen pembina selalu cepat tanggap dan suportif terhadap eksplorasi riset mahasiswa.',
                'foto_path' => null,
                'urutan' => 2,
            ],
            [
                'nama' => 'Dimas Pratama',
                'role' => 'Alumni - Software Engineer PT Telkom',
                'angkatan' => 'Alumni Angkatan 2020',
                'kutipan' => 'Fondasi hands-on praktikum di Wargalab SI UTM menjadi bekal utama saya menghadapi tantangan sistem enterprise berskala nasional di industri digital saat ini. Budaya belajar kolaboratifnya sangat luar biasa.',
                'foto_path' => null,
                'urutan' => 3,
            ],
        ];

        foreach ($testimoniList as $t) {
            Testimoni::updateOrCreate(['nama' => $t['nama']], $t);
        }

        // 4. FAQ
        $faqList = [
            [
                'pertanyaan' => 'Bagaimana prosedur peminjaman alat atau ruang laboratorium SI?',
                'jawaban' => 'Mahasiswa dapat langsung mengajukan peminjaman melalui formulir di halaman Fasilitas tanpa harus login terlebih dahulu. Sertakan email dan nomor WhatsApp aktif sebagai log kontak peminjam. Laboran akan meninjau dan mengonfirmasi izin dalam kurun waktu 1x24 jam kerja.',
                'halaman' => 'umum',
                'urutan' => 1,
            ],
            [
                'pertanyaan' => 'Apa saja persyaratan untuk mendaftar sebagai Asisten Laboratorium?',
                'jawaban' => 'Syarat utamanya adalah mahasiswa aktif Program Studi Sistem Informasi minimal semester 3, memiliki nilai minimal B+ pada mata kuliah terkait, tidak sedang terkena sanksi akademik, serta lolos tahapan tes kompetensi teknis dan wawancara asistensi.',
                'halaman' => 'umum',
                'urutan' => 2,
            ],
            [
                'pertanyaan' => 'Kapan jadwal praktikum reguler dilaksanakan dan bagaimana melihatnya?',
                'jawaban' => 'Jadwal praktikum semester berjalan diumumkan sebelum masa perkuliahan dimulai dan dapat diakses pada halaman Layanan atau papan pengumuman laboratorium. Praktikum reguler umumnya berlangsung hari Senin hingga Jumat pukul 07.30 - 17.00 WIB.',
                'halaman' => 'umum',
                'urutan' => 3,
            ],
            [
                'pertanyaan' => 'Apakah mahasiswa boleh memanfaatkan fasilitas komputer di luar jam praktikum?',
                'jawaban' => 'Boleh. Mahasiswa dipersilakan menggunakan fasilitas komputer untuk kebutuhan riset, tugas akhir, atau koding mandiri selama ruangan tidak sedang dipakai untuk sesi praktikum terjadwal dan telah melapor kepada laboran piket.',
                'halaman' => 'umum',
                'urutan' => 4,
            ],
        ];

        foreach ($faqList as $f) {
            Faq::updateOrCreate(['pertanyaan' => $f['pertanyaan']], $f);
        }
    }
}

