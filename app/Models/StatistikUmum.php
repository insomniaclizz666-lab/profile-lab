<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatistikUmum extends Model
{
    protected $table = 'statistik_umum';
    protected $fillable = ['key', 'label', 'nilai', 'satuan', 'urutan', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];
}

