<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fasilitas;
use App\Models\Riset;
use App\Models\Praktikum;

class LandingPageSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Fasilitas
        Fasilitas::create([
            'nama_alat' => 'PC Server HP ProLiant ML350',
            'kode_alat' => 'SRV-01-UTM',
            'kategori' => 'Infrastruktur Komputasi',
            'gambar' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=600&q=80',
            'status' => 'Tersedia',
            'spesifikasi' => [
                'Processor' => 'Intel Xeon Silver 4210R',
                'Memory' => '64 GB DDR4 ECC Reg',
                'Storage' => '2x 1TB NVMe + 4TB HDD RAID',
                'Peruntukan' => 'Deployment Riset & Database',
            ],
        ]);

        Fasilitas::create([
            'nama_alat' => 'Router MikroTik CCR1036-8G-2S+',
            'kode_alat' => 'RTR-04-UTM',
            'kategori' => 'Perangkat Jaringan',
            'gambar' => 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?auto=format&fit=crop&w=600&q=80',
            'status' => 'Tersedia',
            'spesifikasi' => [
                'Architecture' => 'TILE-Gx36 Core CPU 1.2GHz',
                'Port Interface' => '8x Gigabit LAN + 2x SFP+ 10G',
                'Sistem Operasi' => 'RouterOS Level 6 License',
                'Peruntukan' => 'Praktikum Jarkom & Topologi BGP',
            ],
        ]);

        Fasilitas::create([
            'nama_alat' => 'Switch Cisco Catalyst 2960-X',
            'kode_alat' => 'SW-02-UTM',
            'kategori' => 'Switching & VLAN',
            'gambar' => 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?auto=format&fit=crop&w=600&q=80',
            'status' => 'Sedang Dipinjam',
            'spesifikasi' => [
                'Total Port' => '48x Gigabit Ethernet 10/100/1000',
                'Uplink' => '4x 1G SFP Ports',
                'Fitur' => 'LAN Base, FlexStack-Plus, VLAN',
                'Estimasi Kembali' => '28 September 2026',
            ],
        ]);

        // 2. Seed Riset
        Riset::create([
            'judul' => 'Analisis Sentimen Opini Publik Madura Menggunakan NLP Berbasis Transformer',
            'kategori' => 'AI & Data Science',
            'dosen_nama' => 'Dr. Firman Maulana, S.Kom., M.Kom.',
            'dosen_inisial' => 'FM',
            'deskripsi' => 'Pengembangan model klasifikasi sentimen multibahasa (Indonesia - Madura) menggunakan arsitektur IndoBERT guna memetakan persepsi publik terhadap digitalisasi layanan maritim.',
            'batas_waktu' => '2026-10-15',
            'skills' => ['Python', 'PyTorch', 'HuggingFace'],
        ]);

        Riset::create([
            'judul' => 'Perancangan UI/UX & Arsitektur Microservices Portal Smart Campus UTM',
            'kategori' => 'Rekayasa Web & Mobile',
            'dosen_nama' => 'Andini Nurulita, S.T., M.Sc.',
            'dosen_inisial' => 'AN',
            'deskripsi' => 'Riset desain interaksi manusia dan komputer (HCI) serta implementasi API gateway berbasis event-driven architecture untuk integrasi modul akademik terdistribusi.',
            'batas_waktu' => '2026-10-20',
            'skills' => ['Figma Design', 'Node.js', 'Docker'],
        ]);

        Riset::create([
            'judul' => 'Audit Tata Kelola Keamanan Informasi Layanan Publik Menggunakan COBIT 2019',
            'kategori' => 'Audit & Governance SI',
            'dosen_nama' => 'Rahmat Hidayat, S.Kom., M.MT.',
            'dosen_inisial' => 'RH',
            'deskripsi' => 'Analisis maturity level dan identifikasi capability gaps pada sistem data instansi daerah di Madura mengacu pada framework internasional COBIT 2019 dan ISO 27001.',
            'batas_waktu' => '2026-10-25',
            'skills' => ['COBIT 2019', 'Risk Assessment', 'Qualitative'],
        ]);

        // 3. Seed Praktikum
        Praktikum::create([
            'nama' => 'Praktikum Jaringan Komputer',
            'semester' => 3,
            'lab' => '1',
            'sks' => 4,
            'status_modul' => 'Modul 04 Aktif',
        ]);

        Praktikum::create([
            'nama' => 'Praktikum Basis Data Lanjut',
            'semester' => 3,
            'lab' => '2',
            'sks' => 3,
            'status_modul' => 'Modul 05 Aktif',
        ]);

        Praktikum::create([
            'nama' => 'Praktikum Rekayasa Web & API',
            'semester' => 5,
            'lab' => '3',
            'sks' => 4,
            'status_modul' => 'Modul 06 Aktif',
        ]);

        Praktikum::create([
            'nama' => 'Praktikum Audit & Tata Kelola SI',
            'semester' => 7,
            'lab' => '4',
            'sks' => 3,
            'status_modul' => 'Modul 03 Aktif',
        ]);
    }
}
