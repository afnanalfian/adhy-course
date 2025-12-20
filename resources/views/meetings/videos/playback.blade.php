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
                Rekaman Pembelajaran (YouTube)
            </p>
        </div>

        {{-- Back --}}
        <a
            href="{{ route('meeting.show', $meeting) }}"
            class="inline-flex items-center gap-2
                   px-4 py-2 rounded-lg
                   bg-gray-200 dark:bg-gray-700
                   text-gray-800 dark:text-gray-200
                   hover:bg-gray-300 dark:hover:bg-gray-600">
            ← Kembali ke Meeting
        </a>
    </div>

    {{-- Video Card --}}
    <div
        class="bg-black
               rounded-2xl overflow-hidden
               shadow-xl">

        <div class="relative w-full aspect-video">
            <iframe
                src="{{ $embedUrl }}"
                class="absolute inset-0 w-full h-full"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen>
            </iframe>
        </div>

    </div>

    {{-- Video Meta --}}
    <div
        class="bg-white/80 dark:bg-gray-800/80
               backdrop-blur
               rounded-2xl shadow
               p-4 flex flex-wrap gap-6 text-sm text-gray-700 dark:text-gray-300">

        <div>
            <span class="block text-xs uppercase tracking-wide text-gray-500">
                Judul Video
            </span>
            {{ $video->title }}
        </div>

        <div>
            <span class="block text-xs uppercase tracking-wide text-gray-500">
                Platform
            </span>
            YouTube
        </div>
    </div>

</div>

@endsection
