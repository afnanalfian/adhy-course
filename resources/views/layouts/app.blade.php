{{-- <!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    @include('layouts.partials.head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @include('layouts.partials.ga')
    @include('components.structured-data')
</head>

<body class="flex h-screen overflow-hidden
           bg-gradient-to-br from-ens-lighter via-ens-medium/20 to-white
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

</html> --}}

{{-- app.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    @include('layouts.partials.head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @include('layouts.partials.ga')
    @include('components.structured-data')
    
    <style>
        /* Custom Scrollbar */
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
        
        /* Sidebar Transition */
        .sidebar-transition {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Glassmorphism */
        .glass-header {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .dark .glass-header {
            background: rgba(17, 24, 39, 0.7);
        }
        
        /* Gradient Background */
        .bg-main-gradient {
            background: linear-gradient(135deg, #f5f3ff 0%, #ede9fe 30%, #dbeafe 70%, #f5f3ff 100%);
        }
        .dark .bg-main-gradient {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #1a1a2e 100%);
        }
    </style>
</head>

<body class="flex h-screen overflow-hidden bg-main-gradient transition-all duration-500">

    {{-- Sidebar Backdrop --}}
    <div id="sidebar-backdrop" onclick="toggleSidebar()" 
         class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden md:hidden z-40 transition-all duration-300">
    </div>

    {{-- Sidebar --}}
    <aside id="sidebar" 
           class="fixed md:static z-50 inset-y-0 left-0 w-72
                  bg-white/90 dark:bg-gray-900/90 backdrop-blur-xl
                  border-r border-gray-200/50 dark:border-gray-700/50
                  sidebar-transition
                  -translate-x-full md:translate-x-0
                  flex flex-col shadow-2xl shadow-purple-500/5">

        {{-- Sidebar Header --}}
        <div class="flex-shrink-0 flex flex-col items-center py-8 px-4 border-b border-gray-200/50 dark:border-gray-700/50">
            <a href="{{ route('dashboard.redirect') }}" class="group">
                <div class="w-24 h-24 rounded-2xl overflow-hidden border-4 border-purple-500/20 shadow-lg shadow-purple-500/20 group-hover:shadow-purple-500/40 transition-all duration-300 group-hover:scale-105">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="object-cover w-full h-full">
                </div>
            </a>
            
            <div class="mt-3 text-center">
                <h2 class="text-lg font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">
                    ENS Makassar
                </h2>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Bimbel Kedinasan</p>
            </div>
        </div>

        {{-- Menu --}}
        <nav class="flex-1 overflow-y-auto px-3 py-4 scrollbar-custom">
            @role('admin')
                @include('layouts.partials.menus.admin')
            @endrole

            @role('tentor')
                @include('layouts.partials.menus.tentor')
            @endrole

            @role('siswa')
                @include('layouts.partials.menus.siswa')
            @endrole
        </nav>

        {{-- Sidebar Footer --}}
        <div class="flex-shrink-0 p-4 border-t border-gray-200/50 dark:border-gray-700/50">
            <div class="text-xs text-center text-gray-400 dark:text-gray-500">
                <p>© {{ date('Y') }} ENS Makassar</p>
                <p class="mt-0.5">v2.0.0</p>
            </div>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col h-screen relative z-10">
        {{-- Header --}}
        <header class="w-full h-16 glass-header border-b border-gray-200/50 dark:border-gray-700/50 px-4 md:px-6
                       flex justify-between items-center sticky top-0 z-30 shadow-sm">

            {{-- Left Section --}}
            <div class="flex items-center gap-3">
                {{-- Hamburger Button --}}
                <button onclick="toggleSidebar()" 
                        class="md:hidden p-2 rounded-xl hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-all duration-300 text-gray-700 dark:text-gray-300">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 6h20M4 12h20M4 18h20" />
                    </svg>
                </button>

                {{-- Breadcrumb / Page Title --}}
                <div class="hidden md:block">
                    <h1 class="text-lg font-semibold text-gray-800 dark:text-white">
                        @yield('title', 'Dashboard')
                    </h1>
                </div>
            </div>

            {{-- Right Section --}}
            <div class="flex items-center gap-3">
                {{-- Theme Toggle --}}
                <button onclick="toggleTheme()" 
                        class="p-2.5 rounded-xl text-gray-600 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 hover:bg-purple-50 dark:hover:bg-purple-900/30 transition-all duration-300 theme-toggle">
                    <svg class="block dark:hidden w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3a7 7 0 0 0 9.79 9.79Z" />
                    </svg>
                    <svg class="hidden dark:block w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="5" />
                        <path d="M12 1v2m0 18v2m11-11h-2M3 12H1m16.95 7.95-1.41-1.41M6.46 6.46 5.05 5.05m12.9 0-1.41 1.41M6.46 17.54 5.05 18.95" />
                    </svg>
                </button>

                {{-- User Dropdown --}}
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" 
                            class="flex items-center gap-3 p-1.5 rounded-xl hover:bg-purple-50 dark:hover:bg-purple-900/30 transition-all duration-300 group">
                        <span class="hidden md:block text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                            {{ auth()->user()->name }}
                        </span>
                        <img src="{{ auth()->user()->avatar_url }}"
                             class="w-10 h-10 rounded-xl border-2 border-purple-500/20 object-cover group-hover:border-purple-500/50 transition-all duration-300" />
                    </button>

                    <!-- Dropdown Panel -->
                    <div x-show="open" @click.outside="open = false" x-transition x-cloak
                         class="absolute right-0 mt-2 w-48 bg-white/95 dark:bg-gray-900/95 backdrop-blur-xl shadow-2xl shadow-purple-500/10 rounded-2xl border border-gray-200/50 dark:border-gray-700/50 p-2 z-50">
                        
                        <div class="px-3 py-2.5 border-b border-gray-200/50 dark:border-gray-700/50">
                            <p class="text-sm font-semibold text-gray-800 dark:text-white">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ auth()->user()->email }}</p>
                        </div>
                        
                        <a href="{{ route('profile.show') }}"
                           class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-purple-50 dark:hover:bg-purple-900/30 rounded-xl transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Profil
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}" class="mt-1">
                            @csrf
                            <button class="flex items-center gap-3 w-full px-3 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-xl transition-all duration-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        {{-- Main Content --}}
        <main class="flex-1 p-4 md:p-6 overflow-y-auto scrollbar-custom">
            @yield('content')
            @include('layouts.partials.footer')
        </main>
    </div>

    @include('layouts.partials.toast')
    @stack('scripts')

    <script>
        // Toggle Sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }

        // Close sidebar on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const sidebar = document.getElementById('sidebar');
                const backdrop = document.getElementById('sidebar-backdrop');
                if (!sidebar.classList.contains('-translate-x-full') && window.innerWidth < 768) {
                    sidebar.classList.add('-translate-x-full');
                    backdrop.classList.add('hidden');
                }
            }
        });

        // Close sidebar on window resize to desktop
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.add('hidden');
            } else {
                if (sidebar.classList.contains('-translate-x-full')) {
                    backdrop.classList.add('hidden');
                }
            }
        });

        // Theme Toggle
        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            
            // Animate icon
            const button = document.querySelector('.theme-toggle');
            button.style.transform = 'rotate(180deg) scale(0.8)';
            setTimeout(() => {
                button.style.transform = 'rotate(0deg) scale(1)';
            }, 300);
        }

        // Initialize theme
        document.addEventListener('DOMContentLoaded', function() {
            const storedTheme = localStorage.getItem('theme');
            if (storedTheme === 'dark' || (!storedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        });

        // Notification click handler
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.notif-link').forEach(link => {
                link.addEventListener('click', () => {
                    const id = link.dataset.notifId;
                    if (!id) return;

                    fetch(`/notifications/${id}/mark-read`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
                            'Accept': 'application/json',
                        },
                        keepalive: true
                    });
                });
            });
        });
    </script>
</body>

</html>