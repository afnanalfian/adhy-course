@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        {{-- ================= HEADER ================= --}}
        <div class="mb-8">
            <a href="{{ route('exams.results', $exam) }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 transition-colors mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Hasil Ujian
            </a>

            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">
                    📊 Analisis Soal
                </h1>
                <div class="mt-2 flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2">
                    <p class="text-gray-700 dark:text-gray-300 font-medium">
                        {{ $exam->title }}
                    </p>
                    <span class="hidden sm:inline text-gray-400 dark:text-gray-500">•</span>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">
                        Soal #{{ $examQuestion->order ?? '-' }}
                    </p>
                    @if($isTkp ?? false)
                        <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                            TKP (Bobot)
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- ================= RINGKASAN STATISTIK ================= --}}
        @php
            $total = $summary['correct'] + $summary['wrong'] + $summary['empty'];
            $accuracy = $total > 0
                ? round(($summary['correct'] / $total) * 100, 2)
                : 0;
            $accuracyColor = $accuracy >= 70 ? 'text-green-600 dark:text-green-400' :
                ($accuracy >= 40 ? 'text-yellow-600 dark:text-yellow-400' :
                    'text-red-600 dark:text-red-400');
        @endphp

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-10">
            @php
                $stats = [
                    ['label' => 'Total Peserta', 'value' => $total, 'icon' => 'users', 'color' => 'blue'],
                    ['label' => 'Jawaban Benar', 'value' => $summary['correct'], 'icon' => 'check', 'color' => 'green'],
                    ['label' => 'Jawaban Salah', 'value' => $summary['wrong'], 'icon' => 'x', 'color' => 'red'],
                    ['label' => 'Akurasi', 'value' => $accuracy . '%', 'icon' => 'target', 'color' => 'purple'],
                ];
            @endphp

            @foreach ($stats as $stat)
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-5 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                {{ $stat['label'] }}
                            </div>
                            <div class="text-2xl font-bold text-gray-900 dark:text-white mt-1">
                                {{ $stat['value'] }}
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center 
                            @if($stat['color'] === 'blue') bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400
                            @elseif($stat['color'] === 'green') bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400
                            @elseif($stat['color'] === 'red') bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400
                            @else bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 @endif">
                            @if($stat['icon'] === 'users')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-8a5.5 5.5 0 11-11 0 5.5 5.5 0 0111 0z" />
                                </svg>
                            @elseif($stat['icon'] === 'check')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            @elseif($stat['icon'] === 'x')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            @else
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- ================= DETAIL SOAL ================= --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-9 h-9 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Detail Soal</h2>
                @if($isTkp ?? false)
                    <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                        TKP (Bobot)
                    </span>
                @endif
            </div>

            <div class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200 text-sm leading-relaxed mb-5 tex2jax_process">
                {!! $question->question_text !!}
            </div>

            @if ($question->image)
                <div class="mt-4 border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden">
                    <img src="{{ asset('storage/' . $question->image) }}" class="w-full h-auto max-w-2xl mx-auto object-contain" alt="Gambar soal">
                </div>
            @endif
            
            @if($isTkp ?? false)
                <div class="mt-4 text-xs text-gray-500 dark:text-gray-400 italic bg-blue-50 dark:bg-blue-900/10 p-3 rounded-lg">
                    💡 Soal TKP menggunakan sistem bobot. Jawaban dengan bobot maksimum dianggap benar.
                </div>
            @endif
        </div>

        {{-- ================= ANALISIS OPSI ================= --}}
        <div class="mb-10">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-9 h-9 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Analisis Pilihan Jawaban</h2>
            </div>

            <div class="space-y-3">
                @foreach ($question->options as $option)
                    @php
                        $stat = $optionStats[$option->id] ?? ['count' => 0, 'percentage' => 0];
                        $isCorrect = $option->is_correct;
                        $isTkpOption = $isTkp ?? false;
                        $optionWeight = $option->weight ?? 0;
                        $maxWeight = $question->options->max('weight') ?? 0;
                        $isMaxWeight = $isTkpOption && $optionWeight === $maxWeight && $maxWeight > 0;
                        
                        $percentageColor = $stat['percentage'] > 50 ? 'bg-green-500' :
                            ($stat['percentage'] > 25 ? 'bg-yellow-500' : 'bg-red-500');
                    @endphp

                    <div class="bg-white dark:bg-gray-800 rounded-xl border p-5 transition-all duration-300
                        {{ $isTkpOption ? (
                            $isMaxWeight ? 'border-green-400 dark:border-green-700 shadow-lg shadow-green-500/10' : 
                            'border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600'
                        ) : (
                            $isCorrect ? 'border-green-400 dark:border-green-700 shadow-lg shadow-green-500/10' : 
                            'border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600'
                        ) }}">
                        
                        <div class="flex flex-col md:flex-row md:items-start gap-4">
                            {{-- LABEL --}}
                            <div class="flex-shrink-0">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl flex items-center justify-center font-bold text-sm
                                        {{ $isTkpOption ? (
                                            $isMaxWeight ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' : 
                                            'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300'
                                        ) : (
                                            $isCorrect ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' : 
                                            'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300'
                                        ) }}">
                                        {{ $option->label }}
                                    </div>
                                    @if($isTkpOption)
                                        @if($isMaxWeight)
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400">
                                                ⭐ Bobot: {{ $optionWeight }} (Maksimal)
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
                                                Bobot: {{ $optionWeight }}
                                            </span>
                                        @endif
                                    @elseif($isCorrect)
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400">
                                            ✅ Benar
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- CONTENT --}}
                            <div class="flex-1 min-w-0">
                                <div class="text-gray-800 dark:text-gray-200 text-sm mb-3 tex2jax_process">
                                    {!! $option->option_text !!}
                                </div>

                                @if ($option->image)
                                    <div class="mt-3 mb-4 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden max-w-xs">
                                        <img src="{{ asset('storage/' . $option->image) }}" class="w-full h-auto object-contain" alt="Gambar opsi {{ $option->label }}" loading="lazy">
                                    </div>
                                @endif

                                {{-- STATISTIK --}}
                                <div class="mt-3">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $stat['count'] }}</span> dari {{ $totalAnswered }} peserta
                                        </span>
                                        <span class="text-sm font-bold text-gray-900 dark:text-white">
                                            {{ $stat['percentage'] }}%
                                        </span>
                                    </div>
                                    <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                        <div class="h-full {{ $percentageColor }} rounded-full transition-all duration-700" style="width: {{ min($stat['percentage'], 100) }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ================= PEMBAHASAN ================= --}}
        @if ($question->explanation)
            <div x-data="{ open: false }" class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 mb-10">
                <button @click="open = !open" class="w-full flex items-center justify-between text-left focus:outline-none">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pembahasan</h3>
                    </div>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" x-collapse class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 text-sm leading-relaxed tex2jax_process">
                        {!! $question->explanation !!}
                    </div>
                </div>
            </div>
        @endif

        {{-- ================= STATUS JAWABAN PESERTA ================= --}}
        <div>
            <div class="flex items-center gap-3 mb-5">
                <div class="w-9 h-9 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-8a5.5 5.5 0 11-11 0 5.5 5.5 0 0111 0z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Status Jawaban Peserta</h2>
                <span class="text-xs text-gray-500 dark:text-gray-400">(Klik nama untuk melihat detail)</span>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gradient-to-r from-purple-50 to-blue-50 dark:from-purple-900/20 dark:to-blue-900/20 border-b border-gray-200 dark:border-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Nama Peserta</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Jawaban</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse ($attemptRows as $row)
                                <tr class="hover:bg-purple-50 dark:hover:bg-purple-900/10 transition">
                                    <td class="px-4 py-3">
                                        <span class="font-medium text-gray-900 dark:text-white">{{ $row['user']->name }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($row['status'] === 'empty')
                                            <span class="text-gray-400 dark:text-gray-500 text-sm">Tidak menjawab</span>
                                        @else
                                            <div class="flex flex-wrap items-center gap-2">
                                                @foreach($row['selected_options'] as $index => $option)
                                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium
                                                        {{ $row['is_tkp'] ? (
                                                            $option->weight === $row['max_weight'] && $row['max_weight'] > 0 ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' :
                                                            'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300'
                                                        ) : (
                                                            $option->is_correct ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' :
                                                            'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300'
                                                        ) }}">
                                                        {{ $option->label }}
                                                        @if($row['is_tkp'])
                                                            <span class="text-xs opacity-75">({{ $option->weight }})</span>
                                                        @endif
                                                    </span>
                                                @endforeach
                                                @if($row['is_tkp'] && $row['status'] !== 'empty')
                                                    <span class="text-xs text-gray-400 dark:text-gray-500">
                                                        Bobot: {{ $row['selected_weight'] }}/{{ $row['max_weight'] }}
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium {{ $row['status_color'] }}">
                                            {{ $row['status_icon'] }} {{ $row['status_label'] }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-12 text-center">
                                        <span class="text-4xl mb-3 block">📭</span>
                                        <p class="text-gray-500 dark:text-gray-400">Belum ada data peserta</p>
                                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Data akan muncul setelah peserta mengikuti ujian</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

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
                skipHtmlTags: ['script', 'noscript', 'style', 'textarea', 'pre'],
                ignoreHtmlClass: 'tex2jax_ignore',
                processHtmlClass: 'tex2jax_process'
            }
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.MathJax && MathJax.typeset) {
                MathJax.typeset();
            }

            // Re-render MathJax when accordion opens
            document.addEventListener('alpine:init', () => {
                Alpine.data('mathJaxRenderer', () => ({
                    renderMath() {
                        if (window.MathJax && MathJax.typesetPromise) {
                            MathJax.typesetPromise();
                        }
                    }
                }));
            });
        });
    </script>
@endpush