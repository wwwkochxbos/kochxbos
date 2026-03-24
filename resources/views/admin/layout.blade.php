<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'KochxBos Gallery')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans+Extra+Condensed:wght@400;700;800&family=Abel&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Abel', Arial, sans-serif; background: #f5f5f5; color: #333; }
        a { color: inherit; text-decoration: none; }

        .admin-layout { display: flex; min-height: 100vh; }

        .admin-sidebar {
            width: 240px;
            background: #000;
            color: #fff;
            padding: 20px 0;
            flex-shrink: 0;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            overflow-y: auto;
        }

        .admin-sidebar-logo {
            padding: 15px 20px 30px;
            font-family: 'Fira Sans Extra Condensed', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            color: #f4adbb;
        }

        .admin-sidebar-logo small {
            display: block;
            font-size: 0.6rem;
            color: #999;
            font-weight: 400;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .admin-nav a {
            display: block;
            padding: 12px 20px;
            color: #ccc;
            font-family: 'Fira Sans Extra Condensed', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            transition: background 0.2s, color 0.2s;
            border-left: 3px solid transparent;
        }

        .admin-nav a:hover,
        .admin-nav a.active {
            background: #111;
            color: #f4adbb;
            border-left-color: #f4adbb;
        }

        .admin-main {
            margin-left: 240px;
            flex: 1;
            padding: 30px;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .admin-header h1 {
            font-family: 'Fira Sans Extra Condensed', sans-serif;
            font-weight: 800;
            font-size: 1.8rem;
        }

        .admin-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            padding: 25px;
            margin-bottom: 20px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            padding: 20px;
            text-align: center;
        }

        .stat-card .stat-number {
            font-family: 'Fira Sans Extra Condensed', sans-serif;
            font-weight: 800;
            font-size: 2.5rem;
            color: #f4adbb;
        }

        .stat-card .stat-label {
            font-size: 0.85rem;
            color: #999;
            text-transform: uppercase;
        }

        /* Tables */
        .admin-table { width: 100%; border-collapse: collapse; }
        .admin-table th, .admin-table td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eee; }
        .admin-table th { font-family: 'Fira Sans Extra Condensed', sans-serif; font-weight: 700; color: #999; font-size: 0.85rem; text-transform: uppercase; }
        .admin-table tr:hover td { background: #fafafa; }

        /* Forms */
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            font-family: 'Fira Sans Extra Condensed', sans-serif;
            font-weight: 700;
            margin-bottom: 6px;
            color: #555;
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="number"],
        .form-group input[type="url"],
        .form-group input[type="date"],
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: 'Abel', sans-serif;
            font-size: 1rem;
            transition: border-color 0.2s;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #f4adbb;
        }
        .form-group textarea { min-height: 120px; resize: vertical; }
        .form-group .form-help { font-size: 0.85rem; color: #999; margin-top: 4px; }

        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }
        .form-check input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #f4adbb;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* Buttons */
        .btn-admin {
            display: inline-block;
            font-family: 'Fira Sans Extra Condensed', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            padding: 10px 24px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
            text-transform: uppercase;
        }

        .btn-admin-primary { background: #f4adbb; color: #000; }
        .btn-admin-primary:hover { background: #e899a8; }
        .btn-admin-danger { background: #e74c3c; color: #fff; }
        .btn-admin-danger:hover { background: #c0392b; }
        .btn-admin-sm { padding: 6px 14px; font-size: 0.8rem; }

        .tag-status {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 700;
            font-family: 'Fira Sans Extra Condensed', sans-serif;
            text-transform: uppercase;
        }
        .tag-now { background: #d4edda; color: #155724; }
        .tag-soon { background: #fff3cd; color: #856404; }
        .tag-past { background: #e2e3e5; color: #383d41; }

        .flash { padding: 15px 20px; border-radius: 6px; margin-bottom: 20px; }
        .flash-success { background: #d4edda; color: #155724; }

        .admin-thumb {
            width: 50px;
            height: 50px;
            border-radius: 4px;
            object-fit: cover;
            background: #eee;
        }

        @media (max-width: 768px) {
            .admin-sidebar { width: 60px; padding: 10px 0; }
            .admin-sidebar-logo { font-size: 0; padding: 10px; }
            .admin-sidebar-logo::first-letter { font-size: 1.5rem; }
            .admin-nav a { padding: 12px; font-size: 0; text-align: center; }
            .admin-main { margin-left: 60px; padding: 15px; }
            .form-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <div class="admin-sidebar-logo">
                KochxBos
                <small>Admin Panel</small>
            </div>
            <nav class="admin-nav">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('admin.exhibitions.index') }}" class="{{ request()->routeIs('admin.exhibitions.*') ? 'active' : '' }}">Exhibitions</a>
                <a href="{{ route('admin.artists.index') }}" class="{{ request()->routeIs('admin.artists.*') ? 'active' : '' }}">Artists</a>
                <a href="{{ route('admin.artworks.index') }}" class="{{ request()->routeIs('admin.artworks.*') ? 'active' : '' }}">Artworks</a>
                <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">Products</a>
                <a href="{{ route('admin.news.index') }}" class="{{ request()->routeIs('admin.news.*') ? 'active' : '' }}">News</a>
                <a href="{{ route('home') }}" style="margin-top: 30px; border-top: 1px solid #333; padding-top: 20px;">View Site</a>
            </nav>
        </aside>

        <main class="admin-main">
            @if(session('success'))
                <div class="flash flash-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="flash" style="background: #f8d7da; color: #721c24;">
                    <ul style="list-style: none;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
