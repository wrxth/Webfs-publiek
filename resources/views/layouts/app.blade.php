<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'De Gouden Draak')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="dragon-page">
    <header class="legacy-header">
        <a class="brand-block" href="{{ route('home') }}">
            <img src="{{ asset('legacy-assets/pictures/dragon-small.png') }}" alt="Golden Dragon">
            <span>De Gouden Draak</span>
            <img src="{{ asset('legacy-assets/pictures/dragon-small-flipped.png') }}" alt="Golden Dragon">
        </a>
        <a class="legacy-marquee" href="{{ route('offers.public') }}"><span>Welkom bij De Gouden Draak. Klik hier om de aanbiedingen van deze week te zien!</span></a>
        <a class="brand-block" href="{{ route('home') }}">
            <img src="{{ asset('legacy-assets/pictures/dragon-small.png') }}" alt="Golden Dragon">
            <span>De Gouden Draak</span>
            <img src="{{ asset('legacy-assets/pictures/dragon-small-flipped.png') }}" alt="Golden Dragon">
        </a>
    </header>
    <div class="legacy-frame">
        <div class="frame-content">
            <section class="hero">
                <div class="hero-dragons">
                    <img src="{{ asset('legacy-assets/pictures/dragon-small.png') }}" alt="Golden Dragon">
                    <div class="hero-title">
                        <span class="subtitle">Chinees Indische Specialiteiten</span>
                        <span class="name">De Gouden Draak</span>
                    </div>
                    <img src="{{ asset('legacy-assets/pictures/dragon-small-flipped.png') }}" alt="Golden Dragon">
                </div>
                <nav class="legacy-nav" aria-label="Hoofdnavigatie">
                    <a href="{{ route('menu.index') }}">Menukaart</a>
                    <a href="{{ route('news') }}">Nieuws</a>
                    <a href="{{ route('contact') }}">Contact</a>
                    <a href="{{ route('offers.public') }}">Aanbiedingen</a>
                    <a href="{{ route('orders.create') }}">Bestellen</a>
                    <a href="{{ route('pos.index') }}">Kassa</a>
                    <a href="{{ route('admin.dashboard') }}">Admin</a>
                </nav>
            </section>

            @if (session('success')) <div class="alert">{{ session('success') }}</div> @endif
            @if ($errors->any())
                <div class="alert error"><strong>Controleer je invoer:</strong><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
            @endif
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
