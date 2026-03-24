<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exhibition extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'start_date', 'end_date',
        'banner_image', 'thumbnail', 'status', 'is_featured',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_featured' => 'boolean',
    ];

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class);
    }

    public function artworks(): HasMany
    {
        return $this->hasMany(Artwork::class);
    }

    public function scopeNow($query)
    {
        return $query->where('status', 'now');
    }

    public function scopeSoon($query)
    {
        return $query->where('status', 'soon');
    }

    public function scopePast($query)
    {
        return $query->where('status', 'past');
    }
}
