<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanLayanan extends Model
{
    protected $table = 'pengajuan_layanan';
    protected $fillable = [
        'user_id',
        'jenis',
        'referensi_id',
        'nama',
        'email',
        'nim_nip',
        'pesan',
        'status',
        'catatan_admin',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

