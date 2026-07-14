@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="relative mb-8 overflow-hidden rounded-2xl bg-gradient-to-r from-purple-600 via-blue-600 to-pink-600 p-6 md:p-8">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute -top-20 -right-20 w-64 h-64 bg-white rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-white rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-white">
                📚 Kategori Bank Soal
            </h1>
            <p class="text-white/80 text-sm mt-1">
                Semua kategori mata pelajaran untuk bank soal
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            {{-- SEARCH --}}
            <form method="GET" action="{{ route('bank.category.index') }}" class="flex gap-2">
                <div class="relative">
                    <input type="text" 
                           name="q" 
                           placeholder="Cari kategori..." 
                           value="{{ request('q') }}" 
                           class="pl-10 pr-4 py-2.5 rounded-xl bg-white/20 backdrop-blur-sm border border-white/30 text-white placeholder-white/70 focus:bg-white/30 focus:border-white/50 focus:ring-2 focus:ring-white/30 outline-none transition-all duration-300 w-full sm:w-56" />
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <button type="submit" 
                        class="px-5 py-2.5 bg-white/20 backdrop-blur-sm text-white font-medium rounded-xl hover:bg-white/30 transition-all duration-300 border border-white/30">
                    Cari
                </button>
            </form>

            {{-- ADD BUTTON --}}
            @role('admin')
            <a href="{{ route('bank.category.create') }}"
               class="px-5 py-2.5 bg-white text-purple-600 font-medium rounded-xl hover:bg-white/90 hover:shadow-lg hover:shadow-white/20 transition-all duration-300 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Kategori
            </a>
            @endrole
        </div>
    </div>
</div>

{{-- GRID --}}
<div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
    @forelse($categories as $cat)
        <div class="group bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-2xl hover:shadow-purple-500/10 dark:hover:shadow-purple-500/5 transition-all duration-300 hover:-translate-y-1">
            
            {{-- BODY --}}
            <a href="{{ route('bank.category.materials.index', $cat) }}" class="block p-6">
                {{-- Badge --}}
                <div class="flex items-start justify-between mb-3">
                    <span class="text-xs font-semibold px-3 py-1 rounded-full bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400">
                        📂 Kategori
                    </span>
                    <span class="text-xs text-gray-400 dark:text-gray-500">
                        {{ $cat->materials->count() }} Materi
                    </span>
                </div>

                {{-- Title --}}
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 line-clamp-1 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition">
                    {{ $cat->name }}
                </h3>

                {{-- Description --}}
                <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed line-clamp-3">
                    {{ \Illuminate\Support\Str::limit($cat->description ?? 'Tidak ada deskripsi', 120) }}
                </p>
            </a>

            {{-- FOOTER ACTIONS --}}
            @role('admin')
            <div class="flex items-center gap-3 px-6 py-3 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('bank.category.edit', $cat) }}" 
                   class="flex-1 px-4 py-2 text-sm font-medium text-center rounded-xl bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-purple-500 transition-all duration-300">
                    ✏️ Edit
                </a>

                <form method="POST" action="{{ route('bank.category.delete', $cat) }}" 
                      class="flex-1 sweet-confirm"
                      data-message="Yakin ingin menghapus kategori ini? Semua materi dan soal di dalamnya akan ikut terhapus secara permanen.">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full px-4 py-2 text-sm font-medium text-center rounded-xl bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-800 hover:bg-red-100 dark:hover:bg-red-900/30 transition-all duration-300">
                        🗑️ Hapus
                    </button>
                </form>
            </div>
            @endrole
        </div>
    @empty
        <div class="col-span-full">
            <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Belum Ada Kategori</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Klik "Tambah Kategori" untuk memulai</p>
                @role('admin')
                <a href="{{ route('bank.category.create') }}" class="inline-block mt-4 px-6 py-2.5 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition">
                    + Tambah Kategori
                </a>
                @endrole
            </div>
        </div>
    @endforelse
</div>

{{-- PAGINATION --}}
@if($categories->hasPages())
    <div class="mt-8">
        {{ $categories->links() }}
    </div>
@endif

@endsection