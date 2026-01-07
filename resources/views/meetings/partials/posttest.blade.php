<x-toggle-section title="🧪 Post Test">

    @php
        $exam = $meeting->exam;
    @endphp

    {{-- ================================================= --}}
    {{-- BELUM ADA POST TEST --}}
    {{-- ================================================= --}}
    @if(!$exam)

        <div class="rounded-2xl p-6
                    bg-white dark:bg-secondary
                    border border-dashed border-gray-300 dark:border-white/10
                    text-center space-y-4">

            <p class="text-sm text-gray-500 dark:text-gray-400">
                Post Test belum tersedia untuk pertemuan ini.
            </p>

            @role('admin|tentor')
            <button
                type="button"
                onclick="openPostTestModal()"
                class="inline-flex items-center justify-center
                    px-6 py-3 rounded-xl
                    bg-primary text-white font-semibold
                    hover:bg-primary/90 transition">
                ➕ Buat Post Test
            </button>
            @endrole
        </div>

    @else

        {{-- ================================================= --}}
        {{-- INFO --}}
        {{-- ================================================= --}}
        <div class="grid grid-cols-2 gap-4 mt-6 mb-6">

            <div class="rounded-2xl p-4
                        bg-white dark:bg-secondary
                        border border-gray-200 dark:border-white/10">
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Durasi
                </p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ $exam->duration_minutes ?? '-' }} menit
                </p>
            </div>

            <div class="rounded-2xl p-4
                        bg-white dark:bg-secondary
                        border border-gray-200 dark:border-white/10">
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Jumlah Soal
                </p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ $exam->questions->count() }} soal
                </p>
            </div>

        </div>

        {{-- ================== ACTIONS ================== --}}
        <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap">

            {{-- ================== ADMIN / TENTOR ================== --}}
            @role('admin|tentor')

                @if($exam->status === 'inactive')

                    <a href="{{ route('exams.edit', $exam) }}"
                       class="px-5 py-3 rounded-xl
                              bg-amber-500 text-white
                              hover:bg-amber-600
                              font-semibold text-center">
                        ✏️ Edit Post Test
                    </a>

                    <form method="POST"
                          action="{{ route('exams.activate', $exam) }}">
                        @csrf
                        <button class="px-5 py-3 rounded-xl
                                       bg-primary text-white
                                       hover:bg-primary/90
                                       font-semibold w-full sm:w-auto">
                            ▶️ Launch
                        </button>
                    </form>

                @elseif($exam->status === 'active')

                    <form method="POST"
                          action="{{ route('exams.close', $exam) }}"
                          class="sweet-confirm"
                          data-message="Yakin ingin menutup post test?">
                        @csrf
                        <button class="px-5 py-3 rounded-xl
                                       bg-red-600 text-white
                                       hover:bg-red-700
                                       font-semibold w-full sm:w-auto">
                            ⛔ Close
                        </button>
                    </form>

                    <a href="{{ route('exams.result.admin', $exam) }}"
                        class="px-5 py-3 rounded-xl
                            bg-gray-200 dark:bg-gray-600
                            text-gray-800 dark:text-white
                            font-semibold
                            grid place-items-center">
                        📊 Lihat Hasil
                    </a>

                @else
                    <a href="{{ route('exams.result.admin', $exam) }}"
                       class="px-5 py-3 rounded-xl
                              bg-gray-200 dark:bg-gray-600
                              text-gray-800 dark:text-white
                              font-semibold text-center">
                        📘 Hasil & Pembahasan
                    </a>
                @endif
                @if(in_array($exam->status, ['inactive', 'closed']))
                    <form
                        method="POST"
                        action="{{ route('exams.destroy', $exam) }}"
                        class="sweet-confirm w-full sm:w-auto"
                        data-message="Yakin ingin menghapus exam ini? Data akan diarsipkan.">
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="px-4 py-2 rounded-xl text-sm font-medium
                                bg-red-100 text-red-700
                                hover:bg-red-200 transition
                                dark:bg-red-900/30 dark:text-red-400">
                            Hapus Exam
                        </button>
                    </form>
                @endif
            @endrole

            {{-- ================== SISWA ================== --}}
            @role('siswa')

                @if($attempt && $attempt->is_submitted)

                    <div class="rounded-xl p-4
                                bg-green-50 dark:bg-green-900/20
                                border border-green-200 dark:border-green-500/30">
                        <p class="text-sm text-gray-700 dark:text-gray-200">
                            Skor Anda
                        </p>
                        <p class="text-2xl font-bold text-green-700 dark:text-green-400">
                            {{ $attempt->score }}
                        </p>
                    </div>

                    <a href="{{ route('exams.result.student', $exam) }}"
                        class="px-5 py-3 rounded-xl
                            bg-gray-200 dark:bg-gray-600
                            text-gray-800 dark:text-white
                            font-semibold
                            grid place-items-center">
                        📘 Lihat Hasil & Pembahasan
                    </a>

                @else

                    @if($exam->status === 'active')

                        @if(!$attempt)
                            <form method="POST"
                                  action="{{ route('exams.start', $exam) }}">
                                @csrf
                                <button class="px-5 py-3 rounded-xl
                                               bg-primary text-white
                                               hover:bg-primary/90
                                               font-semibold w-full sm:w-auto">
                                    ▶️ Mulai Post Test
                                </button>
                            </form>
                        @else
                            <a href="{{ route('exams.attempt', $exam) }}"
                               class="px-5 py-3 rounded-xl
                                      bg-primary text-white
                                      hover:bg-primary/90
                                      font-semibold text-center">
                                ⏩ Lanjutkan Post Test
                            </a>
                        @endif

                    @else
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            Post test belum tersedia
                        </span>
                    @endif

                @endif

            @endrole

        </div>

    @endif

</x-toggle-section>
