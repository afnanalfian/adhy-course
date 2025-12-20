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
                        $answered = $attempt->answers
                            ->where('question_id', $question->id)
                            ->isNotEmpty();
                    @endphp

                    <button
                        type="button"
                        class="nav-btn
                               w-full py-2 rounded text-sm font-semibold text-white
                               {{ $answered ? 'bg-green-600' : 'bg-red-600' }}"
                        data-index="{{ $i }}">
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
                    $selected = $answer?->selected_options ?? [];
                @endphp

                <div
                    class="question-slide {{ $i === 0 ? '' : 'hidden' }}"
                    data-index="{{ $i }}"
                    data-question-id="{{ $question->id }}">

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

                    {{-- OPSI --}}
                    <div class="space-y-4">
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
                                        @checked(in_array($option->id, $selected))
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

@push('script')
<script>
/* ================= TIMER ================= */
const timerEl = document.getElementById('timer');
let remaining = parseInt(timerEl.dataset.remaining, 10);

function formatTime(seconds) {
    const m = Math.floor(seconds / 60);
    const s = seconds % 60;
    return `${m}:${s.toString().padStart(2, '0')}`;
}

timerEl.innerText = formatTime(remaining);

setInterval(() => {
    if (remaining <= 0) {
        document.getElementById('auto-submit-form')?.submit();
        return;
    }
    remaining--;
    timerEl.innerText = formatTime(remaining);
}, 1000);

/* ================= SIDEBAR TOGGLE ================= */
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('sidebarOverlay');
const toggleBtn = document.getElementById('toggleSidebar');

toggleBtn?.addEventListener('click', () => {
    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
});

overlay?.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
});

/* ================= QUESTION NAV ================= */
let currentIndex = 0;
const slides = document.querySelectorAll('.question-slide');
const navButtons = document.querySelectorAll('.nav-btn');

function setActiveNav(index) {
    navButtons.forEach(btn => {
        btn.classList.remove(
            'ring-2',
            'ring-blue-500',
            'bg-blue-700',
            'scale-95',
            'shadow-inner'
        );
    });

    navButtons[index].classList.add(
        'ring-2',
        'ring-blue-500',
        'bg-blue-700',
        'scale-95',
        'shadow-inner'
    );
}

setActiveNav(0);

function showQuestion(index) {
    slides.forEach(s => s.classList.add('hidden'));
    slides[index].classList.remove('hidden');
    currentIndex = index;

    setActiveNav(index);

    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
}

navButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        showQuestion(parseInt(btn.dataset.index));
    });
});

document.getElementById('prevBtn').onclick = () => {
    if (currentIndex > 0) showQuestion(currentIndex - 1);
};

document.getElementById('nextBtn').onclick = () => {
    if (currentIndex < slides.length - 1) showQuestion(currentIndex + 1);
};

/* ================= SAVE ANSWER ================= */
document.querySelectorAll('.answer-input').forEach(input => {
    input.addEventListener('change', () => {
        const slide = input.closest('.question-slide');
        const questionId = slide.dataset.questionId;

        const checked = slide.querySelectorAll('.answer-input:checked');
        let selected = [];
        checked.forEach(i => selected.push(i.value));

        fetch("{{ route('exams.answer.save', $attempt->exam) }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                question_id: questionId,
                selected_options: selected
            })
        });

        const nav = document.querySelector(
            `.nav-btn[data-index="${slide.dataset.index}"]`
        );
        nav.classList.remove('bg-red-600');
        nav.classList.add('bg-green-600');
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
@endpush
