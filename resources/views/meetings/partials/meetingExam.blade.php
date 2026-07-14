<x-toggle-section title="🧪 Evaluasi">
    @php
        $blindExam = $meeting->exams->firstWhere('type', 'blind_test');
        $postExam  = $meeting->exams->firstWhere('type', 'post_test');

        $blindAttempt = auth()->check() && auth()->user()->hasRole('siswa') && $blindExam
            ? $blindExam->attempts->firstWhere('user_id', auth()->id())
            : null;

        $postAttempt = auth()->check() && auth()->user()->hasRole('siswa') && $postExam
            ? $postExam->attempts->firstWhere('user_id', auth()->id())
            : null;
    @endphp

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-2">
        {{-- Blind Test Card --}}
        <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-5">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-9 h-9 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Blind Test</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Tes sebelum materi</p>
                </div>
            </div>

            @if(!$blindExam)
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Belum ada ujian</p>
                @role('admin|tentor')
                <button type="button" onclick="openBlindTestModal()"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition">
                    + Buat Blind Test
                </button>
                @endrole
            @else
                {{-- Info --}}
                <div class="grid grid-cols-2 gap-2 mb-3">
                    <div class="p-2 rounded-lg bg-gray-50 dark:bg-gray-900/50">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Durasi</p>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $blindExam->duration_minutes ?? 0 }} menit</p>
                    </div>
                    <div class="p-2 rounded-lg bg-gray-50 dark:bg-gray-900/50">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Soal</p>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $blindExam->questions->count() }}</p>
                    </div>
                </div>

                {{-- Access Code (Admin/Tentor) --}}
                @role('admin|tentor')
                    <div class="flex items-center justify-between p-2 mb-3 rounded-lg bg-blue-50 dark:bg-blue-900/20 text-sm">
                        <span class="text-blue-700 dark:text-blue-400 font-medium">Code:</span>
                        <span class="font-mono tracking-widest text-blue-900 dark:text-blue-300">{{ $blindExam->access_code }}</span>
                        <button type="button" onclick="navigator.clipboard.writeText('{{ $blindExam->access_code }}')"
                                class="text-xs text-blue-600 dark:text-blue-400 hover:underline">Copy</button>
                    </div>

                    <div class="flex gap-2">
                        @if($blindExam->status === 'inactive')
                            <a href="{{ route('exams.edit', $blindExam) }}"
                               class="flex-1 px-4 py-2 text-sm font-medium text-center text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('exams.activate', $blindExam) }}" class="flex-1">
                                @csrf
                                <button type="submit"
                                        class="w-full px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-xl hover:bg-green-700 transition">
                                    Launch
                                </button>
                            </form>
                        @else
                            <a href="{{ route('exams.results', $blindExam) }}"
                               class="w-full px-4 py-2 text-sm font-medium text-center text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                                Hasil
                            </a>
                        @endif
                    </div>
                @endrole

                {{-- Siswa --}}
                @role('siswa')
                    @if($blindAttempt && $blindAttempt->is_submitted)
                        <div class="p-3 mb-3 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-green-800 dark:text-green-300">Skor Anda</span>
                                <span class="text-xl font-bold text-green-900 dark:text-green-100">{{ $blindAttempt->score }}</span>
                            </div>
                        </div>
                        <a href="{{ route('exams.result.student', $blindExam) }}"
                           class="block w-full px-4 py-2 text-sm font-medium text-center text-purple-600 dark:text-purple-400 bg-purple-50 dark:bg-purple-900/20 rounded-xl hover:bg-purple-100 dark:hover:bg-purple-900/30 transition">
                            Lihat Pembahasan
                        </a>
                    @elseif($blindExam->status === 'active')
                        <form method="POST" action="{{ route('exams.start', $blindExam) }}">
                            @csrf
                            <input type="text" name="access_code" required maxlength="7"
                                   placeholder="ACCESS CODE"
                                   class="w-full mb-2 px-4 py-2 text-center font-mono uppercase tracking-widest rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition">
                            <button type="submit"
                                    class="w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition">
                                Mulai Ujian
                            </button>
                        </form>
                    @endif
                @endrole
            @endif
        </div>

        {{-- Post Test Card --}}
        <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-5">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-9 h-9 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Post Test</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Tes setelah materi</p>
                </div>
            </div>

            @if(!$postExam)
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Belum ada ujian</p>
                @role('admin|tentor')
                <button type="button" onclick="openPostTestModal()"
                        class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-xl hover:bg-purple-700 transition">
                    + Buat Post Test
                </button>
                @endrole
            @else
                {{-- Info --}}
                <div class="grid grid-cols-2 gap-2 mb-3">
                    <div class="p-2 rounded-lg bg-gray-50 dark:bg-gray-900/50">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Durasi</p>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $postExam->duration_minutes ?? 0 }} menit</p>
                    </div>
                    <div class="p-2 rounded-lg bg-gray-50 dark:bg-gray-900/50">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Soal</p>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $postExam->questions->count() }}</p>
                    </div>
                </div>

                {{-- Access Code (Admin/Tentor) --}}
                @role('admin|tentor')
                    <div class="flex items-center justify-between p-2 mb-3 rounded-lg bg-purple-50 dark:bg-purple-900/20 text-sm">
                        <span class="text-purple-700 dark:text-purple-400 font-medium">Code:</span>
                        <span class="font-mono tracking-widest text-purple-900 dark:text-purple-300">{{ $postExam->access_code }}</span>
                        <button type="button" onclick="navigator.clipboard.writeText('{{ $postExam->access_code }}')"
                                class="text-xs text-purple-600 dark:text-purple-400 hover:underline">Copy</button>
                    </div>

                    <div class="flex gap-2">
                        @if($postExam->status === 'inactive')
                            <a href="{{ route('exams.edit', $postExam) }}"
                               class="flex-1 px-4 py-2 text-sm font-medium text-center text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('exams.activate', $postExam) }}" class="flex-1">
                                @csrf
                                <button type="submit"
                                        class="w-full px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-xl hover:bg-green-700 transition">
                                    Launch
                                </button>
                            </form>
                        @else
                            <a href="{{ route('exams.results', $postExam) }}"
                               class="w-full px-4 py-2 text-sm font-medium text-center text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                                Hasil
                            </a>
                        @endif
                    </div>
                @endrole

                {{-- Siswa --}}
                @role('siswa')
                    @if($postAttempt && $postAttempt->is_submitted)
                        <div class="p-3 mb-3 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-green-800 dark:text-green-300">Skor Anda</span>
                                <span class="text-xl font-bold text-green-900 dark:text-green-100">{{ $postAttempt->score }}</span>
                            </div>
                        </div>
                        <a href="{{ route('exams.result.student', $postExam) }}"
                           class="block w-full px-4 py-2 text-sm font-medium text-center text-purple-600 dark:text-purple-400 bg-purple-50 dark:bg-purple-900/20 rounded-xl hover:bg-purple-100 dark:hover:bg-purple-900/30 transition">
                            Lihat Pembahasan
                        </a>
                    @elseif($postExam->status === 'active')
                        <form method="POST" action="{{ route('exams.start', $postExam) }}">
                            @csrf
                            <input type="text" name="access_code" required maxlength="7"
                                   placeholder="ACCESS CODE"
                                   class="w-full mb-2 px-4 py-2 text-center font-mono uppercase tracking-widest rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition">
                            <button type="submit"
                                    class="w-full px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-xl hover:bg-purple-700 transition">
                                Mulai Ujian
                            </button>
                        </form>
                    @endif
                @endrole
            @endif
        </div>
    </div>
</x-toggle-section>