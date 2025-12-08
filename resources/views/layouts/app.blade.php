<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Azwara Dashboard' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="flex bg-azwara-lighter dark:bg-azwara-darkest transition-colors duration-300 overflow-x-hidden">

    @include('layouts.partials.sidebar')

    <div class="flex-1 min-h-screen flex flex-col relative z-10">
        @include('layouts.partials.header')

        <main class="p-6">
            @yield('content')
        </main>

        @include('layouts.partials.footer')
    </div>
</body>
</html>
