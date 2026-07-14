@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto">
    {{-- Tombol Kembali --}}
    <div class="mb-4">
        <a href="{{ route('course.show', $course->slug) }}" 
           class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>
    </div>

    {{-- Card --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 sm:p-8">
        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Tambah Pertemuan</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Course: <span class="font-medium text-gray-700 dark:text-gray-300">{{ $course->name }}</span>
            </p>
        </div>

        <form action="{{ route('meeting.store', $course) }}" method="POST" class="space-y-5">
            @csrf

            {{-- Judul --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Judul Pertemuan <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="title" 
                       value="{{ old('title') }}" 
                       required
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition">
                @error('title')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal & Jam --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Tanggal & Jam Mulai
                </label>
                <input type="datetime-local" 
                       name="scheduled_at" 
                       value="{{ old('scheduled_at') }}"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition">
                @error('scheduled_at')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Link Zoom --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Link Zoom <span class="text-gray-400 text-xs">(opsional)</span>
                </label>
                <input type="url" 
                       name="zoom_link" 
                       value="{{ old('zoom_link') }}" 
                       placeholder="https://zoom.us/..."
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition">
                @error('zoom_link')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="flex items-center gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('course.show', $course->slug) }}" 
                   class="px-5 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition">
                    Batal
                </a>
                <button type="submit" 
                        class="flex-1 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-xl transition duration-300 focus:ring-2 focus:ring-purple-500/20">
                    Simpan Pertemuan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection