@extends('admin.layout')

@section('title', 'Exhibitions')

@section('content')
    <div class="admin-header">
        <h1>Exhibitions</h1>
        <a href="{{ route('admin.exhibitions.create') }}" class="btn-admin btn-admin-primary">New Exhibition</a>
    </div>

    <div class="admin-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Artists</th>
                    <th>Status</th>
                    <th>Dates</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($exhibitions as $exhibition)
                    <tr>
                        <td>
                            @if($exhibition->thumbnail)
                                <img src="{{ asset('storage/' . $exhibition->thumbnail) }}" class="admin-thumb" alt="">
                            @else
                                <div class="admin-thumb" style="display:inline-block;"></div>
                            @endif
                        </td>
                        <td><strong>{{ $exhibition->title }}</strong></td>
                        <td>{{ $exhibition->artists->pluck('name')->join(', ') }}</td>
                        <td><span class="tag-status tag-{{ $exhibition->status }}">{{ $exhibition->status }}</span></td>
                        <td>{{ $exhibition->start_date->format('M d') }} - {{ $exhibition->end_date->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('admin.exhibitions.edit', $exhibition) }}" class="btn-admin btn-admin-sm btn-admin-primary">Edit</a>
                            <form action="{{ route('admin.exhibitions.destroy', $exhibition) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this exhibition?')">
                                @csrf @method('DELETE')
                                <button class="btn-admin btn-admin-sm btn-admin-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-top: 20px;">{{ $exhibitions->links() }}</div>
    </div>
@endsection
