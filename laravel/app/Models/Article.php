<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable = ['name', 'author_id'];
    
    // 3. Article belongs to Author
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    // 4. Article has many Audiences
    public function audiences(): HasMany
    {
        return $this->hasMany(Audience::class);
    }

    // 6. Article has many comments (Polymorphic)
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
