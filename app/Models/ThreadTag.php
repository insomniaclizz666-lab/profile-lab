<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThreadTag extends Model
{
    protected $table = 'thread_tags';
    protected $fillable = ['thread_id', 'tag'];

    public function thread()
    {
        return $this->belongsTo(Thread::class, 'thread_id');
    }
}

