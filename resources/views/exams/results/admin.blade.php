@extends('layouts.app')

@section('content')
    @php
        $testTypeLabels = [
            'tiu' => 'TIU',
            'twk' => 'TWK',
            'tkp' => 'TKP',
            'tpa' => 'TPA',
            'tbi' => 'TBI',
            'mtk_stis' => 'MTK STIS',
            'mtk_tka' => 'MTK TKA',
            'general' => 'GENERAL',
        ];
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        {{-- ================= HEADER ================= --}}
        <div class="mb-8">
            <a href="{{ $backUrl }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 transition-colors mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>

            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">
                    📊 Hasil Ujian
                </h1>
                <div class="mt-2 flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2">
                    <p class="text-gray-700 dark:text-gray-300 font-medium">
                        {{ $displayTitle ?? $exam->title }}
                    </p>
                    @if (!empty($displaySubtitle))
                        <span class="hidden sm:inline text-gray-400 dark:text-gray-500">•</span>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">
                            {{ $displaySubtitle }}
                        </p>
                    @endif
                </div>
            </div>
        </div>

        {{-- ================= STATISTIK UTAMA ================= --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-10">
            @php
                $stats = [
                    ['label' => 'Peserta', 'value' => $totalParticipants, 'icon' => 'users', 'color' => 'blue'],
                    ['label' => 'Rata-rata', 'value' => $averageScore, 'icon' => 'average', 'color' => 'purple'],
                    ['label' => 'Tertinggi', 'value' => $maxScore, 'icon' => 'trophy', 'color' => 'yellow'],
                    ['label' => 'Terendah', 'value' => $minScore, 'icon' => 'chart', 'color' => 'red'],
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
                            @elseif($stat['color'] === 'purple') bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400
                            @elseif($stat['color'] === 'yellow') bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400
                            @else bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 @endif">
                            @if($stat['icon'] === 'users')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-8a5.5 5.5 0 11-11 0 5.5 5.5 0 0111 0z" />
                                </svg>
                            @elseif($stat['icon'] === 'average')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            @elseif($stat['icon'] === 'trophy')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            @else
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- ================= PERINGKAT PESERTA ================= --}}
        <div class="mb-12">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    🏆 Peringkat Peserta
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2.5 py-0.5 rounded-full">
                        {{ $ranking->total() }}
                    </span>
                </h2>

                <form method="GET" class="flex items-center gap-3">
                    <label class="text-sm text-gray-600 dark:text-gray-400">Tampilkan:</label>
                    <select name="rank_per_page" onchange="this.form.submit()" 
                            class="text-sm rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition px-3 py-2">
                        @foreach ([10, 20, 30, 50, 100] as $n)
                            <option value="{{ $n }}" @selected($rankPerPage == $n)>
                                {{ $n }} per halaman
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gradient-to-r from-purple-50 to-blue-50 dark:from-purple-900/20 dark:to-blue-900/20 border-b border-gray-200 dark:border-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Rank</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Nama</th>
                                @if ($exam->type === 'tryout' && $exam->test_type === 'skd')
                                    <th class="px-3 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">TWK</th>
                                    <th class="px-3 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">TIU</th>
                                    <th class="px-3 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">TKP</th>
                                @endif
                                @if (!($exam->type === 'tryout' && $exam->test_type === 'skd'))
                                    <th class="px-3 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">✅</th>
                                    <th class="px-3 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">❌</th>
                                    @if ($exam->test_type === 'mtk_stis')
                                        <th class="px-3 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">⬜</th>
                                    @endif
                                @endif
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Skor</th>
                                @if ($exam->type === 'tryout')
                                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse ($ranking as $attempt)
                                <tr class="hover:bg-purple-50 dark:hover:bg-purple-900/10 transition">
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        @if ($attempt->rank <= 3)
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full font-bold text-sm
                                                @if($attempt->rank === 1) bg-gradient-to-br from-yellow-400 to-yellow-500 text-white shadow-lg shadow-yellow-500/30
                                                @elseif($attempt->rank === 2) bg-gradient-to-br from-gray-300 to-gray-400 text-white shadow-lg shadow-gray-400/30
                                                @else bg-gradient-to-br from-amber-600 to-amber-700 text-white shadow-lg shadow-amber-600/30 @endif">
                                                {{ $attempt->rank }}
                                            </span>
                                        @else
                                            <span class="text-gray-500 dark:text-gray-400 font-medium">#{{ $attempt->rank }}</span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-3">
                                        <span class="font-medium text-gray-900 dark:text-white">{{ $attempt->user->name }}</span>
                                    </td>

                                    @if ($exam->type === 'tryout' && $exam->test_type === 'skd')
                                        <td class="px-3 py-3 text-center font-semibold text-gray-900 dark:text-white">{{ $attempt->score_twk ?? 0 }}</td>
                                        <td class="px-3 py-3 text-center font-semibold text-gray-900 dark:text-white">{{ $attempt->score_tiu ?? 0 }}</td>
                                        <td class="px-3 py-3 text-center font-semibold text-gray-900 dark:text-white">{{ $attempt->score_tkp ?? 0 }}</td>
                                    @endif
                                    @if (!($exam->type === 'tryout' && $exam->test_type === 'skd'))
                                        <td class="px-3 py-3 text-center">
                                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 font-semibold text-xs">
                                                {{ $attempt->correct }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-3 text-center">
                                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 font-semibold text-xs">
                                                {{ $attempt->wrong }}
                                            </span>
                                        </td>
                                        @if ($exam->test_type === 'mtk_stis')
                                            <td class="px-3 py-3 text-center">
                                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 font-semibold text-xs">
                                                    {{ $attempt->empty }}
                                                </span>
                                            </td>
                                        @endif
                                    @endif
                                    <td class="px-4 py-3 text-center">
                                        <span class="text-lg font-bold text-purple-600 dark:text-purple-400">{{ $attempt->score }}</span>
                                    </td>

                                    @if ($exam->type === 'tryout')
                                        <td class="px-4 py-3 text-center">
                                            @if ($attempt->is_passed)
                                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                                                    ✅ Lulus
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400">
                                                    ❌ Tidak
                                                </span>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ $exam->type === 'tryout' ? 8 : 7 }}" class="px-4 py-12 text-center">
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

            @if($ranking->hasPages())
                <div class="mt-6">
                    {{ $ranking->withQueryString()->links() }}
                </div>
            @endif
        </div>

        {{-- ================= ANALISIS SOAL ================= --}}
        <div>
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    📝 Analisis Soal
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2.5 py-0.5 rounded-full">
                        {{ $questions->total() }}
                    </span>
                </h2>

                <form method="GET" class="flex items-center gap-3">
                    <label class="text-sm text-gray-600 dark:text-gray-400">Tampilkan:</label>
                    <select name="per_page" onchange="this.form.submit()"
                            class="text-sm rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition px-3 py-2">
                        @foreach ([10, 20, 30, 50, 100] as $n)
                            <option value="{{ $n }}" @selected($perPage == $n)>
                                {{ $n }} per halaman
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="space-y-3">
                @foreach ($questions as $examQuestion)
                    @php
                        $stat = $questionStats[$examQuestion->question_id] ?? [
                            'accuracy' => 0,
                            'correct' => 0,
                            'answered' => 0,
                            'total_participants' => $totalParticipants,
                            'is_tkp' => ($examQuestion->question?->test_type === 'tkp'),
                        ];
                        
                        // Untuk TKP, hitung akurasi berdasarkan bobot maksimum
                        if ($stat['is_tkp']) {
                            // Akurasi TKP dihitung dari jawaban yang mendapat bobot maksimum
                            $accuracyColor = $stat['accuracy'] >= 70 ? 'text-green-600 dark:text-green-400' :
                                ($stat['accuracy'] >= 40 ? 'text-yellow-600 dark:text-yellow-400' :
                                    'text-red-600 dark:text-red-400');
                        } else {
                            $accuracyColor = $stat['accuracy'] >= 70 ? 'text-green-600 dark:text-green-400' :
                                ($stat['accuracy'] >= 40 ? 'text-yellow-600 dark:text-yellow-400' :
                                    'text-red-600 dark:text-red-400');
                        }
                    @endphp

                    <div class="group bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-5 hover:border-purple-500 hover:shadow-lg transition-all duration-300">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="flex-1">
                                <div class="flex flex-wrap items-center gap-3 mb-2">
                                    <span class="font-bold text-gray-900 dark:text-white">
                                        Soal #{{ $loop->iteration + ($questions->firstItem() - 1) }}
                                    </span>
                                    <span class="text-xs font-medium px-3 py-1 rounded-full bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400">
                                        {{ $testTypeLabels[$examQuestion->question?->test_type] ?? '-' }}
                                    </span>
                                    @if($stat['is_tkp'])
                                        <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                                            TKP (Bobot)
                                        </span>
                                    @endif
                                </div>

                                <div class="flex flex-wrap items-center gap-4">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-500 dark:text-gray-400">Akurasi:</span>
                                        <span class="text-sm font-bold {{ $accuracyColor }}">
                                            {{ $stat['accuracy'] }}%
                                        </span>
                                        <div class="w-24 h-1.5 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden">
                                            <div class="h-full rounded-full 
                                                @if($stat['accuracy'] >= 70) bg-green-500
                                                @elseif($stat['accuracy'] >= 40) bg-yellow-500
                                                @else bg-red-500 @endif" 
                                                style="width: {{ $stat['accuracy'] }}%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-500 dark:text-gray-400">✅</span>
                                        <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ $stat['correct'] }} / {{ $stat['answered'] }}
                                        </span>
                                        @if($stat['is_tkp'])
                                            <span class="text-xs text-gray-400 dark:text-gray-500">
                                                (dari {{ $stat['total_participants'] }} peserta)
                                            </span>
                                        @endif
                                    </div>
                                    @if($stat['is_tkp'])
                                        <span class="text-xs text-gray-400 dark:text-gray-500 italic">
                                            💡 Bobot maksimum dianggap benar
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <a href="{{ route('exams.questions.analysis', [$exam, $examQuestion]) }}" 
                               class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-purple-600 to-blue-600 rounded-xl hover:from-purple-700 hover:to-blue-700 transition-all shadow-lg shadow-purple-500/30 group-hover:shadow-xl">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Analisis
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($questions->hasPages())
                <div class="mt-6">
                    {{ $questions->withQueryString()->links() }}
                </div>
            @endif
        </div>

    </div>
@endsection