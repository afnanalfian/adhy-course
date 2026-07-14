@push('script')
    <!-- 🔥 INDICATOR PAUSE -->
    <div id="pauseIndicator" class="hidden fixed top-20 left-1/2 transform -translate-x-1/2 z-50 bg-yellow-500 text-white px-4 py-2 rounded-lg shadow-lg flex items-center gap-2">
        <svg class="animate-pulse w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span>Timer Dijeda</span>
    </div>

    <script>
        /* =====================================================
           FULLSCREEN FUNCTION
        ===================================================== */
        const fullscreenBtn = document.getElementById('fullscreenBtn');
        fullscreenBtn?.addEventListener('click', () => {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen().catch(err => {
                    console.log(`Error attempting to enable fullscreen: ${err.message}`);
                });
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        });

        // Update fullscreen button icon
        document.addEventListener('fullscreenchange', () => {
            const icon = fullscreenBtn?.querySelector('svg');
            if (icon) {
                if (document.fullscreenElement) {
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 9V4.5a.5.5 0 00-1 0V9H4.5a.5.5 0 000 1H8v4.5a.5.5 0 001 0V10h3.5a.5.5 0 000-1H9z"/>';
                } else {
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>';
                }
            }
        });

        /* =====================================================
           TIMER WITH PAUSE - FIXED (HANYA PAUSE SAAT TAB HIDDEN)
        ===================================================== */
        const timerEl = document.getElementById('timer');
        let remaining = parseInt(timerEl.dataset.remaining, 10);
        let isTabVisible = true;
        let isTimerPaused = false;
        let timerInterval = null;
        let syncInterval = null;
        let pauseSyncInterval = null;
        const ATTEMPT_ID = '{{ $attempt->id }}';
        let isPausing = false;
        let isInitialized = false;
        let isManualPause = false; // 🔥 Track manual pause

        function formatTime(seconds) {
            const h = Math.floor(seconds / 3600);
            const m = Math.floor((seconds % 3600) / 60);
            const s = seconds % 60;
            return h > 0
                ? `${h}:${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`
                : `${m}:${s.toString().padStart(2, '0')}`;
        }

        timerEl.innerText = formatTime(remaining);

        // ==== FUNGSI UNTUK MENJALANKAN TIMER ====
        function startTimer() {
            if (timerInterval) {
                clearInterval(timerInterval);
            }
            
            timerInterval = setInterval(() => {
                // 🔥 PERBAIKAN: Timer berhenti jika paused
                if (isTimerPaused) {
                    return;
                }
                
                if (remaining <= 0) {
                    clearInterval(timerInterval);
                    if (syncInterval) {
                        clearInterval(syncInterval);
                    }
                    if (pauseSyncInterval) {
                        clearInterval(pauseSyncInterval);
                    }
                    forceSubmitNow();
                    return;
                }
                
                remaining--;
                timerEl.innerText = formatTime(remaining);

                // Warning colors
                if (remaining <= 300) {
                    timerEl.classList.add('text-red-400');
                    timerEl.classList.remove('text-white');
                } else if (remaining <= 600) {
                    timerEl.classList.add('text-yellow-400');
                    timerEl.classList.remove('text-white');
                }
            }, 1000);
        }

        // ==== FUNGSI PAUSE DI SERVER ====
        async function pauseExamOnServer() {
            try {
                const response = await fetch("{{ route('exams.pause', $attempt->exam) }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                
                if (response.ok) {
                    const data = await response.json();
                    console.log('✅ Exam paused on server, remaining: ' + data.remaining_seconds);
                    
                    if (data.remaining_seconds !== undefined) {
                        remaining = data.remaining_seconds;
                        timerEl.innerText = formatTime(remaining);
                    }
                    return true;
                }
                return false;
            } catch (e) {
                console.warn('Failed to pause exam on server:', e);
                return false;
            }
        }

        // ==== FUNGSI RESUME DI SERVER ====
        async function resumeExamOnServer() {
            try {
                const response = await fetch("{{ route('exams.resume', $attempt->exam) }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                
                if (response.ok) {
                    const data = await response.json();
                    if (data.remaining_seconds !== undefined) {
                        remaining = data.remaining_seconds;
                        timerEl.innerText = formatTime(remaining);
                    }
                    console.log('✅ Exam resumed on server, remaining: ' + remaining);
                    return true;
                }
                return false;
            } catch (e) {
                console.warn('Failed to resume exam on server:', e);
                return false;
            }
        }

        // ==== AUTO-RESUME SAAT KLIK DI MANA SAJA ====
        document.addEventListener('click', async function(e) {
            // 🔥 Jangan resume jika klik di tombol submit atau elemen form
            if (e.target.closest('button[type="submit"]') || e.target.closest('#auto-submit-form')) {
                return;
            }
            
            if (isTimerPaused) {
                console.log('🔄 Auto-resume on click');
                const success = await resumeExamOnServer();
                if (success) {
                    isTimerPaused = false;
                    isManualPause = false;
                    timerEl.classList.remove('opacity-50');
                    timerEl.title = '';
                    document.getElementById('pauseIndicator')?.classList.add('hidden');
                    console.log('▶️ Timer resumed');
                }
            }
        }, { once: false });

        // ==== FUNGSI CEK STATUS PAUSE DARI SERVER ====
        async function checkPauseStatus() {
            try {
                const res = await fetch("{{ route('exams.time.sync', $attempt->exam) }}", {
                    headers: { 'Accept': 'application/json' }
                });
                if (res.ok) {
                    const data = await res.json();
                    
                    if (data.remaining_seconds !== undefined) {
                        remaining = data.remaining_seconds;
                        timerEl.innerText = formatTime(remaining);
                    }
                    
                    // 🔥 PERBAIKAN: Update status pause dari server
                    if (data.is_paused && !isTimerPaused) {
                        isTimerPaused = true;
                        timerEl.classList.add('opacity-50');
                        timerEl.title = 'Timer dijeda';
                        document.getElementById('pauseIndicator')?.classList.remove('hidden');
                        console.log('⏸️ Timer status: PAUSED (from server)');
                    } else if (!data.is_paused && isTimerPaused) {
                        isTimerPaused = false;
                        isManualPause = false;
                        timerEl.classList.remove('opacity-50');
                        timerEl.title = '';
                        document.getElementById('pauseIndicator')?.classList.add('hidden');
                        console.log('▶️ Timer status: RESUMED (from server)');
                    }
                    
                    return data;
                }
            } catch (e) {
                console.warn('Failed to sync:', e);
            }
            return null;
        }

        // ==== 🔥 PERBAIKAN: DETEKSI PERUBAHAN VISIBILITAS TAB ====
        document.addEventListener('visibilitychange', () => {
            // 🔥 HANYA PAUSE JIKA TAB BENAR-BENAR HIDDEN
            if (document.hidden) {
                // Tab disembunyikan - PAUSE TIMER (HANYA JIKA BELUM PAUSE)
                if (!isPausing && !isTimerPaused) {
                    isPausing = true;
                    isTabVisible = false;
                    
                    console.log('🔄 Tab hidden, pausing exam...');
                    
                    // Pause di server
                    pauseExamOnServer().then(() => {
                        isTimerPaused = true;
                        isManualPause = true; // 🔥 Tandai sebagai pause dari tab
                        timerEl.classList.add('opacity-50');
                        timerEl.title = 'Timer dijeda karena tab tidak aktif';
                        document.getElementById('pauseIndicator')?.classList.remove('hidden');
                        isPausing = false;
                        console.log('⏸️ Timer paused - tab tidak aktif, sisa waktu: ' + remaining);
                    });
                    
                    // Simpan waktu pause ke localStorage
                    localStorage.setItem('exam_paused_at_' + ATTEMPT_ID, Date.now().toString());
                }
            } else {
                // 🔥 Tab kembali aktif - RESUME TIMER (HANYA JIKA PAUSE DARI TAB)
                isTabVisible = true;
                
                // Cek apakah pause terjadi karena tab
                if (isManualPause) {
                    console.log('🔄 Tab active, resuming exam...');
                    
                    // Cek localStorage
                    const pausedKey = 'exam_paused_at_' + ATTEMPT_ID;
                    const pausedAt = localStorage.getItem(pausedKey);
                    
                    if (pausedAt) {
                        const pausedTime = parseInt(pausedAt, 10);
                        const elapsedPause = Math.floor((Date.now() - pausedTime) / 1000);
                        
                        // Resume di server
                        resumeExamOnServer().then(() => {
                            isTimerPaused = false;
                            isManualPause = false;
                            timerEl.classList.remove('opacity-50');
                            timerEl.title = '';
                            document.getElementById('pauseIndicator')?.classList.add('hidden');
                            console.log('▶️ Timer resumed - tab aktif kembali, sisa waktu: ' + remaining);
                        });
                        
                        localStorage.removeItem(pausedKey);
                    } else {
                        // Jika tidak ada localStorage, cek status dari server
                        checkPauseStatus().then((data) => {
                            if (!data?.is_paused) {
                                isTimerPaused = false;
                                isManualPause = false;
                                timerEl.classList.remove('opacity-50');
                                timerEl.title = '';
                                document.getElementById('pauseIndicator')?.classList.add('hidden');
                                console.log('▶️ Timer resumed - tab aktif kembali, sisa waktu: ' + remaining);
                            }
                        });
                    }
                }
            }
        });

        // ==== FUNGSI SINKRONISASI WAKTU DENGAN SERVER ====
        async function syncTimeWithServer() {
            try {
                const res = await fetch("{{ route('exams.time.sync', $attempt->exam) }}", {
                    headers: { 'Accept': 'application/json' }
                });
                if (res.ok) {
                    const data = await res.json();
                    const serverRemaining = data.remaining_seconds;
                    
                    // 🔥 PERBAIKAN: Update status pause dari server
                    if (data.is_paused && !isTimerPaused) {
                        isTimerPaused = true;
                        timerEl.classList.add('opacity-50');
                        timerEl.title = 'Timer dijeda (server)';
                        document.getElementById('pauseIndicator')?.classList.remove('hidden');
                    } else if (!data.is_paused && isTimerPaused) {
                        isTimerPaused = false;
                        isManualPause = false;
                        timerEl.classList.remove('opacity-50');
                        timerEl.title = '';
                        document.getElementById('pauseIndicator')?.classList.add('hidden');
                    }
                    
                    // Koreksi waktu dengan server
                    if (serverRemaining < remaining) {
                        remaining = serverRemaining;
                        timerEl.innerText = formatTime(remaining);
                        
                        if (remaining <= 300) {
                            timerEl.classList.add('text-red-400');
                            timerEl.classList.remove('text-white');
                        } else if (remaining <= 600) {
                            timerEl.classList.add('text-yellow-400');
                            timerEl.classList.remove('text-white');
                        }
                    }
                }
            } catch (e) { /* biarkan, coba lagi nanti */ }
        }

        // ==== START TIMER ====
        startTimer();

        // ==== SYNC DENGAN SERVER SETIAP 30 DETIK ====
        syncInterval = setInterval(() => {
            if (!isTimerPaused) {
                syncTimeWithServer();
            }
        }, 30000);

        // ==== SYNC PAUSE STATUS SETIAP 10 DETIK ====
        pauseSyncInterval = setInterval(() => {
            if (isTimerPaused) {
                checkPauseStatus();
            }
        }, 10000);

        // ==== CEK PAUSE TIME SAAT LOAD ====
        document.addEventListener('DOMContentLoaded', async () => {
            if (isInitialized) return;
            isInitialized = true;
            
            console.log('🔄 Initializing exam...');
            
            // 🔥 CEK STATUS PAUSE DARI SERVER PERTAMA
            const data = await checkPauseStatus();
            
            // Jika server menyatakan paused, pause timer lokal
            if (data?.is_paused) {
                isTimerPaused = true;
                isManualPause = true;
                timerEl.classList.add('opacity-50');
                timerEl.title = 'Timer dijeda';
                document.getElementById('pauseIndicator')?.classList.remove('hidden');
                console.log('⏸️ Exam is paused on server');
            } else {
                isTimerPaused = false;
                isManualPause = false;
                timerEl.classList.remove('opacity-50');
                timerEl.title = '';
                document.getElementById('pauseIndicator')?.classList.add('hidden');
                console.log('▶️ Exam is running');
            }
            
            // Cek localstorage untuk resume
            const pausedKey = 'exam_paused_at_' + ATTEMPT_ID;
            const pausedAt = localStorage.getItem(pausedKey);
            
            if (pausedAt) {
                const pausedTime = parseInt(pausedAt, 10);
                const elapsedPause = Math.floor((Date.now() - pausedTime) / 1000);
                
                console.log('📦 Found paused_at in localStorage: ' + elapsedPause + 's ago');
                
                // Jika paused lebih dari 3 detik dan server tidak paused, resume
                if (elapsedPause > 3 && !data?.is_paused) {
                    console.log('🔄 Resuming from localStorage...');
                    await resumeExamOnServer();
                    isTimerPaused = false;
                    isManualPause = false;
                    timerEl.classList.remove('opacity-50');
                    timerEl.title = '';
                    document.getElementById('pauseIndicator')?.classList.add('hidden');
                }
                
                localStorage.removeItem(pausedKey);
            }
            
            // Update warning colors
            if (remaining <= 300) {
                timerEl.classList.add('text-red-400');
                timerEl.classList.remove('text-white');
            } else if (remaining <= 600) {
                timerEl.classList.add('text-yellow-400');
                timerEl.classList.remove('text-white');
            }
            
            console.log('✅ Exam initialized, remaining: ' + remaining + 's');
        });

        // ==== DETEKSI KETIKA USER MENUTUP TAB ====
        window.addEventListener('beforeunload', function (e) {
            // Pause di server sebelum tab ditutup
            if (!document.hidden && !isTimerPaused) {
                const formData = new FormData();
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
                
                navigator.sendBeacon(
                    "{{ route('exams.pause', $attempt->exam) }}",
                    formData
                );
                
                localStorage.setItem('exam_paused_at_' + ATTEMPT_ID, Date.now().toString());
                console.log('📤 Sending pause via beacon before unload');
            }
        });

        /* =====================================================
           SIDEBAR MANAGEMENT
        ===================================================== */
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggleBtn = document.getElementById('toggleSidebar');
        const closeBtn = document.getElementById('closeSidebar');

        function showSidebar() {
            sidebar.classList.remove('translate-x-full');
            overlay.classList.remove('hidden');
        }

        function hideSidebar() {
            sidebar.classList.add('translate-x-full');
            overlay.classList.add('hidden');
        }

        toggleBtn?.addEventListener('click', showSidebar);
        closeBtn?.addEventListener('click', hideSidebar);
        overlay?.addEventListener('click', hideSidebar);

        /* =====================================================
           QUESTION NAVIGATION
        ===================================================== */
        let currentIndex = 0;
        const slides = document.querySelectorAll('.question-slide');
        const navButtons = document.querySelectorAll('.nav-btn');
        const totalQuestions = slides.length;

        function updateSubmitButtonVisibility() {
            const submitForm = document.getElementById('auto-submit-form');
            const nextBtn = document.getElementById('nextBtn');

            if (currentIndex === totalQuestions - 1) {
                submitForm?.classList.remove('hidden');
                nextBtn?.classList.add('hidden');
            } else {
                submitForm?.classList.add('hidden');
                nextBtn?.classList.remove('hidden');
            }
        }

        function setActiveNav(index) {
            navButtons.forEach(btn => {
                btn.classList.remove('ring-4', 'ring-primary/30', 'scale-110', 'shadow-lg');
            });

            navButtons[index]?.classList.add('ring-4', 'ring-primary/30', 'scale-110', 'shadow-lg');
        }

        function updateQuestionCounters() {
            let answeredCount = 0;
            navButtons.forEach(btn => {
                if (btn.classList.contains('bg-green-100') || btn.classList.contains('dark:bg-green-900/30')) {
                    answeredCount++;
                }
            });

            document.getElementById('answeredCount').textContent = answeredCount;
            document.getElementById('unansweredCount').textContent = totalQuestions - answeredCount;
        }

        function showQuestion(index) {
            slides.forEach(s => s.classList.add('hidden'));
            slides[index]?.classList.remove('hidden');
            currentIndex = index;
            setActiveNav(index);
            updateSubmitButtonVisibility();
            hideSidebar();

            document.getElementById('prevBtn').disabled = index === 0;
        }

        setActiveNav(0);
        updateSubmitButtonVisibility();
        updateQuestionCounters();

        navButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                showQuestion(parseInt(btn.dataset.index));
            });
        });

        document.getElementById('prevBtn').addEventListener('click', () => {
            if (currentIndex > 0) showQuestion(currentIndex - 1);
        });

        document.getElementById('nextBtn').addEventListener('click', () => {
            if (currentIndex < totalQuestions - 1) showQuestion(currentIndex + 1);
        });

        /* =====================================================
           ANSWER HANDLING
        ===================================================== */
        let pendingSaves = [];

        async function saveAnswer(payload) {
            let resolveSave, rejectSave;
            const savePromise = new Promise((resolve, reject) => {
                resolveSave = resolve;
                rejectSave = reject;
            });
            
            pendingSaves.push(savePromise);
            
            try {
                const response = await fetch("{{ route('exams.answer.save', $attempt->exam) }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(payload)
                });
                
                if (!response.ok) {
                    const err = await response.json().catch(() => ({}));
                    if (response.status === 403 && err.expired) {
                        clearInterval(timerInterval);
                        if (syncInterval) {
                            clearInterval(syncInterval);
                        }
                        await forceSubmitNow();
                    }
                    resolveSave(false);
                    return false;
                }
                
                resolveSave(true);
                return true;
            } catch (e) {
                console.error('Save answer error:', e);
                resolveSave(false);
                return false;
            } finally {
                pendingSaves = pendingSaves.filter(p => p !== savePromise);
            }
        }

        async function forceSubmitNow() {
            if (pendingSaves.length > 0) {
                const timeout = new Promise((_, reject) => 
                    setTimeout(() => reject(new Error('Timeout')), 3000)
                );
                
                try {
                    await Promise.race([
                        Promise.allSettled(pendingSaves),
                        timeout
                    ]);
                } catch (e) {
                    console.warn('Force submit timeout, proceeding anyway');
                }
            }
            
            document.getElementById('auto-submit-form')?.submit();
        }

        function markAnswered(questionId, answered = true) {
            const slide = document.querySelector(`.question-slide[data-question-id="${questionId}"]`);
            const navBtn = document.querySelector(`.nav-btn[data-index="${slide?.dataset.index}"]`);

            if (navBtn) {
                if (answered) {
                    navBtn.classList.remove('bg-gray-100', 'dark:bg-ens-medium/30', 'text-gray-700', 'dark:text-gray-300', 'border-gray-200', 'dark:border-ens-medium');
                    navBtn.classList.add('bg-green-100', 'dark:bg-green-900/30', 'text-green-800', 'dark:text-green-300', 'border-green-300', 'dark:border-green-700');
                } else {
                    navBtn.classList.remove('bg-green-100', 'dark:bg-green-900/30', 'text-green-800', 'dark:text-green-300', 'border-green-300', 'dark:border-green-700');
                    navBtn.classList.add('bg-gray-100', 'dark:bg-ens-medium/30', 'text-gray-700', 'dark:text-gray-300', 'border-gray-200', 'dark:border-ens-medium');
                }
            }

            updateQuestionCounters();
        }

        /* =====================================================
           MCQ / MCMA / TRUEFALSE
        ===================================================== */
        document.querySelectorAll('.option-button').forEach(container => {
            const input = container.querySelector('input[type="radio"], input[type="checkbox"]');
            const label = container.querySelector('label');
            const questionSlide = container.closest('.question-slide');
            const questionId = questionSlide?.dataset.questionId;
            const questionType = questionSlide?.dataset.questionType;

            if (!input || !label) return;

            label.addEventListener('click', async (e) => {
                if (input.type === 'radio') {
                    questionSlide?.querySelectorAll('.option-button input[type="radio"]').forEach(otherInput => {
                        if (otherInput !== input) {
                            otherInput.checked = false;
                            otherInput.closest('.option-button')?.classList.remove('selected');
                        }
                    });
                }

                input.checked = !input.checked;

                if (input.checked) {
                    container.classList.add('selected');
                } else {
                    container.classList.remove('selected');
                }

                const selected = Array.from(
                    questionSlide?.querySelectorAll('.answer-section input:checked') || []
                ).map(i => parseInt(i.value));

                if (selected.length > 0 || input.type === 'radio') {
                    const success = await saveAnswer({
                        question_id: questionId,
                        answer_type: questionType,
                        selected_options: selected
                    });
                    markAnswered(questionId, success);
                } else {
                    markAnswered(questionId, false);
                }
            });
        });

        /* =====================================================
           SHORT ANSWER
        ===================================================== */
        document.querySelectorAll('.short-answer-input').forEach(textarea => {
            let timeout;

            textarea.addEventListener('input', function () {
                clearTimeout(timeout);

                timeout = setTimeout(async () => {
                    const slide = this.closest('.question-slide');
                    const questionId = slide?.dataset.questionId;
                    const value = this.value.trim();

                    if (value) {
                        const success = await saveAnswer({
                            question_id: questionId,
                            answer_type: 'short_answer',
                            short_answer_value: value
                        });
                        markAnswered(questionId, success);
                    } else {
                        markAnswered(questionId, false);
                    }
                }, 500);
            });

            textarea.addEventListener('blur', async function () {
                clearTimeout(timeout);
                const slide = this.closest('.question-slide');
                const questionId = slide?.dataset.questionId;
                const value = this.value.trim();

                if (value) {
                    const success = await saveAnswer({
                        question_id: questionId,
                        answer_type: 'short_answer',
                        short_answer_value: value
                    });
                    markAnswered(questionId, success);
                } else {
                    markAnswered(questionId, false);
                }
            });
        });

        /* =====================================================
           COMPOUND QUESTION
        ===================================================== */
        document.querySelectorAll('.truefalse-btn').forEach(button => {
            button.addEventListener('click', async function () {
                const subId = this.dataset.subId;
                const questionSlide = this.closest('.question-slide');
                const questionId = questionSlide?.dataset.questionId;
                const isTrue = this.textContent.includes('Benar');

                const otherBtn = questionSlide?.querySelector(`.truefalse-btn[data-sub-id="${subId}"]:not(:disabled)`);
                if (otherBtn && otherBtn !== this) {
                    otherBtn.classList.remove('border-green-500', 'bg-green-50', 'dark:bg-green-900/20', 'text-green-700', 'dark:text-green-300',
                        'border-red-500', 'bg-red-50', 'dark:bg-red-900/20', 'text-red-700', 'dark:text-red-300');
                }

                const isSelected = this.classList.contains('border-green-500') || this.classList.contains('border-red-500');
                if (isSelected) {
                    this.classList.remove(isTrue ? 'border-green-500' : 'border-red-500',
                        isTrue ? 'bg-green-50' : 'bg-red-50',
                        isTrue ? 'dark:bg-green-900/20' : 'dark:bg-red-900/20',
                        isTrue ? 'text-green-700' : 'text-red-700',
                        isTrue ? 'dark:text-green-300' : 'dark:text-red-300');
                } else {
                    this.classList.add(isTrue ? 'border-green-500' : 'border-red-500',
                        isTrue ? 'bg-green-50' : 'bg-red-50',
                        isTrue ? 'dark:bg-green-900/20' : 'dark:bg-red-900/20',
                        isTrue ? 'text-green-700' : 'text-red-700',
                        isTrue ? 'dark:text-green-300' : 'dark:text-red-300');
                }

                await collectAndSaveCompoundAnswers(questionSlide);
            });
        });

        document.querySelectorAll('.compound-short-answer').forEach(textarea => {
            let timeout;

            textarea.addEventListener('input', function () {
                clearTimeout(timeout);

                timeout = setTimeout(async () => {
                    const slide = this.closest('.question-slide');
                    await collectAndSaveCompoundAnswers(slide);
                }, 500);
            });

            textarea.addEventListener('blur', async function () {
                clearTimeout(timeout);
                const slide = this.closest('.question-slide');
                await collectAndSaveCompoundAnswers(slide);
            });
        });

        async function collectAndSaveCompoundAnswers(slide) {
            const questionId = slide?.dataset.questionId;
            const answers = [];

            slide?.querySelectorAll('.truefalse-btn').forEach(btn => {
                const subId = btn.dataset.subId;
                const isSelected = btn.classList.contains('border-green-500') || btn.classList.contains('border-red-500');

                if (isSelected) {
                    answers.push({
                        sub_id: parseInt(subId),
                        type: 'truefalse',
                        boolean: btn.classList.contains('border-green-500')
                    });
                }
            });

            slide?.querySelectorAll('.compound-short-answer').forEach(textarea => {
                const subId = textarea.dataset.subId;
                const value = textarea.value.trim();

                if (value) {
                    answers.push({
                        sub_id: parseInt(subId),
                        type: 'short_answer',
                        value: value
                    });
                }
            });

            if (answers.length > 0) {
                const success = await saveAnswer({
                    question_id: questionId,
                    answer_type: 'compound',
                    compound_answers: answers
                });
                markAnswered(questionId, success);
            } else {
                markAnswered(questionId, false);
            }
        }

        /* =====================================================
           KEYBOARD NAVIGATION
        ===================================================== */
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
                e.preventDefault();
                if (currentIndex > 0) showQuestion(currentIndex - 1);
            } else if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
                e.preventDefault();
                if (currentIndex < totalQuestions - 1) showQuestion(currentIndex + 1);
            } else if (e.key === 'Escape') {
                hideSidebar();
            }
        });

        /* =====================================================
           INITIALIZATION
        ===================================================== */
        if (typeof MathJax !== 'undefined') {
            MathJax.typesetPromise();
        }

        document.querySelectorAll('.question-slide').forEach(slide => {
            const questionId = slide.dataset.questionId;
            const hasAnswer = slide.querySelector('input:checked') ||
                slide.querySelector('.short-answer-input')?.value.trim() ||
                slide.querySelector('.truefalse-btn.selected') ||
                slide.querySelector('.compound-short-answer')?.value.trim();

            if (hasAnswer) {
                markAnswered(questionId, true);
            }
        });
    </script>
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
        MathJax.typesetPromise();
    });
    </script>
@endpush