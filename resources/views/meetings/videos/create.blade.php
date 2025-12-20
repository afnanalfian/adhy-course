@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                Tambah Rekaman Pembelajaran
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

        {{-- Info --}}
        <div class="space-y-1">
            <p class="text-sm text-gray-700 dark:text-gray-300">
                Masukkan <strong>YouTube Video ID</strong> dari rekaman pembelajaran.
            </p>
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Contoh URL:
                <code class="px-1 rounded bg-gray-100 dark:bg-gray-700">
                    https://www.youtube.com/watch?v=<strong>dQw4w9WgXcQ</strong>
                </code>
            </p>
        </div>

        {{-- Form --}}
        <form
            action="{{ route('meetings.video.store', $meeting) }}"
            method="POST"
            class="space-y-6">

            @csrf

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
                    value="{{ old('youtube_video_id') }}"
                    placeholder="contoh: dQw4w9WgXcQ"
                    required
                    class="block w-full rounded-lg
                           border-gray-300 dark:border-gray-600
                           dark:bg-gray-700 dark:text-gray-200
                           focus:ring-primary focus:border-primary">

                @error('youtube_video_id')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Actions --}}
            <div
                class="flex justify-end gap-3 pt-4
                       border-t border-gray-200 dark:border-gray-700">

                <a
                    href="{{ route('meeting.show', $meeting) }}"
                    class="px-4 py-2 rounded-lg
                           bg-gray-200 dark:bg-gray-700
                           text-gray-800 dark:text-gray-200
                           hover:bg-gray-300 dark:hover:bg-gray-600">
                    Batal
                </a>

                <button
                    type="submit"
                    class="px-6 py-2 rounded-lg
                           bg-primary text-white
                           hover:bg-primary/90">
                    Simpan Video
                </button>

            </div>

        </form>

    </div>
</div>

@endsection
