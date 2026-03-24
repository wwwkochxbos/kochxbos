@extends('layouts.app')

@section('title', 'Press - KochxBos Gallery')

@section('breadcrumb')
    <a href="{{ route('home') }}">Home</a>
    <span class="separator">&gt;</span>
    Press
@endsection

@section('content')
    <div class="section-header">
        <h2>Press</h2>
    </div>

    @if($pressItems->isNotEmpty())
        <div class="press-grid">
            @foreach($pressItems as $item)
                <a href="{{ $item->url }}" target="_blank" rel="noopener" class="press-card">
                    @if($item->image)
                        <div style="aspect-ratio: 16/10; overflow: hidden; margin: -25px -25px 20px; background: #f5f5f5;">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" style="width:100%;height:100%;object-fit:cover;">
                        </div>
                    @endif
                    @if($item->source)
                        <div class="press-card-source">{{ $item->source }}</div>
                    @endif
                    <h3 class="press-card-title">{{ $item->title }}</h3>
                    @if($item->excerpt)
                        <p style="color: #666; font-size: 0.95rem; margin-bottom: 10px;">{{ $item->excerpt }}</p>
                    @endif
                    @if($item->published_at)
                        <div class="press-card-date">{{ $item->published_at->format('F d, Y') }}</div>
                    @endif
                </a>
            @endforeach
        </div>
        <div class="pagination-wrapper">
            {{ $pressItems->links() }}
        </div>
    @else
        <div class="empty-state">
            <h3>No press items yet</h3>
        </div>
    @endif
@endsection
