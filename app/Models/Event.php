<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'status',
        'status_registrasi',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'lokasi',
        'deskripsi',
        'thumbnail_path',
        'mentor_nama',
        'mentor_role',
        'mentor_avatar_path',
        'kuota_total',
        'is_active',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'is_active' => 'boolean',
    ];

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class, 'event_id');
    }

    public function materials()
    {
        return $this->hasMany(EventMaterial::class, 'event_id');
    }

    public function getFilledQuotaAttribute(): int
    {
        return $this->registrations()->where('status', '!=', 'cancelled')->count();
    }
}

