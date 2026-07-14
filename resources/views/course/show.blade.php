@extends('layouts.app')

@section('title', $course->name . ' | Course ENS Makassar')
@section('description', Str::limit($course->description, 155))
@section('content')

<div class="max-w-4xl mx-auto">
    {{-- Tombol Kembali --}}
    <div class="mb-4">
        <a href="{{ route('course.index') }}" 
           class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Daftar Course
        </a>
    </div>

    {{-- Header Course --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $course->name }}</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $course->meetings->count() }} Pertemuan</p>
    </div>

    {{-- Header Meeting --}}
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-sm font-medium text-gray-700 dark:text-gray-300">Daftar Pertemuan</h2>
        <div class="flex items-center gap-3">
            <input id="meeting-search" 
                   type="text" 
                   placeholder="Cari pertemuan..." 
                   class="px-4 py-2 text-sm rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition w-48">
            
            @hasanyrole('admin|tentor')
            <a href="{{ route('meeting.create', $course) }}" 
               class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-xl hover:bg-purple-700 transition">
                + Tambah
            </a>
            @endhasanyrole
        </div>
    </div>

    {{-- Meeting List --}}
    <div id="meeting-list" class="space-y-2">
        @forelse ($course->meetings as $index => $meeting)
            @php
                $canAccess = auth()->check() && auth()->user()->can('view', $meeting);
                $statusColor = match($meeting->status) {
                    'upcoming' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
                    'live' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                    'done' => 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300',
                    default => 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300',
                };
            @endphp

            <div @if($canAccess) onclick="window.location='{{ route('meeting.show', $meeting) }}'" @endif
                 class="meeting-card group rounded-xl px-4 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 
                        {{ $canAccess ? 'cursor-pointer hover:border-purple-500 hover:shadow-md transition-all duration-300' : 'opacity-75' }}">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-3">
                            <span class="text-xs text-gray-400 dark:text-gray-500 font-medium">
                                #{{ $index + 1 }}
                            </span>
                            <h3 class="meeting-title text-sm font-medium text-gray-900 dark:text-white truncate">
                                {{ $meeting->title }}
                            </h3>
                        </div>
                        @if($meeting->scheduled_at)
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">
                                {{ $meeting->scheduled_at->translatedFormat('l, d F Y • H:i') }} WITA
                            </p>
                        @endif
                    </div>
                    
                    <div class="flex items-center gap-2 flex-shrink-0">
                        @if($canAccess)
                            <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $statusColor }}">
                                {{ ucfirst($meeting->status) }}
                            </span>
                        @else
                            <span class="text-xs font-medium px-2.5 py-1 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400">
                                🔒 Terkunci
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                Belum ada pertemuan untuk course ini.
            </div>
        @endforelse
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Search meeting
    const searchInput = document.getElementById('meeting-search');
    const cards = document.querySelectorAll('.meeting-card');

    searchInput?.addEventListener('input', function() {
        const keyword = this.value.toLowerCase();

        cards.forEach(card => {
            const title = card.querySelector('.meeting-title');
            if (title) {
                const text = title.innerText.toLowerCase();
                card.style.display = text.includes(keyword) ? '' : 'none';
            }
        });
    });
</script>
@endpush