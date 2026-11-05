<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilLaboratorium extends Model
{
    protected $table = 'profil_laboratorium';
    protected $fillable = ['jabatan', 'nama', 'gelar', 'foto_path', 'deskripsi', 'urutan', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];
}

