<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Azwara Learning – Bimbel Online, Quiz Harian, & Tryout')</title>
    <meta name="description" content="@yield('description', 'Bimbel online, tryout beragam, quiz harian, live zoom, materi lengkap, latihan soal terbaru.')">
    <meta name="google-site-verification" content="exlEPP1kFOZJWZ_zxo5Qa-PoW-3oPa-9avX-Xbgcjb4" />
    <meta name="msvalidate.01" content="E0E1D8239606A4386F61EB8D5FC2DED6" />
    <meta property="og:image" content="{{ asset('img/og-image.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Azwara Learning - Bimbel Online">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Azwara Learning – Bimbel Online, Quiz Harian, & Tryout')">
    <meta name="twitter:description" content="@yield('description', 'Bimbel online, tryout beragam, quiz harian, live zoom, materi lengkap, latihan soal terbaru.')">
    <meta name="twitter:image" content="{{ asset('img/og-image.jpg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @include('layouts.partials.ga')
    @include('components.structured-data')
</head>

<body class="font-sans text-secondary bg-azwara-lightest overflow-x-hidden landing-page">

    @include('front.partials.header')

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('front.partials.footer')
    @include('front.partials.scroll-to-top')
    @include('front.partials.promo')
    @stack('scripts')
</body>
</html>
