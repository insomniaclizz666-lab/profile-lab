<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThreadVote extends Model
{
    protected $table = 'thread_votes';
    protected $fillable = ['thread_id', 'user_id', 'voter_ip', 'tipe'];

    public function thread()
    {
        return $this->belongsTo(Thread::class, 'thread_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

