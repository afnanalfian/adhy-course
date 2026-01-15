@extends('layouts.guest')

@section('title', 'Login – ENS Makassar')
@section('content')
<div class="min-h-[80vh] flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-ens-darker dark:text-white mb-2">
                Masuk ke Akun
            </h1>
            <p class="text-gray-500 dark:text-gray-400 text-sm">
                Lanjutkan perjalanan belajarmu
            </p>
        </div>

        {{-- Card --}}
        <div class="bg-ens-lighter dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700">
            @if(session('status'))
                <div class="mb-4 p-3 rounded-lg bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-3 rounded-lg bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Email
                    </label>
                    <input type="email"
                           name="email"
                           required
                           placeholder="email@example.com"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition">
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Password
                    </label>
                    <input type="password"
                           name="password"
                           required
                           placeholder="••••••••"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition">
                </div>

                {{-- Remember & Forgot --}}
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                        <input type="checkbox"
                               name="remember"
                               class="rounded border-gray-300 dark:border-gray-600 text-primary focus:ring-primary">
                        Ingat saya
                    </label>

                    <a href="{{ route('password.request') }}"
                       class="text-sm text-primary hover:text-ens-medium transition">
                        Lupa password?
                    </a>
                </div>

                {{-- Submit Button --}}
                <button type="submit"
                        class="w-full py-3 bg-primary text-white font-medium rounded-lg hover:bg-ens-medium transition focus:ring-2 focus:ring-primary/20 focus:outline-none">
                    Masuk
                </button>
            </form>

            {{-- Register Link --}}
            <div class="mt-6 pt-5 border-t border-gray-100 dark:border-gray-700 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Belum punya akun?
                    <a href="{{ route('register') }}"
                       class="text-primary font-medium hover:text-ens-medium transition">
                        Daftar
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
