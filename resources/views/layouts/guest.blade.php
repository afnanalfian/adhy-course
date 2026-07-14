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
    
    {{-- Additional Styles for enhanced design --}}
    <style>
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #8B5CF6, #3B82F6);
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .nav-link.active::after {
            width: 100%;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .dark .glass-effect {
            background: rgba(17, 24, 39, 0.7);
        }
        .btn-gradient {
            background: linear-gradient(135deg, #8B5CF6, #3B82F6);
            transition: all 0.3s ease;
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(139, 92, 246, 0.4);
        }
        .btn-outline-gradient {
            background: transparent;
            border: 2px solid;
            border-image: linear-gradient(135deg, #8B5CF6, #3B82F6) 1;
            transition: all 0.3s ease;
        }
        .btn-outline-gradient:hover {
            background: linear-gradient(135deg, #8B5CF6, #3B82F6);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(139, 92, 246, 0.3);
        }
        .theme-toggle {
            transition: all 0.3s ease;
        }
        .theme-toggle:hover {
            transform: rotate(30deg) scale(1.1);
        }
        .logo-text {
            background: linear-gradient(135deg, #8B5CF6, #3B82F6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .footer-gradient {
            background: linear-gradient(180deg, transparent, rgba(139, 92, 246, 0.05));
        }
        .dark .footer-gradient {
            background: linear-gradient(180deg, transparent, rgba(139, 92, 246, 0.1));
        }
        .scrollbar-custom::-webkit-scrollbar {
            width: 6px;
        }
        .scrollbar-custom::-webkit-scrollbar-track {
            background: transparent;
        }
        .scrollbar-custom::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #8B5CF6, #3B82F6);
            border-radius: 3px;
        }
        .scrollbar-custom::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #7C3AED, #2563EB);
        }
    </style>
</head>

<body class="h-screen overflow-hidden flex flex-col bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">

    {{-- Navbar with Glassmorphism --}}
    <nav class="w-full glass-effect border-b border-gray-200/50 dark:border-gray-700/50 py-3 sticky top-0 z-50 transition-all duration-300">
        <div class="container mx-auto px-4 lg:px-6 flex items-center justify-between">
            {{-- Logo --}}
            <a href="/" class="flex items-center gap-2 group">
                <div class="w-10 h-10 rounded-xl btn-gradient flex items-center justify-center shadow-lg shadow-purple-500/25 group-hover:shadow-purple-500/40 transition-all duration-300 group-hover:scale-105">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div class="flex items-baseline">
                    <span class="text-2xl font-extrabold tracking-tight">ENS</span>
                    <span class="text-2xl font-extrabold logo-text">Makassar</span>
                </div>
            </a>

            {{-- Right Section --}}
            <div class="flex items-center gap-3">
                {{-- Theme Toggle --}}
                <button onclick="
                    const html = document.documentElement;
                    const isDark = html.classList.toggle('dark');
                    localStorage.setItem('theme', isDark ? 'dark' : 'light');
                " class="theme-toggle p-2.5 rounded-xl text-gray-600 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 hover:bg-purple-50 dark:hover:bg-purple-900/30 transition-all duration-300 relative">
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
                    <span class="absolute -top-1 -right-1 w-2 h-2 rounded-full bg-purple-500 dark:bg-purple-400 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                </button>

                {{-- Login Button --}}
                <a href="{{ route('login') }}"
                   class="px-5 py-2.5 text-sm font-semibold rounded-xl transition-all duration-300
                          {{ request()->routeIs('login')
                             ? 'btn-gradient text-white shadow-lg shadow-purple-500/25'
                             : 'btn-outline-gradient text-gray-700 dark:text-gray-300 hover:text-white' }}">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Masuk
                    </span>
                </a>

                {{-- Register Button --}}
                <a href="{{ route('register') }}"
                   class="px-5 py-2.5 text-sm font-semibold rounded-xl transition-all duration-300
                          {{ request()->routeIs('register')
                             ? 'btn-gradient text-white shadow-lg shadow-purple-500/25'
                             : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-purple-100 dark:hover:bg-purple-900/30 hover:text-purple-600 dark:hover:text-purple-400' }}">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Daftar
                    </span>
                </a>
            </div>
        </div>
    </nav>

    {{-- Page Content --}}
    <main class="flex-1 overflow-y-auto scrollbar-custom relative">
        {{-- Decorative Background Elements --}}
        <div class="fixed inset-0 -z-10 pointer-events-none">
            <div class="absolute top-20 right-0 w-96 h-96 bg-gradient-to-br from-purple-400/10 to-blue-400/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 left-0 w-96 h-96 bg-gradient-to-tr from-pink-400/5 to-yellow-400/5 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-to-r from-purple-300/5 to-blue-300/5 rounded-full blur-3xl"></div>
        </div>
        
        @yield('content')

        {{-- Enhanced Footer --}}
        <footer class="footer-gradient py-8 text-center border-t border-gray-200/50 dark:border-gray-800/50 mt-12">
            <div class="container mx-auto px-4">
                <div class="flex flex-col items-center gap-3">
                    <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                        <span>© {{ date('Y') }}</span>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">ENS Makassar</span>
                        <span class="w-1 h-1 rounded-full bg-purple-400"></span>
                        <span>Bimbel Kedinasan Terpercaya</span>
                    </div>
                    <div class="flex items-center gap-4 text-xs text-gray-400 dark:text-gray-500">
                        <a href="#" class="hover:text-purple-500 dark:hover:text-purple-400 transition-colors">Tentang</a>
                        <span class="w-px h-3 bg-gray-300 dark:bg-gray-700"></span>
                        <a href="#" class="hover:text-purple-500 dark:hover:text-purple-400 transition-colors">Kebijakan</a>
                        <span class="w-px h-3 bg-gray-300 dark:bg-gray-700"></span>
                        <a href="#" class="hover:text-purple-500 dark:hover:text-purple-400 transition-colors">Kontak</a>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    @include('layouts.partials.toast')
    @stack('scripts')
</body>

</html>