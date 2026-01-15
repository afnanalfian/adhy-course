<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENS Makassar</title>
    <meta name="description"
        content="Bimbel Kedinasan, tryout beragam, quiz harian, live zoom, materi lengkap, latihan soal terbaru.">
    <meta name="google-site-verification" content="exlEPP1kFOZJWZ_zxo5Qa-PoW-3oPa-9avX-Xbgcjb4" />
    <meta name="msvalidate.01" content="E0E1D8239606A4386F61EB8D5FC2DED6" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('layouts.partials.ga')
    <script>
        (function () {
            const storedTheme = localStorage.getItem('theme');
            if (storedTheme === 'dark' || (!storedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
    @include('components.structured-data')
</head>

<body class="h-screen overflow-hidden flex flex-col bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors">

    {{-- Navbar --}}
    <nav class="w-full bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 py-4 sticky top-0 z-50">
        <div class="container mx-auto px-4 flex items-center justify-between">
            {{-- Logo --}}
            <a href="#" class="text-xl font-bold text-gray-900 dark:text-white tracking-wide">
                ENS<span class="text-primary dark:text-ens-lighter">Makassar</span>
            </a>

            <div class="flex items-center gap-4">
                {{-- Theme Toggle --}}
                <button onclick="
                    const html = document.documentElement;
                    const isDark = html.classList.toggle('dark');
                    localStorage.setItem('theme', isDark ? 'dark' : 'light');
                " class="p-2 text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary transition rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg class="block dark:hidden w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3a7 7 0 0 0 9.79 9.79Z" />
                    </svg>
                    <svg class="hidden dark:block w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="5" />
                        <path d="M12 1v2m0 18v2m11-11h-2M3 12H1
                            m16.95 7.95-1.41-1.41
                            M6.46 6.46 5.05 5.05
                            m12.9 0-1.41 1.41
                            M6.46 17.54 5.05 18.95" />
                    </svg>
                </button>

                {{-- Login Button --}}
                <a href="{{ route('login') }}"
                   class="px-4 py-2 text-sm font-medium rounded-lg transition
                          {{ request()->routeIs('login')
                             ? 'bg-primary text-white'
                             : 'text-gray-700 dark:text-gray-300 hover:text-primary border border-gray-300 dark:border-gray-600 hover:border-primary' }}">
                    Login
                </a>

                {{-- Register Button --}}
                <a href="{{ route('register') }}"
                   class="px-4 py-2 text-sm font-medium rounded-lg transition
                          {{ request()->routeIs('register')
                             ? 'bg-primary text-white'
                             : 'text-gray-700 dark:text-gray-300 hover:text-primary border border-gray-300 dark:border-gray-600 hover:border-primary' }}">
                    Register
                </a>
            </div>
        </div>
    </nav>

    {{-- Page Content --}}
    <main class="flex-1 overflow-y-auto">
        @yield('content')

        {{-- Footer --}}
        <footer class="py-6 text-center text-sm text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-800 mt-8">
            © {{ date('Y') }} ENS Makassar
        </footer>
    </main>

    @include('layouts.partials.toast')
    @stack('scripts')
</body>

</html>
