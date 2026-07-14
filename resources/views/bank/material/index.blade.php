@extends('layouts.app')

@section('content')

{{-- Tombol Kembali --}}
<div class="mb-4">
    <a href="{{ route('bank.category.index') }}" 
       class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Kategori
    </a>
</div>

{{-- HEADER --}}
<div class="relative mb-8 overflow-hidden rounded-2xl bg-gradient-to-r from-purple-600 via-blue-600 to-pink-600 p-6 md:p-8">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute -top-20 -right-20 w-64 h-64 bg-white rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-white rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-white">
                📚 {{ $category->name }}
            </h1>
            <p class="text-white/80 text-sm mt-1">
                Daftar materi dalam kategori ini
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            {{-- SEARCH --}}
            <form method="GET" action="{{ route('bank.category.materials.index', $category) }}" class="flex gap-2">
                <div class="relative">
                    <input type="text" 
                           name="q" 
                           placeholder="Cari materi..." 
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
            <a href="{{ route('bank.category.materials.create', $category) }}"
               class="px-5 py-2.5 bg-white text-purple-600 font-medium rounded-xl hover:bg-white/90 hover:shadow-lg hover:shadow-white/20 transition-all duration-300 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Materi
            </a>
            @endrole
        </div>
    </div>
</div>

{{-- LIST --}}
<div class="space-y-3">
    @forelse ($materials as $m)
        <div class="group bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-5 hover:border-purple-500 hover:shadow-lg transition-all duration-300">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                {{-- LEFT: TITLE --}}
                <a href="{{ route('bank.material.questions.index', $m) }}" class="flex-1 min-w-0">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white truncate group-hover:text-purple-600 dark:group-hover:text-purple-400 transition">
                        {{ $m->name }}
                    </h3>
                </a>

                {{-- RIGHT --}}
                <div class="flex items-center gap-4 flex-shrink-0">
                    {{-- NUMBER OF QUESTIONS --}}
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        <span class="font-bold text-gray-900 dark:text-white">{{ $m->questions->count() }}</span> Soal
                    </div>

                    {{-- ACTION BUTTONS --}}
                    @role('admin')
                    <div class="flex items-center gap-2">
                        <a href="{{ route('bank.material.edit', $m) }}" 
                           class="px-4 py-1.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('bank.material.delete', $m) }}" 
                              class="sweet-confirm"
                              data-message="Yakin ingin menghapus materi ini? Semua soal di dalamnya akan ikut terhapus secara permanen.">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-4 py-1.5 text-sm font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 rounded-xl hover:bg-red-100 dark:hover:bg-red-900/30 transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                    @endrole
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700">
            <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Belum Ada Materi</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Klik "Tambah Materi" untuk memulai</p>
            @role('admin')
            <a href="{{ route('bank.category.materials.create', $category) }}" 
               class="inline-block mt-4 px-6 py-2.5 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition">
                + Tambah Materi
            </a>
            @endrole
        </div>
    @endforelse
</div>

{{-- PAGINATION --}}
@if($materials->hasPages())
    <div class="mt-6">
        {{ $materials->links() }}
    </div>
@endif

@endsection