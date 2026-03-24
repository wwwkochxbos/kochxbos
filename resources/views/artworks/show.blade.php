@extends('layouts.app')

@section('title', $artwork->title . ' - KochxBos Gallery')

@section('breadcrumb')
    <a href="{{ route('home') }}">Home</a>
    <span class="separator">&gt;</span>
    <a href="{{ route('artworks.available') }}">Available</a>
    <span class="separator">&gt;</span>
    {{ $artwork->title }}
@endsection

@section('content')
    <div class="artwork-detail">
        <div>
            <div class="artwork-main-image" onclick="openLightbox(this.querySelector('img').src)">
                @if($artwork->image)
                    <img src="{{ asset('storage/' . $artwork->image) }}" alt="{{ $artwork->title }}">
                @endif
            </div>
            @if($artwork->images->isNotEmpty())
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 10px; margin-top: 15px;">
                    @foreach($artwork->images as $img)
                        <div style="aspect-ratio: 1; overflow: hidden; cursor: pointer; background: #f5f5f5;"
                             onclick="openLightbox('{{ asset('storage/' . $img->image) }}')">
                            <img src="{{ asset('storage/' . $img->image) }}" alt="" style="width:100%;height:100%;object-fit:cover;">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="artwork-sidebar">
            <h1>{{ $artwork->title }}</h1>
            <a href="{{ route('artists.show', $artwork->artist->slug) }}" class="artwork-artist-link">
                {{ $artwork->artist->name }}
            </a>

            <ul class="artwork-specs">
                @if($artwork->year)
                    <li><span class="spec-label">Year</span><span>{{ $artwork->year }}</span></li>
                @endif
                @if($artwork->medium)
                    <li><span class="spec-label">Medium</span><span>{{ $artwork->medium }}</span></li>
                @endif
                @if($artwork->dimensions)
                    <li><span class="spec-label">Dimensions</span><span>{{ $artwork->dimensions }}</span></li>
                @endif
            </ul>

            @if($artwork->is_available && !$artwork->is_sold && $artwork->price)
                <div class="artwork-price-block">
                    <div class="price">&euro; {{ number_format($artwork->price, 0, ',', '.') }}</div>
                </div>
                <a href="mailto:info@kochxbos.com?subject=Inquiry: {{ $artwork->title }}" class="btn btn-primary" style="width: 100%;">
                    Inquire About This Work
                </a>
            @elseif($artwork->is_sold)
                <div class="artwork-price-block">
                    <div class="price" style="color: #999;">Sold</div>
                </div>
            @endif

            @if($artwork->description)
                <div style="margin-top: 25px; line-height: 1.8;">
                    {!! nl2br(e($artwork->description)) !!}
                </div>
            @endif

            @if($artwork->exhibition)
                <div style="margin-top: 25px; padding-top: 20px; border-top: 1px solid #eee;">
                    <h4>Exhibition</h4>
                    <a href="{{ route('exhibitions.show', $artwork->exhibition->slug) }}" style="color: #f4adbb; font-weight: 700;">
                        {{ $artwork->exhibition->title }}
                    </a>
                </div>
            @endif
        </div>
    </div>

    {{-- Lightbox --}}
    <div class="lightbox" id="lightbox" onclick="closeLightbox()">
        <img src="" alt="" id="lightboxImg">
    </div>

    @push('scripts')
    <script>
        function openLightbox(src) {
            document.getElementById('lightboxImg').src = src;
            document.getElementById('lightbox').classList.add('is-open');
            document.body.style.overflow = 'hidden';
        }
        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('is-open');
            document.body.style.overflow = '';
        }
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeLightbox();
        });
    </script>
    @endpush
@endsection
