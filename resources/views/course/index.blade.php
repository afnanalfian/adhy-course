@extends('layouts.app')

@section('title', 'Course Kedinasan | ENS Makassar')
@section('description', 'Bimbingan Persiapan Masuk Sekolah kedinasan dengan materi terstruktur dan latihan soal.')
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
                    📚 Daftar Course
                </h1>
                <p class="text-white/80 text-sm mt-1">
                    Kelas yang tersedia saat ini untuk perjalanan belajarmu
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                {{-- SEARCH --}}
                <form method="GET" action="{{ route('course.index') }}" class="flex gap-2">
                    <div class="relative">
                        <input type="text"
                               name="q"
                               placeholder="Cari course..."
                               value="{{ $q ?? '' }}"
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

                {{-- ADD BUTTON (ADMIN ONLY) --}}
                @role('admin')
                <a href="{{ route('course.create') }}"
                   class="px-5 py-2.5 bg-white text-purple-600 font-medium rounded-xl hover:bg-white/90 hover:shadow-lg hover:shadow-white/20 transition-all duration-300 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Course
                </a>
                @endrole
            </div>
        </div>
    </div>

    {{-- GRID --}}
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($courses as $c)
            <article class="group bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-2xl hover:shadow-purple-500/10 dark:hover:shadow-purple-500/5 transition-all duration-300 hover:-translate-y-1">
                
                <div class="p-6">
                    {{-- Badge --}}
                    <div class="flex items-start justify-between mb-3">
                        @php
                            $user = auth()->user();
                            $badgeText = 'Course';
                            $badgeClass = 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400';

                            if ($user && $user->hasRole('siswa')) {
                                if ($c->is_free) {
                                    $badgeText = '🎯 FREE';
                                    $badgeClass = 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400';
                                } else {
                                    $totalMeetings = $c->meetings->count();

                                    if ($user->hasCourse($c->id)) {
                                        $badgeText = '✅ Full Access';
                                        $badgeClass = 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400';
                                    } else {
                                        $ownedMeetingIds = $user->ownedMeetingIds();
                                        $ownedCount = $c->meetings->whereIn('id', $ownedMeetingIds)->count();

                                        if ($ownedCount === 0) {
                                            $badgeText = '🔒 Belum Akses';
                                            $badgeClass = 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-400';
                                        } elseif ($ownedCount >= $totalMeetings) {
                                            $badgeText = '✅ Full Access';
                                            $badgeClass = 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400';
                                        } else {
                                            $badgeText = "📊 {$ownedCount}/{$totalMeetings}";
                                            $badgeClass = 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400';
                                        }
                                    }
                                }
                            }
                        @endphp

                        <span class="text-xs font-semibold px-3 py-1 rounded-full {{ $badgeClass }}">
                            {{ $badgeText }}
                        </span>

                        @if($c->is_free)
                            <span class="text-xs font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-900/30 px-3 py-1 rounded-full">
                                GRATIS
                            </span>
                        @endif
                    </div>

                    {{-- Title --}}
                    <a href="{{ route('course.show', $c->slug) }}" class="block group-hover:translate-x-0.5 transition-transform">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 line-clamp-2">
                            {{ $c->name }}
                        </h3>
                    </a>

                    {{-- Description --}}
                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 leading-relaxed line-clamp-3">
                        {{ \Illuminate\Support\Str::limit($c->description ?? 'Tidak ada deskripsi', 120) }}
                    </p>

                    {{-- Course Info --}}
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center gap-2 text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <span class="truncate">
                                {{ $c->teachers->isNotEmpty()
                                   ? $c->teachers->map(fn($t) => $t->user->name ?? '-')->join(', ')
                                   : 'Belum ada tentor' }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <span>{{ $c->meetings->count() }} Pertemuan</span>
                        </div>
                    </div>

                    {{-- Action Button --}}
                    <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('course.show', $c->slug) }}"
                           class="inline-flex items-center justify-center w-full px-4 py-2.5 bg-gradient-to-r from-purple-600 to-blue-600 text-white font-medium rounded-xl hover:from-purple-700 hover:to-blue-700 transition-all duration-300 shadow-lg shadow-purple-500/25 hover:shadow-purple-500/40">
                            <span class="flex items-center gap-2">
                                Lihat Course
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>

                {{-- ADMIN ACTIONS --}}
                @role('admin')
                <div class="flex items-center justify-between gap-3 p-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('course.edit', $c->slug) }}"
                       class="flex-1 px-4 py-2 text-sm font-medium text-center rounded-xl bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-purple-500 transition-all duration-300">
                        ✏️ Edit
                    </a>

                    <form method="POST"
                          action="{{ route('course.delete', $c->slug) }}"
                          class="flex-1 sweet-confirm"
                          data-message="Yakin ingin menghapus course ini? Semua meeting dan datanya akan hilang secara permanen.">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full px-4 py-2 text-sm font-medium text-center rounded-xl bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-800 hover:bg-red-100 dark:hover:bg-red-900/30 transition-all duration-300">
                            🗑️ Hapus
                        </button>
                    </form>
                </div>
                @endrole
            </article>
        @empty
            <div class="col-span-full">
                <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700">
                    <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Belum Ada Course</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Klik "Tambah Course" untuk memulai</p>
                    @role('admin')
                    <a href="{{ route('course.create') }}" class="inline-block mt-4 px-6 py-2.5 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition">
                        + Tambah Course
                    </a>
                    @endrole
                </div>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    @if($courses->hasPages())
        <div class="mt-8">
            {{ $courses->links() }}
        </div>
    @endif

@endsection