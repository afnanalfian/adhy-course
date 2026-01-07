@extends('layouts.app')

@section('content')
<div class="min-h-screen text-azwara-darkest dark:text-azwara-lighter">

    {{-- ================= HEADER ================= --}}
    <div class="px-4 py-6 border-b border-azwara-lighter/40 dark:border-white/10">
        <h1 class="text-xl md:text-2xl font-semibold">
            Hasil Ujian
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
            {{ $exam->title }}
        </p>
    </div>

    {{-- ================= SUMMARY ================= --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-4">
        <div class="rounded-xl bg-azwara-lightest dark:bg-azwara-darker p-4 shadow-sm">
            <p class="text-xs text-gray-500">Nilai</p>
            <p class="text-2xl font-bold">{{ $attempt->score }}</p>
        </div>

        <div class="rounded-xl bg-azwara-lightest dark:bg-azwara-darker p-4 shadow-sm">
            <p class="text-xs text-gray-500">Benar</p>
            <p class="text-2xl font-bold text-green-600">
                {{ $attempt->correct_count }}
            </p>
        </div>

        <div class="rounded-xl bg-azwara-lightest dark:bg-azwara-darker p-4 shadow-sm">
            <p class="text-xs text-gray-500">Salah</p>
            <p class="text-2xl font-bold text-red-600">
                {{ $attempt->wrong_count }}
            </p>
        </div>

        <div class="rounded-xl bg-azwara-lightest dark:bg-azwara-darker p-4 shadow-sm">
            <p class="text-xs text-gray-500">Durasi</p>
            <p class="text-2xl font-bold">
                {{ $duration
                    ? gmdate('i:s', $duration)
                    : '-' }}
            </p>
        </div>
    </div>

    {{-- ================= RANK INFO ================= --}}
    @if(isset($rank))
        <div class="px-4 mb-2">
            <div class="rounded-xl bg-primary text-white p-4 text-center">
                <p class="text-sm">Peringkat Kamu</p>
                <p class="text-2xl font-bold">
                    {{ $rank }} dari {{ $totalParticipants ?? 0 }}
                </p>
            </div>
        </div>
    @endif

    {{-- ================= QUESTIONS & EXPLANATION ================= --}}
    <div class="px-4 pb-6">
        <h2 class="text-lg font-semibold mb-3">
            Pembahasan Soal
        </h2>

        <div class="space-y-4">
            @foreach($questions as $index => $item)
                @php
                    $question = $item['question'];
                    $answer   = $item['answer'];
                @endphp

                <div
                    x-data="{ open: false }"
                    class="rounded-xl bg-azwara-lightest dark:bg-azwara-darker shadow-sm">

                    {{-- Header --}}
                    <button
                        @click="open = !open"
                        class="w-full text-left px-4 py-3 flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-sm">
                                Soal {{ $index + 1 }}
                            </p>
                            <p class="text-xs">
                                @if($item['is_correct'])
                                    <span class="text-green-600">Jawaban Benar</span>
                                @else
                                    <span class="text-red-600">Jawaban Salah</span>
                                @endif
                            </p>
                        </div>

                        <span class="text-xs text-primary">
                            {{ $item['is_correct'] ? 'Lihat' : 'Perbaiki' }}
                        </span>
                    </button>

                    {{-- Content --}}
                    <div
                        x-show="open"
                        x-collapse
                        class="px-4 pb-4 space-y-4 text-sm">

                        {{-- Question --}}
                        <div class="space-y-3">
                            <div class="prose dark:prose-invert max-w-none">
                                {!! $question->question_text !!}
                            </div>

                            @if($question->image)
                                <div class="flex justify-center">
                                    <img
                                        src="{{ Storage::url($question->image) }}"
                                        alt="Gambar soal"
                                        class="max-h-[320px] rounded-xl border
                                            bg-white dark:bg-gray-800 p-2 object-contain">
                                </div>
                            @endif
                        </div>

                        {{-- Options --}}
                        @if(in_array($question->type, ['mcq','mcma','truefalse']))
                            <div class="space-y-3">
                                @foreach($question->options as $option)
                                    @php
                                        $isCorrect = $option->is_correct;
                                        $isChosen = in_array(
                                            $option->id,
                                            $answer?->selected_ids ?? []
                                        );
                                    @endphp

                                    <div
                                        class="rounded-lg border p-3 space-y-2
                                        {{
                                            $isCorrect
                                                ? 'border-green-500 bg-green-50 dark:bg-green-900/20'
                                                : ($isChosen
                                                    ? 'border-red-500 bg-red-50 dark:bg-red-900/20'
                                                    : 'border-gray-200 dark:border-white/10')
                                        }}">

                                        {{-- Label + Text --}}
                                        <div class="flex items-start gap-2">
                                            <span class="font-semibold shrink-0">
                                                {{ $option->label }}.
                                            </span>

                                            <div class="prose dark:prose-invert max-w-none">
                                                {!! $option->option_text !!}
                                            </div>
                                        </div>

                                        {{-- Option Image --}}
                                        @if($option->image)
                                            <div class="mt-2 flex justify-center">
                                                <img
                                                    src="{{ Storage::url($option->image) }}"
                                                    alt="Gambar opsi"
                                                    class="max-h-48 rounded-lg border
                                                        bg-white dark:bg-gray-800 p-2 object-contain">
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        {{-- SHORT ANSWER (STANDALONE) --}}
                        @if($question->type === 'short_answer')
                            <div class="space-y-3">

                                {{-- Jawaban Siswa --}}
                                <div class="p-3 rounded-lg bg-gray-100 dark:bg-white/5">
                                    <p class="text-xs text-gray-500 mb-1">
                                        Jawaban Kamu
                                    </p>
                                    <p class="font-medium">
                                        {{ $answer?->short_answer_value ?? '-' }}
                                    </p>
                                </div>

                                {{-- Jawaban Benar --}}
                                <div class="p-3 rounded-lg bg-green-50 dark:bg-green-900/20">
                                    <p class="text-xs text-green-700 dark:text-green-300 mb-1">
                                        Jawaban Benar
                                    </p>

                                    <ul class="list-disc list-inside text-sm">
                                        @php
                                            $correctAnswers = $question->options
                                                ->where('is_correct', true);
                                        @endphp

                                        @forelse($correctAnswers as $opt)
                                            <li>{{ $opt->option_text }}</li>
                                        @empty
                                            <li class="text-gray-500">
                                                Tidak ada jawaban benar tersedia
                                            </li>
                                        @endforelse
                                    </ul>
                                </div>

                            </div>
                        @endif

                        {{-- COMPOUND --}}
                        @if($question->type === 'compound')
                            <div class="space-y-3">
                                @foreach($item['subItems'] as $sub)
                                    <div class="p-3 rounded-lg border border-gray-200 dark:border-white/10">
                                        <p class="text-sm font-semibold mb-1">
                                            {{ $sub['subItem']->label }}.
                                            {{ $sub['subItem']->prompt }}
                                        </p>

                                        <p class="text-xs mb-1">
                                            @if($sub['isCorrect'])
                                                <span class="text-green-600">Benar</span>
                                            @else
                                                <span class="text-red-600">Salah</span>
                                            @endif
                                        </p>

                                        <p class="text-xs text-gray-500">
                                            Jawaban Benar:
                                            {{ is_array($sub['correctAnswer'])
                                                ? ($sub['correctAnswer']['primary'] ?? implode(', ', $sub['correctAnswer']['answers']))
                                                : '-' }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        {{-- Explanation --}}
                        @if($question->explanation)
                            <div class="p-3 rounded-lg bg-azwara-light/10 dark:bg-azwara-lightest/5">
                                <p class="text-xs font-semibold mb-1">
                                    Pembahasan
                                </p>
                                <div class="prose dark:prose-invert max-w-none text-sm">
                                    {!! $question->explanation !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $questions->links() }}
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
