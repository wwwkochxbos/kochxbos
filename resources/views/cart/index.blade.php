@extends('layouts.app')

@section('title', 'Cart - KochxBos Gallery')

@section('breadcrumb')
    <a href="{{ route('home') }}">Home</a>
    <span class="separator">&gt;</span>
    Cart
@endsection

@section('content')
    <div class="cart-page">
        <h1 style="margin-bottom: 30px;">Your Cart</h1>

        @if(!empty($cart) && count($cart) > 0)
            @php $total = 0; @endphp
            @foreach($cart as $id => $item)
                @php $total += $item['price'] * $item['quantity']; @endphp
                <div class="cart-item">
                    <div class="cart-item-image">
                        @if($item['image'])
                            <img src="{{ public_storage_url($item['image']) }}" alt="{{ $item['name'] }}">
                        @endif
                    </div>
                    <div>
                        <div class="cart-item-name">{{ $item['name'] }}</div>
                        <div style="color: #999; font-size: 0.9rem;">Qty: {{ $item['quantity'] }}</div>
                    </div>
                    <div style="font-weight: 700;">
                        &euro; {{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}
                    </div>
                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: #999; cursor: pointer; font-size: 1.2rem;">&times;</button>
                    </form>
                </div>
            @endforeach

            <div class="cart-total">
                Total: &euro; {{ number_format($total, 2, ',', '.') }}
            </div>

            <div style="text-align: right;">
                <a href="mailto:info@kochxbos.com?subject=Order Inquiry" class="btn btn-primary">Proceed to Checkout</a>
            </div>
        @else
            <div class="cart-empty">
                <h3>Your cart is empty</h3>
                <p>Browse our <a href="{{ route('shop.index') }}" style="color: #f4adbb; font-weight: 700;">shop</a> to find something you like</p>
            </div>
        @endif
    </div>
@endsection
