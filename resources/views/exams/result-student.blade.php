@extends('layouts.app')

@section('content')
<a href="{{ $exam->backRoute() }}"
    class="inline-flex items-center gap-2
            text-sm font-medium mt-3
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

<div class="max-w-5xl mx-auto p-2 space-y-5">

    {{-- ================= HEADER ================= --}}
    <div class="text-center space-y-6">

        <h1 class="text-3xl font-bold text-azwara-darker dark:text-azwara-lightest">
            Hasil {{ $exam->type_label }}
        </h1>

        <p class="text-base text-gray-600 dark:text-azwara-lightest/80">
            {{ $exam->context_title }}
        </p>

        {{-- SCORE SUMMARY CARD --}}
        <div class="max-w-4xl mx-auto bg-white dark:bg-secondary/80 border border-gray-200 dark:border-white/10 rounded-2xl p-6 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- SCORE --}}
                <div class="text-center p-4 bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-xl border border-blue-200 dark:border-blue-700">
                    <div class="flex justify-center mb-2">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-3xl font-bold {{ $attempt->score >= 75 ? 'text-green-600' : ($attempt->score >= 50 ? 'text-yellow-600' : 'text-red-600') }}">
                        {{ $attempt->score }}
                    </div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Skor</div>
                </div>

                {{-- CORRECT/WRONG --}}
                <div class="text-center p-4 bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 rounded-xl border border-green-200 dark:border-green-700">
                    <div class="flex justify-center mb-2">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold">{{ $attempt->correct_count ?? 0 }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Benar</div>
                </div>

                <div class="text-center p-4 bg-gradient-to-br from-red-50 to-red-100 dark:from-red-900/20 dark:to-red-800/20 rounded-xl border border-red-200 dark:border-red-700">
                    <div class="flex justify-center mb-2">
                        <svg class="w-8 h-8 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold">{{ $attempt->wrong_count ?? 0 }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Salah</div>
                </div>

                {{-- DURATION --}}
                <div class="text-center p-4 bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 rounded-xl border border-purple-200 dark:border-purple-700">
                    <div class="flex justify-center mb-2">
                        <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    @php
                        $duration = $attempt->work_duration_seconds;
                        $minutes = floor($duration / 60);
                        $seconds = $duration % 60;
                    @endphp
                    <div class="text-2xl font-bold">{{ $minutes }}:{{ str_pad($seconds, 2, '0', STR_PAD_LEFT) }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Durasi</div>
                </div>
            </div>

            {{-- STUDENT INFO --}}
            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-white/10 text-center">
                <div class="text-sm text-gray-500 dark:text-gray-400">Siswa</div>
                <div class="text-lg font-semibold text-gray-900 dark:text-white">{{ $attempt->user->name }}</div>
                <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Selesai pada {{ $attempt->submitted_at->format('d F Y H:i') }}
                </div>
            </div>
        </div>
    </div>

    {{-- ================= SCORE BY QUESTION TYPE ================= --}}
    @if(isset($scoreByType) && count($scoreByType) > 1)
    <div class="bg-white dark:bg-secondary/80 border border-gray-200 dark:border-white/10 rounded-2xl p-6">
        <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            Performa Berdasarkan Tipe Soal
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-5 gap-3">
            @foreach($scoreByType as $type => $data)
            @if($data['total'] > 0)
            <div class="border rounded-lg p-3 text-center">
                <div class="text-sm font-medium mb-1">{{ \App\Models\Question::getAvailableTypes()[$type] ?? strtoupper($type) }}</div>
                <div class="text-2xl font-bold {{ $data['score'] >= 75 ? 'text-green-600' : ($data['score'] >= 50 ? 'text-yellow-600' : 'text-red-600') }}">
                    {{ $data['score'] }}%
                </div>
                <div class="text-xs text-gray-500">{{ $data['correct'] }}/{{ $data['total'] }} benar</div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
    @endif

    {{-- ================= QUESTION DETAILS ================= --}}
    <div class="space-y-6">
        <h2 class="text-xl font-semibold dark:text-azwara-lightest flex items-center gap-2">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            Detail Jawaban
        </h2>

        {{-- GROUP QUESTIONS BY TYPE --}}
        @foreach($questionsByType as $type => $typeQuestions)
        @if(count($typeQuestions) > 0)
        <div class="mb-8">
            <h3 class="text-lg font-semibold mb-4 pb-2 border-b border-gray-200 dark:border-white/10">
                {{ \App\Models\Question::getAvailableTypes()[$type] ?? strtoupper($type) }}
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    ({{ count($typeQuestions) }} soal)
                </span>
            </h3>
            <div class="space-y-4">
                @foreach($typeQuestions as $item)
                    @php
                        $question = $item['question'];
                        $answer = $item['answer'];
                        $isCorrect = $item['is_correct'];
                    @endphp

                    <div class="bg-white dark:bg-secondary/80 border border-gray-200 dark:border-white/10 rounded-xl overflow-hidden">
                        {{-- QUESTION HEADER --}}
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-white/10">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <h4 class="font-semibold">Soal {{ $loop->parent->iteration }}.{{ $loop->iteration }}</h4>
                                    <span class="px-2 py-1 text-xs rounded-full {{ $isCorrect ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                        {{ $isCorrect ? 'BENAR' : 'SALAH' }}
                                    </span>
                                </div>
                                @if($isCorrect)
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                @else
                                <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                @endif
                            </div>
                        </div>

                        {{-- QUESTION CONTENT --}}
                        <div class="p-6 space-y-4">
                            {{-- QUESTION TEXT --}}
                            <div class="prose dark:prose-invert max-w-none">
                                {!! $question->question_text !!}
                            </div>

                            @if($question->image)
                                <div class="flex justify-center">
                                    <img src="{{ Storage::url($question->image) }}"
                                         alt="Gambar soal"
                                         class="max-h-48 rounded-lg border bg-white p-2 object-contain">
                                </div>
                            @endif

                            {{-- MCQ/MCMA/TrueFalse ANSWERS --}}
                            @if(in_array($question->type, ['mcq', 'mcma', 'truefalse']))
                                <div class="space-y-2">
                                    @foreach($question->options as $option)
                                        @php
                                            $isSelected = in_array($option->id, $answer?->selected_ids ?? []);
                                            $isCorrectOption = $option->is_correct;
                                        @endphp

                                        <div class="p-3 rounded-lg border
                                            {{ $isCorrectOption ? 'border-green-500 bg-green-50 dark:bg-green-900/20' :
                                               ($isSelected ? 'border-red-500 bg-red-50 dark:bg-red-900/20' :
                                               'border-gray-200 dark:border-white/10') }}">
                                            <div class="flex items-start justify-between">
                                                <div class="flex items-start gap-2">
                                                    @if($question->type !== 'truefalse')
                                                        <span class="font-semibold">{{ $option->label }}.</span>
                                                    @endif
                                                    <div class="prose dark:prose-invert max-w-none">
                                                        {!! $option->option_text !!}
                                                    </div>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    @if($isSelected)
                                                        <span class="text-sm font-medium {{ $isCorrectOption ? 'text-green-600' : 'text-red-600' }}">
                                                            Jawaban Anda
                                                        </span>
                                                    @endif
                                                    @if($isCorrectOption)
                                                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                        </svg>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            {{-- SHORT ANSWER --}}
                            @if($question->type === 'short_answer')
                                <div class="space-y-3">
                                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-lg p-4">
                                        <h5 class="font-semibold text-blue-800 dark:text-blue-300 mb-2 flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                            </svg>
                                            Jawaban Isian Singkat
                                        </h5>

                                        {{-- STUDENT ANSWER --}}
                                        <div class="mb-3">
                                            <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Jawaban Anda:</div>
                                            <div class="p-3 bg-gray-100 dark:bg-gray-800 rounded border {{ $isCorrect ? 'border-green-500' : 'border-red-500' }}">
                                                <span class="{{ $isCorrect ? 'text-green-700 dark:text-green-300' : 'text-red-700 dark:text-red-300' }} font-medium">
                                                    {{ $answer?->short_answer_value ?? '(Tidak dijawab)' }}
                                                </span>
                                            </div>
                                        </div>

                                        {{-- CORRECT ANSWERS --}}
                                        @if($question->subItems->count() > 0)
                                            @php
                                                $subItem = $question->subItems->first();
                                                $primaryAnswer = $subItem->answers->where('is_primary', true)->first();
                                                $allAnswers = $subItem->answers;
                                            @endphp
                                            <div>
                                                <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Jawaban yang benar:</div>
                                                @if($primaryAnswer)
                                                    <div class="p-3 bg-green-50 dark:bg-green-900/30 rounded border border-green-500 mb-2">
                                                        <span class="text-green-700 dark:text-green-300 font-medium">
                                                            {{ $primaryAnswer->answer_text }}
                                                        </span>
                                                        <span class="text-xs text-green-600 ml-2">(Jawaban utama)</span>
                                                    </div>
                                                @endif

                                                @if($allAnswers->count() > 1)
                                                    <div>
                                                        <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Semua kemungkinan jawaban:</div>
                                                        <div class="flex flex-wrap gap-2">
                                                            @foreach($allAnswers as $ans)
                                                                <span class="px-2 py-1 text-sm bg-gray-200 dark:bg-gray-700 rounded">
                                                                    {{ $ans->answer_text }}
                                                                    @if($ans->is_primary)
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
                                    </div>
                                </div>
                            @endif

                            {{-- COMPOUND QUESTION --}}
                            @if($question->type === 'compound' && isset($compoundQuestions[$loop->parent->index]))
                                @php
                                    $compoundData = $compoundQuestions[$loop->parent->index];
                                @endphp
                                <div class="bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-700 rounded-lg p-4">
                                    <h5 class="font-semibold text-purple-800 dark:text-purple-300 mb-3 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                        Sub Pertanyaan
                                    </h5>

                                    <div class="space-y-3">
                                        @foreach($compoundData['subItems'] as $subItemData)
                                            <div class="border rounded-lg p-3 bg-white/50 dark:bg-gray-800/50">
                                                <div class="flex items-start justify-between mb-2">
                                                    <div class="font-medium text-gray-800 dark:text-gray-100">
                                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $subItemData['subItem']->label }}.</span>
                                                        <span class="ml-1">{{ $subItemData['subItem']->prompt }}</span>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <span class="text-xs px-2 py-1 rounded {{ $subItemData['isCorrect'] ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                                            {{ $subItemData['isCorrect'] ? 'BENAR' : 'SALAH' }}
                                                        </span>
                                                    </div>
                                                </div>

                                                {{-- STUDENT VS CORRECT ANSWER --}}
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-2">
                                                    <div>
                                                        <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Jawaban Anda:</div>
                                                        <div class="p-2 bg-gray-100 dark:bg-gray-800 rounded text-sm">
                                                            @if($subItemData['studentAnswer'])
                                                                @if($subItemData['subItem']->type === 'truefalse')
                                                                    {{ $subItemData['studentAnswer']['boolean'] ? 'BENAR' : 'SALAH' }}
                                                                @else
                                                                    {{ $subItemData['studentAnswer']['value'] ?? '(Kosong)' }}
                                                                @endif
                                                            @else
                                                                <span class="text-gray-400">(Tidak dijawab)</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Jawaban Benar:</div>
                                                        <div class="p-2 bg-green-50 dark:bg-green-900/30 rounded text-sm">
                                                            @if($subItemData['subItem']->type === 'truefalse')
                                                                {{ $subItemData['correctAnswer']['boolean'] ? 'BENAR' : 'SALAH' }}
                                                            @else
                                                                @if(isset($subItemData['correctAnswer']['primary']))
                                                                    {{ $subItemData['correctAnswer']['primary'] }}
                                                                @elseif(isset($subItemData['correctAnswer']['answers']))
                                                                    {{ implode(', ', $subItemData['correctAnswer']['answers']) }}
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="mt-4 pt-4 border-t border-purple-200 dark:border-purple-700">
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <em>Soal kompleks dianggap benar jika semua sub pertanyaan benar.</em>
                                        </p>
                                    </div>
                                </div>
                            @endif

                            {{-- EXPLANATION --}}
                            @if($question->explanation)
                                <div class="border border-gray-200 dark:border-white/10 rounded-lg overflow-hidden">
                                    <div class="bg-gray-50 dark:bg-gray-800/50 px-4 py-3 border-b border-gray-200 dark:border-white/10">
                                        <h5 class="font-semibold flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Pembahasan
                                        </h5>
                                    </div>
                                    <div class="p-4">
                                        <div class="prose dark:prose-invert max-w-none">
                                            {!! $question->explanation !!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
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
