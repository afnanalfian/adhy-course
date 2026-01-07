@extends('layouts.exam')

@section('content')
<div class="h-full flex flex-col overflow-hidden">

    {{-- ================= TIMER ================= --}}
    <div class="p-4 bg-secondary text-white flex items-center">

        {{-- spacer kiri --}}
        <div class="flex-1 hidden md:block"></div>

        {{-- TIMER (tengah) --}}
        <div class="flex-1 text-center font-semibold">
            Sisa Waktu:
            <span
                id="timer"
                data-remaining="{{ $attempt->remainingSeconds() }}"
                class="font-bold text-lg">
            </span>
        </div>

        {{-- Toggle sidebar (mobile) --}}
        <div class="flex-1 flex justify-end">
            <button
                id="toggleSidebar"
                class="md:hidden px-3 py-2 rounded bg-white/20 text-sm">
                Soal
            </button>
        </div>
    </div>


    <div class="flex flex-1 overflow-hidden relative">

        {{-- ================= SIDEBAR ================= --}}
        <aside
            id="sidebar"
            class="fixed md:static inset-y-0 left-0 z-40
                   w-64 md:w-52
                   bg-white dark:bg-secondary
                   border-r border-gray-200 dark:border-white/10
                   transform -translate-x-full md:translate-x-0
                   transition-transform duration-200
                   overflow-y-auto p-3">

            <h3 class="font-semibold mb-3 text-center md:text-left">
                Navigasi Soal
            </h3>

            <div class="grid grid-cols-4 md:grid-cols-3 gap-2">
                @foreach($attempt->exam->questions as $i => $eq)
                    @php
                        $question = $eq->question;
                        $answer = $attempt->answers
                            ->where('question_id', $question->id)
                            ->first();
                        $answered = $answer && !$answer->isEmpty;
                    @endphp

                    <button
                        type="button"
                        class="nav-btn
                               w-full py-2 rounded text-sm font-semibold text-white
                               {{ $answered ? 'bg-green-600' : 'bg-red-600' }}"
                        data-index="{{ $i }}"
                        data-question-type="{{ $question->type }}">
                        {{ $i + 1 }}
                    </button>
                @endforeach
            </div>
        </aside>

        {{-- overlay mobile --}}
        <div
            id="sidebarOverlay"
            class="fixed inset-0 bg-black/40 z-30 hidden md:hidden">
        </div>

        {{-- ================= QUESTION AREA ================= --}}
        <main class="flex-1 overflow-y-auto p-4 md:p-6">

            @foreach($attempt->exam->questions as $i => $eq)
                @php
                    $question = $eq->question;
                    $answer = $attempt->answers
                        ->where('question_id', $question->id)
                        ->first();
                    $selectedOptions = $answer?->selected_options ?? [];
                @endphp

                <div
                    class="question-slide {{ $i === 0 ? '' : 'hidden' }}"
                    data-index="{{ $i }}"
                    data-question-id="{{ $question->id }}"
                    data-question-type="{{ $question->type }}">

                    {{-- SOAL --}}
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold mb-3">
                            Soal {{ $i + 1 }}
                        </h2>

                        <div class="prose dark:prose-invert max-w-none">
                            {!! $question->question_text !!}
                        </div>

                        @if($question->image)
                            <div class="mt-4 flex justify-center">
                                <img
                                    src="{{ asset('storage/'.$question->image) }}"
                                    class="max-w-full md:max-w-sm max-h-64 object-contain rounded shadow"
                                    alt="Gambar Soal">
                            </div>
                        @endif
                    </div>

                    {{-- MCQ, MCMA, TrueFalse --}}
                    @if(in_array($question->type, ['mcq', 'mcma', 'truefalse']))
                        <div class="space-y-4 answer-section">
                            @foreach($question->options as $option)
                                <label
                                    class="block p-3 rounded-lg
                                           border border-gray-200 dark:border-white/10
                                           cursor-pointer hover:bg-gray-100 dark:hover:bg-white/5">

                                    <div class="flex items-start gap-3">
                                        <input
                                            type="{{ $question->type === 'mcma' ? 'checkbox' : 'radio' }}"
                                            name="question_{{ $question->id }}[]"
                                            value="{{ $option->id }}"
                                            @checked(in_array($option->id, $answer?->selected_ids ?? []))
                                            class="answer-input mt-1"
                                        >

                                        <div class="flex-1">
                                            {{-- label + teks --}}
                                            @if($question->type !== 'truefalse')
                                                <span class="font-semibold mr-1">
                                                    {{ $option->label }}.
                                                </span>
                                            @endif

                                            <span class="prose dark:prose-invert max-w-none text-sm inline">
                                                {!! $option->option_text !!}
                                            </span>
                                        </div>
                                    </div>

                                    {{-- gambar opsi --}}
                                    @if($option->image)
                                        <div class="mt-2 ml-7">
                                            <img
                                                src="{{ asset('storage/'.$option->image) }}"
                                                class="max-w-[160px] rounded"
                                                alt="Gambar Opsi">
                                        </div>
                                    @endif
                                </label>
                            @endforeach
                        </div>
                    @endif

                    {{-- SHORT ANSWER --}}
                    @if($question->type === 'short_answer')
                        <div class="space-y-4 answer-section">
                            <div class="p-4 bg-blue-50 dark:bg-blue-900/30 rounded-lg">
                                <p class="text-sm text-blue-800 dark:text-blue-300 mb-2">
                                    Masukkan jawaban:
                                </p>
                                <textarea
                                    name="short_answer_{{ $question->id }}"
                                    class="short-answer-input w-full p-3 rounded-lg border
                                           bg-white dark:bg-secondary/50
                                           text-gray-800 dark:text-gray-100"
                                    rows="3"
                                    placeholder="Tulis jawaban di sini...">{{ $answer?->short_answer_value ?? '' }}</textarea>
                            </div>
                        </div>
                    @endif

                    {{-- COMPOUND --}}
                    @if($question->type === 'compound')
                        <div class="space-y-4 answer-section">
                            <div class="p-4 bg-purple-50 dark:bg-purple-900/30 rounded-lg">
                                <p class="text-sm text-purple-800 dark:text-purple-300 mb-4">
                                    Jawab semua pertanyaan berikut:
                                </p>

                                <div class="space-y-6">
                                    @foreach($question->subItems->sortBy('order') as $subIndex => $subItem)
                                        @php
                                            $subAnswer = $answer?->getCompoundAnswerBySubId($subItem->id);
                                        @endphp

                                        <div class="border rounded-lg p-4 bg-white/50 dark:bg-gray-800/50">
                                            <div class="flex items-start justify-between mb-3">
                                                <h4 class="font-semibold text-gray-800 dark:text-gray-100">
                                                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $subItem->label }}.</span>
                                                    <span class="ml-1">{{ $subItem->prompt }}</span>
                                                </h4>
                                                <span class="text-xs px-2 py-1 rounded bg-gray-100 dark:bg-gray-700">
                                                    {{ $subItem->type === 'truefalse' ? 'BENAR/SALAH' : 'ISIAN SINGKAT' }}
                                                </span>
                                            </div>

                                            @if($subItem->type === 'truefalse')
                                                <div class="flex gap-4">
                                                    <label class="flex items-center gap-2">
                                                        <input type="radio"
                                                               name="compound_{{ $question->id }}_sub_{{ $subItem->id }}"
                                                               value="1"
                                                               class="compound-answer-input"
                                                               data-sub-id="{{ $subItem->id }}"
                                                               data-type="truefalse"
                                                               {{ $subAnswer && ($subAnswer['boolean'] ?? false) ? 'checked' : '' }}>
                                                        <span>Benar</span>
                                                    </label>
                                                    <label class="flex items-center gap-2">
                                                        <input type="radio"
                                                               name="compound_{{ $question->id }}_sub_{{ $subItem->id }}"
                                                               value="0"
                                                               class="compound-answer-input"
                                                               data-sub-id="{{ $subItem->id }}"
                                                               data-type="truefalse"
                                                               {{ $subAnswer && !($subAnswer['boolean'] ?? true) ? 'checked' : '' }}>
                                                        <span>Salah</span>
                                                    </label>
                                                </div>
                                            @elseif($subItem->type === 'short_answer')
                                                <div>
                                                    <textarea
                                                        name="compound_{{ $question->id }}_sub_{{ $subItem->id }}"
                                                        class="compound-answer-input w-full p-3 rounded-lg border
                                                               bg-white dark:bg-secondary/50
                                                               text-gray-800 dark:text-gray-100"
                                                        rows="2"
                                                        data-sub-id="{{ $subItem->id }}"
                                                        data-type="short_answer"
                                                        placeholder="Jawaban...">{{ $subAnswer['value'] ?? '' }}</textarea>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            @endforeach

        </main>
    </div>

    {{-- ================= ACTION ================= --}}
    <div class="p-4 bg-white dark:bg-secondary border-t border-gray-200 dark:border-white/10
                flex justify-between items-center">

        <button id="prevBtn"
                class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-white/10">
            Sebelumnya
        </button>

        <form
            id="auto-submit-form"
            method="POST"
            action="{{ route('exams.submit', $attempt->exam) }}"
            class="sweet-confirm"
            data-message="Yakin ingin mengakhiri ujian?">
            @csrf
            <button class="px-5 py-2 rounded-lg bg-red-600 text-white">
                Submit
            </button>
        </form>

        <button id="nextBtn"
                class="px-4 py-2 rounded-lg bg-primary text-white">
            Selanjutnya
        </button>
    </div>

</div>
@endsection
@include('exams.js.attempt')
