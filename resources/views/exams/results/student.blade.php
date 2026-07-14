@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">

    {{-- HEADER --}}
    <div class="mb-8">
        <a href="{{ $backUrl }}" 
           class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 transition-colors mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>

        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                📊 Hasil Ujian Anda
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                {{ $displayTitle }}
            </p>
        </div>
    </div>

    {{-- STATISTICS --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Benar</p>
            <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $summary['correct'] }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Salah</p>
            <p class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $summary['wrong'] }}</p>
        </div>

        @if($exam->type === 'tryout' && $exam->test_type === 'mtk_stis')
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Kosong</p>
            <p class="text-2xl font-bold text-gray-600 dark:text-gray-400">{{ $summary['empty'] }}</p>
        </div>
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Skor Total</p>
            <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $attempt->score }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Durasi</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ gmdate('H:i:s', $attempt->work_duration_seconds) }}</p>
        </div>

        @if($exam->type === 'tryout' && in_array($exam->test_type, ['skd', 'mtk_stis']))
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Status Lulus</p>
            <p class="text-2xl font-bold {{ $attempt->is_passed ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                {{ $attempt->is_passed ? '✅ Lulus' : '❌ Tidak' }}
            </p>
        </div>
        @endif
    </div>

    {{-- SKD SUMMARY --}}
    @if($skdSummary)
    <div class="mb-8">
        <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">📋 Ringkasan SKD</h2>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gradient-to-r from-purple-50 to-blue-50 dark:from-purple-900/20 dark:to-blue-900/20 border-b border-gray-200 dark:border-gray-700">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Komponen</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">TIU</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">TWK</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">TKP</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400 font-medium">Benar</td>
                            <td class="px-4 py-3 text-center">
                                <span class="text-sm font-semibold text-green-600 dark:text-green-400">
                                    {{ $skdSummary['tiu']['correct'] }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="text-sm font-semibold text-green-600 dark:text-green-400">
                                    {{ $skdSummary['twk']['correct'] }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="text-sm font-semibold text-green-600 dark:text-green-400">
                                    {{ $skdSummary['tkp']['correct'] }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400 font-medium">Salah</td>
                            <td class="px-4 py-3 text-center">
                                <span class="text-sm font-semibold text-red-600 dark:text-red-400">
                                    {{ $skdSummary['tiu']['wrong'] }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="text-sm font-semibold text-red-600 dark:text-red-400">
                                    {{ $skdSummary['twk']['wrong'] }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="text-sm font-semibold text-red-600 dark:text-red-400">
                                    {{ $skdSummary['tkp']['wrong'] }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400 font-medium">Kosong</td>
                            <td class="px-4 py-3 text-center">
                                <span class="text-sm font-semibold text-gray-500 dark:text-gray-400">
                                    {{ $skdSummary['tiu']['empty'] ?? 0 }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="text-sm font-semibold text-gray-500 dark:text-gray-400">
                                    {{ $skdSummary['twk']['empty'] ?? 0 }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="text-sm font-semibold text-gray-500 dark:text-gray-400">
                                    {{ $skdSummary['tkp']['empty'] ?? 0 }}
                                </span>
                            </td>
                        </tr>
                        <tr class="bg-gray-50 dark:bg-gray-900/50">
                            <td class="px-4 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Skor</td>
                            <td class="px-4 py-3 text-center">
                                <span class="text-lg font-bold text-purple-600 dark:text-purple-400">
                                    {{ $skdSummary['tiu']['score'] }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="text-lg font-bold text-purple-600 dark:text-purple-400">
                                    {{ $skdSummary['twk']['score'] }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="text-lg font-bold text-purple-600 dark:text-purple-400">
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

    {{-- FILTER --}}
    <div class="flex justify-end mb-6">
        <form method="GET" class="flex items-center gap-3">
            <label class="text-sm text-gray-600 dark:text-gray-400">Tampilkan:</label>
            <select name="per_page" onchange="this.form.submit()"
                    class="text-sm rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition px-3 py-2">
                @foreach ([10, 20, 30, 50, 100] as $n)
                    <option value="{{ $n }}" @selected($perPage == $n)>{{ $n }} per halaman</option>
                @endforeach
            </select>
        </form>
    </div>

    {{-- QUESTIONS --}}
    <div class="space-y-4">
        @foreach ($questions as $examQuestion)
            @php
                $question = $examQuestion->question;
                $answer = $attempt->answers->firstWhere('question_id', $question->id);
                $selected = $answer?->selected_ids ?? [];
                $questionNumber = $loop->iteration + ($questions->firstItem() - 1);
                
                // Untuk TKP: hitung bobot yang dipilih
                $selectedWeight = 0;
                $maxWeight = 0;
                $isTkp = ($question->test_type === 'tkp');
                
                if ($isTkp && $answer && !empty($selected)) {
                    $selectedWeight = $question->options
                        ->whereIn('id', $selected)
                        ->sum('weight');
                    $maxWeight = $question->options->max('weight');
                }
            @endphp

            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 hover:border-purple-500 transition-all duration-300">
                
                {{-- QUESTION HEADER --}}
                <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-bold text-gray-400 dark:text-gray-500">#{{ $questionNumber }}</span>
                        <span class="text-base font-medium text-gray-900 dark:text-white">Soal {{ $questionNumber }}</span>
                        @if($isTkp)
                            <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                                TKP
                            </span>
                        @endif
                    </div>

                    @if($answer && !$answer->isEmpty)
                        @if($isTkp)
                            {{-- TKP: Tampilkan bobot yang didapat --}}
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-medium px-3 py-1 rounded-full bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                                    🎯 Bobot: {{ $selectedWeight }}/{{ $maxWeight }}
                                </span>
                                @if($selectedWeight === $maxWeight && $maxWeight > 0)
                                    <span class="text-xs font-medium px-3 py-1 rounded-full bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                                        ✅ Maksimal
                                    </span>
                                @elseif($selectedWeight > 0)
                                    <span class="text-xs font-medium px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400">
                                        ⚡ Sebagian
                                    </span>
                                @else
                                    <span class="text-xs font-medium px-3 py-1 rounded-full bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400">
                                        ❌ Salah
                                    </span>
                                @endif
                            </div>
                        @else
                            {{-- Non-TKP: Tampilkan benar/salah --}}
                            @if(in_array($question->options->where('is_correct', true)->first()->id ?? null, $selected))
                                <span class="text-xs font-medium px-3 py-1 rounded-full bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                                    ✅ Benar
                                </span>
                            @else
                                <span class="text-xs font-medium px-3 py-1 rounded-full bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400">
                                    ❌ Salah
                                </span>
                            @endif
                        @endif
                    @else
                        <span class="text-xs font-medium px-3 py-1 rounded-full bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400">
                            ⬜ Kosong
                        </span>
                    @endif
                </div>

                {{-- QUESTION CONTENT --}}
                <div class="mb-5 space-y-4">
                    @if ($question->image)
                        <img src="{{ asset('storage/' . $question->image) }}"
                             class="max-w-full max-h-64 mx-auto rounded-lg border border-gray-200 dark:border-gray-700 object-contain"
                             alt="Gambar soal" loading="lazy">
                    @endif

                    @if ($question->question_text)
                        <div class="text-gray-800 dark:text-gray-200 text-sm leading-relaxed">
                            {!! $question->question_text !!}
                        </div>
                    @endif
                    
                </div>

                {{-- OPTIONS --}}
                <div class="space-y-2 mb-5">
                    @foreach ($question->options as $option)
                        @php
                            $isCorrect = $option->is_correct;
                            $isChosen = in_array($option->id, $selected ?? []);
                            
                            // Untuk TKP: tentukan warna berdasarkan bobot
                            $optionWeight = $option->weight ?? 0;
                            $maxWeightOption = $question->options->max('weight');
                            $isMaxWeight = ($optionWeight === $maxWeightOption && $maxWeightOption > 0);
                        @endphp

                        <div class="rounded-xl border p-3.5 transition-all
                            {{ $isTkp ? (
                                $isChosen && $optionWeight === $maxWeightOption ? 'border-green-500 bg-green-50 dark:bg-green-900/20' :
                                ($isChosen && $optionWeight > 0 ? 'border-yellow-500 bg-yellow-50 dark:bg-yellow-900/20' :
                                ($isChosen ? 'border-red-500 bg-red-50 dark:bg-red-900/20' :
                                ($optionWeight === $maxWeightOption ? 'border-green-300 bg-green-50/50 dark:bg-green-900/10' :
                                'border-gray-200 dark:border-gray-700')))
                            ) : (
                                $isCorrect && $isChosen ? 'border-green-500 bg-green-50 dark:bg-green-900/20' : 
                                ($isCorrect ? 'border-green-300 bg-green-50/50 dark:bg-green-900/10' : 
                                ($isChosen ? 'border-red-500 bg-red-50 dark:bg-red-900/20' : 
                                'border-gray-200 dark:border-gray-700'))
                            ) }}">
                            
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0 w-7 h-7 rounded-lg flex items-center justify-center font-bold text-xs
                                    {{ $isTkp ? (
                                        $isChosen && $optionWeight === $maxWeightOption ? 'bg-green-500 text-white' :
                                        ($isChosen && $optionWeight > 0 ? 'bg-yellow-500 text-white' :
                                        ($isChosen ? 'bg-red-500 text-white' :
                                        ($optionWeight === $maxWeightOption ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' :
                                        'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400')))
                                    ) : (
                                        $isCorrect && $isChosen ? 'bg-green-500 text-white' : 
                                        ($isCorrect ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 
                                        ($isChosen ? 'bg-red-500 text-white' : 
                                        'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400'))
                                    ) }}">
                                    {{ $option->label }}
                                </div>

                                <div class="flex-1 min-w-0">
                                    @if ($option->image)
                                        <img src="{{ asset('storage/' . $option->image) }}"
                                             class="max-w-xs max-h-32 rounded-lg border border-gray-200 dark:border-gray-700 mb-2 object-contain"
                                             alt="Gambar opsi" loading="lazy">
                                    @endif

                                    @if ($option->option_text)
                                        <div class="text-sm text-gray-800 dark:text-gray-200">
                                            {!! $option->option_text !!}
                                        </div>
                                    @endif
                                    
                                    {{-- Tampilkan bobot untuk TKP --}}
                                    @if($isTkp)
                                        <div class="mt-1 text-xs text-gray-400 dark:text-gray-500">
                                            Bobot: {{ $optionWeight }}
                                            @if($optionWeight === $maxWeightOption && $maxWeightOption > 0)
                                                <span class="text-green-600 dark:text-green-400">⭐ (Maksimal)</span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                
                                {{-- Icon jawaban user untuk TKP --}}
                                @if($isTkp && $isChosen)
                                    <div class="flex-shrink-0">
                                        @if($optionWeight === $maxWeightOption && $maxWeightOption > 0)
                                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        @elseif($optionWeight > 0)
                                            <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- EXPLANATION --}}
                @if ($question->explanation)
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                        <details class="group">
                            <summary class="flex items-center justify-between cursor-pointer list-none">
                                <span class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 transition">
                                    📖 Lihat Pembahasan
                                </span>
                                <svg class="w-4 h-4 text-gray-500 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </summary>
                            <div class="mt-3 text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
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