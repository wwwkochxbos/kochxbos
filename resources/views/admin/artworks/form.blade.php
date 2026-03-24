@extends('admin.layout')

@section('title', $artwork ? 'Edit Artwork' : 'New Artwork')

@section('content')
    <div class="admin-header">
        <h1>{{ $artwork ? 'Edit Artwork' : 'New Artwork' }}</h1>
    </div>

    <div class="admin-card">
        <form action="{{ $artwork ? route('admin.artworks.update', $artwork) : route('admin.artworks.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if($artwork) @method('PUT') @endif

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $artwork?->title) }}" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="artist_id">Artist</label>
                    <select name="artist_id" id="artist_id" required>
                        <option value="">Select artist...</option>
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}" {{ old('artist_id', $artwork?->artist_id) == $artist->id ? 'selected' : '' }}>
                                {{ $artist->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exhibition_id">Exhibition (optional)</label>
                    <select name="exhibition_id" id="exhibition_id">
                        <option value="">None</option>
                        @foreach($exhibitions as $exhibition)
                            <option value="{{ $exhibition->id }}" {{ old('exhibition_id', $artwork?->exhibition_id) == $exhibition->id ? 'selected' : '' }}>
                                {{ $exhibition->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description">{{ old('description', $artwork?->description) }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="medium">Medium</label>
                    <input type="text" name="medium" id="medium" value="{{ old('medium', $artwork?->medium) }}" placeholder="e.g. Oil on canvas">
                </div>
                <div class="form-group">
                    <label for="dimensions">Dimensions</label>
                    <input type="text" name="dimensions" id="dimensions" value="{{ old('dimensions', $artwork?->dimensions) }}" placeholder="e.g. 100 x 80 cm">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="number" name="year" id="year" value="{{ old('year', $artwork?->year) }}" min="1900" max="2100">
                </div>
                <div class="form-group">
                    <label for="price">Price (EUR)</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $artwork?->price) }}" step="0.01" min="0">
                </div>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" accept="image/*">
                @if($artwork?->image)
                    <div class="form-help">Current: {{ basename($artwork->image) }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="sort_order">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $artwork?->sort_order ?? 0) }}">
            </div>

            <div class="form-check">
                <input type="checkbox" name="is_available" id="is_available" value="1"
                    {{ old('is_available', $artwork?->is_available ?? true) ? 'checked' : '' }}>
                <label for="is_available" style="margin-bottom: 0;">Available for sale</label>
            </div>

            <div class="form-check">
                <input type="checkbox" name="is_sold" id="is_sold" value="1"
                    {{ old('is_sold', $artwork?->is_sold) ? 'checked' : '' }}>
                <label for="is_sold" style="margin-bottom: 0;">Sold</label>
            </div>

            <button type="submit" class="btn-admin btn-admin-primary">
                {{ $artwork ? 'Update Artwork' : 'Create Artwork' }}
            </button>
        </form>
    </div>
@endsection
