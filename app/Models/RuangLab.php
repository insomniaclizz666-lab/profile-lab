<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuangLab extends Model
{
    protected $table = 'ruang_lab';
    protected $fillable = ['kode', 'nama_ruang', 'kapasitas_pc', 'lokasi', 'deskripsi', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function mataKuliah()
    {
        return $this->hasMany(MataKuliahPraktikum::class, 'ruang_lab_id');
    }
}

