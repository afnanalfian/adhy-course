<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Azwara Learning – Bimbel Online, Quiz Harian, & Tryout')</title>
    <meta name="description" content="@yield('description', 'Bimbel online, tryout beragam, quiz harian, live zoom, materi lengkap, latihan soal terbaru.')">
    <meta name="google-site-verification" content="exlEPP1kFOZJWZ_zxo5Qa-PoW-3oPa-9avX-Xbgcjb4" />
    <meta name="msvalidate.01" content="E0E1D8239606A4386F61EB8D5FC2DED6" />
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="@yield('title', 'Azwara Learning')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @include('layouts.partials.ga')
    @include('components.structured-data')
</head>

<body
    class="flex h-screen overflow-hidden
           bg-gradient-to-br from-azwara-lighter via-azwara-medium/20 to-white
           dark:bg-brand-gradient
           bg-fixed bg-no-repeat bg-[length:200%_200%]
           transition-all duration-500">

    @include('layouts.partials.sidebar')

    <div class="flex-1 flex flex-col h-screen relative z-10">
        @include('layouts.partials.header')

        <main class="flex-1 p-6 overflow-y-auto">
            @yield('content')
            @include('layouts.partials.footer')
        </main>
    </div>
    @include('layouts.partials.toast')
    @stack('scripts')
</body>
</html>
