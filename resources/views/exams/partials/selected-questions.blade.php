{{-- ================= SOAL TERPILIH ================= --}}
<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 space-y-5">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                📋 Soal Ujian
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2.5 py-0.5 rounded-full">
                    {{ $questions->total() }}
                </span>
            </h2>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                Soal diurut mulai dari yang pertama ditambahkan
            </p>
        </div>

        {{-- RIGHT: ACTIONS --}}
        <div class="flex flex-wrap items-center gap-3">
            {{-- PER PAGE SELECT --}}
            <form method="GET" class="flex items-center gap-2 text-sm">
                <label class="text-gray-600 dark:text-gray-400">
                    Tampilkan
                </label>
                <select name="per_page" onchange="this.form.submit()" 
                        class="px-3 py-1.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition w-20">
                    @foreach ([10, 20, 30, 50, 100] as $size)
                        <option value="{{ $size }}" @selected(request('per_page', 10) == $size)>
                            {{ $size }}
                        </option>
                    @endforeach
                </select>
                <span class="text-gray-600 dark:text-gray-400">
                    soal / halaman
                </span>
            </form>

            {{-- ADD QUESTION --}}
            @if($exam->status === 'inactive')
                <button @click="openAddQuestion = true" 
                        class="px-5 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-xl transition shadow-lg shadow-purple-500/30 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Soal
                </button>
            @endif
        </div>
    </div>

    @if($exam->questions->isEmpty())
        <div class="text-center py-12">
            <span class="text-4xl mb-3 block">📭</span>
            <p class="text-gray-500 dark:text-gray-400">Belum ada soal dipilih</p>
            @if($exam->status === 'inactive')
                <button @click="openAddQuestion = true" 
                        class="mt-4 px-6 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-xl transition">
                    + Tambah Soal
                </button>
            @endif
        </div>
    @else

        {{-- ================= SORTABLE WRAPPER ================= --}}
        <div id="sortable-questions" class="space-y-4">
            @foreach ($questions as $i => $pq)
                @php $q = $pq->question; @endphp

                {{-- ================= ITEM ================= --}}
                <div data-id="{{ $pq->id }}" class="relative bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-xl p-5 hover:border-purple-500 transition-all duration-300">
                    
                    {{-- HEADER --}}
                    <div class="flex flex-wrap items-start justify-between gap-3 mb-4">
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-bold text-gray-400 dark:text-gray-500">
                                #{{ $questions->firstItem() + $i }}
                            </span>
                            <span class="text-xs font-medium px-3 py-1 rounded-full bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400">
                                {{ $typeLabels[$q->type] ?? strtoupper($q->type) }}
                            </span>
                            @if($q->type === 'compound')
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    ({{ $q->subItems->count() }} sub)
                                </span>
                            @endif
                        </div>

                        {{-- ACTIONS --}}
                        @if($exam->status === 'inactive')
                            <div class="flex flex-wrap items-center gap-2">
                                <form method="POST" action="{{ route('exams.questions.move', [$exam, $pq]) }}"
                                      class="flex items-center gap-2">
                                    @csrf
                                    <label class="text-xs text-gray-500 dark:text-gray-400">Pindah ke:</label>
                                    <input type="number" name="to_order" min="1" max="{{ $exam->questions()->count() }}"
                                           value="{{ $pq->order }}" 
                                           class="w-16 px-2 py-1 text-sm rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition">
                                    <button type="submit" 
                                            class="px-3 py-1 text-xs font-medium text-white bg-purple-600 rounded-xl hover:bg-purple-700 transition">
                                        OK
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('ajax.exams.questions.detach', $exam) }}" 
                                      class="sweet-confirm"
                                      data-message="Yakin ingin menghapus soal ini?">
                                    @csrf
                                    <input type="hidden" name="question_id" value="{{ $q->id }}">
                                    <button type="submit" 
                                            class="text-xs font-medium text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    {{-- GAMBAR SOAL --}}
                    @if ($q->image)
                        <div class="mb-4">
                            <img src="{{ Storage::url($q->image) }}" alt="Gambar Soal" 
                                 class="max-h-[250px] mx-auto rounded-xl border border-gray-200 dark:border-gray-700 object-contain bg-white dark:bg-gray-800 p-2">
                        </div>
                    @endif

                    {{-- TEKS SOAL --}}
                    <div class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200 text-sm mb-4">
                        {!! $q->question_text !!}
                    </div>

                    {{-- OPTIONS FOR MCQ/MCMA/TrueFalse --}}
                    @if (in_array($q->type, ['mcq', 'mcma', 'truefalse']))
                        <div class="space-y-2">
                            @foreach ($q->options as $opt)
                                <div class="rounded-xl px-4 py-2.5 flex items-start gap-3 border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                                    @if ($q->type !== 'truefalse')
                                        <span class="font-semibold text-sm text-gray-600 dark:text-gray-400">
                                            {{ $opt->label }}.
                                        </span>
                                    @endif
                                    <div class="flex-1 text-sm text-gray-800 dark:text-gray-200">
                                        {!! $opt->option_text !!}
                                    </div>
                                    @if ($opt->is_correct)
                                        <span class="text-green-500 font-bold text-sm flex-shrink-0">✓</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- SHORT ANSWER PREVIEW --}}
                    @if ($q->type === 'short_answer')
                        <div class="rounded-xl bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 p-4">
                            <h4 class="text-sm font-semibold text-blue-800 dark:text-blue-300 mb-2">Isian Singkat:</h4>
                            @php $correctOptions = $q->options->where('is_correct', true); @endphp
                            @if($correctOptions->count() > 0)
                                @php $primaryAnswer = $correctOptions->first(); @endphp
                                <p class="text-sm text-gray-800 dark:text-gray-200">
                                    Jawaban utama: <span class="font-medium text-green-600 dark:text-green-400">{{ $primaryAnswer->option_text }}</span>
                                </p>
                                @if($correctOptions->count() > 1)
                                    <div class="mt-2">
                                        <p class="text-xs text-gray-600 dark:text-gray-400">Semua kemungkinan:</p>
                                        <div class="flex flex-wrap gap-2 mt-1">
                                            @foreach($correctOptions as $option)
                                                <span class="px-2 py-1 text-xs bg-gray-100 dark:bg-gray-700 rounded">{{ $option->option_text }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @else
                                <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada jawaban</p>
                            @endif
                        </div>
                    @endif

                    {{-- COMPOUND QUESTION PREVIEW --}}
                    @if ($q->type === 'compound')
                        <div class="rounded-xl bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800 p-4">
                            <h4 class="text-sm font-semibold text-purple-800 dark:text-purple-300 mb-3">
                                Sub Pertanyaan ({{ $q->subItems->count() }}):
                            </h4>
                            <div class="space-y-3">
                                @foreach($q->subItems->sortBy('order') as $subItem)
                                    <div class="rounded-lg p-3 bg-white/50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700">
                                        <div class="flex items-start justify-between mb-1">
                                            <span class="text-sm font-medium text-gray-800 dark:text-gray-200">
                                                {{ $subItem->label }}. {{ $subItem->prompt }}
                                            </span>
                                            <span class="text-xs px-2 py-0.5 rounded bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
                                                {{ $subItem->type === 'truefalse' ? 'Benar/Salah' : 'Isian Singkat' }}
                                            </span>
                                        </div>
                                        @if($subItem->type === 'truefalse')
                                            @php $correctAnswer = $subItem->answers->first(); @endphp
                                            @if($correctAnswer)
                                                <div class="text-sm">
                                                    Jawaban: <span class="font-semibold {{ $correctAnswer->boolean_answer ? 'text-green-600' : 'text-red-600' }}">
                                                        {{ $correctAnswer->boolean_answer ? 'BENAR' : 'SALAH' }}
                                                    </span>
                                                </div>
                                            @endif
                                        @elseif($subItem->type === 'short_answer')
                                            @php $primaryAnswer = $subItem->answers->where('is_primary', true)->first(); @endphp
                                            @if($primaryAnswer)
                                                <div class="text-sm">
                                                    Jawaban: <span class="font-semibold text-green-600">{{ $primaryAnswer->answer_text }}</span>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-3 italic">
                                Catatan: Jika satu sub salah, seluruh soal dianggap salah.
                            </p>
                        </div>
                    @endif

                </div>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
            {{ $questions->links() }}
        </div>
    @endif
</div>