<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Fasilitas;
use App\Models\Riset;
use App\Models\Praktikum;
use App\Models\Peminjaman;

class LandingPageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_home_page_is_accessible_and_renders_database_records(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSeeText('Laboratorium Sistem Informasi');
        $response->assertSeeText('PC Server HP ProLiant ML350');
        $response->assertSeeText('Dr. Firman Maulana');
        $response->assertSeeText('Praktikum Jaringan Komputer');
    }

    public function test_fasilitas_page_is_accessible(): void
    {
        $response = $this->get('/fasilitas');
        $response->assertStatus(200);
        $response->assertSeeText('Katalog Fasilitas & Inventaris');
        $response->assertSeeText('PC Server HP ProLiant ML350');
    }

    public function test_inventaris_html_route_is_accessible(): void
    {
        $response = $this->get('/inventaris.html');
        $response->assertStatus(200);
        $response->assertSeeText('Katalog Fasilitas & Inventaris');
    }

    public function test_riset_page_is_accessible(): void
    {
        $response = $this->get('/riset');
        $response->assertStatus(200);
        $response->assertSeeText('Riset Dosen & Rekrutmen Asisten');
    }

    public function test_akademik_page_is_accessible(): void
    {
        $response = $this->get('/akademik');
        $response->assertStatus(200);
        $response->assertSeeText('Layanan Akademik & Praktikum Terpadu');
    }

    public function test_peminjaman_can_be_submitted_and_saved_to_database(): void
    {
        $payload = [
            'nama_alat'     => 'Router MikroTik CCR1036-8G-2S+',
            'nama_peminjam' => 'Ahmad Salman',
            'nim_nip'       => '230411100055',
            'durasi'        => '3 Hari (Tugas Besar)',
            'keperluan'     => 'Pengerjaan Ujian Praktikum Jarkom',
        ];

        $response = $this->post('/peminjaman', $payload);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('peminjaman', [
            'nama_alat'     => 'Router MikroTik CCR1036-8G-2S+',
            'nama_peminjam' => 'Ahmad Salman',
            'nim_nip'       => '230411100055',
            'status'        => 'Pending',
        ]);
    }
}
