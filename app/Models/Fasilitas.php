<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';
    protected $fillable = [
        'judul',
        'slug',
        'deskripsi_singkat',
        'deskripsi_lengkap',
        'foto_path',
        'kategori',
        'sasaran',
        'cakupan',
        'status_ketersediaan',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'cakupan' => 'array',
        'is_active' => 'boolean',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'fasilitas_id');
    }
}
