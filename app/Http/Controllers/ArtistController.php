<?php

namespace App\Http\Controllers;

use App\Models\Artist;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::where('is_active', true)->orderBy('name')->get();
        return view('artists.index', compact('artists'));
    }

    public function show(string $slug)
    {
        $artist = Artist::where('slug', $slug)
            ->with(['artworks', 'exhibitions' => fn($q) => $q->orderByDesc('start_date')])
            ->firstOrFail();
        return view('artists.show', compact('artist'));
    }
}
