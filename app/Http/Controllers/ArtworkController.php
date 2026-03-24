<?php

namespace App\Http\Controllers;

use App\Models\Artwork;

class ArtworkController extends Controller
{
    public function available()
    {
        $artworks = Artwork::where('is_available', true)
            ->where('is_sold', false)
            ->with('artist')
            ->orderByDesc('created_at')
            ->paginate(24);

        return view('artworks.available', compact('artworks'));
    }

    public function show(string $slug)
    {
        $artwork = Artwork::where('slug', $slug)->with(['artist', 'images', 'exhibition'])->firstOrFail();
        return view('artworks.show', compact('artwork'));
    }
}
