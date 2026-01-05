<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Azwara Learning</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @include('layouts.partials.ga')
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
