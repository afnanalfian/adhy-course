@push('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    /* =====================================================
       GLOBAL VARIABLES
    ===================================================== */
    const questions = document.querySelectorAll('.question-slide');
    const navButtons = document.querySelectorAll('.nav-btn');
    let currentIndex = 0;
    let answeredQuestions = new Set();

    /* =====================================================
       TIMER (Dual: Desktop + Mobile)
    ===================================================== */
    const timerEl = document.getElementById('timer');
    const mobileTimerEl = document.getElementById('mobile-timer');
    let remaining = parseInt(timerEl.dataset.remaining, 10);

    function formatTime(seconds) {
        const h = Math.floor(seconds / 3600);
        const m = Math.floor((seconds % 3600) / 60);
        const s = seconds % 60;
        if (h > 0) {
            return `${h}:${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
        }
        return `${m}:${s.toString().padStart(2, '0')}`;
    }

    function updateTimers() {
        const formatted = formatTime(remaining);
        timerEl.textContent = formatted;
        if (mobileTimerEl) {
            mobileTimerEl.textContent = formatted;
        }
    }

    updateTimers();

    const timerInterval = setInterval(() => {
        if (remaining <= 0) {
            clearInterval(timerInterval);
            document.getElementById('auto-submit-form')?.submit();
            return;
        }
        remaining--;
        updateTimers();

        // Change color when less than 5 minutes
        if (remaining <= 300) {
            timerEl.classList.add('text-red-300');
            if (mobileTimerEl) {
                mobileTimerEl.classList.add('text-red-300');
            }
        }
    }, 1000);

    /* =====================================================
       SIDEBAR FUNCTIONS
    ===================================================== */
    function showSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function hideSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.style.overflow = '';
    }

    document.getElementById('toggleSidebar')?.addEventListener('click', showSidebar);
    document.getElementById('sidebarOverlay')?.addEventListener('click', hideSidebar);

    /* =====================================================
       QUESTION NAVIGATION
    ===================================================== */
    function updateProgress() {
        const progress = (answeredQuestions.size / questions.length) * 100;
        const progressBar = document.getElementById('progress-bar');
        const progressCount = document.getElementById('progress-count');

        progressBar.style.width = `${progress}%`;
        progressCount.textContent = `${answeredQuestions.size}/${questions.length}`;
    }

    function setActiveNav(index) {
        navButtons.forEach((btn, i) => {
            btn.classList.remove('ring-2', 'ring-azwara-medium', 'scale-105', 'shadow-md');
            if (i === index) {
                btn.classList.add('ring-2', 'ring-azwara-medium', 'scale-105', 'shadow-md');
            }
        });
    }

    function showQuestion(index) {
        if (index < 0 || index >= questions.length) return;

        questions.forEach(slide => slide.classList.add('hidden'));
        questions[index].classList.remove('hidden');
        currentIndex = index;

        setActiveNav(index);
        document.getElementById('current-question-num').textContent = index + 1;

        // Update button states
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        if (prevBtn) prevBtn.disabled = index === 0;
        if (nextBtn) nextBtn.disabled = index === questions.length - 1;

        hideSidebar();

        // Scroll to top of question
        window.scrollTo({ top: 0, behavior: 'smooth' });

        // Update MathJax if needed
        if (window.MathJax) {
            MathJax.typesetPromise();
        }
    }

    navButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            showQuestion(parseInt(btn.dataset.index));
        });
    });

    document.getElementById('prevBtn').addEventListener('click', () => {
        if (currentIndex > 0) showQuestion(currentIndex - 1);
    });

    document.getElementById('nextBtn').addEventListener('click', () => {
        if (currentIndex < questions.length - 1) showQuestion(currentIndex + 1);
    });

    /* =====================================================
       UPDATE OPTION STYLE WHEN SELECTED
    ===================================================== */
    function updateOptionStyle(input) {
        const label = input.closest('.option-item').querySelector('label');
        const optionText = label.querySelector('.option-text-wrapper');

        if (input.checked) {
            label.classList.add('border-azwara-medium', 'bg-azwara-medium/10', 'dark:bg-azwara-medium/20', 'shadow-md');
            label.classList.remove('border-azwara-lighter', 'dark:border-gray-700', 'bg-white', 'dark:bg-gray-800');

            // Update label badge color
            const badge = label.querySelector('span.inline-flex');
            if (badge) {
                badge.classList.add('bg-azwara-medium', 'text-white');
                badge.classList.remove('bg-azwara-lighter', 'dark:bg-gray-700', 'text-azwara-medium', 'dark:text-gray-300');
            }
        } else {
            label.classList.remove('border-azwara-medium', 'bg-azwara-medium/10', 'dark:bg-azwara-medium/20', 'shadow-md');
            label.classList.add('border-azwara-lighter', 'dark:border-gray-700', 'bg-white', 'dark:bg-gray-800');

            // Update label badge color
            const badge = label.querySelector('span.inline-flex');
            if (badge) {
                badge.classList.remove('bg-azwara-medium', 'text-white');
                badge.classList.add('bg-azwara-lighter', 'dark:bg-gray-700', 'text-azwara-medium', 'dark:text-gray-300');
            }
        }
    }

    function updateShortAnswerStyle(textarea) {
        const container = textarea.closest('.answer-section > div');
        const hasValue = textarea.value.trim().length > 0;

        if (hasValue) {
            container.classList.add('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/10');
            container.classList.remove('border-azwara-lighter', 'dark:border-gray-700', 'bg-white', 'dark:bg-gray-800');

            // Update icon
            const iconContainer = container.querySelector('.flex.h-8.w-8');
            if (iconContainer) {
                iconContainer.classList.add('bg-blue-500', 'text-white');
                iconContainer.classList.remove('bg-blue-100', 'dark:bg-blue-900/30', 'text-blue-600', 'dark:text-blue-400');
            }
        } else {
            container.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/10');
            container.classList.add('border-azwara-lighter', 'dark:border-gray-700', 'bg-white', 'dark:bg-gray-800');

            // Update icon
            const iconContainer = container.querySelector('.flex.h-8.w-8');
            if (iconContainer) {
                iconContainer.classList.remove('bg-blue-500', 'text-white');
                iconContainer.classList.add('bg-blue-100', 'dark:bg-blue-900/30', 'text-blue-600', 'dark:text-blue-400');
            }
        }
    }

    function updateCompoundStyle(slide) {
        const container = slide.querySelector('.answer-section > div');
        const hasAnyAnswer = Array.from(slide.querySelectorAll('.compound-answer-input')).some(input => {
            if (input.type === 'radio') return input.checked;
            if (input.type === 'textarea') return input.value.trim().length > 0;
            return false;
        });

        if (hasAnyAnswer) {
            container.classList.add('border-purple-500', 'bg-purple-50', 'dark:bg-purple-900/10');
            container.classList.remove('border-azwara-lighter', 'dark:border-gray-700', 'bg-white', 'dark:bg-gray-800');

            // Update main icon
            const mainIcon = container.querySelector('.flex.h-8.w-8');
            if (mainIcon) {
                mainIcon.classList.add('bg-purple-500', 'text-white');
                mainIcon.classList.remove('bg-purple-100', 'dark:bg-purple-900/30', 'text-purple-600', 'dark:text-purple-400');
            }
        } else {
            container.classList.remove('border-purple-500', 'bg-purple-50', 'dark:bg-purple-900/10');
            container.classList.add('border-azwara-lighter', 'dark:border-gray-700', 'bg-white', 'dark:bg-gray-800');

            // Update main icon
            const mainIcon = container.querySelector('.flex.h-8.w-8');
            if (mainIcon) {
                mainIcon.classList.remove('bg-purple-500', 'text-white');
                mainIcon.classList.add('bg-purple-100', 'dark:bg-purple-900/30', 'text-purple-600', 'dark:text-purple-400');
            }
        }

        // Update sub-item styles
        slide.querySelectorAll('.compound-answer-input').forEach(input => {
            if (input.type === 'radio') {
                const label = input.nextElementSibling;
                const isChecked = input.checked;

                if (input.value === '1') { // True
                    label.classList.toggle('border-green-500', isChecked);
                    label.classList.toggle('bg-green-500/10', isChecked);
                    label.classList.toggle('dark:bg-green-500/20', isChecked);
                    label.classList.toggle('shadow-sm', isChecked);
                    label.classList.toggle('border-green-200', !isChecked);
                    label.classList.toggle('dark:border-green-900/30', !isChecked);
                    label.classList.toggle('bg-green-50', !isChecked);
                    label.classList.toggle('dark:bg-green-900/10', !isChecked);
                } else { // False
                    label.classList.toggle('border-red-500', isChecked);
                    label.classList.toggle('bg-red-500/10', isChecked);
                    label.classList.toggle('dark:bg-red-500/20', isChecked);
                    label.classList.toggle('shadow-sm', isChecked);
                    label.classList.toggle('border-red-200', !isChecked);
                    label.classList.toggle('dark:border-red-900/30', !isChecked);
                    label.classList.toggle('bg-red-50', !isChecked);
                    label.classList.toggle('dark:bg-red-900/10', !isChecked);
                }
            } else if (input.tagName === 'TEXTAREA') {
                const hasText = input.value.trim().length > 0;
                input.classList.toggle('border-azwara-medium', hasText);
                input.classList.toggle('bg-azwara-medium/5', hasText);
                input.classList.toggle('dark:bg-azwara-medium/10', hasText);
                input.classList.toggle('border-azwara-lighter', !hasText);
                input.classList.toggle('dark:border-gray-600', !hasText);
                input.classList.toggle('bg-white', !hasText);
                input.classList.toggle('dark:bg-secondary/50', !hasText);
            }
        });
    }

    /* =====================================================
       KEYBOARD SHORTCUTS
    ===================================================== */
    document.addEventListener('keydown', (e) => {
        // Alt + Arrow keys for navigation
        if (e.altKey) {
            if (e.key === 'ArrowLeft' && currentIndex > 0) {
                e.preventDefault();
                showQuestion(currentIndex - 1);
            } else if (e.key === 'ArrowRight' && currentIndex < questions.length - 1) {
                e.preventDefault();
                showQuestion(currentIndex + 1);
            }
        }

        // Ctrl + Enter to submit
        if (e.ctrlKey && e.key === 'Enter') {
            e.preventDefault();
            const submitBtn = document.querySelector('#auto-submit-form button[type="submit"]');
            submitBtn?.click();
        }

        // Number keys for navigation (1-9)
        if (e.key >= '1' && e.key <= '9' && !e.altKey && !e.ctrlKey) {
            const num = parseInt(e.key) - 1;
            if (num < questions.length) {
                e.preventDefault();
                showQuestion(num);
            }
        }
    });

    /* =====================================================
       SAVE ANSWER FUNCTION
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
            } else {
                console.log('Answer saved successfully');
            }
        } catch (e) {
            console.error('Save answer error:', e);
        }
    }

    function markQuestionAnswered(questionId) {
        answeredQuestions.add(questionId);

        const slide = document.querySelector(`.question-slide[data-question-id="${questionId}"]`);
        const index = parseInt(slide.dataset.index);
        const navBtn = navButtons[index];

        // Update navigation button
        navBtn.classList.remove('bg-azwara-lighter', 'dark:bg-gray-700', 'text-azwara-medium', 'dark:text-gray-300');
        navBtn.classList.add('bg-green-500', 'text-white');

        // Add checkmark
        if (!navBtn.querySelector('.checkmark')) {
            const checkmark = document.createElement('div');
            checkmark.className = 'checkmark absolute -top-1 -right-1 h-3 w-3 rounded-full bg-white flex items-center justify-center';
            checkmark.innerHTML = `
                <svg class="h-2 w-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            `;
            navBtn.appendChild(checkmark);
        }

        updateProgress();
    }

    /* =====================================================
       ANSWER HANDLERS
    ===================================================== */
    function initAnswerHandlers() {
        // MCQ / MCMA / TrueFalse
        document.querySelectorAll('.option-item input[type="radio"], .option-item input[type="checkbox"]').forEach(input => {
            // Set initial style
            updateOptionStyle(input);

            input.addEventListener('change', function() {
                const slide = this.closest('.question-slide');
                const questionId = slide.dataset.questionId;
                const questionType = slide.dataset.questionType;

                // Update visual style
                updateOptionStyle(this);

                const selected = Array.from(
                    slide.querySelectorAll(`input[name^="question_"]:checked`)
                ).map(i => parseInt(i.value));

                saveAnswer({
                    question_id: questionId,
                    answer_type: questionType,
                    selected_options: selected
                });

                markQuestionAnswered(questionId);
            });
        });

        // Short Answer
        document.querySelectorAll('.short-answer-input').forEach(textarea => {
            // Set initial style
            updateShortAnswerStyle(textarea);

            let timeout;
            textarea.addEventListener('input', function() {
                // Update visual style immediately
                updateShortAnswerStyle(this);

                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    const slide = this.closest('.question-slide');
                    const questionId = slide.dataset.questionId;
                    const value = this.value.trim();

                    if (!value) {
                        // Remove from answered if cleared
                        if (answeredQuestions.has(questionId)) {
                            answeredQuestions.delete(questionId);
                            updateProgress();
                        }
                        return;
                    }

                    saveAnswer({
                        question_id: questionId,
                        answer_type: 'short_answer',
                        short_answer_value: value
                    });

                    markQuestionAnswered(questionId);
                }, 800);
            });
        });

        // Compound Answers
        function collectCompoundAnswers(slide) {
            const answers = [];

            // True/False answers
            slide.querySelectorAll('input[data-type="truefalse"]:checked').forEach(input => {
                answers.push({
                    sub_id: parseInt(input.dataset.subId),
                    type: 'truefalse',
                    boolean: input.value === '1'
                });
            });

            // Short answer values
            slide.querySelectorAll('textarea[data-type="short_answer"]').forEach(textarea => {
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

        function handleCompoundChange(element) {
            const slide = element.closest('.question-slide');
            const questionId = slide.dataset.questionId;

            // Update visual styles
            updateCompoundStyle(slide);

            const answers = collectCompoundAnswers(slide);

            if (answers.length === 0) {
                // Remove from answered if all cleared
                if (answeredQuestions.has(questionId)) {
                    answeredQuestions.delete(questionId);
                    updateProgress();
                }
                return;
            }

            saveAnswer({
                question_id: questionId,
                answer_type: 'compound',
                compound_answers: answers
            });

            markQuestionAnswered(questionId);
        }

        document.querySelectorAll('.compound-answer-input').forEach(input => {
            if (input.type === 'radio') {
                // Set initial style
                if (input.checked) {
                    const label = input.nextElementSibling;
                    if (input.value === '1') {
                        label.classList.add('border-green-500', 'bg-green-500/10', 'dark:bg-green-500/20', 'shadow-sm');
                    } else {
                        label.classList.add('border-red-500', 'bg-red-500/10', 'dark:bg-red-500/20', 'shadow-sm');
                    }
                }

                input.addEventListener('change', () => handleCompoundChange(input));
            } else if (input.tagName === 'TEXTAREA') {
                // Set initial style
                if (input.value.trim().length > 0) {
                    input.classList.add('border-azwara-medium', 'bg-azwara-medium/5', 'dark:bg-azwara-medium/10');
                }

                let timeout;
                input.addEventListener('input', () => {
                    handleCompoundChange(input);
                });
            }
        });
    }

    /* =====================================================
       INITIALIZATION
    ===================================================== */
    function initAnsweredQuestions() {
        questions.forEach(slide => {
            const questionId = slide.dataset.questionId;
            const questionType = slide.dataset.questionType;
            let isAnswered = false;

            if (questionType === 'short_answer') {
                const textarea = slide.querySelector('.short-answer-input');
                isAnswered = textarea && textarea.value.trim().length > 0;
                if (isAnswered) updateShortAnswerStyle(textarea);
            } else if (questionType === 'compound') {
                const hasTrueFalse = slide.querySelector('input[data-type="truefalse"]:checked');
                const hasShortAnswer = Array.from(slide.querySelectorAll('textarea[data-type="short_answer"]'))
                    .some(t => t.value.trim().length > 0);
                isAnswered = hasTrueFalse || hasShortAnswer;
                if (isAnswered) updateCompoundStyle(slide);
            } else {
                isAnswered = slide.querySelector('input[type="radio"]:checked, input[type="checkbox"]:checked') !== null;
                if (isAnswered) {
                    slide.querySelectorAll('input[type="radio"]:checked, input[type="checkbox"]:checked').forEach(input => {
                        updateOptionStyle(input);
                    });
                }
            }

            if (isAnswered) {
                answeredQuestions.add(questionId);
                const index = parseInt(slide.dataset.index);
                const navBtn = navButtons[index];
                if (navBtn) {
                    navBtn.classList.remove('bg-azwara-lighter', 'dark:bg-gray-700', 'text-azwara-medium', 'dark:text-gray-300');
                    navBtn.classList.add('bg-green-500', 'text-white');

                    // Add checkmark if not exists
                    if (!navBtn.querySelector('.checkmark')) {
                        const checkmark = document.createElement('div');
                        checkmark.className = 'checkmark absolute -top-1 -right-1 h-3 w-3 rounded-full bg-white flex items-center justify-center';
                        checkmark.innerHTML = `
                            <svg class="h-2 w-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        `;
                        navBtn.appendChild(checkmark);
                    }
                }
            }
        });

        updateProgress();
        showQuestion(0);
        initAnswerHandlers();
    }

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            hideSidebar();
        }
    });

    // Initialize
    initAnsweredQuestions();
});

