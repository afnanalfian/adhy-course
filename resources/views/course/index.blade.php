@extends('layouts.app')

@section('title', 'Course Kedinasan | ENS Makassar')
@section('description', 'Bimbingan Persiapan Masuk Sekolah kedinasan dengan materi terstruktur dan latihan soal.')
@section('content')

    {{-- HEADER --}}
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            {{-- Title --}}
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Daftar Course
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Kelas yang tersedia saat ini
                </p>
            </div>

            {{-- Search + Add Button --}}
            <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                {{-- SEARCH --}}
                <form method="GET" action="{{ route('course.index') }}" class="flex w-full sm:w-auto gap-2">
                    <input type="text"
                           name="q"
                           placeholder="Cari course..."
                           value="{{ $q ?? '' }}"
                           class="flex-1 px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition w-full sm:w-64" />
                    <button type="submit"
                            class="px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-ens-medium transition focus:ring-2 focus:ring-primary/20">
                        Cari
                    </button>
                </form>

                {{-- ADD BUTTON (ADMIN ONLY) --}}
                @role('admin')
                <a href="{{ route('course.create') }}"
                   class="px-4 py-2.5 bg-gray-900 dark:bg-gray-700 text-white rounded-lg hover:bg-gray-800 dark:hover:bg-gray-600 transition focus:ring-2 focus:ring-gray-300">
                    + Tambah Course
                </a>
                @endrole
            </div>
        </div>
    </div>

    {{-- GRID --}}
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($courses as $c)
            <article class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition">

                {{-- IMAGE & BADGE --}}
                <div class="relative">
                    <a href="{{ route('course.show', $c->slug) }}">
                        <img src="{{ $c->thumbnail ? asset('storage/' . $c->thumbnail) : asset('img/course-default.png') }}"
                             alt="{{ $c->name }}"
                             class="w-full h-44 object-cover">
                    </a>

                    {{-- BADGE AKSES COURSE --}}
                    @php
                        $user = auth()->user();
                        $badgeText = 'Course';
                        $badgeClass = 'bg-primary text-white';

                        if ($user && $user->hasRole('siswa')) {
                            if ($c->is_free) {
                                $badgeText = 'FREE';
                                $badgeClass = 'bg-emerald-600 text-white';
                            } else {
                                $totalMeetings = $c->meetings->count();

                                if ($user->hasCourse($c->id)) {
                                    $badgeText = 'Full Access';
                                    $badgeClass = 'bg-green-600 text-white';
                                } else {
                                    $ownedMeetingIds = $user->ownedMeetingIds();
                                    $ownedCount = $c->meetings->whereIn('id', $ownedMeetingIds)->count();

                                    if ($ownedCount === 0) {
                                        $badgeText = 'Belum Akses';
                                        $badgeClass = 'bg-gray-500 text-white';
                                    } elseif ($ownedCount >= $totalMeetings) {
                                        $badgeText = 'Full Access';
                                        $badgeClass = 'bg-green-600 text-white';
                                    } else {
                                        $badgeText = "{$ownedCount}/{$totalMeetings} Meetings";
                                        $badgeClass = 'bg-blue-600 text-white';
                                    }
                                }
                            }
                        }
                    @endphp

                    {{-- <span class="absolute left-3 top-3 text-xs font-medium px-3 py-1.5 rounded-md shadow {{ $badgeClass }}">
                        {{ $badgeText }}
                    </span> --}}
                </div>

                {{-- CARD CONTENT --}}
                <div class="p-5">
                    <a href="{{ route('course.show', $c->slug) }}">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 truncate">
                            {{ $c->name }}
                        </h3>
                    </a>

                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
                        {{ \Illuminate\Support\Str::limit($c->description ?? '-', 100) }}
                    </p>

                    <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                        <span class="font-medium text-gray-700 dark:text-gray-300 mr-2">Tentor:</span>
                        <span class="truncate">
                            {{ $c->teachers->isNotEmpty()
                               ? $c->teachers->map(fn($t) => $t->user->name ?? '-')->join(', ')
                               : '-' }}
                        </span>
                    </div>
                </div>

                {{-- ADMIN ACTIONS --}}
                @role('admin')
                <div class="flex items-center justify-between gap-3 p-4 border-t border-gray-100 dark:border-gray-700">
                    <a href="{{ route('course.edit', $c->slug) }}"
                       class="px-4 py-2 text-sm font-medium rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                        Edit
                    </a>

                    <form method="POST"
                          action="{{ route('course.delete', $c->slug) }}"
                          class="sweet-confirm"
                          data-message="Yakin ingin menghapus course ini? Semua meeting dan datanya akan hilang secara permanen.">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 text-sm font-medium rounded-lg bg-red-600 text-white hover:bg-red-700 transition focus:ring-2 focus:ring-red-300">
                            Hapus
                        </button>
                    </form>
                </div>
                @endrole
            </article>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-600 dark:text-gray-400">
                    Belum ada course. Klik "Tambah Course" untuk menambahkan baru.
                </p>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    @if($courses->hasPages())
        <div class="mt-6">
            {{ $courses->links() }}
        </div>
    @endif

@endsection
