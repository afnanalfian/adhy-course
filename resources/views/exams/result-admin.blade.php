@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-10">

    {{-- BACK BUTTON --}}
    <a href="{{ $exam->backRoute() }}"
        class="inline-flex items-center gap-2
                text-sm font-medium
                text-azwara-darkest dark:text-azwara-lighter
                hover:text-primary
                transition">

        <svg xmlns="http://www.w3.org/2000/svg"
                class="w-4 h-4"
                fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15 19l-7-7 7-7" />
        </svg>
        Kembali
    </a>

    {{-- ================= HEADER ================= --}}
    <div>
        <h1 class="text-2xl font-bold text-azwara-darker dark:text-azwara-lighter">
            Hasil {{ ucfirst($exam->type) }}: {{ $exam->title }}
        </h1>
        <p class="text-gray-600 dark:text-gray-300">
            {{ $exam->exam_date ? $exam->exam_date->format('d F Y') : 'Tanpa tanggal' }}
        </p>
    </div>

    {{-- ================= STATISTICS SUMMARY ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-700 rounded-xl p-4">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-blue-100 dark:bg-blue-800 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Peserta</p>
                    <p class="text-xl dark:text-white font-semibold">{{ $attempts->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-xl p-4">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-green-100 dark:bg-green-800 rounded-lg">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Rata-rata Nilai</p>
                    <p class="text-xl dark:text-white font-semibold">{{ $attempts->avg('score') ? round($attempts->avg('score'), 1) : 0 }}</p>
                </div>
            </div>
        </div>

        <div class="bg-purple-50 dark:bg-purple-900/30 border border-purple-200 dark:border-purple-700 rounded-xl p-4">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-purple-100 dark:bg-purple-800 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Waktu Rata-rata</p>
                    <p class="text-xl dark:text-white font-semibold">
                        @php
                            $avgSeconds = $attempts->avg('work_duration_seconds') ?? 0;
                            $minutes = floor($avgSeconds / 60);
                            $seconds = round($avgSeconds % 60);
                        @endphp
                        {{ $minutes }}:{{ str_pad($seconds, 2, '0', STR_PAD_LEFT) }}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-orange-50 dark:bg-orange-900/30 border border-orange-200 dark:border-orange-700 rounded-xl p-4">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-orange-100 dark:bg-orange-800 rounded-lg">
                    <svg class="w-6 h-6 text-orange-600 dark:text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Total Soal</p>
                    <p class="text-xl dark:text-white font-semibold">{{ $exam->questions->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= QUESTION TYPE BREAKDOWN ================= --}}
    @if(isset($typeBreakdown))
    <div class="bg-azwara-lightest dark:bg-secondary/80 rounded-2xl p-6">
        <h2 class="text-lg dark:text-azwara-lightest font-semibold mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            Analisis Berdasarkan Tipe Soal
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-3">
            @foreach($typeBreakdown as $type => $data)
            @if($data['total'] > 0)
            <div class="border rounded-lg p-3 text-center">
                <div class="text-sm font-medium mb-1">{{ \App\Models\Question::getAvailableTypes()[$type] ?? strtoupper($type) }}</div>
                <div class="text-2xl font-bold text-primary">{{ $data['accuracy'] }}%</div>
                <div class="text-xs text-gray-500">{{ $data['correct'] }}/{{ $data['total'] }} benar</div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
    @endif

    {{-- ================= RANKING ================= --}}
    <div class="bg-azwara-lightest dark:bg-secondary/80 rounded-2xl p-6">
        <h2 class="text-lg dark:text-azwara-lightest font-semibold mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            Peringkat Siswa
        </h2>

        <div class="overflow-x-auto">
            <table class="w-full dark:text-azwara-lightest text-sm">
                <thead class="border-b border-white/10">
                    <tr class="text-left">
                        <th class="py-3 px-4">Rank</th>
                        <th class="py-3 px-4">Nama</th>
                        <th class="py-3 px-4">Nilai</th>
                        <th class="py-3 px-4">Durasi</th>
                        <th class="py-3 px-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-white/10">
                    @forelse($attempts as $i => $attempt)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5">
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-2">
                                @if($i < 3)
                                <span class="px-2 py-1 rounded-full text-xs font-bold
                                    {{ $i === 0 ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' :
                                       ($i === 1 ? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200' :
                                       'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200') }}">
                                    {{ $i + 1 }}
                                </span>
                                @else
                                <span class="px-2 py-1 text-gray-600 dark:text-gray-400">{{ $i + 1 }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="py-3 px-4 font-medium">{{ $attempt->user->name }}</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-2">
                                <span class="font-semibold {{ $attempt->score >= 75 ? 'text-green-600' : ($attempt->score >= 50 ? 'text-yellow-600' : 'text-red-600') }}">
                                    {{ $attempt->score }}
                                </span>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            {{ floor($attempt->work_duration_seconds / 60) }}:{{ str_pad($attempt->work_duration_seconds % 60, 2, '0', STR_PAD_LEFT) }}
                        </td>
                        <td class="py-3 px-4">
                            @if($attempt->score >= 75)
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                Sangat Baik
                            </span>
                            @elseif($attempt->score >= 50)
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                Cukup
                            </span>
                            @else
                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                Perlu Perbaikan
                            </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-6 text-center text-gray-500">
                            Belum ada siswa mengerjakan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ================= SOAL & STATISTIK ================= --}}
    <div class="space-y-6">
        <h2 class="text-lg font-semibold dark:text-azwara-lightest flex items-center gap-2">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Analisis Detail Soal
        </h2>

        @foreach($exam->questions as $i => $eq)
            @php
                $question = $eq->question;
                $stat = $questionStats[$question->id] ?? ['correct'=>0,'total'=>0,'accuracy'=>0];
            @endphp

            <div class="bg-white dark:bg-secondary/80 rounded-2xl border border-gray-200 dark:border-white/10 overflow-hidden">
                {{-- QUESTION HEADER --}}
                <div class="bg-gray-50 dark:bg-gray-800/50 px-6 py-4 border-b border-gray-200 dark:border-white/10">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <h3 class="font-semibold text-gray-900 dark:text-white">
                                Soal {{ $i + 1 }}
                            </h3>
                            @if($question->type === 'compound')
                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                ({{ $question->subItems->count() }} sub)
                            </span>
                            @endif
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="text-center">
                                <div class="text-lg font-bold {{ $stat['accuracy'] >= 70 ? 'text-green-600' : ($stat['accuracy'] >= 40 ? 'text-yellow-600' : 'text-red-600') }}">
                                    {{ $stat['accuracy'] }}%
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    Akurasi
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg dark:text-azwara-lightest font-bold">{{ $stat['correct'] }}/{{ $stat['total'] }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    Benar/Total
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- QUESTION CONTENT --}}
                <div class="p-6 space-y-4">
                    {{-- QUESTION TEXT --}}
                    <div class="prose dark:text-azwara-lightest dark:prose-invert max-w-none">
                        {!! $question->question_text !!}
                    </div>

                    {{-- QUESTION IMAGE --}}
                    @if ($question->image)
                        <div class="flex justify-center">
                            <img src="{{ Storage::url($question->image) }}"
                                 alt="Gambar soal"
                                 class="max-h-64 rounded-lg border bg-white p-2 object-contain">
                        </div>
                    @endif

                    {{-- MCQ/MCMA/TrueFalse OPTIONS --}}
                    @if(in_array($question->type, ['mcq', 'mcma', 'truefalse']))
                        <div class="space-y-2">
                            @foreach($question->options ?? [] as $option)
                                <div class="p-3 rounded-lg border
                                    {{ $option->is_correct
                                        ? 'border-green-500 bg-green-50 dark:text-azwara-lightest dark:bg-green-900/20'
                                        : 'border-gray-200 dark:border-white/10' }}">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-start gap-2">
                                            @if($question->type !== 'truefalse')
                                                <span class="dark:text-azwara-lightest font-semibold">{{ $option->label }}.</span>
                                            @endif
                                            <div class="prose dark:text-azwara-lightest dark:prose-invert max-w-none">
                                                {!! $option->option_text !!}
                                            </div>
                                        </div>
                                        @if($option->is_correct)
                                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </div>
                                    @if($option->image)
                                        <img src="{{ Storage::url($option->image) }}"
                                             alt="Gambar opsi"
                                             class="mt-2 max-h-32 rounded-lg border bg-white p-2 object-contain">
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- SHORT ANSWER CORRECT ANSWERS --}}
                    @if($question->type === 'short_answer' && $question->subItems->count() > 0)
                        @php
                            $subItem = $question->subItems->first();
                            $primaryAnswer = $subItem->answers->where('is_primary', true)->first();
                            $allAnswers = $subItem->answers;
                        @endphp
                        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-lg p-4">
                            <h4 class="font-semibold text-blue-800 dark:text-blue-300 mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                                Jawaban Isian Singkat
                            </h4>
                            @if($primaryAnswer)
                                <p class="mb-2">
                                    <span class="dark:text-white font-medium">Jawaban utama:</span>
                                    <span class="ml-2 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 px-3 py-1 rounded">{{ $primaryAnswer->answer_text }}</span>
                                </p>
                            @endif
                            @if($allAnswers->count() > 1)
                                <div class="mt-2">
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Semua kemungkinan jawaban:</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($allAnswers as $answer)
                                            <span class="px-3 py-1 dark:text-azwara-lightest bg-gray-100 dark:bg-gray-700 rounded text-sm">
                                                {{ $answer->answer_text }}
                                                @if($answer->is_primary)
                                                    <svg class="w-3 h-3 inline ml-1 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                    </svg>
                                                @endif
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- COMPOUND SUB-ITEMS --}}
                    @if($question->type === 'compound')
                        <div class="bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-700 rounded-lg p-4">
                            <h4 class="font-semibold text-purple-800 dark:text-purple-300 mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                Sub Pertanyaan
                            </h4>
                            <div class="space-y-3">
                                @foreach($question->subItems->sortBy('order') as $subIndex => $subItem)
                                    <div class="border rounded-lg p-3 bg-white/50 dark:bg-gray-800/50">
                                        <div class="flex items-start justify-between mb-2">
                                            <div class="font-medium text-gray-800 dark:text-gray-100">
                                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $subItem->label }}.</span>
                                                <span class="ml-1">{{ $subItem->prompt }}</span>
                                            </div>
                                            <span class="text-xs px-2 py-1 rounded dark:text-azwara-lightest bg-gray-100 dark:bg-gray-700">
                                                {{ $subItem->type === 'truefalse' ? 'BENAR/SALAH' : 'ISIAN' }}
                                            </span>
                                        </div>

                                        {{-- Answers for sub item --}}
                                        @if($subItem->type === 'truefalse')
                                            @php
                                                $correctAnswer = $subItem->answers->first();
                                            @endphp
                                            @if($correctAnswer)
                                                <div class="text-sm dark:text-azwara-lightest">
                                                    Jawaban:
                                                    <span class="font-semibold {{ $correctAnswer->boolean_answer ? 'text-green-600' : 'text-red-600' }}">
                                                        {{ $correctAnswer->boolean_answer ? 'BENAR' : 'SALAH' }}
                                                    </span>
                                                </div>
                                            @endif
                                        @elseif($subItem->type === 'short_answer')
                                            @php
                                                $primaryAnswer = $subItem->answers->where('is_primary', true)->first();
                                                $allAnswers = $subItem->answers;
                                            @endphp
                                            <div class="text-sm">
                                                @if($primaryAnswer)
                                                    <div class="mb-1">
                                                        <span class="font-medium dark:text-azwara-lightest">Jawaban utama:</span>
                                                        <span class="ml-2 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 px-2 py-1 rounded">{{ $primaryAnswer->answer_text }}</span>
                                                    </div>
                                                @endif
                                                @if($allAnswers->count() > 1)
                                                    <div>
                                                        <span class="font-medium dark:text-azwara-lightest">Semua kemungkinan:</span>
                                                        <div class="flex flex-wrap gap-1 mt-1">
                                                            @foreach($allAnswers as $answer)
                                                                <span class="px-2 py-0.5 text-xs bg-gray-100 dark:text-azwara-lightest dark:bg-gray-700 rounded">
                                                                    {{ $answer->answer_text }}
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- EXPLANATION --}}
                    @if($question->explanation)
                        <div class="border border-gray-200 dark:border-white/10 rounded-lg overflow-hidden">
                            <div class="bg-gray-50 dark:bg-gray-800/50 px-4 py-3 border-b border-gray-200 dark:border-white/10">
                                <h4 class="font-semibold flex items-center gap-2 dark:text-azwara-lightest">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Pembahasan
                                </h4>
                            </div>
                            <div class="p-4">
                                <div class="prose dark:prose-invert max-w-none dark:text-azwara-lightest">
                                    {!! $question->explanation !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- QUESTION ANALYSIS LINK --}}
                    <div class="pt-4 border-t border-gray-200 dark:border-white/10">
                        <a href="{{ route('exams.question.analysis', [$exam, $question->id]) }}"
                           class="inline-flex dark:text-azwara-lighter items-center gap-2 text-sm text-primary hover:text-primary-dark">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Lihat analisis detail jawaban siswa
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
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