/* =====================================================
   BEFORE UNLOAD WARNING
===================================================== */
window.addEventListener('beforeunload', function(e) {
    // Only show warning if there are unanswered questions
    const questions = document.querySelectorAll('.question-slide');
    const answered = new Set();

    document.querySelectorAll('.question-slide').forEach(slide => {
        const questionId = slide.dataset.questionId;
        const questionType = slide.dataset.questionType;
        let isAnswered = false;

        if (questionType === 'short_answer') {
            const textarea = slide.querySelector('.short-answer-input');
            isAnswered = textarea && textarea.value.trim().length > 0;
        } else if (questionType === 'compound') {
            const hasTrueFalse = slide.querySelector('input[data-type="truefalse"]:checked');
            const hasShortAnswer = Array.from(slide.querySelectorAll('textarea[data-type="short_answer"]'))
                .some(t => t.value.trim().length > 0);
            isAnswered = hasTrueFalse || hasShortAnswer;
        } else {
            isAnswered = slide.querySelector('input[type="radio"]:checked, input[type="checkbox"]:checked') !== null;
        }

        if (isAnswered) answered.add(questionId);
    });

    if (answered.size < questions.length) {
        e.preventDefault();
        e.returnValue = 'Anda memiliki jawaban yang belum disubmit. Yakin ingin meninggalkan halaman?';
    }
});
</script>

{{-- MathJax for math rendering --}}
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
@endpush
