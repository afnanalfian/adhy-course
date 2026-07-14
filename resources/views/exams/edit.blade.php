@extends('layouts.app')

@section('content')
<div x-data="{ openAddQuestion: false }" class="max-w-6xl mx-auto space-y-6">

    {{-- Tombol Kembali --}}
    <div class="mb-4">
        <a href="{{ route('exams.show', $exam) }}" 
           class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Detail Ujian
        </a>
    </div>

    {{-- HEADER --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Edit Exam
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">
                    {{ ucfirst($exam->type) }}
                </p>
            </div>

            @php
                $statusColor = match ($exam->status) {
                    'inactive' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
                    'active' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                    'closed' => 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400',
                };
            @endphp

            <span class="inline-block px-3 py-1 text-xs font-medium rounded-full {{ $statusColor }}">
                {{ ucfirst($exam->status) }}
            </span>
        </div>
    </div>

    {{-- FORM --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6">
        <form method="POST" action="{{ route('exams.update', $exam) }}" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Judul --}}
            @if(in_array($exam->type, ['quiz', 'tryout']))
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        Judul <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           value="{{ old('title', $exam->title) }}" 
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition"
                           @disabled($exam->status !== 'inactive')>
                </div>
            @endif

            {{-- Tipe Tes (Read Only) --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Tipe Tes
                </label>
                <div class="w-full sm:w-64 px-4 py-2.5 rounded-xl bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 cursor-not-allowed">
                    {{ strtoupper($exam->test_type) }}
                </div>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Tipe tes tidak dapat diubah setelah ujian dibuat.</p>
            </div>

            {{-- Tanggal & Jam --}}
            @if(in_array($exam->type, ['quiz', 'tryout']))
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        Tanggal & Jam Mulai
                    </label>
                    <input type="datetime-local" 
                           name="exam_date" 
                           value="{{ old('exam_date', optional($exam->exam_date)->format('Y-m-d\TH:i')) }}" 
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition"
                           @disabled($exam->status !== 'inactive')>
                </div>
            @endif

            {{-- Durasi --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Durasi Ujian (menit) <span class="text-red-500">*</span>
                </label>
                <input type="number" 
                       name="duration_minutes" 
                       min="1"
                       value="{{ old('duration_minutes', $exam->duration_minutes) }}" 
                       class="w-full sm:w-64 px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition"
                       @disabled($exam->status !== 'inactive')>
            </div>

            {{-- Submit --}}
            @if($exam->status === 'inactive')
                <div class="pt-2">
                    <button type="submit" 
                            class="px-6 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-xl transition">
                        💾 Simpan Perubahan
                    </button>
                </div>
            @else
                <p class="text-sm text-gray-500 dark:text-gray-400">Exam sudah aktif/ditutup, data tidak dapat diubah.</p>
            @endif
        </form>
    </div>

    {{-- Selected Questions --}}
    @include('exams.partials.selected-questions')

    {{-- Action Buttons --}}
    <div class="flex flex-wrap items-center gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        @if($exam->status === 'inactive')
            <form method="POST" action="{{ route('exams.activate', $exam) }}" class="sweet-confirm"
                  data-message="Yakin ingin memulai ujian ini?">
                @csrf
                <button type="submit"
                        class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white font-medium rounded-xl transition">
                    🚀 Launch Ujian
                </button>
            </form>
        @endif

        @if($exam->status === 'active')
            <form method="POST" action="{{ route('exams.close', $exam) }}" class="sweet-confirm"
                  data-message="Yakin ingin menutup ujian ini?">
                @csrf
                <button type="submit"
                        class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-xl transition">
                    ⏹ Tutup Ujian
                </button>
            </form>
        @endif

        <a href="{{ route('exams.show', $exam) }}" 
           class="px-5 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition">
            ← Kembali ke Detail
        </a>
    </div>

    {{-- Add Question Modal --}}
    @include('exams.partials.add-question-modal')
</div>
@endsection

@push('scripts')
<script>
    window.MathJax = {
        tex: {
            inlineMath: [['\\(', '\\)']]
        }
    };
</script>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (window.MathJax) {
            MathJax.typesetPromise();
        }
    });
</script>
@endpush