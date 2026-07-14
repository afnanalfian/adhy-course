@extends('layouts.app')

@section('content')

{{-- Tombol Kembali --}}
<div class="mb-4">
    <a href="{{ route('bank.category.materials.index', $material->category) }}" 
       class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Daftar Materi
    </a>
</div>

{{-- HEADER --}}
<div class="relative mb-8 overflow-hidden rounded-2xl bg-gradient-to-r from-purple-600 via-blue-600 to-pink-600 p-6 md:p-8">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute -top-20 -right-20 w-64 h-64 bg-white rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-white rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-white">
                📝 {{ $material->name }}
            </h1>
            <p class="text-white/80 text-sm mt-1">
                Total Soal: {{ $questions->total() }}
            </p>
        </div>

        @role('admin|tentor')
        <a href="{{ route('bank.material.questions.create', $material) }}"
           class="px-5 py-2.5 bg-white text-purple-600 font-medium rounded-xl hover:bg-white/90 hover:shadow-lg hover:shadow-white/20 transition-all duration-300 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Soal
        </a>
        @endrole
    </div>
</div>

{{-- FILTERS --}}
<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-5 mb-6">
    <form method="GET" class="flex flex-wrap items-end gap-3">
        {{-- Test Type --}}
        <div>
            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tipe Tes</label>
            <select name="test_type" class="px-3 py-2 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white text-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition">
                <option value="">Semua Tes</option>
                <option value="general" {{ request('test_type') === 'general' ? 'selected' : '' }}>No Type</option>
                <option value="tiu" {{ request('test_type') === 'tiu' ? 'selected' : '' }}>TIU</option>
                <option value="twk" {{ request('test_type') === 'twk' ? 'selected' : '' }}>TWK</option>
                <option value="tkp" {{ request('test_type') === 'tkp' ? 'selected' : '' }}>TKP</option>
                <option value="tpa" {{ request('test_type') === 'tpa' ? 'selected' : '' }}>TPA</option>
                <option value="tbi" {{ request('test_type') === 'tbi' ? 'selected' : '' }}>TBI</option>
                <option value="mtk_stis" {{ request('test_type') === 'mtk_stis' ? 'selected' : '' }}>Matematika STIS</option>
                <option value="mtk_tka" {{ request('test_type') === 'mtk_tka' ? 'selected' : '' }}>Matematika TKA</option>
            </select>
        </div>

        {{-- Tipe Soal --}}
        <div>
            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tipe Soal</label>
            <select name="type" class="px-3 py-2 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white text-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition">
                <option value="">Semua Tipe</option>
                <option value="mcq" {{ request('type') === 'mcq' ? 'selected' : '' }}>Pilihan Ganda (1 Benar)</option>
                <option value="mcma" {{ request('type') === 'mcma' ? 'selected' : '' }}>Pilihan Ganda (Banyak Benar)</option>
                <option value="truefalse" {{ request('type') === 'truefalse' ? 'selected' : '' }}>Benar / Salah</option>
                <option value="short_answer" {{ request('type') === 'short_answer' ? 'selected' : '' }}>Isian Singkat</option>
                <option value="compound" {{ request('type') === 'compound' ? 'selected' : '' }}>Soal Kompleks</option>
            </select>
        </div>

        {{-- Search --}}
        <div class="flex-1 min-w-[150px]">
            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Cari</label>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari soal..."
                   class="w-full px-3 py-2 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white text-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition">
        </div>

        {{-- Per Page --}}
        <div>
            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tampilkan</label>
            <select name="per_page" onchange="this.form.submit()"
                    class="px-3 py-2 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white text-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition">
                @foreach([10,20,50,100] as $size)
                    <option value="{{ $size }}" {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                        {{ $size }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Actions --}}
        <div class="flex gap-2">
            <button type="submit" class="px-5 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-xl transition">
                Filter
            </button>
            <a href="{{ route('bank.material.questions.index', $material) }}"
               class="px-5 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-xl transition">
                Reset
            </a>
        </div>
    </form>
</div>

