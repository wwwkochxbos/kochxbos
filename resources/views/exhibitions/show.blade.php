@extends('layouts.app')

@section('title', $exhibition->title . ' - KochxBos Gallery')

@section('breadcrumb')
    <a href="{{ route('home') }}">Home</a>
    <span class="separator">&gt;</span>
    <a href="{{ route('exhibitions.' . $exhibition->status) }}">{{ strtoupper($exhibition->status) }}</a>
    <span class="separator">&gt;</span>
    {{ $exhibition->title }}
@endsection

@section('content')
    @if($exhibition->banner_image)
        <div class="hero-banner">
            <img src="{{ public_storage_url($exhibition->banner_image) }}" alt="{{ $exhibition->title }}">
            <div class="hero-overlay">
                <h1>{{ $exhibition->title }}</h1>
                <p class="hero-dates">
                    {{ $exhibition->start_date->format('F d') }} &mdash; {{ $exhibition->end_date->format('F d, Y') }}
                </p>
            </div>
        </div>
    @endif

    <div class="exhibition-detail">
        @unless($exhibition->banner_image)
            <div class="exhibition-detail-header">
                <h1>{{ $exhibition->title }}</h1>
                <div class="exhibition-meta">
                    <span class="tag">{{ $exhibition->status }}</span>
                    <span>{{ $exhibition->start_date->format('F d') }} &mdash; {{ $exhibition->end_date->format('F d, Y') }}</span>
                </div>
            </div>
        @endunless

        @if($exhibition->artists->isNotEmpty())
            <div style="margin-bottom: 30px;">
                <h3>
                    @foreach($exhibition->artists as $artist)
                        <a href="{{ route('artists.show', $artist->slug) }}" style="color: #f4adbb; border-bottom: 2px solid #f4adbb;">
                            {{ $artist->name }}
                        </a>
                        @unless($loop->last) &amp; @endunless
                    @endforeach
                </h3>
            </div>
        @endif

        @if($exhibition->description)
            <div class="exhibition-description">
                {!! nl2br(e($exhibition->description)) !!}
            </div>
        @endif

        @if($exhibition->artworks->isNotEmpty())
            <div class="section-header" style="text-align: left; padding-left: 0;">
                <h2>Works</h2>
            </div>
            <div class="artwork-grid" style="padding-left: 0; padding-right: 0;">
                @foreach($exhibition->artworks as $artwork)
                    <a href="{{ route('artworks.show', $artwork->slug) }}" class="artwork-card">
                        <div class="artwork-card-image">
                            @if($artwork->image)
                                <img src="{{ public_storage_url($artwork->image) }}" alt="{{ $artwork->title }}">
                            @endif
                        </div>
                        <div class="artwork-card-info">
                            <div class="artwork-card-title">{{ $artwork->title }}</div>
                            <div class="artwork-card-artist">{{ $artwork->artist->name }}</div>
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
    </div>
@endsection
