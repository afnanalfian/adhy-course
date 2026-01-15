@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">

    {{-- HEADER --}}
    <div class="mb-8">
        <a href="{{ $backUrl }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-primary mb-4 inline-block">
            ← Kembali
        </a>

        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Hasil Ujian Anda
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">
                {{ $displayTitle }}
            </p>
        </div>
    </div>

    {{-- STATISTICS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Benar</p>
            <p class="text-xl font-bold text-green-600 dark:text-green-400">{{ $summary['correct'] }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Salah</p>
            <p class="text-xl font-bold text-red-600 dark:text-red-400">{{ $summary['wrong'] }}</p>
        </div>

        @if($exam->type === 'tryout' && $exam->test_type === 'mtk_stis')
        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Kosong</p>
            <p class="text-xl font-bold text-gray-600 dark:text-gray-400">{{ $summary['empty'] }}</p>
        </div>
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Skor Total</p>
            <p class="text-xl font-bold text-primary">{{ $attempt->score }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Durasi</p>
            <p class="text-xl font-bold text-gray-900 dark:text-white">{{ gmdate('H:i:s', $attempt->work_duration_seconds) }}</p>
        </div>

        @if($exam->type === 'tryout' && in_array($exam->test_type, ['skd', 'mtk_stis']))
        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Status</p>
            <p class="text-xl font-bold {{ $attempt->is_passed ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                {{ $attempt->is_passed ? 'Lulus' : 'Belum Lulus' }}
            </p>
        </div>
        @endif
    </div>

    {{-- SKD SUMMARY --}}
    @if($skdSummary)
    <div class="mb-8">
        <div class="text-lg font-bold text-gray-900 dark:text-white mb-4">Ringkasan SKD</div>

        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">
                                Komponen
                            </th>
                            <th class="px-6 py-3 text-center text-sm font-medium text-gray-700 dark:text-gray-300">
                                TIU
                            </th>
                            <th class="px-6 py-3 text-center text-sm font-medium text-gray-700 dark:text-gray-300">
                                TWK
                            </th>
                            <th class="px-6 py-3 text-center text-sm font-medium text-gray-700 dark:text-gray-300">
                                TKP
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">Benar</td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-medium text-green-600 dark:text-green-400">
                                    {{ $skdSummary['tiu']['correct'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-medium text-green-600 dark:text-green-400">
                                    {{ $skdSummary['twk']['correct'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-medium text-green-600 dark:text-green-400">
                                    {{ $skdSummary['tkp']['correct'] }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">Salah</td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-medium text-red-600 dark:text-red-400">
                                    {{ $skdSummary['tiu']['wrong'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-medium text-red-600 dark:text-red-400">
                                    {{ $skdSummary['twk']['wrong'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-medium text-red-600 dark:text-red-400">
                                    {{ $skdSummary['tkp']['wrong'] }}
                                </span>
                            </td>
                        </tr>
                        <tr class="bg-gray-50 dark:bg-gray-900">
                            <td class="px-6 py-4 text-sm font-medium text-gray-700 dark:text-gray-300">Skor</td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-lg font-bold text-gray-900 dark:text-white">
                                    {{ $skdSummary['tiu']['score'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-lg font-bold text-gray-900 dark:text-white">
                                    {{ $skdSummary['twk']['score'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-lg font-bold text-gray-900 dark:text-white">
                                    {{ $skdSummary['tkp']['score'] }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    {{-- ACTIONS --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <a href="{{ route('exams.ranking.student', $exam) }}"
           class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-ens-medium text-sm font-medium">
            Lihat Peringkat
        </a>

        <form method="GET" class="flex items-center gap-3">
            <label class="text-sm text-gray-600 dark:text-gray-400">Tampilkan:</label>
            <select name="per_page" onchange="this.form.submit()"
                    class="text-sm rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 px-3 py-2">
                @foreach ([10, 20, 30, 50, 100] as $n)
                    <option value="{{ $n }}" @selected($perPage == $n)>{{ $n }} per halaman</option>
                @endforeach
            </select>
        </form>
    </div>

    {{-- QUESTIONS --}}
    <div class="space-y-6">
        @foreach ($questions as $examQuestion)
            @php
                $question = $examQuestion->question;
                $answer = $attempt->answers->firstWhere('question_id', $question->id);
                $selected = $answer?->selected_ids ?? [];
                $questionNumber = $loop->iteration + ($questions->firstItem() - 1);
            @endphp

            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                {{-- QUESTION HEADER --}}
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                            <span class="font-bold text-gray-900 dark:text-white">#{{ $questionNumber }}</span>
                        </div>
                        <div class="text-lg font-medium text-gray-900 dark:text-white">Soal {{ $questionNumber }}</div>
                    </div>

                    @if($answer)
                        @if(in_array($question->options->where('is_correct', true)->first()->id ?? null, $selected))
                            <span class="text-xs font-medium px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                Benar
                            </span>
                        @else
                            <span class="text-xs font-medium px-3 py-1 rounded-full bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">
                                Salah
                            </span>
                        @endif
                    @else
                        <span class="text-xs font-medium px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                            Kosong
                        </span>
                    @endif
                </div>

                {{-- QUESTION CONTENT --}}
                <div class="mb-6 space-y-4">
                    @if ($question->image)
                        <img src="{{ asset('storage/' . $question->image) }}"
                             class="w-full h-auto max-w-2xl mx-auto rounded-lg border border-gray-200 dark:border-gray-700"
                             alt="Gambar soal">
                    @endif

                    @if ($question->question_text)
                        <div class="text-gray-900 dark:text-white">
                            {!! $question->question_text !!}
                        </div>
                    @endif
                </div>

                {{-- OPTIONS --}}
                <div class="space-y-3 mb-6">
                    @foreach ($question->options as $option)
                        @php
                            $isCorrect = $option->is_correct;
                            $isChosen = in_array($option->id, $selected ?? []);
                        @endphp

                        <div class="rounded-lg border p-4 {{ $isCorrect
                            ? 'border-green-400 bg-green-50 dark:bg-green-900/20'
                            : ($isChosen
                                ? 'border-red-400 bg-red-50 dark:bg-red-900/20'
                                : 'border-gray-200 dark:border-gray-700') }}">

                            <div class="flex flex-col md:flex-row md:items-start gap-4">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center font-bold text-sm
                                                {{ $isCorrect
                                                    ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300'
                                                    : ($isChosen
                                                        ? 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-300'
                                                        : 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white') }}">
                                        {{ $option->label }}
                                    </div>
                                </div>

                                <div class="flex-1">
                                    @if ($option->image)
                                        <img src="{{ asset('storage/' . $option->image) }}"
                                             class="w-full h-auto max-w-xs rounded-lg border border-gray-200 dark:border-gray-700 mb-3"
                                             alt="Gambar opsi">
                                    @endif

                                    @if ($option->option_text)
                                        <div class="text-gray-800 dark:text-gray-200">
                                            {!! $option->option_text !!}
                                        </div>
                                    @endif

                                    <div class="flex flex-wrap gap-2 mt-3">
                                        @if ($isCorrect)
                                            <span class="text-xs font-medium px-2 py-1 rounded bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300">
                                                Jawaban Benar
                                            </span>
                                        @endif
                                        @if ($isChosen)
                                            <span class="text-xs font-medium px-2 py-1 rounded bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-300">
                                                Jawaban Anda
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- EXPLANATION --}}
                @if ($question->explanation)
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                        <details class="group">
                            <summary class="flex items-center justify-between cursor-pointer list-none">
                                <span class="font-medium text-gray-900 dark:text-white">Pembahasan Soal</span>
                                <svg class="w-5 h-5 text-gray-500 group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </summary>
                            <div class="mt-3 text-gray-700 dark:text-gray-300">
                                {!! $question->explanation !!}
                            </div>
                        </details>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    {{-- PAGINATION --}}
    @if($questions->hasPages())
        <div class="mt-8">
            {{ $questions->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    window.MathJax = {
        tex: {
            inlineMath: [['\\(', '\\)']],
            displayMath: [['\\[', '\\]']]
        },
        options: {
            skipHtmlTags: ['script', 'noscript', 'style', 'textarea', 'pre']
        }
    };
</script>

<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (window.MathJax && MathJax.typeset) {
            MathJax.typeset();
        }

        // Re-render MathJax when details open
        document.querySelectorAll('details').forEach(detail => {
            detail.addEventListener('toggle', () => {
                if (detail.open && window.MathJax && MathJax.typesetPromise) {
                    MathJax.typesetPromise();
                }
            });
        });
    });
</script>
@endpush
