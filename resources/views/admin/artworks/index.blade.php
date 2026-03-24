@extends('admin.layout')

@section('title', 'Artworks')

@section('content')
    <div class="admin-header">
        <h1>Artworks</h1>
        <a href="{{ route('admin.artworks.create') }}" class="btn-admin btn-admin-primary">New Artwork</a>
    </div>

    <div class="admin-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($artworks as $artwork)
                    <tr>
                        <td>
                            @if($artwork->image)
                                <img src="{{ asset('storage/' . $artwork->image) }}" class="admin-thumb" alt="">
                            @else
                                <div class="admin-thumb" style="display:inline-block;"></div>
                            @endif
                        </td>
                        <td><strong>{{ $artwork->title }}</strong></td>
                        <td>{{ $artwork->artist->name }}</td>
                        <td>{{ $artwork->price ? '€ ' . number_format($artwork->price, 0, ',', '.') : '-' }}</td>
                        <td>
                            @if($artwork->is_sold)
                                <span class="tag-status tag-past">Sold</span>
                            @elseif($artwork->is_available)
                                <span class="tag-status tag-now">Available</span>
                            @else
                                <span class="tag-status tag-soon">Not Listed</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.artworks.edit', $artwork) }}" class="btn-admin btn-admin-sm btn-admin-primary">Edit</a>
                            <form action="{{ route('admin.artworks.destroy', $artwork) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button class="btn-admin btn-admin-sm btn-admin-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-top: 20px;">{{ $artworks->links() }}</div>
    </div>
@endsection
