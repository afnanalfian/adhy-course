@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                Upload Rekaman Pembelajaran
            </h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Meeting: <span class="font-medium">{{ $meeting->title }}</span>
            </p>
        </div>

        {{-- Back Button --}}
        <a
            href="{{ route('meetings.show', $meeting) }}"
            class="inline-flex items-center gap-2
                   px-4 py-2 rounded-lg
                   bg-gray-200 dark:bg-gray-700
                   text-gray-800 dark:text-gray-200
                   hover:bg-gray-300 dark:hover:bg-gray-600
                   transition">
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
                Silakan upload rekaman video hasil pertemuan Zoom.
            </p>
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Format yang didukung: MP4 / MOV • Maksimal 2 GB
            </p>
        </div>

        {{-- Form --}}
        <form
            action="{{ route('meetings.video.store', $meeting) }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-6">

            @csrf

            {{-- File Input --}}
            <div>
                <label
                    for="video"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    File Video
                </label>

                <input
                    type="file"
                    name="video"
                    id="video"
                    accept="video/mp4,video/quicktime"
                    required
                    class="block w-full
                           text-sm text-gray-700 dark:text-gray-200
                           file:mr-4 file:py-2 file:px-4
                           file:rounded-lg file:border-0
                           file:bg-primary file:text-white
                           hover:file:bg-primary/90
                           cursor-pointer">

                @error('video')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">

                <a
                    href="{{ route('meetings.show', $meeting) }}"
                    class="px-4 py-2 rounded-lg
                           bg-gray-200 dark:bg-gray-700
                           text-gray-800 dark:text-gray-200
                           hover:bg-gray-300 dark:hover:bg-gray-600
                           transition">
                    Batal
                </a>

                <button
                    type="submit"
                    class="px-6 py-2 rounded-lg
                           bg-primary text-white
                           hover:bg-primary/90
                           transition">
                    Upload Video
                </button>

            </div>

        </form>

    </div>
</div>

@endsection
