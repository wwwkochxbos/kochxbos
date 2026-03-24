<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artist extends Model
{
    protected $fillable = [
        'name', 'slug', 'bio', 'country', 'website', 'instagram',
        'photo', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function exhibitions(): BelongsToMany
    {
        return $this->belongsToMany(Exhibition::class);
    }

    public function artworks(): HasMany
    {
        return $this->hasMany(Artwork::class);
    }

    public function availableArtworks(): HasMany
    {
        return $this->hasMany(Artwork::class)->where('is_available', true)->where('is_sold', false);
    }

    /** Path on the public disk for list/grid images (generated thumbnail, or photo fallback). */
    public function getGridImagePathAttribute(): ?string
    {
        return $this->thumbnail ?? $this->photo;
    }
}
