<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::orderBy('name')->paginate(20);
        return view('admin.artists.index', compact('artists'));
    }

    public function create()
    {
        return view('admin.artists.form', ['artist' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'country' => 'nullable|string|max:100',
            'website' => 'nullable|url|max:255',
            'instagram' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'thumbnail' => 'nullable|image|max:2048',
            'photo' => 'nullable|image|max:5120',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('artists', 'public');
        }
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('artists', 'public');
        }

        Artist::create($data);

        return redirect()->route('admin.artists.index')->with('success', 'Artist created.');
    }

    public function edit(Artist $artist)
    {
        return view('admin.artists.form', compact('artist'));
    }

    public function update(Request $request, Artist $artist)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'country' => 'nullable|string|max:100',
            'website' => 'nullable|url|max:255',
            'instagram' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'thumbnail' => 'nullable|image|max:2048',
            'photo' => 'nullable|image|max:5120',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('artists', 'public');
        }
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('artists', 'public');
        }

        $artist->update($data);

        return redirect()->route('admin.artists.index')->with('success', 'Artist updated.');
    }

    public function destroy(Artist $artist)
    {
        $artist->delete();
        return redirect()->route('admin.artists.index')->with('success', 'Artist deleted.');
    }
}
