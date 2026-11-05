<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanan';
    protected $fillable = ['judul', 'slug', 'deskripsi_singkat', 'deskripsi_lengkap', 'foto_path', 'sasaran', 'cakupan', 'urutan', 'is_active'];
    protected $casts = [
        'cakupan' => 'array',
        'is_active' => 'boolean',
    ];
}

