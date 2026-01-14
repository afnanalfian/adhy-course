@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- ================= HEADER ================= --}}
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-azwara-darkest dark:text-azwara-lightest">
            Hasil Ujian
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
            {{ $exam->title }}
        </p>
    </div>

    {{-- ================= AGREGASI ================= --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
        @php
            $stats = [
                ['label' => 'Peserta', 'value' => $totalParticipants],
                ['label' => 'Rata-rata Skor', 'value' => $averageScore],
                ['label' => 'Skor Tertinggi', 'value' => $maxScore],
                ['label' => 'Skor Terendah', 'value' => $minScore],
            ];
        @endphp

        @foreach ($stats as $stat)
            <div class="rounded-lg border border-azwara-lighter dark:border-azwara-darker
                        bg-white dark:bg-azwara-darker p-4">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $stat['label'] }}
                </div>
                <div class="text-xl font-semibold text-azwara-darkest dark:text-azwara-lightest mt-1">
                    {{ $stat['value'] }}
                </div>
            </div>
        @endforeach
    </div>

    {{-- ================= RANKING ================= --}}
    <div class="mb-12">
        <h2 class="text-lg font-semibold text-azwara-darkest dark:text-azwara-lightest mb-4">
            Peringkat Peserta
        </h2>

        <div class="overflow-x-auto rounded-lg border border-azwara-lighter dark:border-azwara-darker">
            <table class="min-w-full text-sm">
                <thead class="bg-azwara-lightest dark:bg-azwara-darker">
                    <tr>
                        <th class="px-4 py-3 text-left">Peringkat</th>
                        <th class="px-4 py-3 text-left">Nama Peserta</th>
                        <th class="px-4 py-3 text-center">Skor</th>

                        @if ($exam->type === 'tryout' && in_array($exam->test_type, ['skd', 'mtk_stis']))
                            <th class="px-4 py-3 text-center">Keterangan</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-azwara-lighter dark:divide-azwara-darker">
                    @forelse ($ranking as $attempt)
                        <tr>
                            <td class="px-4 py-2 font-medium">
                                @if ($attempt->rank <= 3)
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold
                                        {{ $attempt->rank === 1 ? 'bg-yellow-400 text-black' :
                                           ($attempt->rank === 2 ? 'bg-gray-300 text-black' :
                                           'bg-amber-600 text-white') }}">
                                        #{{ $attempt->rank }}
                                    </span>
                                @else
                                    {{ $attempt->rank }}
                                @endif
                            </td>

                            <td class="px-4 py-2">
                                {{ $attempt->user->name }}
                            </td>

                            <td class="px-4 py-2 text-center font-semibold">
                                {{ $attempt->score }}
                            </td>

                            @if ($exam->type === 'tryout' && in_array($exam->test_type, ['skd', 'mtk_stis']))
                                <td class="px-4 py-2 text-center">
                                    @if ($attempt->is_passed)
                                        <span class="text-green-600 font-medium">
                                            Lulus
                                        </span>
                                    @else
                                        <span class="text-red-600 font-medium">
                                            Belum Lulus
                                        </span>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                Belum ada data peserta.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ================= ANALISIS SOAL ================= --}}
    <div>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-azwara-darkest dark:text-azwara-lightest">
                Analisis Soal
            </h2>

            <form method="GET">
                <select name="per_page"
                        onchange="this.form.submit()"
                        class="text-sm rounded-md border border-azwara-lighter dark:border-azwara-darker
                               bg-white dark:bg-azwara-darker text-gray-700 dark:text-gray-200">
                    @foreach ([10,20,30,50,100] as $n)
                        <option value="{{ $n }}" @selected($perPage == $n)>
                            {{ $n }} / halaman
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="space-y-4">
            @foreach ($questions as $examQuestion)
                @php
                    $stat = $questionStats[$examQuestion->question_id] ?? [
                        'accuracy' => 0,
                        'correct' => 0,
                        'answered' => 0,
                    ];
                @endphp

                <div class="rounded-lg border border-azwara-lighter dark:border-azwara-darker
                            bg-white dark:bg-azwara-darker p-4">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div>
                            <div class="font-medium text-azwara-darkest dark:text-azwara-lightest">
                                Soal #{{ $loop->iteration + ($questions->firstItem() - 1) }}
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                Akurasi:
                                <span class="font-semibold">
                                    {{ $stat['accuracy'] }}%
                                </span>
                                ({{ $stat['correct'] }} /
                                {{ $stat['answered'] }})
                            </div>
                        </div>

                        <a href="{{ route('exams.questions.analysis', [$exam, $examQuestion]) }}"
                           class="inline-flex items-center justify-center
                                  px-4 py-2 rounded-md text-sm font-medium
                                  bg-azwara-medium text-white
                                  hover:bg-azwara-light transition">
                            Lihat Analisis
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $questions->withQueryString()->links() }}
        </div>
    </div>

</div>
@endsection
