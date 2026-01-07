@push('script')
<script>
/* =====================================================
   TIMER
===================================================== */
const timerEl = document.getElementById('timer');
let remaining = parseInt(timerEl.dataset.remaining, 10);

function formatTime(seconds) {
    const m = Math.floor(seconds / 60);
    const s = seconds % 60;
    return `${m}:${s.toString().padStart(2, '0')}`;
}

timerEl.innerText = formatTime(remaining);

const timerInterval = setInterval(() => {
    if (remaining <= 0) {
        clearInterval(timerInterval);
        document.getElementById('auto-submit-form')?.submit();
        return;
    }
    remaining--;
    timerEl.innerText = formatTime(remaining);
}, 1000);


/* =====================================================
   SIDEBAR
===================================================== */
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


/* =====================================================
   QUESTION NAV
===================================================== */
let currentIndex = 0;
const slides = document.querySelectorAll('.question-slide');
const navButtons = document.querySelectorAll('.nav-btn');

function setActiveNav(index) {
    navButtons.forEach(btn => {
        btn.classList.remove(
            'ring-2','ring-blue-500','bg-blue-700','scale-95','shadow-inner'
        );
    });

    navButtons[index].classList.add(
        'ring-2','ring-blue-500','bg-blue-700','scale-95','shadow-inner'
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


/* =====================================================
   SAVE ANSWER (CORE)
===================================================== */
async function saveAnswer(payload) {
    try {
        const response = await fetch("{{ route('exams.answer.save', $attempt->exam) }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        if (!response.ok) {
            const err = await response.json().catch(() => ({}));
            console.error('Save answer failed:', err);

            if (response.status === 403 && err.expired) {
                clearInterval(timerInterval);
                document.getElementById('auto-submit-form')?.submit();
            }
        }
    } catch (e) {
        console.error('Save answer error:', e);
    }
}

function markAnswered(slide) {
    const nav = document.querySelector(`.nav-btn[data-index="${slide.dataset.index}"]`);
    nav?.classList.remove('bg-red-600');
    nav?.classList.add('bg-green-600');
}


/* =====================================================
   MCQ / MCMA / TRUEFALSE
===================================================== */
document.querySelectorAll('.answer-input').forEach(input => {
    input.addEventListener('change', function () {
        const slide = this.closest('.question-slide');
        const questionId = slide.dataset.questionId;
        const questionType = slide.dataset.questionType;

        const selected = Array.from(
            slide.querySelectorAll('.answer-input:checked')
        ).map(i => parseInt(i.value));

        saveAnswer({
            question_id: questionId,
            answer_type: questionType,
            selected_options: selected
        });

        markAnswered(slide);
    });
});


/* =====================================================
   SHORT ANSWER
===================================================== */
document.querySelectorAll('.short-answer-input').forEach(textarea => {
    let timeout;

    textarea.addEventListener('input', function () {
        clearTimeout(timeout);

        timeout = setTimeout(() => {
            const slide = this.closest('.question-slide');
            const questionId = slide.dataset.questionId;
            const value = this.value.trim();

            if (!value) return;

            saveAnswer({
                question_id: questionId,
                answer_type: 'short_answer',
                short_answer_value: value
            });

            markAnswered(slide);
        }, 600);
    });
});


/* =====================================================
   COMPOUND
===================================================== */
function collectCompoundAnswers(slide) {
    const answers = [];

    slide.querySelectorAll('input[data-type="truefalse"].compound-answer-input:checked')
        .forEach(input => {
            answers.push({
                sub_id: parseInt(input.dataset.subId),
                type: 'truefalse',
                boolean: input.value === '1'
            });
        });

    slide.querySelectorAll('textarea[data-type="short_answer"].compound-answer-input')
        .forEach(textarea => {
            const value = textarea.value.trim();
            if (value) {
                answers.push({
                    sub_id: parseInt(textarea.dataset.subId),
                    type: 'short_answer',
                    value: value
                });
            }
        });

    return answers;
}

function handleCompoundChange(el) {
    const slide = el.closest('.question-slide');
    const questionId = slide.dataset.questionId;
    const answers = collectCompoundAnswers(slide);

    if (answers.length === 0) return;

    saveAnswer({
        question_id: questionId,
        answer_type: 'compound',
        compound_answers: answers
    });

    markAnswered(slide);
}

document.querySelectorAll('.compound-answer-input').forEach(el => {
    if (el.tagName === 'INPUT') {
        el.addEventListener('change', () => handleCompoundChange(el));
    } else {
        let timeout;
        el.addEventListener('input', () => {
            clearTimeout(timeout);
            timeout = setTimeout(() => handleCompoundChange(el), 600);
        });
    }
});


/* =====================================================
   INITIAL RENDER
===================================================== */
MathJax.typesetPromise();
</script>

<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
@endpush
