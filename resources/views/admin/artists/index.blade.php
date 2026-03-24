@extends('admin.layout')

@section('title', 'Artists')

@section('content')
    <div class="admin-header">
        <h1>Artists</h1>
        <a href="{{ route('admin.artists.create') }}" class="btn-admin btn-admin-primary">New Artist</a>
    </div>

    <div class="admin-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($artists as $artist)
                    <tr>
                        <td>
                            @if($artist->thumbnail)
                                <img src="{{ public_storage_url($artist->thumbnail) }}" class="admin-thumb" alt="">
                            @else
                                <div class="admin-thumb" style="display:inline-block;background:#f4adbb;border-radius:50%;"></div>
                            @endif
                        </td>
                        <td><strong>{{ $artist->name }}</strong></td>
                        <td>{{ $artist->country ?? '-' }}</td>
                        <td>{{ $artist->is_active ? 'Yes' : 'No' }}</td>
                        <td>
                            <a href="{{ route('admin.artists.edit', $artist) }}" class="btn-admin btn-admin-sm btn-admin-primary">Edit</a>
                            <form action="{{ route('admin.artists.destroy', $artist) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this artist?')">
                                @csrf @method('DELETE')
                                <button class="btn-admin btn-admin-sm btn-admin-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-top: 20px;">{{ $artists->links() }}</div>
    </div>
@endsection
