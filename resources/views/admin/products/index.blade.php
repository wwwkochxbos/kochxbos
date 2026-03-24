@extends('admin.layout')

@section('title', 'Products')

@section('content')
    <div class="admin-header">
        <h1>Products</h1>
        <a href="{{ route('admin.products.create') }}" class="btn-admin btn-admin-primary">New Product</a>
    </div>

    <div class="admin-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>
                            @if($product->image)
                                <img src="{{ public_storage_url($product->image) }}" class="admin-thumb" alt="">
                            @else
                                <div class="admin-thumb" style="display:inline-block;"></div>
                            @endif
                        </td>
                        <td><strong>{{ $product->name }}</strong></td>
                        <td>{{ ucfirst($product->category) }}</td>
                        <td>&euro; {{ number_format($product->price, 2, ',', '.') }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn-admin btn-admin-sm btn-admin-primary">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button class="btn-admin btn-admin-sm btn-admin-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-top: 20px;">{{ $products->links() }}</div>
    </div>
@endsection
