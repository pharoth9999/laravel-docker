<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //
    protected $fillable = ['name', 'user_id'];

    // 1. Author has one User
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    // 3. Author wrote multiple Articles
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    // 7. Author has many comments (Polymorphic)
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    // 9. Author has many audiences (hasManyThrough)
    public function audiences(): HasManyThrough
    {
        return $this->hasManyThrough(
            Audience::class,
            Article::class,
            'author_id',   // FK on articles table
            'article_id',  // FK on audiences table
            'id',
            'id'
        );
    }

}
