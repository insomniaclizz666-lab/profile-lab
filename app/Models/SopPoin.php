<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SopPoin extends Model
{
    protected $table = 'sop_poin';
    protected $fillable = ['halaman', 'isi', 'urutan', 'icon_type', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];
}