{{-- QUESTION LIST --}}
<div class="space-y-4">
    @forelse ($questions as $index => $q)
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-5 hover:border-purple-500 hover:shadow-lg transition-all duration-300">
            
            {{-- HEADER --}}
            <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
                <div class="flex items-center gap-3">
                    <span class="text-sm font-bold text-gray-400 dark:text-gray-500">
                        #{{ ($questions->currentPage() - 1) * $questions->perPage() + ($index + 1) }}
                    </span>
                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400">
                        {{ \App\Models\Question::TYPES[$q->type] ?? strtoupper($q->type) }}
                    </span>
                    @if($q->type === 'compound')
                        <span class="text-xs text-gray-500 dark:text-gray-400">
                            ({{ $q->subItems->count() }} sub)
                        </span>
                    @endif
                    <span class="text-xs px-2 py-1 rounded-lg bg-gray-100 dark:bg-white/10 text-gray-600 dark:text-gray-300">
                        Dipakai {{ $q->exam_questions_count }}x
                    </span>
                </div>
            </div>

            {{-- QUESTION IMAGE --}}
            @if ($q->image)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $q->image) }}" alt="Gambar Soal" 
                         class="max-h-[200px] mx-auto rounded-xl border border-gray-200 dark:border-gray-700 object-contain bg-gray-50 dark:bg-gray-900 p-2">
                </div>
            @endif

            {{-- QUESTION TEXT --}}
            <div class="prose dark:prose-invert max-w-none leading-relaxed mb-4 text-gray-800 dark:text-gray-100">
                {!! $q->question_text !!}
            </div>

            {{-- OPTIONS (TKP) --}}
            @if ($q->test_type === 'tkp')
                @php
                    $maxWeight = $q->options->max('weight');
                @endphp
                <div class="space-y-2 mb-4">
                    @foreach ($q->options as $opt)
                        @php $isBest = $opt->weight === $maxWeight; @endphp
                        <div class="rounded-xl px-4 py-2.5 flex items-center justify-between gap-3 border
                                    {{ $isBest ? 'bg-green-50 border-green-300 dark:bg-green-900/20 dark:border-green-700' : 'border-gray-200 dark:border-gray-700' }}">
                            <div class="flex-1 text-gray-800 dark:text-gray-100">
                                <div class="flex items-start gap-2">
                                    <span class="font-semibold">{{ $opt->label }}.</span>
                                    <div class="prose dark:prose-invert max-w-none">{!! $opt->option_text !!}</div>
                                </div>
                            </div>
                            <div class="text-right min-w-[60px]">
                                <div class="text-lg font-bold {{ $isBest ? 'text-green-600 dark:text-green-400' : 'text-gray-500' }}">
                                    {{ $opt->weight }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- OPTIONS (MCQ & MCMA) --}}
            @if (in_array($q->type, ['mcq', 'mcma']) && $q->test_type !== 'tkp')
                <div class="space-y-2 mb-4">
                    @foreach ($q->options as $opt)
                        <div class="rounded-xl px-4 py-2.5 flex items-start gap-3 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <span class="font-semibold text-sm text-gray-600 dark:text-gray-400">{{ $opt->label }}.</span>
                            <div class="flex-1 text-sm text-gray-800 dark:text-gray-200">
                                <div class="prose dark:prose-invert max-w-none">{!! $opt->option_text !!}</div>
                                @if ($opt->image)
                                    <img src="{{ asset('storage/' . $opt->image) }}" alt="Gambar Opsi" 
                                         class="max-h-[150px] rounded-lg object-contain mt-2">
                                @endif
                            </div>
                            @if ($opt->is_correct)
                                <span class="text-green-500 font-bold text-sm flex-shrink-0">✔</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- TRUE / FALSE --}}
            @if ($q->type === 'truefalse')
                <div class="space-y-2 mb-4">
                    @foreach ($q->options as $opt)
                        <div class="rounded-xl px-4 py-2.5 flex items-center justify-between border border-gray-200 dark:border-gray-700">
                            <div class="text-sm text-gray-800 dark:text-gray-200">
                                <div class="prose dark:prose-invert max-w-none">{!! $opt->option_text !!}</div>
                            </div>
                            @if ($opt->is_correct)
                                <span class="text-green-500 font-bold text-sm flex-shrink-0">✔ Benar</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- SHORT ANSWER --}}
            @if ($q->type === 'short_answer')
                <div class="rounded-xl bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-700 p-4 mb-4">
                    <h3 class="font-semibold text-blue-800 dark:text-blue-300 mb-2 text-sm">Jawaban Isian Singkat:</h3>
                    @php
                        $correctOptions = $q->options->where('is_correct', true);
                        $primaryAnswer = $correctOptions->first();
                    @endphp
                    @if($primaryAnswer)
                        <p class="text-gray-800 dark:text-gray-100 font-medium text-sm">
                            Jawaban utama: <span class="text-green-600 dark:text-green-400">{{ $primaryAnswer->option_text }}</span>
                        </p>
                        @if($correctOptions->count() > 1)
                            <div class="mt-2">
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Semua kemungkinan jawaban:</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($correctOptions as $answer)
                                        <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded text-sm text-gray-800 dark:text-gray-200">
                                            {{ $answer->option_text }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada jawaban</p>
                    @endif
                </div>
            @endif

            {{-- COMPOUND --}}
            @if ($q->type === 'compound')
                <div class="rounded-xl bg-purple-50 dark:bg-purple-900/30 border border-purple-200 dark:border-purple-700 p-4 mb-4">
                    <h3 class="font-semibold text-purple-800 dark:text-purple-300 mb-3 text-sm">
                        Sub Pertanyaan ({{ $q->subItems->count() }}):
                    </h3>
                    <div class="space-y-3">
                        @foreach($q->subItems->sortBy('order') as $subItem)
                            <div class="border rounded-lg p-3 bg-white/50 dark:bg-gray-800/50">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="font-medium text-gray-800 dark:text-gray-100 text-sm">
                                        <span class="text-gray-500 dark:text-gray-400">{{ $subItem->label }}.</span>
                                        <span class="ml-1">{{ $subItem->prompt }}</span>
                                    </div>
                                    <span class="text-xs px-2 py-1 rounded bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                                        {{ $subItem->type === 'truefalse' ? 'Benar/Salah' : 'Isian Singkat' }}
                                    </span>
                                </div>

                                @if($subItem->type === 'truefalse')
                                    @php $correctAnswer = $subItem->answers->first(); @endphp
                                    @if($correctAnswer)
                                        <div class="text-sm text-gray-800 dark:text-gray-200">
                                            Jawaban:
                                            <span class="font-semibold {{ $correctAnswer->boolean_answer ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $correctAnswer->boolean_answer ? 'BENAR' : 'SALAH' }}
                                            </span>
                                        </div>
                                    @endif
                                @elseif($subItem->type === 'short_answer')
                                    @php
                                        $primaryAnswer = $subItem->answers->where('is_primary', true)->first();
                                        $allAnswers = $subItem->answers;
                                    @endphp
                                    <div class="mt-1">
                                        @if($primaryAnswer)
                                            <p class="text-sm text-gray-800 dark:text-gray-200">
                                                Jawaban utama: <span class="font-medium text-green-600 dark:text-green-400">{{ $primaryAnswer->answer_text }}</span>
                                            </p>
                                        @endif
                                        @if($allAnswers->count() > 1)
                                            <div class="mt-1">
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Semua kemungkinan:</p>
                                                <div class="flex flex-wrap gap-1 mt-1">
                                                    @foreach($allAnswers as $answer)
                                                        <span class="px-2 py-0.5 text-xs bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded">
                                                            {{ $answer->answer_text }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-3 italic">
                        Catatan: Jika satu sub salah, seluruh soal dianggap salah.
                    </p>
                </div>
            @endif

            {{-- TOGGLE PEMBAHASAN --}}
            <div x-data="{ open: false }" class="mt-4">
                <button @click="open = !open" 
                        class="px-4 py-2 rounded-lg bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400 hover:bg-purple-200 dark:hover:bg-purple-900/50 transition text-sm font-medium">
                    <span x-show="!open">📖 Lihat Pembahasan</span>
                    <span x-show="open">📕 Tutup Pembahasan</span>
                </button>

                <div x-show="open" x-collapse class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                    @if($q->type === 'short_answer')
                        <div class="mb-4">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2 text-sm">Jawaban Isian Singkat:</h3>
                            @php
                                $correctOptions = $q->options->where('is_correct', true);
                                $primaryAnswer = $correctOptions->first();
                            @endphp
                            @if($primaryAnswer)
                                <div class="bg-green-50 dark:bg-green-900/30 p-3 rounded-lg border border-green-200 dark:border-green-700">
                                    <p class="text-gray-800 dark:text-gray-100 font-medium">{{ $primaryAnswer->option_text }}</p>
                                    @if($correctOptions->count() > 1)
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                            <em>Jawaban lain juga diterima (case-insensitive, spasi diabaikan)</em>
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @elseif($q->type === 'compound')
                        <div class="mb-4">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2 text-sm">Jawaban Sub Pertanyaan:</h3>
                            <div class="space-y-3">
                                @foreach($q->subItems->sortBy('order') as $subItem)
                                    <div class="border rounded-lg p-3 bg-gray-50 dark:bg-gray-900/50">
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="font-medium text-gray-800 dark:text-gray-200 text-sm">{{ $subItem->label }}. {{ $subItem->prompt }}</span>
                                        </div>
                                        @if($subItem->type === 'truefalse')
                                            @php $correctAnswer = $subItem->answers->first(); @endphp
                                            @if($correctAnswer)
                                                <div class="text-sm {{ $correctAnswer->boolean_answer ? 'text-green-600' : 'text-red-600' }}">
                                                    Jawaban: <span class="font-semibold">{{ $correctAnswer->boolean_answer ? 'BENAR' : 'SALAH' }}</span>
                                                </div>
                                            @endif
                                        @elseif($subItem->type === 'short_answer')
                                            @php $primaryAnswer = $subItem->answers->where('is_primary', true)->first(); @endphp
                                            @if($primaryAnswer)
                                                <div class="text-sm">
                                                    Jawaban: <span class="font-semibold text-green-600">{{ $primaryAnswer->answer_text }}</span>
                                                    @if($subItem->answers->count() > 1)
                                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                            <em>Jawaban lain juga diterima</em>
                                                        </p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2 text-sm">Jawaban benar:</h3>
                        <ul class="list-disc ml-6 text-gray-800 dark:text-gray-200 mb-4 space-y-1">
                            @foreach ($q->options->where('is_correct', true) as $opt)
                                <li>{!! $opt->option_text !!}</li>
                            @endforeach
                        </ul>
                    @endif

                    @if($q->explanation)
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2 text-sm">Pembahasan:</h3>
                        <div class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200 text-sm">
                            {!! $q->explanation !!}
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400 italic text-sm">Belum ada pembahasan</p>
                    @endif
                </div>
            </div>

            {{-- ACTION BUTTONS --}}
            @role('admin|tentor')
            <div class="flex gap-2 mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('bank.question.edit', $q) }}" 
                   class="px-4 py-1.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                    Edit
                </a>
                <form method="POST" action="{{ route('bank.question.delete', $q) }}" 
                      class="sweet-confirm"
                      data-message="Yakin ingin menghapus soal ini? Tindakan ini tidak dapat dibatalkan.">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-1.5 text-sm font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 rounded-xl hover:bg-red-100 dark:hover:bg-red-900/30 transition">
                        Hapus
                    </button>
                </form>
            </div>
            @endrole
        </div>
    @empty
        <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700">
            <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Belum Ada Soal</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Klik "Tambah Soal" untuk memulai</p>
            @role('admin|tentor')
            <a href="{{ route('bank.material.questions.create', $material) }}" 
               class="inline-block mt-4 px-6 py-2.5 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition">
                + Tambah Soal
            </a>
            @endrole
        </div>
    @endforelse
</div>

{{-- PAGINATION --}}
@if($questions->hasPages())
    <div class="mt-6">
        {{ $questions->links() }}
    </div>
@endif

@endsection

@include('bank.questions.js.index')