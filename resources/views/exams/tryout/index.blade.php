@extends('layouts.app')

@section('content')
<div x-data="{ open: false }" class="space-y-5">

    {{-- HEADER --}}
    <div class="relative mb-8 overflow-hidden rounded-2xl bg-gradient-to-r from-purple-600 via-blue-600 to-pink-600 p-6 md:p-8">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute -top-20 -right-20 w-64 h-64 bg-white rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-white rounded-full blur-3xl"></div>
        </div>
        
        <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-white">
                    📝 Daftar Tryout
                </h1>
                <p class="text-white/80 text-sm mt-1">
                    Kelola semua tryout yang tersedia
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                {{-- Search --}}
                <form method="GET" action="{{ route('tryouts.index') }}" class="flex gap-2">
                    <div class="relative">
                        <input type="text" 
                               name="q" 
                               value="{{ request('q') }}" 
                               placeholder="Cari judul tryout..." 
                               class="pl-10 pr-4 py-2.5 rounded-xl bg-white/20 backdrop-blur-sm border border-white/30 text-white placeholder-white/70 focus:bg-white/30 focus:border-white/50 focus:ring-2 focus:ring-white/30 outline-none transition-all duration-300 w-full sm:w-48" />
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    {{-- <input type="date" 
                           name="date" 
                           value="{{ request('date') }}" 
                           class="px-3 py-2.5 rounded-xl bg-white/20 backdrop-blur-sm border border-white/30 text-white placeholder-white/70 focus:bg-white/30 focus:border-white/50 focus:ring-2 focus:ring-white/30 outline-none transition-all duration-300 w-full sm:w-36"> --}}
                    <button type="submit" 
                            class="px-5 py-2.5 bg-white/20 backdrop-blur-sm text-white font-medium rounded-xl hover:bg-white/30 transition-all duration-300 border border-white/30">
                        Cari
                    </button>
                </form>

                {{-- Tambah Tryout --}}
                @role('admin')
                <button type="button" @click="open = true" 
                        class="px-5 py-2.5 bg-white text-purple-600 font-medium rounded-xl hover:bg-white/90 hover:shadow-lg hover:shadow-white/20 transition-all duration-300 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Tryout
                </button>
                @endrole
            </div>
        </div>
    </div>

    {{-- GRID CARDS --}}
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($exams as $exam)
            <div onclick="window.location='{{ route('exams.show', $exam) }}'" 
                 class="group bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-5 cursor-pointer hover:border-purple-500 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                
                {{-- Header Card --}}
                <div class="flex items-start justify-between gap-3 mb-3">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white line-clamp-2 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition">
                        {{ $exam->title }}
                    </h3>
                    <span class="inline-block px-2.5 py-1 text-xs font-medium rounded-full flex-shrink-0
                        @if($exam->status === 'active') 
                            bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400
                        @elseif($exam->status === 'upcoming')
                            bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400
                        @else
                            bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400
                        @endif">
                        {{ ucfirst($exam->status) }}
                    </span>
                </div>

                {{-- Info --}}
                <div class="space-y-2 text-sm">
                    <div class="flex items-center gap-2 text-gray-500 dark:text-gray-400">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ $exam->exam_date->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-gray-500 dark:text-gray-400">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span class="capitalize">{{ $exam->test_type ?? 'General' }}</span>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <span class="text-xs text-gray-400 dark:text-gray-500">
                        {{ $exam->questions->count() }} Soal
                    </span>
                    <span class="text-xs text-purple-600 dark:text-purple-400 group-hover:translate-x-1 transition-transform">
                        Lihat Detail →
                    </span>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700">
                    <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Belum Ada Tryout</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Klik "Tambah Tryout" untuk memulai</p>
                    @role('admin')
                    <button type="button" @click="open = true" 
                            class="inline-block mt-4 px-6 py-2.5 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition">
                        + Tambah Tryout
                    </button>
                    @endrole
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($exams->hasPages())
        <div class="mt-6">
            {{ $exams->links() }}
        </div>
    @endif

    @include('exams.partials._create-modal', ['type' => 'tryout'])
</div>
@endsection