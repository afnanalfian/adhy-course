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
                Meeting: <span class="font-medium">{{ $meeting->title }}</span>
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
            ← Kembali
        </a>
    </div>

    {{-- Card --}}
    <div
        class="bg-white/80 dark:bg-gray-800/80
               backdrop-blur
               rounded-2xl shadow-lg
               p-6 space-y-6">

        {{-- Status --}}
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
                    Status Video
                </p>

                @if ($video->status === 'ready')
                    <span class="inline-block mt-1 px-3 py-1 text-xs rounded-full
                                 bg-green-100 text-green-700
                                 dark:bg-green-900/30 dark:text-green-300">
                        Siap Diputar
                    </span>
                @elseif ($video->status === 'processing')
                    <span class="inline-block mt-1 px-3 py-1 text-xs rounded-full
                                 bg-yellow-100 text-yellow-700
                                 dark:bg-yellow-900/30 dark:text-yellow-300">
                        Sedang Diproses
                    </span>
                @else
                    <span class="inline-block mt-1 px-3 py-1 text-xs rounded-full
                                 bg-red-100 text-red-700
                                 dark:bg-red-900/30 dark:text-red-300">
                        Gagal
                    </span>
                @endif
            </div>

            {{-- Thumbnail --}}
            <div class="w-32 aspect-video rounded-lg overflow-hidden bg-gray-200 dark:bg-gray-700">
                @if ($video->thumbnail_url)
                    <img
                        src="{{ $video->thumbnail_url }}"
                        alt="Thumbnail"
                        class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-xs text-gray-500">
                        No Thumbnail
                    </div>
                @endif
            </div>
        </div>

        {{-- Form Edit --}}
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

            {{-- Meta Info --}}
            <div class="grid grid-cols-2 gap-4 text-sm text-gray-600 dark:text-gray-400">
                <div>
                    <span class="block text-xs uppercase tracking-wide">Durasi</span>
                    {{ $video->duration ? gmdate('H:i:s', $video->duration) : '-' }}
                </div>
                <div>
                    <span class="block text-xs uppercase tracking-wide">Library ID</span>
                    {{ $video->library_id }}
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex justify-between items-center pt-6 border-t border-gray-200 dark:border-gray-700">

                {{-- Delete --}}
                <form
                    action="{{ route('meetings.video.destroy', $meeting) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus video ini secara permanen?')">
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="px-4 py-2 rounded-lg
                               bg-red-600 text-white
                               hover:bg-red-700
                               transition">
                        Hapus Video
                    </button>
                </form>

                {{-- Save --}}
                <button
                    type="submit"
                    class="px-6 py-2 rounded-lg
                           bg-primary text-white
                           hover:bg-primary/90
                           transition">
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>
</div>

@endsection
