@extends('layouts.app')

@section('title', 'Available Works - KochxBos Gallery')

@section('breadcrumb')
    <a href="{{ route('home') }}">Home</a>
    <span class="separator">&gt;</span>
    Available
@endsection

@section('content')
    <div class="section-header">
        <h2>Available Works</h2>
    </div>

    @if($artworks->isNotEmpty())
        <div class="artwork-grid">
            @foreach($artworks as $artwork)
                <a href="{{ route('artworks.show', $artwork->slug) }}" class="artwork-card">
                    <div class="artwork-card-image">
                        @if($artwork->image)
                            <img src="{{ asset('storage/' . $artwork->image) }}" alt="{{ $artwork->title }}">
                        @endif
                    </div>
                    <div class="artwork-card-info">
                        <div class="artwork-card-title">{{ $artwork->title }}</div>
                        <div class="artwork-card-artist">{{ $artwork->artist->name }}</div>
                        @if($artwork->price)
                            <div class="artwork-card-price">&euro; {{ number_format($artwork->price, 0, ',', '.') }}</div>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
        <div class="pagination-wrapper">
            {{ $artworks->links() }}
        </div>
    @else
        <div class="empty-state">
            <h3>No available works at the moment</h3>
            <p>Please check back soon or contact the gallery for inquiries</p>
        </div>
    @endif
@endsection
