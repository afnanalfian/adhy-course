<!DOCTYPE html>
<html lang="id" class="h-full scroll-smooth">
<head>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Halaman Ujian | Azwara Learning')</title>
    <meta name="description" content="@yield('description', 'Kerjakan dengan jujur dan serius agar hasilnya maksimal dan berkah.')">
    <meta name="google-site-verification" content="exlEPP1kFOZJWZ_zxo5Qa-PoW-3oPa-9avX-Xbgcjb4" />
    <meta name="msvalidate.01" content="E0E1D8239606A4386F61EB8D5FC2DED6" />
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://azwaralearning.com{{ request()->getRequestUri() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title', 'Azwara Learning')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og:image', asset('images/og-default.jpg'))">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title')">
    <meta name="twitter:description" content="@yield('description')">

    <!-- PWA -->
    <meta name="theme-color" content="#1e40af">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- MathJax -->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @stack('styles')
    @include('layouts.partials.ga')
    @include('components.structured-data')

    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --dark-bg: #0f172a;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .prose img {
            max-width: 100%;
            height: auto;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .dark ::-webkit-scrollbar-track {
            background: #1e293b;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #475569;
        }

        .dark ::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }
    </style>
</head>

<body class="h-full bg-gradient-to-br from-gray-50 to-blue-50 dark:from-gray-900 dark:to-gray-950 text-gray-900 dark:text-gray-100 antialiased">
    <!-- Loading overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-white dark:bg-gray-900 z-50 flex items-center justify-center transition-opacity duration-300">
        <div class="text-center">
            <div class="w-16 h-16 border-4 border-primary border-t-transparent rounded-full animate-spin mx-auto mb-4"></div>
            <p class="text-gray-600 dark:text-gray-400">Memuat ujian...</p>
        </div>
    </div>

    @yield('content')

    <!-- Toast container -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-3"></div>

    @stack('scripts')

    <script>
        // Hide loading overlay when page is loaded
        window.addEventListener('load', function() {
            setTimeout(() => {
                document.getElementById('loading-overlay').classList.add('opacity-0');
                setTimeout(() => {
                    document.getElementById('loading-overlay').style.display = 'none';
                }, 300);
            }, 500);
        });

        // Prevent accidental reload/close during exam
        window.addEventListener('beforeunload', function (e) {
            // Only show confirmation if exam is active
            if (document.querySelector('.question-slide')) {
                e.preventDefault();
                e.returnValue = 'Jawaban Anda belum disimpan. Yakin ingin meninggalkan halaman?';
                return e.returnValue;
            }
        });

        // Toast function
        function showToast(message, type = 'info') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');

            const colors = {
                success: 'bg-green-500 border-green-600',
                error: 'bg-red-500 border-red-600',
                warning: 'bg-yellow-500 border-yellow-600',
                info: 'bg-blue-500 border-blue-600'
            };

            const icons = {
                success: '✓',
                error: '✗',
                warning: '⚠',
                info: 'ℹ'
            };

            toast.className = `${colors[type]} text-white px-4 py-3 rounded-lg shadow-lg border transform transition-all duration-300 translate-x-full opacity-0 max-w-xs`;
            toast.innerHTML = `
                <div class="flex items-center">
                    <span class="font-bold mr-2">${icons[type]}</span>
                    <span class="flex-1">${message}</span>
                    <button class="ml-2 text-white hover:text-gray-200" onclick="this.parentElement.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;

            container.appendChild(toast);

            // Animate in
            setTimeout(() => {
                toast.classList.remove('translate-x-full', 'opacity-0');
                toast.classList.add('translate-x-0', 'opacity-100');
            }, 10);

            // Auto remove
            setTimeout(() => {
                toast.classList.remove('translate-x-0', 'opacity-100');
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 300);
            }, 4000);
        }
    </script>
</body>
</html>
