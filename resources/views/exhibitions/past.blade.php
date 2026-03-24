@extends('layouts.app')

@section('title', 'Past Exhibitions - KochxBos Gallery')

@section('breadcrumb')
    <a href="{{ route('home') }}">Home</a>
    <span class="separator">&gt;</span>
    Past Exhibitions
@endsection

@section('content')
    <div class="section-header">
        <h2>Past Exhibitions</h2>
    </div>

    @if($exhibitions->isNotEmpty())
        <div class="exhibition-grid">
            @foreach($exhibitions as $exhibition)
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
        <div class="pagination-wrapper">
            {{ $exhibitions->links() }}
        </div>
    @else
        <div class="empty-state">
            <h3>No past exhibitions</h3>
        </div>
    @endif
@endsection
