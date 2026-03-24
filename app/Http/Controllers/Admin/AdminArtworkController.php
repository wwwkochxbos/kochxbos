<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Artwork;
use App\Models\Exhibition;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminArtworkController extends Controller
{
    public function index()
    {
        $artworks = Artwork::with('artist')->orderByDesc('created_at')->paginate(20);
        return view('admin.artworks.index', compact('artworks'));
    }

    public function create()
    {
        $artists = Artist::orderBy('name')->get();
        $exhibitions = Exhibition::orderByDesc('start_date')->get();
        return view('admin.artworks.form', ['artwork' => null, 'artists' => $artists, 'exhibitions' => $exhibitions]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'artist_id' => 'required|exists:artists,id',
            'exhibition_id' => 'nullable|exists:exhibitions,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'medium' => 'nullable|string|max:255',
            'dimensions' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:2100',
            'price' => 'nullable|numeric|min:0',
            'is_available' => 'boolean',
            'is_sold' => 'boolean',
            'image' => 'nullable|image|max:20480',
            'sort_order' => 'integer',
        ]);

        $data['slug'] = Str::slug($data['title'] . '-' . ($data['year'] ?? now()->year));
        $data['is_available'] = $request->boolean('is_available');
        $data['is_sold'] = $request->boolean('is_sold');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('artworks', 'public');
        }

        Artwork::create($data);

        return redirect()->route('admin.artworks.index')->with('success', 'Artwork created.');
    }

    public function edit(Artwork $artwork)
    {
        $artists = Artist::orderBy('name')->get();
        $exhibitions = Exhibition::orderByDesc('start_date')->get();
        return view('admin.artworks.form', compact('artwork', 'artists', 'exhibitions'));
    }

    public function update(Request $request, Artwork $artwork)
    {
        $data = $request->validate([
            'artist_id' => 'required|exists:artists,id',
            'exhibition_id' => 'nullable|exists:exhibitions,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'medium' => 'nullable|string|max:255',
            'dimensions' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:2100',
            'price' => 'nullable|numeric|min:0',
            'is_available' => 'boolean',
            'is_sold' => 'boolean',
            'image' => 'nullable|image|max:20480',
            'sort_order' => 'integer',
        ]);

        $data['slug'] = Str::slug($data['title'] . '-' . ($data['year'] ?? now()->year));
        $data['is_available'] = $request->boolean('is_available');
        $data['is_sold'] = $request->boolean('is_sold');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('artworks', 'public');
        }

        $artwork->update($data);

        return redirect()->route('admin.artworks.index')->with('success', 'Artwork updated.');
    }

    public function destroy(Artwork $artwork)
    {
        $artwork->delete();
        return redirect()->route('admin.artworks.index')->with('success', 'Artwork deleted.');
    }
}
