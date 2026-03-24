@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="admin-header">
        <h1>Dashboard</h1>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ $stats['exhibitions'] }}</div>
            <div class="stat-label">Exhibitions</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $stats['artists'] }}</div>
            <div class="stat-label">Artists</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $stats['artworks'] }}</div>
            <div class="stat-label">Artworks</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $stats['available'] }}</div>
            <div class="stat-label">Available Works</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $stats['products'] }}</div>
            <div class="stat-label">Shop Products</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $stats['news'] }}</div>
            <div class="stat-label">News Items</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $stats['orders'] }}</div>
            <div class="stat-label">Orders</div>
        </div>
    </div>

    <div class="admin-card">
        <h3 style="margin-bottom: 15px; font-family: 'Fira Sans Extra Condensed', sans-serif;">Recent Exhibitions</h3>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Dates</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentExhibitions as $exhibition)
                    <tr>
                        <td>{{ $exhibition->title }}</td>
                        <td><span class="tag-status tag-{{ $exhibition->status }}">{{ $exhibition->status }}</span></td>
                        <td>{{ $exhibition->start_date->format('M d') }} - {{ $exhibition->end_date->format('M d, Y') }}</td>
                        <td><a href="{{ route('admin.exhibitions.edit', $exhibition) }}" class="btn-admin btn-admin-sm btn-admin-primary">Edit</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
