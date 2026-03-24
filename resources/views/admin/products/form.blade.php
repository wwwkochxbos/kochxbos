@extends('admin.layout')

@section('title', $product ? 'Edit Product' : 'New Product')

@section('content')
    <div class="admin-header">
        <h1>{{ $product ? 'Edit Product' : 'New Product' }}</h1>
    </div>

    <div class="admin-card">
        <form action="{{ $product ? route('admin.products.update', $product) : route('admin.products.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if($product) @method('PUT') @endif

            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product?->name) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description">{{ old('description', $product?->description) }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="price">Price (EUR)</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $product?->price) }}" step="0.01" min="0" required>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category">
                        <option value="book" {{ old('category', $product?->category) === 'book' ? 'selected' : '' }}>Book</option>
                        <option value="print" {{ old('category', $product?->category) === 'print' ? 'selected' : '' }}>Print</option>
                        <option value="merchandise" {{ old('category', $product?->category) === 'merchandise' ? 'selected' : '' }}>Merchandise</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', $product?->stock ?? 0) }}" min="0">
                </div>
                <div class="form-group">
                    <label for="sort_order">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $product?->sort_order ?? 0) }}">
                </div>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" accept="image/*">
                @if($product?->image)
                    <div class="form-help">Current: {{ basename($product->image) }}</div>
                @endif
            </div>

            <div class="form-check">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                    {{ old('is_active', $product?->is_active ?? true) ? 'checked' : '' }}>
                <label for="is_active" style="margin-bottom: 0;">Active (visible in shop)</label>
            </div>

            <button type="submit" class="btn-admin btn-admin-primary">
                {{ $product ? 'Update Product' : 'Create Product' }}
            </button>
        </form>
    </div>
@endsection
