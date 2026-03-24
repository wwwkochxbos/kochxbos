@extends('admin.layout')

@section('title', $news ? 'Edit News' : 'New News')

@section('content')
    <div class="admin-header">
        <h1>{{ $news ? 'Edit Article' : 'New Article' }}</h1>
    </div>

    <div class="admin-card">
        <form action="{{ $news ? route('admin.news.update', $news) : route('admin.news.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if($news) @method('PUT') @endif

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $news?->title) }}" required>
            </div>

            <div class="form-group">
                <label for="excerpt">Excerpt</label>
                <textarea name="excerpt" id="excerpt" style="min-height: 80px;">{{ old('excerpt', $news?->excerpt) }}</textarea>
            </div>

            <div class="form-group">
                <label for="body">Body</label>
                <textarea name="body" id="body" style="min-height: 300px;">{{ old('body', $news?->body) }}</textarea>
            </div>

            <div class="form-group">
                <label for="published_at">Publish Date</label>
                <input type="date" name="published_at" id="published_at" value="{{ old('published_at', $news?->published_at?->format('Y-m-d')) }}">
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" accept="image/*">
                @if($news?->image)
                    <div class="form-help">Current: {{ basename($news->image) }}</div>
                @endif
            </div>

            <div class="form-check">
                <input type="checkbox" name="is_published" id="is_published" value="1"
                    {{ old('is_published', $news?->is_published) ? 'checked' : '' }}>
                <label for="is_published" style="margin-bottom: 0;">Published</label>
            </div>

            <button type="submit" class="btn-admin btn-admin-primary">
                {{ $news ? 'Update Article' : 'Create Article' }}
            </button>
        </form>
    </div>
@endsection
