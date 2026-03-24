@extends('layouts.app')

@section('title', 'Info - KochxBos Gallery')

@section('breadcrumb')
    <a href="{{ route('home') }}">Home</a>
    <span class="separator">&gt;</span>
    Info
@endsection

@section('content')
    <div class="info-page">
        <h1 style="margin-bottom: 40px;">KochxBos Gallery</h1>

        <div class="info-grid">
            <div class="info-section">
                <h2>About</h2>
                <p>
                    KochxBos Gallery is a contemporary art gallery located in the heart of Amsterdam's Jordaan district.
                    Founded with a passion for discovering and promoting emerging and mid-career artists, the gallery
                    presents a diverse program of exhibitions featuring painting, sculpture, photography, and mixed media works.
                </p>
                <p>
                    The gallery is committed to supporting artists who push boundaries and challenge conventions,
                    while remaining accessible to both seasoned collectors and newcomers to the art world.
                </p>
            </div>

            <div class="info-section">
                <h2>Visit Us</h2>
                <p><strong>Address:</strong><br>Eerste Anjeliersdwarsstraat 36<br>1015NR Amsterdam<br>The Netherlands</p>
                <p><strong>Phone:</strong><br>+31(0)628846653</p>
                <p><strong>Email:</strong><br><a href="mailto:info@kochxbos.com" style="color: #f4adbb; font-weight: 700;">info@kochxbos.com</a></p>
                <p><strong>Opening Hours:</strong><br>Wednesday &mdash; Saturday<br>13:00 &mdash; 18:00<br><em>And by appointment</em></p>
            </div>
        </div>

        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2435.9!2d4.882!3d52.377!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTLCsDIyJzM3LjIiTiA0wrA1Myc1NS4yIkU!5e0!3m2!1sen!2snl!4v1!5m2!1sen!2snl"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
@endsection
