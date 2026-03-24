<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="KochxBos Gallery - Contemporary Art Gallery in Amsterdam">
    <title>@yield('title', 'KochxBos Gallery')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans+Extra+Condensed:wght@400;700;800&family=Abel&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    {{-- Header --}}
    <header class="site-header">
        <div class="header-inner">
            <a href="{{ route('home') }}" class="logo">
                <svg viewBox="0 0 400 50" class="logo-svg">
                    <text x="0" y="40" font-family="Fira Sans Extra Condensed, sans-serif" font-weight="800" font-size="42" fill="#000">KochxBos</text>
                </svg>
            </a>
            <button class="hamburger" aria-label="Toggle menu" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <nav class="main-nav" id="mainNav">
                <ul>
                    <li><a href="{{ route('exhibitions.now') }}" class="{{ request()->routeIs('exhibitions.now') ? 'active' : '' }}">NOW</a></li>
                    <li><a href="{{ route('exhibitions.soon') }}" class="{{ request()->routeIs('exhibitions.soon') ? 'active' : '' }}">SOON</a></li>
                    <li><a href="{{ route('artists.index') }}" class="{{ request()->routeIs('artists.*') ? 'active' : '' }}">ARTISTS</a></li>
                    <li><a href="{{ route('artworks.available') }}" class="{{ request()->routeIs('artworks.*') ? 'active' : '' }}">Available</a></li>
                    <li><a href="{{ route('shop.index') }}" class="{{ request()->routeIs('shop.*') ? 'active' : '' }}">SHOP</a></li>
                    <li><a href="{{ route('pages.info') }}" class="{{ request()->routeIs('pages.info') ? 'active' : '' }}">INFO</a></li>
                    <li><a href="{{ route('pages.press') }}" class="{{ request()->routeIs('pages.press') ? 'active' : '' }}">PRESS</a></li>
                    <li>
                        <a href="{{ route('cart.index') }}" class="cart-link {{ request()->routeIs('cart.*') ? 'active' : '' }}">
                            Cart
                            @if(session('cart') && count(session('cart')) > 0)
                                <span class="cart-count">{{ array_sum(array_column(session('cart'), 'quantity')) }}</span>
                            @endif
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    {{-- Breadcrumb --}}
    @hasSection('breadcrumb')
        <div class="breadcrumb-bar">
            <div class="container">
                @yield('breadcrumb')
            </div>
        </div>
    @endif

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="flash-message flash-success">
            <div class="container">{{ session('success') }}</div>
        </div>
    @endif

    {{-- Main Content --}}
    <main class="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="site-footer">
        <div class="footer-inner">
            <div class="footer-grid">
                <div class="footer-col">
                    <h3 class="footer-heading">KochxBos Gallery</h3>
                    <p>Eerste Anjeliersdwarsstraat 36</p>
                    <p>1015NR Amsterdam</p>
                    <p>The Netherlands</p>
                    <p class="footer-phone">+31(0)628846653</p>
                </div>
                <div class="footer-col">
                    <h3 class="footer-heading">Opening Hours</h3>
                    <p>Wednesday &mdash; Saturday</p>
                    <p>13:00 &mdash; 18:00</p>
                    <p class="footer-note">And by appointment</p>
                </div>
                <div class="footer-col">
                    <h3 class="footer-heading">Newsletter</h3>
                    <form class="newsletter-form" action="#" method="POST">
                        @csrf
                        <input type="email" name="email" placeholder="Your email address" required>
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
                <div class="footer-col">
                    <h3 class="footer-heading">Follow Us</h3>
                    <div class="social-links">
                        <a href="#" target="_blank" rel="noopener">Instagram</a>
                        <a href="#" target="_blank" rel="noopener">Facebook</a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="footer-links">
                    <a href="#">Gallery Fair Practice Code</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">General Conditions</a>
                </div>
                <p class="footer-copy">&copy; {{ date('Y') }} KochxBos Gallery. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('hamburger').addEventListener('click', function() {
            this.classList.toggle('is-active');
            document.getElementById('mainNav').classList.toggle('is-open');
        });
    </script>
    @stack('scripts')
</body>
</html>
