<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $fillable = [
        'code',
        'name',
        'price',
        'stock',
        'image',
        'category_id',
        'user_id'
    ];

    protected $appends = ['image_url'];

    /**
     * Devuelve la URL pública de la imagen o null si no tiene.
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? Storage::disk('public')->url($this->image) : null;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
