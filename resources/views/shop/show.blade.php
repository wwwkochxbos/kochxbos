@extends('layouts.app')

@section('title', $product->name . ' - Shop - KochxBos Gallery')

@section('breadcrumb')
    <a href="{{ route('home') }}">Home</a>
    <span class="separator">&gt;</span>
    <a href="{{ route('shop.index') }}">Shop</a>
    <span class="separator">&gt;</span>
    {{ $product->name }}
@endsection

@section('content')
    <div class="artwork-detail">
        <div class="artwork-main-image">
            @if($product->image)
                <img src="{{ public_storage_url($product->image) }}" alt="{{ $product->name }}">
            @endif
        </div>
        <div class="artwork-sidebar">
            <h1>{{ $product->name }}</h1>
            <p style="color: #999; text-transform: uppercase; font-size: 0.9rem; margin-bottom: 20px;">{{ $product->category }}</p>

            <div class="artwork-price-block">
                <div class="price">&euro; {{ number_format($product->price, 2, ',', '.') }}</div>
            </div>

            @if($product->stock > 0)
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Add to Cart</button>
                </form>
            @else
                <button class="btn btn-outline" style="width: 100%; opacity: 0.5; cursor: not-allowed;" disabled>Out of Stock</button>
            @endif

            @if($product->description)
                <div style="margin-top: 25px; line-height: 1.8;">
                    {!! nl2br(e($product->description)) !!}
                </div>
            @endif
        </div>
    </div>
@endsection
