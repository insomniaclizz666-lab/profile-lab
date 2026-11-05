<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModulPraktikum extends Model
{
    protected $table = 'modul_praktikum';
    protected $fillable = ['mata_kuliah_id', 'judul', 'file_path', 'versi', 'published_at'];
    protected $casts = ['published_at' => 'datetime'];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliahPraktikum::class, 'mata_kuliah_id');
    }
}

