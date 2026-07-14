@extends('layouts.exam')

@section('content')
    <div class="h-full flex flex-col bg-gray-50 dark:bg-gray-900">

        {{-- ================= HEADER / TIMER ================= --}}
        <div class="px-4 py-3 bg-gradient-to-r from-purple-700 to-blue-700 text-white shadow-lg flex-shrink-0">
            <div class="flex items-center justify-between">
                {{-- Left: Exam Info --}}
                <div class="flex-1 min-w-0">
                    <div class="text-sm font-medium text-white/90 truncate">
                        {{ $exam->title }}
                    </div>
                    @if($exam->type === 'tryout' && $exam->test_type === 'skd')
                        <div class="text-xs text-white/60 mt-0.5">
                            TIU: 35 | TWK: 30 | TKP: 45
                        </div>
                    @endif
                </div>

                {{-- Center: Timer --}}
                <div class="flex-1 text-center">
                    <div class="flex items-center justify-center gap-3">
                        <div class="w-2.5 h-2.5 rounded-full bg-red-400 animate-pulse"></div>
                        <div class="text-sm font-medium text-white/80">Sisa Waktu:</div>
                        <div id="timer" data-remaining="{{ $attempt->remainingSeconds() }}"
                            class="font-mono font-bold text-xl bg-white/20 px-4 py-1.5 rounded-xl min-w-[90px] text-white">
                        </div>
                        <div class="w-2.5 h-2.5 rounded-full bg-red-400 animate-pulse"></div>
                    </div>
                </div>

                {{-- Right: Actions --}}
                <div class="flex-1 flex justify-end items-center gap-2">
                    {{-- Fullscreen Button --}}
                    <button id="fullscreenBtn" class="p-2 rounded-xl bg-white/10 hover:bg-white/20 transition-colors" title="Toggle Fullscreen">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                        </svg>
                    </button>

                    {{-- Toggle Sidebar (Mobile) --}}
                    <button id="toggleSidebar" class="md:hidden p-2 rounded-xl bg-white/10 hover:bg-white/20 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- ================= MAIN CONTENT ================= --}}
        <div class="flex flex-1 overflow-hidden">
            {{-- ================= QUESTION AREA ================= --}}
            <main class="flex-1 overflow-y-auto p-4 md:p-8">
                @foreach($questions as $i => $eq)
                    @php
                        $question = $eq->question;
                        $answer = $attempt->answers->where('question_id', $question->id)->first();
                        $selectedOptions = $answer?->selected_ids ?? [];
                    @endphp

                    <div class="question-slide {{ $i === 0 ? '' : 'hidden' }}" data-index="{{ $i }}"
                        data-question-id="{{ $question->id }}" data-question-type="{{ $question->type }}">

                        {{-- Question Header --}}
                        <div class="mb-6 pb-4 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-3">
                                <div>
                                    <div class="flex items-center gap-3 mb-1">
                                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                                            Soal {{ $i + 1 }}
                                        </h2>
                                        <span class="text-xs font-medium px-3 py-1 rounded-full bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400">
                                            {{ strtoupper($question->type) }}
                                        </span>
                                    </div>
                                    @if($exam->type === 'tryout' && $exam->test_type === 'skd' && $question->test_type)
                                        <span class="inline-flex items-center gap-1.5 text-xs font-medium px-3 py-1 rounded-full
                                            @if($question->test_type === 'tiu') bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400
                                            @elseif($question->test_type === 'twk') bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400
                                            @else bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400 @endif">
                                            {{ strtoupper($question->test_type) }}
                                        </span>
                                    @endif
                                </div>

                                <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                                    <span>{{ $i + 1 }} / {{ $questions->count() }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Question Content --}}
                        <div class="mb-8">
                            <div class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200 text-base leading-relaxed">
                                {!! $question->question_text !!}
                            </div>

                            @if($question->image)
                                <div class="mt-6">
                                    <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs mb-3">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Gambar Soal
                                    </div>
                                    <div class="flex justify-center">
                                        <img src="{{ asset('storage/' . $question->image) }}"
                                            class="max-w-full md:max-w-lg max-h-80 object-contain rounded-xl shadow-lg border border-gray-200 dark:border-gray-700"
                                            alt="Gambar Soal" loading="lazy">
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- ANSWER OPTIONS --}}
                        <div class="answer-section space-y-4">
                            {{-- MCQ, MCMA, TrueFalse --}}
                            @if(in_array($question->type, ['mcq', 'mcma', 'truefalse']))
                                <div class="space-y-3">
                                    @foreach($question->options as $option)
                                        <div class="option-button group">
                                            <input type="{{ $question->type === 'mcma' ? 'checkbox' : 'radio' }}"
                                                name="question_{{ $question->id }}[]" value="{{ $option->id }}"
                                                id="option_{{ $option->id }}" class="sr-only" @checked(in_array($option->id, $answer?->selected_ids ?? []))>
                                            <label for="option_{{ $option->id }}"
                                                class="flex items-start gap-4 p-4 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 cursor-pointer transition-all duration-200 hover:border-purple-400 dark:hover:border-purple-500 hover:shadow-md group-has-[input:checked]:border-purple-500 group-has-[input:checked]:bg-purple-50 dark:group-has-[input:checked]:bg-purple-900/20 group-has-[input:checked]:shadow-lg">
                                                
                                                {{-- Option Indicator --}}
                                                <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg border-2 border-gray-300 dark:border-gray-600 group-has-[input:checked]:border-purple-500 group-has-[input:checked]:bg-purple-500 text-gray-600 dark:text-gray-400 group-has-[input:checked]:text-white transition-all font-semibold text-sm">
                                                    @if($question->type === 'truefalse')
                                                        {{ $option->label === 'true' ? 'B' : 'S' }}
                                                    @else
                                                        {{ $option->label }}
                                                    @endif
                                                </div>

                                                {{-- Option Content --}}
                                                <div class="flex-1 min-w-0">
                                                    <div class="prose dark:prose-invert max-w-none text-sm text-gray-700 dark:text-gray-300">
                                                        {!! $option->option_text !!}
                                                    </div>
                                                    @if($option->image)
                                                        <div class="mt-3">
                                                            <img src="{{ asset('storage/' . $option->image) }}"
                                                                class="max-w-[200px] rounded-lg border border-gray-200 dark:border-gray-700" alt="Gambar Opsi" loading="lazy">
                                                        </div>
                                                    @endif
                                                </div>

                                                {{-- Check Indicator --}}
                                                <div class="flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-full border-2 border-gray-300 dark:border-gray-600 group-has-[input:checked]:border-purple-500 group-has-[input:checked]:bg-purple-500 transition-all">
                                                    <svg class="w-3 h-3 text-white opacity-0 group-has-[input:checked]:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            {{-- SHORT ANSWER --}}
                            @if($question->type === 'short_answer')
                                <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border-2 border-gray-200 dark:border-gray-700">
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-9 h-9 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900 dark:text-white">Jawaban Singkat</h4>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Tulis jawaban Anda di bawah</p>
                                        </div>
                                    </div>
                                    <textarea name="short_answer_{{ $question->id }}"
                                        class="short-answer-input w-full p-4 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/20 transition-colors"
                                        rows="4"
                                        placeholder="Ketik jawaban Anda di sini...">{{ $answer?->short_answer_value ?? '' }}</textarea>
                                </div>
                            @endif

                            {{-- COMPOUND --}}
                            @if($question->type === 'compound')
                                <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border-2 border-purple-200 dark:border-purple-500/30">
                                    <div class="flex items-center gap-3 mb-5">
                                        <div class="w-9 h-9 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-purple-800 dark:text-purple-300">Soal Gabungan</h4>
                                            <p class="text-xs text-purple-600/80 dark:text-purple-400/80">Jawab semua pertanyaan di bawah</p>
                                        </div>
                                    </div>

                                    <div class="space-y-4">
                                        @foreach($question->subItems->sortBy('order') as $subIndex => $subItem)
                                            @php
                                                $subAnswer = $answer?->getCompoundAnswerBySubId($subItem->id);
                                            @endphp

                                            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                                                <div class="flex items-start justify-between mb-3">
                                                    <div>
                                                        <div class="flex items-center gap-2 mb-1">
                                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Sub-soal {{ $subIndex + 1 }}</span>
                                                            <span class="text-xs px-2 py-0.5 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
                                                                {{ $subItem->type === 'truefalse' ? 'B/S' : 'Isian' }}
                                                            </span>
                                                        </div>
                                                        <h5 class="font-medium text-gray-800 dark:text-gray-200">{{ $subItem->prompt }}</h5>
                                                    </div>
                                                </div>

                                                @if($subItem->type === 'truefalse')
                                                    <div class="flex gap-3">
                                                        <button type="button" data-sub-id="{{ $subItem->id }}"
                                                            class="truefalse-btn flex-1 p-3 rounded-xl border-2 border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:border-green-500 hover:bg-green-50 dark:hover:bg-green-900/20 transition-all {{ $subAnswer && ($subAnswer['boolean'] ?? false) ? 'border-green-500 bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-300' : '' }}">
                                                            <span class="font-medium">Benar</span>
                                                        </button>
                                                        <button type="button" data-sub-id="{{ $subItem->id }}"
                                                            class="truefalse-btn flex-1 p-3 rounded-xl border-2 border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:border-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all {{ $subAnswer && !($subAnswer['boolean'] ?? true) ? 'border-red-500 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300' : '' }}">
                                                            <span class="font-medium">Salah</span>
                                                        </button>
                                                    </div>
                                                @elseif($subItem->type === 'short_answer')
                                                    <textarea name="compound_{{ $question->id }}_sub_{{ $subItem->id }}"
                                                        data-sub-id="{{ $subItem->id }}"
                                                        class="compound-short-answer w-full p-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/20 transition-colors"
                                                        rows="2" placeholder="Jawaban...">{{ $subAnswer['value'] ?? '' }}</textarea>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-3 italic">Catatan: Jika satu sub salah, seluruh soal dianggap salah.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </main>

            {{-- ================= RIGHT SIDEBAR (NAVIGATION) ================= --}}
            <aside id="sidebar" class="fixed md:relative inset-y-0 right-0 z-40
                          w-72 md:w-64
                          bg-white dark:bg-gray-800
                          border-l border-gray-200 dark:border-gray-700
                          transform translate-x-full md:translate-x-0
                          transition-transform duration-300
                          overflow-y-auto p-5 shadow-xl md:shadow-none">

                {{-- Sidebar Header --}}
                <div class="mb-5 pb-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="font-bold text-gray-900 dark:text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Navigasi
                        </h3>
                        <button id="closeSidebar" class="md:hidden p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Klik nomor untuk berpindah soal</p>
                </div>

                {{-- Question Navigation Grid --}}
                <div class="grid grid-cols-5 gap-2">
                    @foreach($questions as $i => $eq)
                        @php
                            $question = $eq->question;
                            $answer = $attempt->answers->where('question_id', $question->id)->first();
                            $answered = $answer && !$answer->isEmpty;
                        @endphp

                        <button type="button" class="nav-btn relative w-full aspect-square rounded-xl flex items-center justify-center
                                                   font-semibold text-sm transition-all duration-200
                                                   hover:scale-105 hover:shadow-md active:scale-95
                                                   {{ $answered
                                ? 'bg-green-500 text-white hover:bg-green-600 shadow-green-500/30'
                                : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}" 
                                data-index="{{ $i }}" data-question-type="{{ $question->type }}">
                            {{ $i + 1 }}
                            @if($answered)
                                <span class="absolute -top-1 -right-1 w-3 h-3 rounded-full bg-green-300"></span>
                            @endif
                        </button>
                    @endforeach
                </div>

                {{-- Status Summary --}}
                <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <h4 class="font-semibold text-gray-900 dark:text-white mb-3 text-sm">Status Pengerjaan</h4>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Terjawab</span>
                            </div>
                            <span id="answeredCount" class="font-semibold text-gray-900 dark:text-white">0</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-gray-300 dark:bg-gray-600"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Belum Dijawab</span>
                            </div>
                            <span id="unansweredCount" class="font-semibold text-gray-900 dark:text-white">{{ $questions->count() }}</span>
                        </div>
                    </div>
                </div>
            </aside>

            {{-- Mobile Overlay --}}
            <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-30 hidden md:hidden" onclick="hideSidebar()"></div>
        </div>

        {{-- ================= FOOTER NAVIGATION ================= --}}
        <div class="px-4 py-3 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 flex-shrink-0 shadow-lg">
            <div class="flex justify-between items-center max-w-7xl mx-auto">
                <button id="prevBtn"
                    class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Sebelumnya
                </button>

                <div class="flex items-center gap-3">
                    {{-- Submit Button (only show on last question) --}}
                    <form id="auto-submit-form" method="POST" action="{{ route('exams.submit', $attempt->exam) }}"
                        class="sweet-confirm hidden"
                        data-message="Yakin ingin mengakhiri ujian? Pastikan semua jawaban sudah diperiksa.">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-2 px-6 py-2.5 rounded-xl bg-gradient-to-r from-red-600 to-red-700 text-white hover:from-red-700 hover:to-red-800 transition-all shadow-lg shadow-red-500/30 font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Submit Jawaban
                        </button>
                    </form>

                    <button id="nextBtn"
                        class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-purple-600 to-blue-600 text-white hover:from-purple-700 hover:to-blue-700 transition-all shadow-lg shadow-purple-500/30 font-medium">
                        Selanjutnya
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('exams.js.attempt')