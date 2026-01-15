@extends('layouts.app')

@section('content')
<div class="min-h-screen py-8">
    <div class="max-w-3xl mx-auto px-4">
        {{-- Card --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 sm:p-8">
            {{-- Header --}}
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Profil Saya
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Informasi akun pribadi Anda
                </p>
            </div>

            {{-- Profile Info --}}
            <div class="flex flex-col sm:flex-row items-center gap-6 mb-8">
                {{-- Avatar --}}
                <div class="shrink-0">
                    <img src="{{ auth()->user()->avatar_url }}"
                         alt="Avatar"
                         class="w-24 h-24 rounded-full object-cover border-4 border-primary">
                </div>

                {{-- Identity --}}
                <div class="text-center sm:text-left">
                    <p class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ auth()->user()->email }}
                    </p>
                </div>
            </div>

            {{-- Info Grid --}}
            <div class="grid sm:grid-cols-2 gap-4 mb-8">
                <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-900">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                        Phone
                    </p>
                    <p class="font-medium text-gray-900 dark:text-white">
                        {{ auth()->user()->phone ?? '-' }}
                    </p>
                </div>

                <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-900">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                        Provinsi
                    </p>
                    <p class="font-medium text-gray-900 dark:text-white">
                        {{ auth()->user()->province->name ?? '-' }}
                    </p>
                </div>

                <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-900">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                        Kabupaten / Kota
                    </p>
                    <p class="font-medium text-gray-900 dark:text-white">
                        {{ auth()->user()->regency->name ?? '-' }}
                    </p>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('profile.edit') }}"
                   class="px-5 py-3 bg-primary text-white font-medium rounded-lg hover:bg-ens-medium transition">
                    Edit Profil
                </a>

                <a href="{{ route('profile.password') }}"
                   class="px-5 py-3 bg-gray-700 text-white font-medium rounded-lg hover:bg-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 transition">
                    Ganti Password
                </a>

                <a href="{{ route('profile.delete') }}"
                   class="px-5 py-3 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 font-medium rounded-lg hover:bg-red-100 dark:hover:bg-red-900/50 transition">
                    Hapus Akun
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
