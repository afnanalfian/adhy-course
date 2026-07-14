@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    {{-- Card --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 sm:p-8">
        
        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Profil Saya</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Informasi akun pribadi Anda</p>
        </div>

        {{-- Profile --}}
        <div class="flex items-center gap-5 pb-6 border-b border-gray-200 dark:border-gray-700">
            <img src="{{ auth()->user()->avatar_url }}" 
                 alt="Avatar" 
                 class="w-20 h-20 rounded-full object-cover border-2 border-purple-500/30">

            <div>
                <p class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ auth()->user()->name }}
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ auth()->user()->email }}
                </p>
                <span class="inline-block mt-1 text-xs px-2 py-0.5 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400">
                    {{ auth()->user()->roles->first()->name ?? 'User' }}
                </span>
            </div>
        </div>

        {{-- Info Grid --}}
        <div class="grid sm:grid-cols-2 gap-4 mt-6">
            <div>
                <p class="text-xs text-gray-400 dark:text-gray-500 uppercase tracking-wide">No. HP</p>
                <p class="text-sm font-medium text-gray-800 dark:text-gray-200 mt-1">
                    {{ auth()->user()->phone ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs text-gray-400 dark:text-gray-500 uppercase tracking-wide">Provinsi</p>
                <p class="text-sm font-medium text-gray-800 dark:text-gray-200 mt-1">
                    {{ auth()->user()->province->name ?? '-' }}
                </p>
            </div>

            <div class="sm:col-span-2">
                <p class="text-xs text-gray-400 dark:text-gray-500 uppercase tracking-wide">Kabupaten / Kota</p>
                <p class="text-sm font-medium text-gray-800 dark:text-gray-200 mt-1">
                    {{ auth()->user()->regency->name ?? '-' }}
                </p>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex flex-wrap gap-3 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
            <a href="{{ route('profile.edit') }}" 
               class="px-5 py-2.5 text-sm font-medium text-white bg-purple-600 rounded-xl hover:bg-purple-700 transition duration-300">
                Edit Profil
            </a>

            <a href="{{ route('profile.password') }}" 
               class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-300">
                Ganti Password
            </a>

            <a href="{{ route('profile.delete') }}" 
               class="px-5 py-2.5 text-sm font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 rounded-xl hover:bg-red-100 dark:hover:bg-red-900/30 transition duration-300">
                Hapus Akun
            </a>
        </div>

    </div>
</div>
@endsection