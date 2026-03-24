@extends('layouts.app')

@section('title', 'KochxBos Gallery - Contemporary Art in Amsterdam')

@section('content')
    {{-- Hero Banner --}}
    @if($currentExhibition)
        <a href="{{ route('exhibitions.show', $currentExhibition->slug) }}">
            <div class="hero-banner">
                @if($currentExhibition->banner_image)
                    <img src="{{ public_storage_url($currentExhibition->banner_image) }}" alt="{{ $currentExhibition->title }}">
                @else
                    <div class="hero-placeholder">
                        <h1>KochxBos</h1>
                    </div>
                @endif
                <div class="hero-overlay">
                    <h1>{{ $currentExhibition->title }}</h1>
                    <p class="hero-dates">
                        {{ $currentExhibition->start_date->format('M d') }} &mdash; {{ $currentExhibition->end_date->format('M d, Y') }}
                    </p>
                </div>
            </div>
        </a>
    @else
        <div class="hero-banner">
            <div class="hero-placeholder">
                <h1>KochxBos Gallery</h1>
            </div>
        </div>
    @endif

    {{-- Current Exhibition Block --}}
    @if($currentExhibition)
        <section class="current-exhibition">
            <div class="container">
                <h2>Now Showing</h2>
                <h3>{{ $currentExhibition->title }}</h3>
                @if($currentExhibition->artists->isNotEmpty())
                    <p class="exhibition-artist">
                        {{ $currentExhibition->artists->pluck('name')->join(' & ') }}
                    </p>
                @endif
                <p class="exhibition-dates">
                    {{ $currentExhibition->start_date->format('F d') }} &mdash; {{ $currentExhibition->end_date->format('F d, Y') }}
                </p>
                <br>
                <a href="{{ route('exhibitions.show', $currentExhibition->slug) }}" class="btn btn-primary">View Exhibition</a>
            </div>
        </section>
    @endif

    {{-- Upcoming Exhibitions --}}
    @if($upcomingExhibitions->isNotEmpty())
        <div class="section-header">
            <h2>Coming Soon</h2>
        </div>
        <div class="exhibition-grid">
            @foreach($upcomingExhibitions as $exhibition)
                <a href="{{ route('exhibitions.show', $exhibition->slug) }}" class="exhibition-card">
                    @if($exhibition->thumbnail)
                        <img src="{{ public_storage_url($exhibition->thumbnail) }}" alt="{{ $exhibition->title }}">
                    @else
                        <div class="exhibition-placeholder"></div>
                    @endif
                    <div class="exhibition-card-info">
                        <h3>{{ $exhibition->title }}</h3>
                        @if($exhibition->artists->isNotEmpty())
                            <p class="exhibition-card-artist">{{ $exhibition->artists->pluck('name')->join(' & ') }}</p>
                        @endif
                        <p class="exhibition-card-dates">
                            {{ $exhibition->start_date->format('M d') }} &mdash; {{ $exhibition->end_date->format('M d, Y') }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    @endif

    {{-- Artists --}}
    @if($artists->isNotEmpty())
        <div class="section-header">
            <h2>Artists</h2>
        </div>
        <div class="artist-grid">
            @foreach($artists->take(8) as $artist)
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
        @if($artists->count() > 8)
            <div style="text-align: center; padding-bottom: 40px;">
                <a href="{{ route('artists.index') }}" class="btn btn-outline">View All Artists</a>
            </div>
        @endif
    @endif

    {{-- Available Works --}}
    @if($availableWorks->isNotEmpty())
        <div class="section-header">
            <h2>Available</h2>
        </div>
        <div class="artwork-grid">
            @foreach($availableWorks as $artwork)
                <a href="{{ route('artworks.show', $artwork->slug) }}" class="artwork-card">
                    <div class="artwork-card-image">
                        @if($artwork->image)
                            <img src="{{ public_storage_url($artwork->image) }}" alt="{{ $artwork->title }}">
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
        <div style="text-align: center; padding-bottom: 40px;">
            <a href="{{ route('artworks.available') }}" class="btn btn-outline">View All Available Works</a>
        </div>
    @endif

    {{-- News --}}
    @if($news->isNotEmpty())
        <section class="news-section">
            <div class="section-header">
                <h2>News</h2>
            </div>
            <div class="news-grid">
                @foreach($news as $item)
                    <div class="news-card">
                        @if($item->image)
                            <div class="news-card-image">
                                <img src="{{ public_storage_url($item->image) }}" alt="{{ $item->title }}">
                            </div>
                        @endif
                        <div class="news-card-body">
                            <div class="news-card-date">{{ $item->published_at->format('F d, Y') }}</div>
                            <h3 class="news-card-title">{{ $item->title }}</h3>
                            @if($item->excerpt)
                                <p class="news-card-excerpt">{{ $item->excerpt }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Newsletter --}}
    <section class="newsletter-section">
        <div class="container">
            <h2>Stay Updated</h2>
            <p>Subscribe to our newsletter for exhibition updates and gallery news</p>
            <form class="newsletter-form" action="#" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Your email address" required>
                <button type="submit">Subscribe</button>
            </form>
        </div>
    </section>
@endsection
