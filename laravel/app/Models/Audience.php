<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audience extends Model
{
    //
    protected $fillable = ['name', 'article_id', 'user_id'];

    // 2. Audience has one User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // 4. Audience belongs to Article
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    // 5. Audience has many comments (Polymorphic)
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
