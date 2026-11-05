<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $table = 'event_registrations';
    protected $fillable = ['event_id', 'user_id', 'nama', 'nim', 'email', 'angkatan', 'status', 'registered_at'];
    protected $casts = ['registered_at' => 'datetime'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

