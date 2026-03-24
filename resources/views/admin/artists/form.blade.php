@extends('admin.layout')

@section('title', $artist ? 'Edit Artist' : 'New Artist')

@section('content')
    <div class="admin-header">
        <h1>{{ $artist ? 'Edit Artist' : 'New Artist' }}</h1>
    </div>

    <div class="admin-card">
        <form action="{{ $artist ? route('admin.artists.update', $artist) : route('admin.artists.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if($artist) @method('PUT') @endif

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $artist?->name) }}" required>
            </div>

            <div class="form-group">
                <label for="bio">Biography</label>
                <textarea name="bio" id="bio" style="min-height: 200px;">{{ old('bio', $artist?->bio) }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" name="country" id="country" value="{{ old('country', $artist?->country) }}">
                </div>
                <div class="form-group">
                    <label for="sort_order">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $artist?->sort_order ?? 0) }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="website">Website URL</label>
                    <input type="url" name="website" id="website" value="{{ old('website', $artist?->website) }}">
                </div>
                <div class="form-group">
                    <label for="instagram">Instagram URL</label>
                    <input type="text" name="instagram" id="instagram" value="{{ old('instagram', $artist?->instagram) }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="thumbnail">Thumbnail (Grid Image)</label>
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*">
                    @if($artist?->thumbnail)
                        <div class="form-help">Current: {{ basename($artist->thumbnail) }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="photo">Full Photo</label>
                    <input type="file" name="photo" id="photo" accept="image/*">
                    @if($artist?->photo)
                        <div class="form-help">Current: {{ basename($artist->photo) }}</div>
                    @endif
                </div>
            </div>

            <div class="form-check">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                    {{ old('is_active', $artist?->is_active ?? true) ? 'checked' : '' }}>
                <label for="is_active" style="margin-bottom: 0;">Active (visible on site)</label>
            </div>

            <button type="submit" class="btn-admin btn-admin-primary">
                {{ $artist ? 'Update Artist' : 'Create Artist' }}
            </button>
        </form>
    </div>
@endsection
