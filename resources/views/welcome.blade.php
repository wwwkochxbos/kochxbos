<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'KochxBos') }}</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-white text-zinc-900 min-h-screen flex items-center justify-center p-6">
    <main class="w-full max-w-3xl rounded-xl border border-zinc-200 p-8 md:p-12">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-8">
            <img src="{{ asset('images/logo.svg') }}" alt="KochxBos logo" class="h-14 w-auto">

            @if (Route::has('login'))
                <nav class="flex items-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-block rounded-md border border-zinc-300 px-4 py-2 text-sm hover:bg-zinc-50">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-block rounded-md border border-zinc-300 px-4 py-2 text-sm hover:bg-zinc-50">
                            Log in
                        </a>
                    @endauth
                </nav>
            @endif
        </div>

        <h1 class="text-2xl md:text-3xl font-semibold mb-3">KochxBos Gallery</h1>
        <p class="text-zinc-600 mb-6">
            Contemporary art gallery in center of Amsterdam's Jordaan district. This website presents exhibitions, artists, artworks, news, and publications.
        </p>

        <div class="flex flex-wrap gap-3">
            <a href="https://kochxbos.com" target="_blank" rel="noopener noreferrer" class="inline-block rounded-md bg-black text-white px-4 py-2 text-sm hover:bg-zinc-800">
                Visit Website
            </a>
            <a href="{{ url('/admin') }}" class="inline-block rounded-md border border-zinc-300 px-4 py-2 text-sm hover:bg-zinc-50">
                Open Admin
            </a>
        </div>
    </main>
</body>
</html>
