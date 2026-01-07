@extends('layouts.app')

@section('content')
<div class="min-h-screen text-azwara-darkest dark:text-azwara-lighter">

    {{-- ================= HEADER ================= --}}
    <div class="px-4 py-6 border-b border-azwara-lighter/40 dark:border-white/10">
        <h1 class="text-xl md:text-2xl font-semibold">
            Hasil Ujian – {{ $exam->title }}
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
            Ringkasan performa peserta & analisis soal
        </p>
    </div>

    {{-- ================= SUMMARY ================= --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-4">
        <div class="rounded-xl bg-azwara-lightest dark:bg-azwara-darker p-4 shadow-sm">
            <p class="text-xs text-gray-500">Peserta</p>
            <p class="text-2xl font-bold">{{ $totalParticipants }}</p>
        </div>

        <div class="rounded-xl bg-azwara-lightest dark:bg-azwara-darker p-4 shadow-sm">
            <p class="text-xs text-gray-500">Rata-rata Nilai</p>
            <p class="text-2xl font-bold">{{ $averageScore }}</p>
        </div>

        <div class="rounded-xl bg-azwara-lightest dark:bg-azwara-darker p-4 shadow-sm">
            <p class="text-xs text-gray-500">Rata-rata Durasi</p>
            <p class="text-2xl font-bold">
                @php
                    $minutes = floor($averageDuration / 60);
                    $seconds = $averageDuration % 60;
                @endphp
                {{ sprintf('%02d:%02d', $minutes, $seconds) }}
            </p>
        </div>

        <div class="rounded-xl bg-azwara-lightest dark:bg-azwara-darker p-4 shadow-sm">
            <p class="text-xs text-gray-500">Jumlah Soal</p>
            <p class="text-2xl font-bold">{{ $exam->questions->count() }}</p>
        </div>
    </div>

    {{-- ================= RANKING ================= --}}
    <div class="px-4 mt-2">
        <div class="rounded-xl bg-azwara-lightest dark:bg-azwara-darker shadow-sm overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-200 dark:border-white/10">
                <h2 class="font-semibold">Peringkat Peserta</h2>
            </div>

            <div class="divide-y divide-gray-200 dark:divide-white/10">
                @foreach($ranking as $row)
                    <div class="flex items-center justify-between px-4 py-3 text-sm">
                        <div class="flex items-center gap-3">
                            <span class="w-6 text-center font-semibold">
                                {{ $row['rank'] }}
                            </span>
                            <span class="truncate max-w-[140px] md:max-w-none">
                                {{ $row['user']->name }}
                            </span>
                        </div>

                        <div class="flex items-center gap-4">
                            <span class="font-semibold">
                                {{ $row['score'] }}
                            </span>
                            <span class="text-xs text-gray-500">
                                {{ $row['duration'] ? gmdate('i:s', $row['duration']) : '-' }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ================= QUESTION ANALYSIS ================= --}}
    <div class="px-4 mt-6">
        <h2 class="text-lg font-semibold mb-3">
            Analisis Soal
        </h2>

        <div class="space-y-4">
            @foreach($questionStats as $index => $stat)
                @php
                    $question = $stat['question'];
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
                                Soal {{ $stat['exam_order'] }}
                            </p>
                            <p class="text-xs text-gray-500">
                                Akurasi: {{ $stat['accuracy'] }}%
                                ({{ $stat['correct'] }}/{{ $stat['total'] }})
                            </p>
                        </div>

                        <span class="text-xs text-primary">
                            Detail
                        </span>
                    </button>

                    {{-- Content --}}
                    <div
                        x-show="open"
                        x-collapse
                        class="px-4 pb-4 text-sm space-y-4">

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
                                        <div
                                            class="rounded-lg border p-3 space-y-2
                                            {{ $option->is_correct
                                                ? 'border-green-500 bg-green-50 dark:bg-green-900/20'
                                                : 'border-gray-200 dark:border-white/10'
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

                        {{-- Pembahasan --}}
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

                        {{-- Link --}}
                        <div>
                            <a
                                href="{{ route('exams.question.analysis', [$exam, $question->id]) }}"
                                class="text-xs text-primary hover:underline">
                                Lihat analisis detail →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $questionStats->links() }}
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
