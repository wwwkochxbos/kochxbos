<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Exhibition;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminExhibitionController extends Controller
{
    public function index()
    {
        $exhibitions = Exhibition::with('artists')->orderByDesc('start_date')->paginate(20);
        return view('admin.exhibitions.index', compact('exhibitions'));
    }

    public function create()
    {
        $artists = Artist::orderBy('name')->get();
        return view('admin.exhibitions.form', ['exhibition' => null, 'artists' => $artists]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:now,soon,past',
            'is_featured' => 'boolean',
            'banner_image' => 'nullable|image|max:5120',
            'thumbnail' => 'nullable|image|max:2048',
            'artists' => 'nullable|array',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('banner_image')) {
            $data['banner_image'] = $request->file('banner_image')->store('exhibitions', 'public');
        }
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('exhibitions', 'public');
        }

        $exhibition = Exhibition::create($data);

        if ($request->has('artists')) {
            $exhibition->artists()->sync($request->artists);
        }

        return redirect()->route('admin.exhibitions.index')->with('success', 'Exhibition created.');
    }

    public function edit(Exhibition $exhibition)
    {
        $artists = Artist::orderBy('name')->get();
        return view('admin.exhibitions.form', compact('exhibition', 'artists'));
    }

    public function update(Request $request, Exhibition $exhibition)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:now,soon,past',
            'is_featured' => 'boolean',
            'banner_image' => 'nullable|image|max:5120',
            'thumbnail' => 'nullable|image|max:2048',
            'artists' => 'nullable|array',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('banner_image')) {
            $data['banner_image'] = $request->file('banner_image')->store('exhibitions', 'public');
        }
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('exhibitions', 'public');
        }

        $exhibition->update($data);

        if ($request->has('artists')) {
            $exhibition->artists()->sync($request->artists);
        }

        return redirect()->route('admin.exhibitions.index')->with('success', 'Exhibition updated.');
    }

    public function destroy(Exhibition $exhibition)
    {
        $exhibition->delete();
        return redirect()->route('admin.exhibitions.index')->with('success', 'Exhibition deleted.');
    }
}
