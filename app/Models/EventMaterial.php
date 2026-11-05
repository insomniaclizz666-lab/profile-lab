<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventMaterial extends Model
{
    protected $table = 'event_materials';
    protected $fillable = ['event_id', 'nama', 'tipe', 'file_path', 'github_url'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}

