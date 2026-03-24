@extends('layouts.app')

@section('title', $artist->name . ' - KochxBos Gallery')

@section('breadcrumb')
    <a href="{{ route('home') }}">Home</a>
    <span class="separator">&gt;</span>
    <a href="{{ route('artists.index') }}">Artists</a>
    <span class="separator">&gt;</span>
    {{ $artist->name }}
@endsection

@section('content')
    <div class="artist-detail">
        <div class="artist-header">
            <div class="artist-photo">
                @if($artist->photo)
                    <img src="{{ public_storage_url($artist->photo) }}" alt="{{ $artist->name }}">
                @else
                    <div class="artist-box-placeholder" style="height: 100%;">
                        {{ strtoupper(substr($artist->name, 0, 1)) }}
                    </div>
                @endif
            </div>
            <div class="artist-info">
                <h1>{{ $artist->name }}</h1>
                @if($artist->country)
                    <p class="artist-country">{{ $artist->country }}</p>
                @endif
                @if($artist->bio)
                    <div class="artist-bio">
                        {!! nl2br(e($artist->bio)) !!}
                    </div>
                @endif
                <div class="artist-links">
                    @if($artist->website)
                        <a href="{{ $artist->website }}" target="_blank" rel="noopener">Website</a>
                    @endif
                    @if($artist->instagram)
                        <a href="{{ $artist->instagram }}" target="_blank" rel="noopener">Instagram</a>
                    @endif
                </div>
            </div>
        </div>

        @if($artist->artworks->isNotEmpty())
            <div class="section-header" style="text-align: left; padding-left: 0;">
                <h2>Works</h2>
            </div>
            <div class="artwork-grid" style="padding-left: 0; padding-right: 0;">
                @foreach($artist->artworks as $artwork)
                    <a href="{{ route('artworks.show', $artwork->slug) }}" class="artwork-card">
                        <div class="artwork-card-image">
                            @if($artwork->image)
                                <img src="{{ public_storage_url($artwork->image) }}" alt="{{ $artwork->title }}">
                            @endif
                        </div>
                        <div class="artwork-card-info">
                            <div class="artwork-card-title">{{ $artwork->title }}</div>
                            @if($artwork->price && !$artwork->is_sold)
                                <div class="artwork-card-price">&euro; {{ number_format($artwork->price, 0, ',', '.') }}</div>
                            @elseif($artwork->is_sold)
                                <div class="artwork-card-sold">Sold</div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

        @if($artist->exhibitions->isNotEmpty())
            <div class="section-header" style="text-align: left; padding-left: 0;">
                <h2>Exhibitions</h2>
            </div>
            <div class="exhibition-grid" style="padding-left: 0; padding-right: 0;">
                @foreach($artist->exhibitions as $exhibition)
                    <a href="{{ route('exhibitions.show', $exhibition->slug) }}" class="exhibition-card">
                        @if($exhibition->thumbnail)
                            <img src="{{ public_storage_url($exhibition->thumbnail) }}" alt="{{ $exhibition->title }}">
                        @else
                            <div class="exhibition-placeholder"></div>
                        @endif
                        <div class="exhibition-card-info">
                            <h3>{{ $exhibition->title }}</h3>
                            <p class="exhibition-card-dates">
                                {{ $exhibition->start_date->format('M d') }} &mdash; {{ $exhibition->end_date->format('M d, Y') }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
