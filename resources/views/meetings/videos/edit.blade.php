@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                Edit Rekaman Pembelajaran
            </h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Meeting:
                <span class="font-medium">{{ $meeting->title }}</span>
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
            ← Kembali
        </a>
    </div>

    {{-- Card --}}
    <div
        class="bg-white/80 dark:bg-gray-800/80
               backdrop-blur
               rounded-2xl shadow-lg
               p-6 space-y-6">

        @php
            $thumbnailUrl = "https://img.youtube.com/vi/{$video->youtube_video_id}/hqdefault.jpg";
        @endphp

        {{-- Preview --}}
        <div class="flex items-start justify-between gap-6">

            <div>
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
                    Preview Video
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Platform: YouTube
                </p>
            </div>

            <div class="w-40 aspect-video rounded-lg overflow-hidden bg-gray-200 dark:bg-gray-700">
                <img
                    src="{{ $thumbnailUrl }}"
                    alt="Thumbnail YouTube"
                    class="w-full h-full object-cover">
            </div>

        </div>

        {{-- Form --}}
        <form
            action="{{ route('meetings.video.update', $meeting) }}"
            method="POST"
            class="space-y-6">

            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <label
                    for="title"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Judul Video
                </label>

                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title', $video->title) }}"
                    required
                    class="w-full rounded-lg
                           bg-white dark:bg-gray-900
                           border-gray-300 dark:border-gray-700
                           text-gray-800 dark:text-gray-100
                           focus:ring-primary focus:border-primary">

                @error('title')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- YouTube ID --}}
            <div>
                <label
                    for="youtube_video_id"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    YouTube Video ID
                </label>

                <input
                    type="text"
                    name="youtube_video_id"
                    id="youtube_video_id"
                    value="{{ old('youtube_video_id', $video->youtube_video_id) }}"
                    required
                    class="w-full rounded-lg
                           bg-white dark:bg-gray-900
                           border-gray-300 dark:border-gray-700
                           text-gray-800 dark:text-gray-100
                           focus:ring-primary focus:border-primary">

                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    Contoh:
                    <code class="px-1 rounded bg-gray-100 dark:bg-gray-700">
                        dQw4w9WgXcQ
                    </code>
                </p>

                @error('youtube_video_id')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Actions --}}
            <div
                class="flex justify-between items-center pt-6
                       border-t border-gray-200 dark:border-gray-700">

                {{-- Delete --}}
                <form
                    action="{{ route('meetings.video.destroy', $meeting) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus video ini?')">
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="px-4 py-2 rounded-lg
                               bg-red-600 text-white
                               hover:bg-red-700">
                        🗑️ Hapus Video
                    </button>
                </form>

                {{-- Save --}}
                <button
                    type="submit"
                    class="px-6 py-2 rounded-lg
                           bg-primary text-white
                           hover:bg-primary/90">
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>
</div>

@endsection
