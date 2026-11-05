<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $fillable = [
        'user_id',
        'fasilitas_id',
        'nama_alat_ruang',
        'nama_peminjam',
        'nim_nip',
        'email',
        'no_telp',
        'tanggal_mulai',
        'tanggal_selesai',
        'durasi',
        'keperluan',
        'status', // Pending, Disetujui, Ditolak, Selesai
        'catatan_laboran',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class, 'fasilitas_id');
    }
}
