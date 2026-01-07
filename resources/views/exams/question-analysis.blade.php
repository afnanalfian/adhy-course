@extends('layouts.app')

@section('content')
<div class="min-h-screen text-azwara-darkest dark:text-azwara-lighter">

    {{-- ================= HEADER ================= --}}
    <div class="px-4 py-6 border-b border-azwara-lighter/40 dark:border-white/10">
        <h1 class="text-xl md:text-2xl font-semibold">
            Analisis Soal
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
            {{ $exam->title }}
        </p>
    </div>

    <div class="max-w-5xl mx-auto px-4 py-6 space-y-6">

        {{-- ================= QUESTION ================= --}}
        <div class="rounded-xl bg-azwara-lightest dark:bg-azwara-darker shadow-sm p-5 space-y-4">
            <h2 class="font-semibold text-lg">
                Soal
            </h2>

            <div class="prose dark:prose-invert max-w-none">
                {!! $question->question_text !!}
            </div>

            @if($question->image)
                <div class="flex justify-center">
                    <img
                        src="{{ asset('storage/'.$question->image) }}"
                        class="max-h-64 object-contain rounded"
                        alt="Gambar Soal">
                </div>
            @endif
        </div>

        {{-- ================= MCQ / MCMA / TRUEFALSE ================= --}}
        @if(!empty($optionStats))
            <div class="rounded-xl bg-azwara-lightest dark:bg-azwara-darker shadow-sm p-5">
                <h3 class="font-semibold mb-4">
                    Distribusi Jawaban
                </h3>

                <div class="space-y-3">
                    @foreach($optionStats as $stat)
                        <div class="p-3 rounded-lg border
                            {{ $stat['option']->is_correct
                                ? 'border-green-500 bg-green-50 dark:bg-green-900/20'
                                : 'border-gray-200 dark:border-white/10'
                            }}">
                            <div class="flex justify-between items-start gap-4">
                                <div class="flex-1">
                                    <p class="font-semibold text-sm">
                                        {{ $stat['option']->label }}.
                                    </p>
                                    <div class="prose dark:prose-invert text-sm max-w-none">
                                        {!! $stat['option']->option_text !!}
                                    </div>
                                </div>

                                <div class="text-right text-sm">
                                    <p class="font-semibold">
                                        {{ $stat['percentage'] }}%
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $stat['count'] }} respon
                                    </p>
                                </div>
                            </div>

                            @if($stat['option']->image)
                                <div class="mt-2">
                                    <img
                                        src="{{ asset('storage/'.$stat['option']->image) }}"
                                        class="max-h-32 rounded"
                                        alt="Gambar Opsi">
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- ================= SHORT ANSWER ================= --}}
        @if(!empty($shortAnswers))
            <div class="rounded-xl bg-azwara-lightest dark:bg-azwara-darker shadow-sm p-5">
                <h3 class="font-semibold mb-4">
                    Jawaban Siswa
                </h3>

                <div class="divide-y divide-gray-200 dark:divide-white/10">
                    @foreach($shortAnswers as $row)
                        <div class="py-3 flex justify-between items-center gap-4">
                            <div>
                                <p class="font-semibold text-sm">
                                    {{ $row['user']->name }}
                                </p>
                                <p class="text-sm text-gray-700 dark:text-gray-300">
                                    {{ $row['answer'] ?: '-' }}
                                </p>
                            </div>

                            <span class="text-xs font-semibold px-2 py-1 rounded
                                {{ $row['is_correct']
                                    ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300'
                                    : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300'
                                }}">
                                {{ $row['is_correct'] ? 'Benar' : 'Salah' }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- ================= COMPOUND ================= --}}
        @if(!empty($compoundStats))
            <div class="rounded-xl bg-azwara-lightest dark:bg-azwara-darker shadow-sm p-5">
                <h3 class="font-semibold mb-4">
                    Analisis Sub-Soal
                </h3>

                <div class="space-y-4">
                    @foreach($compoundStats as $stat)
                        <div class="p-4 rounded-lg border border-gray-200 dark:border-white/10">
                            <div class="flex justify-between items-center mb-2">
                                <p class="font-semibold text-sm">
                                    {{ $stat['subItem']->label }}.
                                    {{ $stat['subItem']->prompt }}
                                </p>
                                <span class="text-sm font-semibold">
                                    {{ $stat['accuracy'] }}%
                                </span>
                            </div>

                            <div class="w-full h-2 bg-gray-200 dark:bg-azwara-lightest/10 rounded">
                                <div
                                    class="h-2 rounded bg-primary"
                                    style="width: {{ $stat['accuracy'] }}%">
                                </div>
                            </div>

                            <p class="text-xs text-gray-500 mt-1">
                                {{ $stat['correct'] }} dari {{ $stat['total'] }} siswa benar
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- ================= ANSWER LIST ================= --}}
        <div class="rounded-xl bg-azwara-lightest dark:bg-azwara-darker shadow-sm p-5">
            <h3 class="font-semibold mb-4">
                Detail Jawaban Siswa
            </h3>

            <div class="divide-y divide-gray-200 dark:divide-white/10">
                @foreach($answers as $row)
                    <div class="py-3 flex justify-between items-center">
                        <p class="text-sm font-medium">
                            {{ $row['user']->name }}
                        </p>

                        <span class="text-xs font-semibold px-2 py-1 rounded
                            {{ $row['answer']->is_correct
                                ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300'
                                : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300'
                            }}">
                            {{ $row['answer']->is_correct ? 'Benar' : 'Salah' }}
                        </span>
                    </div>
                @endforeach
            </div>
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
