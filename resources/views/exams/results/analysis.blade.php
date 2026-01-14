@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- ================= HEADER ================= --}}
    <div class="mb-6">
        <a href="{{ route('exams.results', $exam) }}"
           class="text-sm text-azwara-medium hover:underline">
            ← Kembali ke Hasil Ujian
        </a>

        <h1 class="text-2xl font-semibold text-azwara-darkest dark:text-azwara-lightest mt-2">
            Analisis Soal
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
            {{ $exam->title }} · Soal #
            {{ $examQuestion->order ?? '-' }}
        </p>
    </div>

    {{-- ================= RINGKASAN ================= --}}
    @php
        $total = $summary['correct'] + $summary['wrong'] + $summary['empty'];
        $accuracy = $total > 0
            ? round(($summary['correct'] / $total) * 100, 2)
            : 0;
    @endphp

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="rounded-lg border border-azwara-lighter dark:border-azwara-darker
                    bg-white dark:bg-azwara-darker p-4">
            <div class="text-sm text-gray-500">Total Peserta</div>
            <div class="text-xl font-semibold text-azwara-darkest dark:text-azwara-lightest">
                {{ $total }}
            </div>
        </div>

        <div class="rounded-lg border border-azwara-lighter dark:border-azwara-darker
                    bg-white dark:bg-azwara-darker p-4">
            <div class="text-sm text-gray-500">Benar</div>
            <div class="text-xl font-semibold text-green-600">
                {{ $summary['correct'] }}
            </div>
        </div>

        <div class="rounded-lg border border-azwara-lighter dark:border-azwara-darker
                    bg-white dark:bg-azwara-darker p-4">
            <div class="text-sm text-gray-500">Salah</div>
            <div class="text-xl font-semibold text-red-600">
                {{ $summary['wrong'] }}
            </div>
        </div>

        <div class="rounded-lg border border-azwara-lighter dark:border-azwara-darker
                    bg-white dark:bg-azwara-darker p-4">
            <div class="text-sm text-gray-500">Akurasi</div>
            <div class="text-xl font-semibold text-azwara-darkest dark:text-azwara-lightest">
                {{ $accuracy }}%
            </div>
        </div>
    </div>

    {{-- ================= SOAL ================= --}}
    <div class="rounded-lg border border-azwara-lighter dark:border-azwara-darker
                bg-white dark:bg-azwara-darker p-5 mb-10">
        <h2 class="font-semibold text-azwara-darkest dark:text-azwara-lightest mb-3">
            Soal
        </h2>

        <div class="prose prose-sm dark:prose-invert max-w-none">
            {!! $question->question_text !!}
        </div>
    </div>

    {{-- ================= DETAIL JAWABAN PESERTA ================= --}}
    <div>
        <h2 class="text-lg font-semibold text-azwara-darkest dark:text-azwara-lightest mb-4">
            Jawaban Peserta
        </h2>

        <div class="overflow-x-auto rounded-lg border border-azwara-lighter dark:border-azwara-darker">
            <table class="min-w-full text-sm">
                <thead class="bg-azwara-lightest dark:bg-azwara-darker">
                    <tr>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-left">Jawaban</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-azwara-lighter dark:divide-azwara-darker">
                    @foreach ($attempts as $attempt)
                        @php
                            $answer = $attempt->answers->first();
                        @endphp

                        <tr>
                            <td class="px-4 py-2">
                                {{ $attempt->user->name }}
                            </td>

                            <td class="px-4 py-2 text-center">
                                @if (!$answer || $answer->isEmpty)
                                    <span class="text-gray-500 font-medium">Kosong</span>
                                @elseif ($answer->is_correct)
                                    <span class="text-green-600 font-medium">Benar</span>
                                @else
                                    <span class="text-red-600 font-medium">Salah</span>
                                @endif
                            </td>

                            <td class="px-4 py-2 text-gray-700 dark:text-gray-300">
                                @if (!$answer || $answer->isEmpty)
                                    —
                                @else
                                    {{-- tampilkan jawaban siswa secara ringkas --}}
                                    {{ $answer->display_answer ?? '—' }}
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    @if ($attempts->isEmpty())
                        <tr>
                            <td colspan="3" class="px-4 py-6 text-center text-gray-500">
                                Belum ada jawaban peserta.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
