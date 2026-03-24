<?php

namespace App\Http\Controllers;

use App\Models\Exhibition;

class ExhibitionController extends Controller
{
    public function now()
    {
        $exhibitions = Exhibition::now()->with('artists')->orderByDesc('start_date')->get();
        return view('exhibitions.index', ['exhibitions' => $exhibitions, 'section' => 'NOW']);
    }

    public function soon()
    {
        $exhibitions = Exhibition::soon()->with('artists')->orderBy('start_date')->get();
        return view('exhibitions.index', ['exhibitions' => $exhibitions, 'section' => 'SOON']);
    }

    public function past()
    {
        $exhibitions = Exhibition::past()->with('artists')->orderByDesc('start_date')->paginate(12);
        return view('exhibitions.past', compact('exhibitions'));
    }

    public function show(string $slug)
    {
        $exhibition = Exhibition::where('slug', $slug)->with(['artists', 'artworks.artist'])->firstOrFail();
        return view('exhibitions.show', compact('exhibition'));
    }
}
