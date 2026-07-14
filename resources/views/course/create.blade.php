@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto">
    {{-- Tombol Kembali --}}
    <div class="mb-4">
        <a href="{{ route('tentor.index') }}" 
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
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Tambah Course</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Buat course baru untuk siswa</p>
        </div>

        {{-- Error --}}
        @if ($errors->any())
            <div class="mb-4 p-3.5 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/30">
                <ul class="text-sm text-red-600 dark:text-red-400 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('course.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- Nama Course --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Nama Course <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name') }}" 
                       required
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition">
                @error('name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Slug --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Slug <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="slug" 
                       value="{{ old('slug') }}" 
                       required
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition">
                @error('slug')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Deskripsi <span class="text-red-500">*</span>
                </label>
                <textarea name="description" 
                          rows="4" 
                          required
                          class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition resize-y">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Thumbnail --}}
            {{-- <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Thumbnail <span class="text-gray-400 text-xs">(opsional)</span>
                </label>
                <input type="file" 
                       name="thumbnail"
                       class="w-full text-sm text-gray-500 dark:text-gray-400
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-xl file:border-0
                              file:bg-purple-600 file:text-white
                              file:hover:bg-purple-700 file:transition
                              cursor-pointer">
                <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Format: JPG, PNG, maks 2MB</p>
                @error('thumbnail')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div> --}}

            {{-- Submit --}}
            <button type="submit" 
                    class="w-full py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-xl transition duration-300 focus:ring-2 focus:ring-purple-500/20">
                Simpan Course
            </button>
        </form>
    </div>
</div>
@endsection