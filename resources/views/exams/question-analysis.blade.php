{{-- resources/views/exams/question-analysis.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    {{-- BACK BUTTON --}}
    <div class="flex items-center justify-between">
        <a href="{{ route('exams.result.admin', $exam) }}"
           class="inline-flex items-center gap-2
                  text-sm font-medium
                  text-azwara-darkest dark:text-azwara-lighter
                  hover:text-primary transition">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-4 h-4"
                 fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Hasil Ujian
        </a>

        <div class="text-sm text-gray-500 dark:text-gray-400">
            {{ $attemptsWithAnswers->count() }} siswa mengerjakan soal ini
        </div>
    </div>

    {{-- HEADER --}}
    <div class="bg-white dark:bg-secondary/80 rounded-2xl border border-gray-200 dark:border-white/10 p-6">
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Analisis Detail Soal
                </h1>
                <p class="text-gray-600 dark:text-gray-300">
                    {{ $exam->title }} • Soal ID: {{ $question->id }}
                </p>
            </div>
            <div class="flex items-center gap-3">
                <span class="px-3 py-1.5 text-sm rounded-lg bg-primary/10 text-primary font-semibold">
                    {{ $question->type_label }}
                </span>
                @if($question->type === 'compound')
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    ({{ $question->subItems->count() }} sub)
                </span>
                @endif
            </div>
        </div>
    </div>

    {{-- QUESTION CONTENT --}}
    <div class="bg-white dark:bg-secondary/80 rounded-2xl border border-gray-200 dark:border-white/10 p-6 space-y-6">
        <div>
            <h2 class="text-lg font-semibold mb-3 text-gray-900 dark:text-white">Soal</h2>
            <div class="prose dark:prose-invert max-w-none">
                {!! $question->question_text !!}
            </div>

            @if($question->image)
            <div class="mt-4 flex justify-center">
                <img src="{{ Storage::url($question->image) }}"
                     alt="Gambar soal"
                     class="max-h-64 rounded-lg border bg-white p-2 object-contain">
            </div>
            @endif
        </div>

        {{-- STATISTICS SUMMARY --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-xl p-4">
                <div class="text-center">
                    <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                        {{ $attemptsWithAnswers->count() }}
                    </div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Total Jawaban</div>
                </div>
            </div>

            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 rounded-xl p-4">
                <div class="text-center">
                    <div class="text-2xl font-bold text-green-600 dark:text-green-400">
                        {{ $attemptsWithAnswers->where('is_correct', true)->count() }}
                    </div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Jawaban Benar</div>
                </div>
            </div>

            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 rounded-xl p-4">
                <div class="text-center">
                    <div class="text-2xl font-bold text-red-600 dark:text-red-400">
                        {{ $attemptsWithAnswers->where('is_correct', false)->count() }}
                    </div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Jawaban Salah</div>
                </div>
            </div>

            <div class="bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-700 rounded-xl p-4">
                <div class="text-center">
                    @php
                        $total = $attemptsWithAnswers->count();
                        $correct = $attemptsWithAnswers->where('is_correct', true)->count();
                        $accuracy = $total > 0 ? round(($correct / $total) * 100, 1) : 0;
                    @endphp
                    <div class="text-2xl font-bold {{ $accuracy >= 70 ? 'text-green-600' : ($accuracy >= 40 ? 'text-yellow-600' : 'text-red-600') }}">
                        {{ $accuracy }}%
                    </div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Akurasi</div>
                </div>
            </div>
        </div>
    </div>

    {{-- MCQ/MCMA/TrueFalse OPTION ANALYSIS --}}
    @if(in_array($question->type, ['mcq', 'mcma', 'truefalse']) && isset($optionStats))
    <div class="bg-white dark:bg-secondary/80 rounded-2xl border border-gray-200 dark:border-white/10 p-6">
        <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">
            <svg class="w-5 h-5 inline mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            Analisis Pilihan Jawaban
        </h2>

        <div class="space-y-4">
            @foreach($question->options as $option)
            @php
                $stat = $optionStats[$option->id] ?? ['count' => 0, 'percentage' => 0];
                $isCorrect = $option->is_correct;
                $totalAnswers = $attemptsWithAnswers->count();
            @endphp
            <div class="border rounded-lg p-4 {{ $isCorrect ? 'border-green-500 bg-green-50 dark:bg-green-900/20' : 'border-gray-200 dark:border-white/10' }}">
                <div class="flex items-start justify-between mb-2">
                    <div class="flex items-start gap-3">
                        @if($question->type !== 'truefalse')
                        <span class="font-bold text-lg">{{ $option->label }}.</span>
                        @endif
                        <div class="prose dark:prose-invert max-w-none">
                            {!! $option->option_text !!}
                        </div>
                    </div>
                    @if($isCorrect)
                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    @endif
                </div>

                <div class="mt-3">
                    <div class="flex items-center justify-between text-sm mb-1">
                        <span class="text-gray-600 dark:text-gray-400">
                            Dipilih oleh {{ $stat['count'] }} siswa
                        </span>
                        <span class="font-semibold {{ $isCorrect ? 'text-green-600' : 'text-gray-700 dark:text-gray-300' }}">
                            {{ $stat['percentage'] }}%
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div class="h-2 rounded-full {{ $isCorrect ? 'bg-green-600' : 'bg-blue-600' }}"
                             style="width: {{ min($stat['percentage'], 100) }}%">
                        </div>
                    </div>
                </div>

                @if($option->image)
                <div class="mt-3">
                    <img src="{{ Storage::url($option->image) }}"
                         alt="Gambar opsi"
                         class="max-h-32 rounded-lg border bg-white p-2 object-contain">
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- SHORT ANSWER RESPONSES --}}
    @if($question->type === 'short_answer' && isset($shortAnswerResponses))
    <div class="bg-white dark:bg-secondary/80 rounded-2xl border border-gray-200 dark:border-white/10 p-6">
        <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">
            <svg class="w-5 h-5 inline mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
            Jawaban Isian Siswa
        </h2>

        {{-- CORRECT ANSWERS --}}
        @if($question->subItems->count() > 0)
        @php
            $subItem = $question->subItems->first();
            $primaryAnswer = $subItem->answers->where('is_primary', true)->first();
            $allAnswers = $subItem->answers;
        @endphp
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 rounded-lg">
            <h3 class="font-semibold text-green-800 dark:text-green-300 mb-2">Jawaban yang Benar:</h3>
            @if($primaryAnswer)
            <div class="mb-2">
                <span class="font-medium">Jawaban utama:</span>
                <span class="ml-2 px-3 py-1 bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200 rounded">{{ $primaryAnswer->answer_text }}</span>
            </div>
            @endif
            @if($allAnswers->count() > 1)
            <div>
                <span class="font-medium">Semua kemungkinan:</span>
                <div class="flex flex-wrap gap-2 mt-1">
                    @foreach($allAnswers as $answer)
                    <span class="px-2 py-1 text-sm bg-gray-100 dark:bg-gray-700 rounded">
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

        {{-- STUDENT RESPONSES --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b border-gray-200 dark:border-white/10">
                    <tr class="text-left">
                        <th class="py-3 px-4">No</th>
                        <th class="py-3 px-4">Siswa</th>
                        <th class="py-3 px-4">Jawaban</th>
                        <th class="py-3 px-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-white/10">
                    @forelse($shortAnswerResponses as $i => $response)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5">
                        <td class="py-3 px-4">{{ $i + 1 }}</td>
                        <td class="py-3 px-4 font-medium">{{ $response['user'] }}</td>
                        <td class="py-3 px-4">
                            <div class="p-2 bg-gray-100 dark:bg-gray-800 rounded">
                                {{ $response['answer'] }}
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            @if($response['is_correct'])
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                BENAR
                            </span>
                            @else
                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                SALAH
                            </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-6 text-center text-gray-500">
                            Belum ada jawaban dari siswa
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif

    {{-- COMPOUND SUB-ITEM ANALYSIS --}}
    @if($question->type === 'compound' && isset($compoundSubStats))
    <div class="bg-white dark:bg-secondary/80 rounded-2xl border border-gray-200 dark:border-white/10 p-6">
        <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">
            <svg class="w-5 h-5 inline mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            Analisis Sub Pertanyaan
        </h2>

        <div class="space-y-6">
            @foreach($question->subItems->sortBy('order') as $subItem)
            @php
                $stat = $compoundSubStats[$subItem->id] ?? ['total' => 0, 'correct' => 0, 'accuracy' => 0];
                $correctAnswer = $subItem->answers->first();
            @endphp
            <div class="border rounded-lg p-4 bg-gray-50 dark:bg-gray-800/50">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">
                            <span class="text-gray-500 dark:text-gray-400">{{ $subItem->label }}.</span>
                            <span class="ml-1">{{ $subItem->prompt }}</span>
                        </h3>
                        <div class="flex items-center gap-3 mt-1">
                            <span class="px-2 py-1 text-xs rounded bg-gray-200 dark:bg-gray-700">
                                {{ $subItem->type === 'truefalse' ? 'BENAR/SALAH' : 'ISIAN SINGKAT' }}
                            </span>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="text-xl font-bold {{ $stat['accuracy'] >= 70 ? 'text-green-600' : ($stat['accuracy'] >= 40 ? 'text-yellow-600' : 'text-red-600') }}">
                            {{ $stat['accuracy'] }}%
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Akurasi</div>
                    </div>
                </div>

                {{-- CORRECT ANSWER --}}
                <div class="mb-4">
                    <div class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jawaban Benar:</div>
                    @if($subItem->type === 'truefalse' && $correctAnswer)
                    <div class="p-2 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 rounded inline-block">
                        {{ $correctAnswer->boolean_answer ? 'BENAR' : 'SALAH' }}
                    </div>
                    @elseif($subItem->type === 'short_answer')
                    <div class="space-y-2">
                        @php
                            $primaryAnswer = $subItem->answers->where('is_primary', true)->first();
                            $allAnswers = $subItem->answers;
                        @endphp
                        @if($primaryAnswer)
                        <div>
                            <span class="text-sm text-gray-600 dark:text-gray-400">Jawaban utama:</span>
                            <div class="p-2 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 rounded mt-1">
                                {{ $primaryAnswer->answer_text }}
                            </div>
                        </div>
                        @endif
                        @if($allAnswers->count() > 1)
                        <div>
                            <span class="text-sm text-gray-600 dark:text-gray-400">Semua kemungkinan:</span>
                            <div class="flex flex-wrap gap-2 mt-1">
                                @foreach($allAnswers as $answer)
                                <span class="px-2 py-1 text-xs bg-gray-200 dark:bg-gray-700 rounded">
                                    {{ $answer->answer_text }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>

                {{-- STATS --}}
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                        <div class="text-xl font-bold">{{ $stat['correct'] }}</div>
                        <div class="text-xs text-gray-600 dark:text-gray-400">Benar</div>
                    </div>
                    <div class="text-center p-3 bg-red-50 dark:bg-red-900/20 rounded-lg">
                        <div class="text-xl font-bold">{{ $stat['total'] - $stat['correct'] }}</div>
                        <div class="text-xs text-gray-600 dark:text-gray-400">Salah</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-white/10">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                <svg class="w-4 h-4 inline mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Soal kompleks dianggap benar jika semua sub pertanyaan benar.
                Total siswa yang menjawab seluruh soal dengan benar:
                <strong>{{ $attemptsWithAnswers->where('is_correct', true)->count() }}</strong> dari
                <strong>{{ $attemptsWithAnswers->count() }}</strong> siswa.
            </p>
        </div>
    </div>
    @endif

    {{-- STUDENT ANSWERS LIST --}}
    <div class="bg-white dark:bg-secondary/80 rounded-2xl border border-gray-200 dark:border-white/10 p-6">
        <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">
            <svg class="w-5 h-5 inline mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Daftar Jawaban Siswa
        </h2>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b border-gray-200 dark:border-white/10">
                    <tr class="text-left">
                        <th class="py-3 px-4">No</th>
                        <th class="py-3 px-4">Siswa</th>
                        <th class="py-3 px-4">Jawaban</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Nilai Ujian</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-white/10">
                    @forelse($attemptsWithAnswers as $i => $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5">
                        <td class="py-3 px-4">{{ $i + 1 }}</td>
                        <td class="py-3 px-4 font-medium">{{ $item['attempt']->user->name }}</td>
                        <td class="py-3 px-4">
                            @if($question->type === 'short_answer')
                                <div class="p-2 bg-gray-100 dark:bg-gray-800 rounded">
                                    {{ $item['answer']->short_answer_value ?? '(Kosong)' }}
                                </div>
                            @elseif($question->type === 'compound')
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $question->subItems->count() }} sub pertanyaan
                                </div>
                            @else
                                <div class="flex flex-wrap gap-1">
                                    @foreach($item['answer']->selected_ids as $optionId)
                                    @php
                                        $option = $question->options->firstWhere('id', $optionId);
                                    @endphp
                                    @if($option)
                                    <span class="px-2 py-1 text-xs bg-gray-200 dark:bg-gray-700 rounded">
                                        {{ $option->label ?? $optionId }}
                                    </span>
                                    @endif
                                    @endforeach
                                </div>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            @if($item['is_correct'])
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                BENAR
                            </span>
                            @else
                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                SALAH
                            </span>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <div class="font-semibold {{ $item['attempt']->score >= 75 ? 'text-green-600' : ($item['attempt']->score >= 50 ? 'text-yellow-600' : 'text-red-600') }}">
                                {{ $item['attempt']->score }}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-6 text-center text-gray-500">
                            Belum ada siswa mengerjakan soal ini
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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
