@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                {{ $meeting->title }}
            </h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Rekaman Pembelajaran
            </p>
        </div>

        {{-- Back --}}
        <a
            href="{{ route('meeting.show', $meeting) }}"
            class="inline-flex items-center gap-2
                   px-4 py-2 rounded-lg
                   bg-gray-200 dark:bg-gray-700
                   text-gray-800 dark:text-gray-200
                   hover:bg-gray-300 dark:hover:bg-gray-600
                   transition">
            ← Kembali ke Meeting
        </a>
    </div>

    {{-- Video Card --}}
    <div
        class="bg-black/90
               rounded-2xl overflow-hidden
               shadow-xl">

        @if ($video->status === 'ready')

            {{-- Bunny Embed --}}
            <div class="relative w-full aspect-video">
                <iframe
                    src="{{ $embedUrl }}"
                    class="absolute inset-0 w-full h-full"
                    allow="accelerometer; gyroscope; autoplay; encrypted-media; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>

        @elseif ($video->status === 'processing')

            {{-- Processing --}}
            <div class="aspect-video flex items-center justify-center text-center p-6">
                <div class="space-y-3">
                    <div class="text-yellow-400 text-lg">⏳</div>
                    <p class="text-gray-200">
                        Video sedang diproses.<br>
                        Silakan kembali beberapa saat lagi.
                    </p>
                </div>
            </div>

        @else

            {{-- Failed --}}
            <div class="aspect-video flex items-center justify-center text-center p-6">
                <div class="space-y-3">
                    <div class="text-red-400 text-lg">⚠️</div>
                    <p class="text-gray-200">
                        Video gagal diproses.<br>
                        Silakan hubungi admin.
                    </p>
                </div>
            </div>

        @endif
    </div>

    {{-- Video Meta --}}
    <div
        class="bg-white/80 dark:bg-gray-800/80
               backdrop-blur
               rounded-2xl shadow
               p-4 flex flex-wrap gap-6 text-sm text-gray-700 dark:text-gray-300">

        <div>
            <span class="block text-xs uppercase tracking-wide text-gray-500">
                Durasi
            </span>
            {{ $video->duration ? gmdate('H:i:s', $video->duration) : '-' }}
        </div>

        <div>
            <span class="block text-xs uppercase tracking-wide text-gray-500">
                Status
            </span>
            {{ ucfirst($video->status) }}
        </div>

    </div>

</div>

@endsection
