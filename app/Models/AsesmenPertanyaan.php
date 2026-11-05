<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsesmenPertanyaan extends Model
{
    protected $table = 'asesmen_pertanyaan';
    protected $fillable = ['pertanyaan', 'urutan', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function opsi()
    {
        return $this->hasMany(AsesmenOpsi::class, 'pertanyaan_id')->orderBy('urutan');
    }
}

