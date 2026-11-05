<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $fillable = ['nama', 'nip', 'foto_path', 'prodi', 'keahlian', 'bidang_minat', 'no_telp', 'email', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];
}

