@extends('layouts.app')

@section('title', 'Shop - KochxBos Gallery')

@section('breadcrumb')
    <a href="{{ route('home') }}">Home</a>
    <span class="separator">&gt;</span>
    Shop
@endsection

@section('content')
    <div class="section-header">
        <h2>Shop</h2>
    </div>

    @if($products->isNotEmpty())
        <div class="shop-grid">
            @foreach($products as $product)
                <a href="{{ route('shop.show', $product->slug) }}" class="product-card">
                    <div class="product-card-image">
                        @if($product->image)
                            <img src="{{ public_storage_url($product->image) }}" alt="{{ $product->name }}">
                        @endif
                    </div>
                    <div class="product-card-info">
                        <div class="product-card-name">{{ $product->name }}</div>
                        <div class="product-card-price">&euro; {{ number_format($product->price, 2, ',', '.') }}</div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="pagination-wrapper">
            {{ $products->links() }}
        </div>
    @else
        <div class="empty-state">
            <h3>Shop is currently empty</h3>
            <p>Check back soon for books, prints, and merchandise</p>
        </div>
    @endif
@endsection
