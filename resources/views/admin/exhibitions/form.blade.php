@extends('admin.layout')

@section('title', $exhibition ? 'Edit Exhibition' : 'New Exhibition')

@section('content')
    <div class="admin-header">
        <h1>{{ $exhibition ? 'Edit Exhibition' : 'New Exhibition' }}</h1>
    </div>

    <div class="admin-card">
        <form action="{{ $exhibition ? route('admin.exhibitions.update', $exhibition) : route('admin.exhibitions.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if($exhibition) @method('PUT') @endif

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $exhibition?->title) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description">{{ old('description', $exhibition?->description) }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $exhibition?->start_date?->format('Y-m-d')) }}" required>
                </div>
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $exhibition?->end_date?->format('Y-m-d')) }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="soon" {{ old('status', $exhibition?->status) === 'soon' ? 'selected' : '' }}>Soon</option>
                    <option value="now" {{ old('status', $exhibition?->status) === 'now' ? 'selected' : '' }}>Now</option>
                    <option value="past" {{ old('status', $exhibition?->status) === 'past' ? 'selected' : '' }}>Past</option>
                </select>
            </div>

            <div class="form-group">
                <label>Artists</label>
                <select name="artists[]" multiple style="min-height: 120px;">
                    @foreach($artists as $artist)
                        <option value="{{ $artist->id }}"
                            {{ ($exhibition && $exhibition->artists->contains($artist->id)) ? 'selected' : '' }}>
                            {{ $artist->name }}
                        </option>
                    @endforeach
                </select>
                <div class="form-help">Hold Ctrl/Cmd to select multiple artists</div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="banner_image">Banner Image</label>
                    <input type="file" name="banner_image" id="banner_image" accept="image/*">
                    @if($exhibition?->banner_image)
                        <div class="form-help">Current: {{ basename($exhibition->banner_image) }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="thumbnail">Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*">
                    @if($exhibition?->thumbnail)
                        <div class="form-help">Current: {{ basename($exhibition->thumbnail) }}</div>
                    @endif
                </div>
            </div>

            <div class="form-check">
                <input type="checkbox" name="is_featured" id="is_featured" value="1"
                    {{ old('is_featured', $exhibition?->is_featured) ? 'checked' : '' }}>
                <label for="is_featured" style="margin-bottom: 0;">Featured Exhibition</label>
            </div>

            <button type="submit" class="btn-admin btn-admin-primary">
                {{ $exhibition ? 'Update Exhibition' : 'Create Exhibition' }}
            </button>
        </form>
    </div>
@endsection
