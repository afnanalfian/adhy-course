@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
        Daftar Tentor
    </h1>

    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
        <form method="GET" action="{{ route('tentor.index') }}" class="flex gap-2 w-full sm:w-auto">
            <input type="text" 
                   name="q" 
                   value="{{ $q ?? '' }}" 
                   placeholder="Cari nama / course" 
                   class="flex-1 sm:w-72 px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition text-sm">
            <button type="submit" 
                    class="px-5 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-xl transition">
                Cari
            </button>
        </form>
        @role('admin')
        <a href="{{ route('tentor.create') }}"
           class="px-5 py-2.5 bg-gray-900 dark:bg-gray-700 text-white font-medium rounded-xl hover:bg-gray-800 dark:hover:bg-gray-600 transition text-center">
            + Tambah Tentor
        </a>
        @endrole
    </div>
</div>

{{-- GRID --}}
<div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
    @forelse ($tentor as $t)
        <a href="{{ route('tentor.show', $t->id) }}" 
           class="group block bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-5 hover:border-purple-500 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
            
            {{-- Profile --}}
            <div class="flex items-center gap-3 mb-3">
                <img src="{{ $t->user->avatar_url }}"
                     class="w-12 h-12 rounded-full object-cover border-2 border-purple-500/30">
                <div class="min-w-0">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white truncate">
                        {{ $t->user->name }}
                    </h3>
                    <span class="text-xs px-2.5 py-0.5 rounded-full inline-block mt-0.5
                                {{ $t->user->is_active 
                                    ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' 
                                    : 'bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400' }}">
                        {{ $t->user->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>
            </div>

            {{-- Bio --}}
            <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2 mb-3">
                {{ $t->bio ?: 'Tidak ada bio.' }}
            </p>

            {{-- Courses --}}
            <p class="text-xs text-gray-500 dark:text-gray-400">
                <span class="font-medium text-gray-700 dark:text-gray-300">Mengajar:</span>
                {{ $t->courses->pluck('name')->join(', ') ?: '-' }}
            </p>
        </a>
    @empty
        <div class="col-span-full text-center py-12 text-gray-500 dark:text-gray-400">
            Belum ada tentor
        </div>
    @endforelse
</div>

{{-- PAGINATION --}}
@if($tentor->hasPages())
    <div class="mt-6">
        {{ $tentor->links() }}
    </div>
@endif

@endsection