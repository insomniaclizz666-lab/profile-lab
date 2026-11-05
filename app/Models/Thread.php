<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thread extends Model
{
    use SoftDeletes;

    protected $table = 'threads';
    protected $fillable = [
        'user_id',
        'author_nama',
        'author_role',
        'author_avatar_path',
        'judul',
        'slug',
        'body',
        'kategori',
        'code_language',
        'code_content',
        'is_solved',
        'views_count',
    ];

    protected $casts = [
        'is_solved' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function votes()
    {
        return $this->hasMany(ThreadVote::class, 'thread_id');
    }

    public function tags()
    {
        return $this->hasMany(ThreadTag::class, 'thread_id');
    }

    public function getUpvotesCountAttribute(): int
    {
        return $this->votes()->where('tipe', 'up')->count();
    }

    public function getDownvotesCountAttribute(): int
    {
        return $this->votes()->where('tipe', 'down')->count();
    }

    public function getScoreAttribute(): int
    {
        return $this->upvotes_count - $this->downvotes_count;
    }
}

