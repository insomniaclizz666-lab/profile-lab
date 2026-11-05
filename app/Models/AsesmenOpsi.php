<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsesmenOpsi extends Model
{
    protected $table = 'asesmen_opsi';
    protected $fillable = ['pertanyaan_id', 'teks', 'nilai_bidang', 'urutan'];

    public function pertanyaan()
    {
        return $this->belongsTo(AsesmenPertanyaan::class, 'pertanyaan_id');
    }
}

