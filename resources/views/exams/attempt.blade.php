@extends('layouts.exam')

@section('content')
<div class="min-h-screen flex flex-col overflow-hidden bg-gradient-to-br from-gray-50 to-blue-50 dark:from-gray-900 dark:to-gray-950">

    {{-- ================= HEADER ================= --}}
    <header class="sticky top-0 z-40 bg-gradient-to-r from-secondary via-secondary to-primary text-white shadow-lg">
        <div class="container mx-auto px-4 py-3">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">

                {{-- Exam Info & Mobile Timer --}}
                <div class="flex items-center justify-between md:justify-start md:space-x-6">
                    {{-- Logo/Brand --}}
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-sm"></i>
                        </div>
                        <span class="font-bold text-lg tracking-tight">Azwara</span>
                    </div>

                    {{-- Exam Title --}}
                    <div class="hidden md:block">
                        <h1 class="font-semibold text-sm truncate max-w-xs">{{ $exam->title }}</h1>
                        <p class="text-xs opacity-90">Total: {{ $questions->count() }} Soal</p>
                    </div>

                    {{-- Mobile Timer --}}
                    <div class="md:hidden bg-white/10 backdrop-blur-sm px-3 py-1.5 rounded-lg">
                        <div class="text-center">
                            <div class="text-xs opacity-90">Sisa Waktu</div>
                            <div id="timer-mobile" class="font-bold text-lg"
                                 data-remaining="{{ $attempt->remainingSeconds() }}"></div>
                        </div>
                    </div>
                </div>

                {{-- Desktop Timer & Actions --}}
                <div class="flex items-center justify-between md:justify-end space-x-4">
                    {{-- Desktop Timer --}}
                    <div class="hidden md:flex items-center space-x-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-lg">
                        <i class="fas fa-clock text-sm"></i>
                        <div>
                            <div class="text-xs opacity-90">Sisa Waktu</div>
                            <div id="timer-desktop" class="font-bold"
                                 data-remaining="{{ $attempt->remainingSeconds() }}"></div>
                        </div>
                    </div>

                    {{-- Toggle Sidebar Button --}}
                    <button id="toggleSidebar"
                            class="md:hidden px-3 py-2 bg-white/20 hover:bg-white/30 rounded-lg transition-colors">
                        <i class="fas fa-bars mr-1"></i>
                        <span>Navigasi</span>
                    </button>

                    {{-- User Info --}}
                    <div class="hidden md:flex items-center space-x-2">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-sm"></i>
                        </div>
                        <div class="text-sm">
                            <div class="font-medium">{{ auth()->user()->name }}</div>
                            <div class="text-xs opacity-90">Siswa</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="flex flex-1 overflow-hidden relative">

        {{-- ================= SIDEBAR ================= --}}
        <aside id="sidebar"
               class="fixed md:relative inset-y-0 left-0 z-30
                      w-full md:w-80 lg:w-96
                      bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm
                      border-r border-gray-200 dark:border-gray-700
                      transform -translate-x-full md:translate-x-0
                      transition-transform duration-300 ease-in-out
                      overflow-y-auto p-4 shadow-lg md:shadow-none">

            {{-- Sidebar Header --}}
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                    <i class="fas fa-list-ol mr-2"></i>Navigasi Soal
                </h2>
                <button id="closeSidebar" class="md:hidden text-gray-500 hover:text-gray-700 dark:text-gray-400">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            {{-- Progress Bar --}}
            <div class="mb-6">
                <div class="flex justify-between text-sm mb-2">
                    <span class="text-gray-600 dark:text-gray-400">Progress</span>
                    <span class="font-semibold text-primary">
                        {{ $attempt->answers->where('isEmpty', false)->count() }}/{{ $questions->count() }}
                    </span>
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                    <div class="bg-green-500 h-2.5 rounded-full transition-all duration-300"
                         style="width: {{ ($attempt->answers->where('isEmpty', false)->count() / $questions->count()) * 100 }}%"></div>
                </div>
            </div>

            {{-- Question Navigation Grid --}}
            <div class="mb-6">
                <h3 class="font-semibold text-gray-700 dark:text-gray-300 mb-3">
                    <i class="fas fa-map-marker-alt mr-2"></i>Pindah Soal
                </h3>
                <div class="grid grid-cols-5 md:grid-cols-4 lg:grid-cols-5 gap-2">
                    @foreach($questions as $i => $eq)
                        @php
                            $question = $eq->question;
                            $answer = $attempt->answers
                                ->where('question_id', $question->id)
                                ->first();
                            $answered = $answer && !$answer->isEmpty;
                            $current = $i === 0;
                        @endphp

                        <button type="button"
                                class="nav-btn relative
                                       w-full aspect-square rounded-lg
                                       flex items-center justify-center
                                       font-semibold text-sm
                                       transition-all duration-200
                                       transform hover:scale-105 active:scale-95
                                       {{ $answered
                                           ? 'bg-gradient-to-br from-green-500 to-emerald-600 text-white shadow-md'
                                           : 'bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600'
                                       }}
                                       {{ $current
                                           ? 'ring-2 ring-primary ring-offset-2 dark:ring-offset-gray-800 shadow-lg scale-105'
                                           : '' }}"
                                data-index="{{ $i }}"
                                data-question-type="{{ $question->type }}"
                                title="Soal {{ $i + 1 }}">
                            {{ $i + 1 }}
                            @if($answered)
                                <i class="fas fa-check absolute -top-1 -right-1 text-xs bg-white text-green-600 rounded-full w-4 h-4 flex items-center justify-center"></i>
                            @endif
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Legend --}}
            <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-3 border border-gray-200 dark:border-gray-700">
                <h4 class="font-medium text-gray-700 dark:text-gray-300 mb-2">
                    <i class="fas fa-info-circle mr-2"></i>Keterangan
                </h4>
                <div class="space-y-2 text-sm">
                    <div class="flex items-center">
                        <div class="w-4 h-4 rounded bg-gradient-to-br from-green-500 to-emerald-600 mr-2"></div>
                        <span class="text-gray-600 dark:text-gray-400">Sudah dijawab</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 rounded bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 border border-gray-300 dark:border-gray-600 mr-2"></div>
                        <span class="text-gray-600 dark:text-gray-400">Belum dijawab</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 rounded ring-2 ring-primary ring-offset-1 bg-white dark:bg-gray-800 mr-2"></div>
                        <span class="text-gray-600 dark:text-gray-400">Soal aktif</span>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="mt-6 space-y-2">
                <button id="jumpToFirstUnanswered"
                        class="w-full py-2.5 bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white rounded-lg font-medium transition-all duration-200">
                    <i class="fas fa-forward mr-2"></i>Lompat ke soal belum terjawab
                </button>
                <button id="reviewAllQuestions"
                        class="w-full py-2.5 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white rounded-lg font-medium transition-all duration-200">
                    <i class="fas fa-eye mr-2"></i>Tinjau semua jawaban
                </button>
            </div>
        </aside>

        {{-- Overlay for Mobile Sidebar --}}
        <div id="sidebarOverlay"
             class="fixed inset-0 bg-black/60 z-20 hidden md:hidden backdrop-blur-sm transition-opacity duration-300">
        </div>

        {{-- ================= MAIN CONTENT ================= --}}
        <main class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8">
            <div class="max-w-4xl mx-auto">

                @foreach($questions as $i => $eq)
                    @php
                        $question = $eq->question;
                        $answer = $attempt->answers
                            ->where('question_id', $question->id)
                            ->first();
                        $selectedOptions = $answer?->selected_options ?? [];
                        $selectedIds = $answer?->selected_ids ?? [];
                    @endphp

                    <div class="question-slide {{ $i === 0 ? '' : 'hidden' }}"
                         data-index="{{ $i }}"
                         data-question-id="{{ $question->id }}"
                         data-question-type="{{ $question->type }}">

                        {{-- Question Card --}}
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">

                            {{-- Question Header --}}
                            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                                    <div>
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-primary text-white text-sm font-bold">
                                                {{ $i + 1 }}
                                            </span>
                                            <span class="text-lg font-bold text-gray-800 dark:text-white">Soal {{ $i + 1 }}</span>
                                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded">
                                                {{ strtoupper($question->type) }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            {{ $questions->count() }} soal • Poin: {{ $question->points ?? 1 }}
                                        </p>
                                    </div>

                                    <div class="flex items-center space-x-2">
                                        <button class="p-2 text-gray-500 hover:text-primary dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors"
                                                title="Tandai untuk ditinjau">
                                            <i class="far fa-flag"></i>
                                        </button>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            <i class="far fa-clock mr-1"></i>
                                            <span id="question-timer-{{ $i }}">--:--</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Question Body --}}
                            <div class="p-6 md:p-8">
                                {{-- Question Text --}}
                                <div class="prose dark:prose-invert max-w-none mb-6">
                                    {!! $question->question_text !!}
                                </div>

                                {{-- Question Image --}}
                                @if($question->image)
                                    <div class="mb-8 flex justify-center">
                                        <div class="relative group">
                                            <img src="{{ asset('storage/'.$question->image) }}"
                                                 class="max-w-full md:max-w-2xl max-h-96 object-contain rounded-xl shadow-lg border border-gray-200 dark:border-gray-700"
                                                 alt="Gambar Soal"
                                                 loading="lazy">
                                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors rounded-xl cursor-zoom-in"
                                                 onclick="openImageModal('{{ asset('storage/'.$question->image) }}')"></div>
                                            <div class="absolute bottom-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <button class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm p-2 rounded-lg shadow"
                                                        onclick="openImageModal('{{ asset('storage/'.$question->image) }}')">
                                                    <i class="fas fa-expand text-gray-700 dark:text-gray-300"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- MCQ, MCMA, TrueFalse Options --}}
                                @if(in_array($question->type, ['mcq', 'mcma', 'truefalse']))
                                    <div class="space-y-3 answer-section">
                                        @foreach($question->options as $option)
                                            @php
                                                $isSelected = in_array($option->id, $selectedIds);
                                                $isCorrect = false; // You might want to add this logic for review mode
                                            @endphp

                                            <button type="button"
                                                    class="option-btn w-full text-left
                                                           p-4 rounded-xl
                                                           border-2 transition-all duration-200
                                                           {{ $isSelected
                                                               ? ($isCorrect
                                                                   ? 'border-green-500 bg-green-50 dark:bg-green-900/20 shadow-md'
                                                                   : 'border-primary bg-blue-50 dark:bg-blue-900/20 shadow-md')
                                                               : 'border-gray-200 dark:border-gray-700 hover:border-primary hover:shadow-sm'
                                                           }}
                                                           group"
                                                    data-option-id="{{ $option->id }}"
                                                    data-selected="{{ $isSelected ? 'true' : 'false' }}">
                                                <div class="flex items-start gap-4">
                                                    {{-- Option Label Badge --}}
                                                    <div class="flex-shrink-0">
                                                        <div class="w-10 h-10 rounded-lg flex items-center justify-center
                                                                    {{ $isSelected
                                                                        ? ($isCorrect
                                                                            ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300 border border-green-300 dark:border-green-700'
                                                                            : 'bg-primary text-white')
                                                                        : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600'
                                                                    }}
                                                                    font-bold text-lg transition-all duration-200">
                                                            @if($question->type === 'truefalse')
                                                                {{ $option->label == 'true' ? 'B' : 'S' }}
                                                            @else
                                                                {{ $option->label }}
                                                            @endif
                                                        </div>
                                                    </div>

                                                    {{-- Option Content --}}
                                                    <div class="flex-1">
                                                        <div class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200 mb-2">
                                                            @if($question->type === 'truefalse')
                                                                <span class="font-semibold">
                                                                    {{ $option->label == 'true' ? 'BENAR' : 'SALAH' }}
                                                                </span>
                                                                @if($option->option_text)
                                                                    : {!! $option->option_text !!}
                                                                @endif
                                                            @else
                                                                {!! $option->option_text !!}
                                                            @endif
                                                        </div>

                                                        {{-- Option Image --}}
                                                        @if($option->image)
                                                            <div class="mt-3">
                                                                <div class="relative inline-block group/image">
                                                                    <img src="{{ asset('storage/'.$option->image) }}"
                                                                         class="max-w-[180px] rounded-lg border border-gray-300 dark:border-gray-600 shadow-sm"
                                                                         alt="Gambar Opsi"
                                                                         loading="lazy">
                                                                    <div class="absolute inset-0 bg-black/0 group-hover/image:bg-black/5 transition-colors rounded-lg cursor-zoom-in"
                                                                         onclick="openImageModal('{{ asset('storage/'.$option->image) }}')"></div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    {{-- Selection Indicator --}}
                                                    <div class="flex-shrink-0">
                                                        @if($isSelected)
                                                            <div class="w-6 h-6 rounded-full flex items-center justify-center
                                                                        {{ $isCorrect
                                                                            ? 'bg-green-500'
                                                                            : 'bg-primary'
                                                                        }}">
                                                                <i class="fas fa-check text-white text-xs"></i>
                                                            </div>
                                                        @else
                                                            <div class="w-6 h-6 rounded-full border-2 border-gray-300 dark:border-gray-600"></div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </button>
                                        @endforeach
                                    </div>
                                @endif

                                {{-- SHORT ANSWER --}}
                                @if($question->type === 'short_answer')
                                    <div class="answer-section">
                                        <div class="bg-gradient-to-br from-blue-50 to-cyan-50 dark:from-blue-900/30 dark:to-cyan-900/30 rounded-xl p-6 border border-blue-200 dark:border-blue-800">
                                            <div class="flex items-center gap-3 mb-4">
                                                <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-800 flex items-center justify-center">
                                                    <i class="fas fa-keyboard text-blue-600 dark:text-blue-300"></i>
                                                </div>
                                                <div>
                                                    <h4 class="font-semibold text-blue-800 dark:text-blue-300">Jawaban Singkat</h4>
                                                    <p class="text-sm text-blue-600 dark:text-blue-400">Masukkan jawaban Anda di bawah ini</p>
                                                </div>
                                            </div>

                                            <div class="relative">
                                                <textarea name="short_answer_{{ $question->id }}"
                                                          class="short-answer-input w-full p-4 rounded-xl border-2
                                                                 bg-white dark:bg-gray-800
                                                                 text-gray-800 dark:text-gray-100
                                                                 border-blue-300 dark:border-blue-700
                                                                 focus:border-primary focus:ring-2 focus:ring-blue-500/20 focus:outline-none
                                                                 transition-all duration-200"
                                                          rows="4"
                                                          placeholder="Tulis jawaban Anda di sini...">{{ $answer?->short_answer_value ?? '' }}</textarea>
                                                <div class="absolute bottom-3 right-3 text-xs text-gray-500 dark:text-gray-400">
                                                    <span id="char-count-{{ $question->id }}">0</span> karakter
                                                </div>
                                            </div>

                                            <div class="mt-3 flex items-center text-sm text-blue-600 dark:text-blue-400">
                                                <i class="fas fa-lightbulb mr-2"></i>
                                                <span>Jawaban akan otomatis disimpan saat Anda mengetik</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- COMPOUND --}}
                                @if($question->type === 'compound')
                                    <div class="answer-section">
                                        <div class="bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-900/30 dark:to-pink-900/30 rounded-xl p-6 border border-purple-200 dark:border-purple-800">
                                            <div class="flex items-center gap-3 mb-6">
                                                <div class="w-10 h-10 rounded-lg bg-purple-100 dark:bg-purple-800 flex items-center justify-center">
                                                    <i class="fas fa-layer-group text-purple-600 dark:text-purple-300"></i>
                                                </div>
                                                <div>
                                                    <h4 class="font-semibold text-purple-800 dark:text-purple-300">Soal Gabungan</h4>
                                                    <p class="text-sm text-purple-600 dark:text-purple-400">Jawab semua pertanyaan berikut</p>
                                                </div>
                                            </div>

                                            <div class="space-y-6">
                                                @foreach($question->subItems->sortBy('order') as $subIndex => $subItem)
                                                    @php
                                                        $subAnswer = $answer?->getCompoundAnswerBySubId($subItem->id);
                                                    @endphp

                                                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
                                                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-4">
                                                            <div>
                                                                <div class="flex items-center gap-2 mb-1">
                                                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-300 text-xs font-bold">
                                                                        {{ $subItem->label }}
                                                                    </span>
                                                                    <h4 class="font-semibold text-gray-800 dark:text-gray-100">{{ $subItem->prompt }}</h4>
                                                                </div>
                                                                @if($subItem->hint)
                                                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $subItem->hint }}</p>
                                                                @endif
                                                            </div>
                                                            <span class="px-3 py-1 text-xs font-medium rounded-full
                                                                      {{ $subItem->type === 'truefalse'
                                                                         ? 'bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-300'
                                                                         : 'bg-cyan-100 dark:bg-cyan-900 text-cyan-800 dark:text-cyan-300'
                                                                      }}">
                                                                {{ $subItem->type === 'truefalse' ? 'BENAR/SALAH' : 'ISIAN SINGKAT' }}
                                                            </span>
                                                        </div>

                                                        {{-- TrueFalse SubItem --}}
                                                        @if($subItem->type === 'truefalse')
                                                            <div class="flex gap-3">
                                                                <button type="button"
                                                                        class="tf-option flex-1 p-4 rounded-xl border-2 text-center font-medium transition-all duration-200
                                                                               {{ $subAnswer && ($subAnswer['boolean'] ?? false)
                                                                                  ? 'border-green-500 bg-green-50 dark:bg-green-900/20 text-green-800 dark:text-green-300'
                                                                                  : 'border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600'
                                                                               }}"
                                                                        data-sub-id="{{ $subItem->id }}"
                                                                        data-value="true">
                                                                    <div class="flex items-center justify-center gap-2">
                                                                        <div class="w-6 h-6 rounded-full flex items-center justify-center
                                                                                    {{ $subAnswer && ($subAnswer['boolean'] ?? false)
                                                                                       ? 'bg-green-500'
                                                                                       : 'bg-gray-200 dark:bg-gray-700'
                                                                                    }}">
                                                                            @if($subAnswer && ($subAnswer['boolean'] ?? false))
                                                                                <i class="fas fa-check text-white text-xs"></i>
                                                                            @endif
                                                                        </div>
                                                                        <span>BENAR</span>
                                                                    </div>
                                                                </button>

                                                                <button type="button"
                                                                        class="tf-option flex-1 p-4 rounded-xl border-2 text-center font-medium transition-all duration-200
                                                                               {{ $subAnswer && !($subAnswer['boolean'] ?? true)
                                                                                  ? 'border-red-500 bg-red-50 dark:bg-red-900/20 text-red-800 dark:text-red-300'
                                                                                  : 'border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600'
                                                                               }}"
                                                                        data-sub-id="{{ $subItem->id }}"
                                                                        data-value="false">
                                                                    <div class="flex items-center justify-center gap-2">
                                                                        <div class="w-6 h-6 rounded-full flex items-center justify-center
                                                                                    {{ $subAnswer && !($subAnswer['boolean'] ?? true)
                                                                                       ? 'bg-red-500'
                                                                                       : 'bg-gray-200 dark:bg-gray-700'
                                                                                    }}">
                                                                            @if($subAnswer && !($subAnswer['boolean'] ?? true))
                                                                                <i class="fas fa-times text-white text-xs"></i>
                                                                            @endif
                                                                        </div>
                                                                        <span>SALAH</span>
                                                                    </div>
                                                                </button>
                                                            </div>
                                                        @endif

                                                        {{-- Short Answer SubItem --}}
                                                        @if($subItem->type === 'short_answer')
                                                            <div class="relative">
                                                                <textarea name="compound_{{ $question->id }}_sub_{{ $subItem->id }}"
                                                                          class="compound-answer-input w-full p-4 rounded-xl border-2
                                                                                 bg-gray-50 dark:bg-gray-900
                                                                                 text-gray-800 dark:text-gray-100
                                                                                 border-cyan-300 dark:border-cyan-700
                                                                                 focus:border-primary focus:ring-2 focus:ring-cyan-500/20 focus:outline-none
                                                                                 transition-all duration-200"
                                                                          rows="3"
                                                                          data-sub-id="{{ $subItem->id }}"
                                                                          placeholder="Jawaban untuk {{ $subItem->label }}...">{{ $subAnswer['value'] ?? '' }}</textarea>
                                                                <div class="absolute bottom-3 right-3 text-xs text-gray-500 dark:text-gray-400">
                                                                    <span id="sub-char-count-{{ $subItem->id }}">0</span> karakter
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Question Navigation Hint --}}
                        <div class="text-center text-sm text-gray-500 dark:text-gray-400 mb-8">
                            <i class="fas fa-mouse-pointer mr-1"></i>
                            Gunakan tombol navigasi di bawah atau tombol pada sidebar untuk berpindah soal
                        </div>
                    </div>
                @endforeach
            </div>
        </main>
    </div>

    {{-- ================= BOTTOM NAVIGATION ================= --}}
    <footer class="sticky bottom-0 z-30 bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm border-t border-gray-200 dark:border-gray-700 shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">

                {{-- Left: Progress & Navigation --}}
                <div class="flex items-center justify-between md:justify-start gap-4">
                    {{-- Previous Button --}}
                    <button id="prevBtn"
                            class="px-5 py-2.5 rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700
                                   text-gray-700 dark:text-gray-300 font-medium
                                   border border-gray-300 dark:border-gray-600
                                   transition-all duration-200 flex items-center gap-2
                                   disabled:opacity-50 disabled:cursor-not-allowed">
                        <i class="fas fa-chevron-left"></i>
                        <span class="hidden sm:inline">Sebelumnya</span>
                    </button>

                    {{-- Progress Info --}}
                    <div class="hidden md:block text-sm">
                        <span class="font-medium text-gray-700 dark:text-gray-300">
                            Soal <span id="currentQuestion">1</span>/{{ $questions->count() }}
                        </span>
                        <div class="w-32 h-1.5 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-primary rounded-full transition-all duration-300"
                                 style="width: {{ (1/$questions->count())*100 }}%"></div>
                        </div>
                    </div>
                </div>

                {{-- Center: Mobile Progress --}}
                <div class="md:hidden text-center">
                    <div class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Soal <span id="currentQuestionMobile">1</span>/{{ $questions->count() }}
                    </div>
                </div>

                {{-- Right: Next & Submit --}}
                <div class="flex items-center justify-between md:justify-end gap-4">
                    {{-- Next Button --}}
                    <button id="nextBtn"
                            class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-primary to-secondary
                                   hover:from-primary/90 hover:to-secondary/90
                                   text-white font-medium
                                   shadow-md hover:shadow-lg
                                   transition-all duration-200 flex items-center gap-2">
                        <span class="hidden sm:inline">Selanjutnya</span>
                        <i class="fas fa-chevron-right"></i>
                    </button>

                    {{-- Submit Button --}}
                    <form id="auto-submit-form"
                          method="POST"
                          action="{{ route('exams.submit', $attempt->exam) }}"
                          class="sweet-confirm">
                        @csrf
                        <button type="button"
                                id="submitExamBtn"
                                class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-red-500 to-pink-600
                                       hover:from-red-600 hover:to-pink-700
                                       text-white font-medium
                                       shadow-md hover:shadow-lg
                                       transition-all duration-200 flex items-center gap-2">
                            <i class="fas fa-paper-plane"></i>
                            <span>Submit Ujian</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </footer>

    {{-- Image Modal --}}
    <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black/90 backdrop-blur-sm">
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="relative max-w-4xl max-h-[90vh]">
                <img id="modalImage" class="max-w-full max-h-[90vh] object-contain rounded-lg" src="" alt="">
                <button onclick="closeImageModal()"
                        class="absolute -top-12 right-0 text-white hover:text-gray-300 text-2xl">
                    <i class="fas fa-times"></i>
                </button>
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-white text-sm">
                    <i class="fas fa-expand-arrows-alt mr-2"></i>Scroll untuk zoom
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
    .option-btn:hover .option-label {
        transform: scale(1.05);
    }

    .option-btn.selected {
        animation: pulse 0.3s ease-in-out;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.02); }
        100% { transform: scale(1); }
    }

    .question-slide {
        animation: fadeIn 0.3s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Smooth transitions for sidebar */
    #sidebar {
        will-change: transform;
    }

    /* Custom scrollbar for question area */
    main::-webkit-scrollbar {
        width: 10px;
    }

    main::-webkit-scrollbar-track {
        background: transparent;
    }

    main::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #3b82f6, #1d4ed8);
        border-radius: 5px;
    }

    .dark main::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #60a5fa, #3b82f6);
    }
</style>
@endpush

@include('exams.js.attempt')
