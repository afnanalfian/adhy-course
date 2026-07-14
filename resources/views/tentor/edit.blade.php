@extends('layouts.app')

@section('content')

{{-- Back --}}
<div class="mb-4">
    <a href="{{ route('tentor.show', $teacher->id) }}" 
       class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali
    </a>
</div>

{{-- Card --}}
<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 sm:p-8 max-w-2xl">
    {{-- Header --}}
    <div class="flex items-center gap-4 mb-6">
        <img src="{{ $teacher->user->avatar_url }}"
             class="w-14 h-14 rounded-full object-cover border-2 border-purple-500/30">

        <div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Edit Tentor</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $teacher->user->name }}</p>
            <p class="text-xs text-gray-400 dark:text-gray-500">{{ $teacher->user->email }}</p>
        </div>
    </div>

    {{-- Form --}}
    <form method="POST" action="{{ route('tentor.update', $teacher->id) }}" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Bio --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                Bio Tentor
            </label>
            <textarea name="bio" rows="4" 
                      class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition resize-y">{{ trim(old('bio', $teacher->bio)) }}</textarea>
        </div>

        {{-- Courses --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                Mengajar Course <span class="text-gray-400 text-xs">(opsional)</span>
            </label>
            <select name="course_id[]" multiple id="course-select"
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition">
                @foreach ($courses as $c)
                    <option value="{{ $c->id }}" {{ in_array($c->id, $teacher->courses->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Save --}}
        <button type="submit" 
                class="w-full py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-xl transition duration-300 focus:ring-2 focus:ring-purple-500/20">
            Simpan Perubahan
        </button>
    </form>
</div>

@endsection

{{-- TOMSELECT --}}
@push('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

    <style>
        .ts-control {
            border-radius: 0.75rem !important;
            padding: 10px !important;
            min-height: 46px;
            background-color: #f9fafb !important;
            border-color: #d1d5db !important;
        }
        .dark .ts-control {
            background-color: #111827 !important;
            border-color: #374151 !important;
            color: #f9fafb !important;
        }
        .ts-control input {
            color: inherit !important;
        }
        .ts-dropdown {
            border-radius: 0.75rem !important;
            background-color: #f9fafb !important;
            border-color: #d1d5db !important;
        }
        .dark .ts-dropdown {
            background-color: #111827 !important;
            border-color: #374151 !important;
            color: #f9fafb !important;
        }
        .dark .ts-dropdown .option {
            color: #f9fafb !important;
        }
        .dark .ts-dropdown .option.active {
            background-color: #1f2937 !important;
        }
        .ts-dropdown .option.active {
            background-color: #e5e7eb !important;
        }
        .ts-wrapper.multi .ts-control > div {
            background-color: #8B5CF6 !important;
            color: white !important;
            border-radius: 6px !important;
            padding: 2px 8px !important;
        }
        .dark .ts-wrapper.multi .ts-control > div {
            background-color: #7C3AED !important;
        }
        .ts-wrapper.multi .ts-control > div .remove {
            color: white !important;
            opacity: 0.8;
        }
        .ts-wrapper.multi .ts-control > div .remove:hover {
            opacity: 1;
        }
    </style>

    <script>
        new TomSelect('#course-select', {
            plugins: ['remove_button'],
            placeholder: "Pilih course (opsional)",
        });
    </script>
@endpush