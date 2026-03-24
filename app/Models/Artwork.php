<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artwork extends Model
{
    protected $fillable = [
        'artist_id', 'exhibition_id', 'title', 'slug', 'description',
        'medium', 'dimensions', 'year', 'price', 'is_available',
        'is_sold', 'image', 'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
        'is_sold' => 'boolean',
    ];

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    public function exhibition(): BelongsTo
    {
        return $this->belongsTo(Exhibition::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ArtworkImage::class)->orderBy('sort_order');
    }
}
