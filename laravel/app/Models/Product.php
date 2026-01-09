<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'pricing',
        'description',
        'images',
        'created_by',
    ];

    protected $casts = [
        'images' => 'array',
        'pricing' => 'float',
    ];

    /**
     * Relationship: Product belongs to Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
