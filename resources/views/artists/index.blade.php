@extends('layouts.app')

@section('title', 'Artists - KochxBos Gallery')

@section('breadcrumb')
    <a href="{{ route('home') }}">Home</a>
    <span class="separator">&gt;</span>
    Artists
@endsection

@section('content')
    <div class="section-header">
        <h2>Artists</h2>
    </div>

    @if($artists->isNotEmpty())
        <div class="artist-grid">
            @foreach($artists as $artist)
                <a href="{{ route('artists.show', $artist->slug) }}" class="artist-box">
                    @if($artist->grid_image_path)
                        <img src="{{ public_storage_url($artist->grid_image_path) }}" alt="{{ $artist->name }}">
                    @else
                        <div class="artist-box-placeholder">
                            {{ strtoupper(substr($artist->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="artist-name">{{ $artist->name }}</div>
                </a>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <h3>No artists found</h3>
        </div>
    @endif
@endsection
