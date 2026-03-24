@extends('admin.layout')

@section('title', 'News')

@section('content')
    <div class="admin-header">
        <h1>News</h1>
        <a href="{{ route('admin.news.create') }}" class="btn-admin btn-admin-primary">New Article</a>
    </div>

    <div class="admin-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Published</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($news as $item)
                    <tr>
                        <td>
                            @if($item->image)
                                <img src="{{ public_storage_url($item->image) }}" class="admin-thumb" alt="">
                            @else
                                <div class="admin-thumb" style="display:inline-block;"></div>
                            @endif
                        </td>
                        <td><strong>{{ $item->title }}</strong></td>
                        <td>{{ $item->is_published ? 'Yes' : 'Draft' }}</td>
                        <td>{{ $item->published_at?->format('M d, Y') ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.news.edit', $item) }}" class="btn-admin btn-admin-sm btn-admin-primary">Edit</a>
                            <form action="{{ route('admin.news.destroy', $item) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button class="btn-admin btn-admin-sm btn-admin-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-top: 20px;">{{ $news->links() }}</div>
    </div>
@endsection
