<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliahPraktikum extends Model
{
    protected $table = 'mata_kuliah_praktikum';
    protected $fillable = [
        'ruang_lab_id',
        'nama',
        'semester',
        'sks',
        'status',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'kelas',
        'dosen_pengampu',
    ];

    public function ruangLab()
    {
        return $this->belongsTo(RuangLab::class, 'ruang_lab_id');
    }

    public function modul()
    {
        return $this->hasMany(ModulPraktikum::class, 'mata_kuliah_id');
    }
}

