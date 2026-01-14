@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- ================= HEADER ================= --}}
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-azwara-darkest dark:text-azwara-lightest">
            Hasil Pengerjaan
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
            {{ $exam->title }}
        </p>
    </div>

    {{-- ================= RINGKASAN NILAI ================= --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">

        <div class="rounded-lg border border-azwara-lighter dark:border-azwara-darker
                    bg-white dark:bg-azwara-darker p-4">
            <div class="text-sm text-gray-500">Skor</div>
            <div class="text-xl font-semibold text-azwara-darkest dark:text-azwara-lightest">
                {{ $attempt->score }}
            </div>
        </div>

        <div class="rounded-lg border border-azwara-lighter dark:border-azwara-darker
                    bg-white dark:bg-azwara-darker p-4">
            <div class="text-sm text-gray-500">Benar</div>
            <div class="text-xl font-semibold text-green-600">
                {{ $attempt->correct_count }}
            </div>
        </div>

        <div class="rounded-lg border border-azwara-lighter dark:border-azwara-darker
                    bg-white dark:bg-azwara-darker p-4">
            <div class="text-sm text-gray-500">Salah</div>
            <div class="text-xl font-semibold text-red-600">
                {{ $attempt->wrong_count }}
            </div>
        </div>

        <div class="rounded-lg border border-azwara-lighter dark:border-azwara-darker
                    bg-white dark:bg-azwara-darker p-4">
            <div class="text-sm text-gray-500">Durasi</div>
            <div class="text-xl font-semibold text-azwara-darkest dark:text-azwara-lightest">
                {{ gmdate('H:i:s', $duration) }}
            </div>
        </div>

    </div>

    {{-- ================= STATUS KELULUSAN ================= --}}
    @if ($exam->type === 'tryout' && in_array($exam->test_type, ['skd', 'mtk_stis']))
        <div class="mb-8">
            <div class="rounded-lg border border-azwara-lighter dark:border-azwara-darker
                        bg-white dark:bg-azwara-darker p-4">
                <div class="text-sm text-gray-500">Status</div>
                @if ($attempt->is_passed)
                    <div class="text-lg font-semibold text-green-600 mt-1">
                        Lulus
                    </div>
                @else
                    <div class="text-lg font-semibold text-red-600 mt-1">
                        Belum Lulus
                    </div>
                @endif
            </div>
        </div>
    @endif

    {{-- ================= ACTION ================= --}}
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('exams.ranking.student', $exam) }}"
           class="inline-flex items-center px-4 py-2 rounded-md text-sm font-medium
                  bg-azwara-medium text-white hover:bg-azwara-light transition">
            Lihat Peringkat
        </a>

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

    {{-- ================= SOAL & PEMBAHASAN ================= --}}
    <div class="space-y-6">

        @foreach ($questions as $examQuestion)
            @php
                $question = $examQuestion->question;
                $answer = $attempt->answers->firstWhere('question_id', $question->id);
            @endphp

            <div class="rounded-lg border border-azwara-lighter dark:border-azwara-darker
                        bg-white dark:bg-azwara-darker p-5">

                {{-- Soal --}}
                <div class="mb-4">
                    <div class="font-medium text-azwara-darkest dark:text-azwara-lightest mb-2">
                        Soal #{{ $loop->iteration + ($questions->firstItem() - 1) }}
                    </div>

                    <div class="prose prose-sm dark:prose-invert max-w-none">
                        {!! $question->question_text !!}
                    </div>
                </div>

                {{-- Jawaban & Status --}}
                <div class="mb-4">
                    <div class="text-sm text-gray-500 mb-1">Jawaban Anda</div>

                    @if (!$answer || $answer->isEmpty)
                        <div class="text-gray-500 italic">Tidak dijawab</div>
                    @else
                        <div class="text-gray-700 dark:text-gray-200">
                            {{ $answer->display_answer ?? '—' }}
                        </div>
                    @endif

                    <div class="mt-2 text-sm font-medium">
                        @if (!$answer || $answer->isEmpty)
                            <span class="text-gray-500">Kosong</span>
                        @elseif ($answer->is_correct)
                            <span class="text-green-600">Benar</span>
                        @else
                            <span class="text-red-600">Salah</span>
                        @endif
                    </div>
                </div>

                {{-- Jawaban Benar --}}
                <div class="mb-4">
                    <div class="text-sm text-gray-500 mb-1">Jawaban Benar</div>
                    <div class="text-gray-700 dark:text-gray-200">
                        {{ $question->correct_answer_text ?? '—' }}
                    </div>
                </div>

                {{-- Pembahasan --}}
                @if ($question->explanation)
                    <div class="pt-4 border-t border-azwara-lighter dark:border-azwara-darker">
                        <div class="text-sm font-medium text-azwara-darkest dark:text-azwara-lightest mb-2">
                            Pembahasan
                        </div>
                        <div class="prose prose-sm dark:prose-invert max-w-none">
                            {!! $question->explanation !!}
                        </div>
                    </div>
                @endif
            </div>
        @endforeach

    </div>

    <div class="mt-8">
        {{ $questions->withQueryString()->links() }}
    </div>

</div>
@endsection
