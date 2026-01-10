<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

    protected $fillable = ['name', 'user_id'];

    // 8. Comment belongs to User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Polymorphic: Comment belongs to Audience / Article / Author
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
}
