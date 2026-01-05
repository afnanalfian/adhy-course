@extends('layouts.app')

@section('title', $exam->title.' | Tryout Azwara Learning - Matematika, SKD, dll')
@section('description', 'Ikuti tryout '.$exam->title.' lengkap dengan pembahasan.')
@section('content')
<div class="max-w-6xl mx-auto space-y-8 px-4 sm:px-0">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

        {{-- Title & Date --}}
        <div class="space-y-1">
            <h1 class="text-2xl font-bold text-azwara-darkest dark:text-azwara-lighter">
                {{ $exam->title }}
            </h1>

            @if($exam->exam_date)
                <div class="flex flex-wrap gap-x-4 text-sm text-gray-500 dark:text-gray-400">
                    <span>
                        Tanggal:
                        <strong class="text-azwara-darkest dark:text-azwara-light">
                            {{ $exam->exam_date->format('d M Y') }}
                        </strong>
                    </span>
                    <span>
                        Jam:
                        <strong class="text-azwara-darkest dark:text-azwara-light">
                            {{ $exam->exam_date->format('H:i') }} WIB
                        </strong>
                    </span>
                </div>
            @endif
        </div>

        {{-- Status --}}
        <div>
            @if($exam->status === 'inactive')
                <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium
                             bg-yellow-100 text-yellow-700
                             dark:bg-yellow-900/30 dark:text-yellow-400">
                    Belum Dimulai
                </span>
            @elseif($exam->status === 'active')
                <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium
                             bg-green-100 text-green-700
                             dark:bg-green-900/30 dark:text-green-400">
                    Berlangsung
                </span>
            @else
                <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium
                             bg-gray-100 text-gray-600
                             dark:bg-gray-800 dark:text-gray-300">
                    Selesai
                </span>
            @endif
        </div>
    </div>

    {{-- ================= INFO CARDS ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        {{-- Durasi --}}
        <div
            class="rounded-2xl p-4
                   bg-azwara-lightest dark:bg-azwara-darker
                   border border-gray-200 dark:border-azwara-darkest">
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Durasi
            </p>
            <p class="mt-1 text-lg font-semibold text-azwara-darkest dark:text-azwara-lighter">
                {{ $exam->duration_minutes ?? '-' }} menit
            </p>
        </div>

        {{-- Jumlah Soal --}}
        <div
            class="rounded-2xl p-4
                   bg-azwara-lightest dark:bg-azwara-darker
                   border border-gray-200 dark:border-azwara-darkest">
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Jumlah Soal
            </p>
            <p class="mt-1 text-lg font-semibold text-azwara-darkest dark:text-azwara-lighter">
                {{ $exam->questions->count() }} soal
            </p>
        </div>

        {{-- Tanggal --}}
        <div
            class="rounded-2xl p-4
                   bg-azwara-lightest dark:bg-azwara-darker
                   border border-gray-200 dark:border-azwara-darkest">
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Tanggal Ujian
            </p>
            <p class="mt-1 text-lg font-semibold text-azwara-darkest dark:text-azwara-lighter">
                {{ $exam->exam_date?->format('d M Y') ?? '-' }}
            </p>
        </div>

        {{-- Jam --}}
        <div
            class="rounded-2xl p-4
                   bg-azwara-lightest dark:bg-azwara-darker
                   border border-gray-200 dark:border-azwara-darkest">
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Jam Mulai
            </p>
            <p class="mt-1 text-lg font-semibold text-azwara-darkest dark:text-azwara-lighter">
                {{ $exam->exam_date?->format('H:i') ?? '-' }} WIB
            </p>
        </div>

    </div>

    {{-- ================= ACTIONS ================= --}}
    <div class="flex flex-wrap gap-3">

        {{-- ===== ADMIN / TENTOR ===== --}}
        @role('admin|tentor')
            @if($exam->type === 'tryout')
            <div x-data="{ open: false }">

                <button
                    @click="open = true"
                    class="px-4 py-2 rounded-xl text-sm font-medium
                        bg-primary text-azwara-lightest border border-gray-300">
                    Atur Urutan Tryout
                </button>
                <div
                    x-show="open"
                    x-cloak
                    class="fixed inset-0 z-50 bg-black/50 flex items-start justify-center"
                >
                    <div class="bg-white max-w-md w-full mt-24 rounded-xl p-6">
                        <h3 class="font-semibold mb-3">
                            Tryout yang Harus Diselesaikan
                        </h3>

                        <form method="POST"
                            action="{{ route('exams.prerequisites.update', $exam) }}">
                            @csrf

                            <select name="required_exam_ids[]" multiple
                                class="w-full rounded-lg border p-2 text-sm">
                                @foreach($allTryouts as $tryout)
                                    @if($tryout->id !== $exam->id)
                                        <option value="{{ $tryout->id }}"
                                            @selected($exam->prerequisites->contains($tryout->id))>
                                            {{ $tryout->title }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>

                            <div class="flex gap-2 mt-4">
                                <button type="submit"
                                    class="flex-1 bg-primary text-white py-2 rounded-xl">
                                    Simpan
                                </button>

                                <button type="button"
                                    @click="open = false"
                                    class="flex-1 border py-2 rounded-xl">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            @endif


            @if($exam->status === 'inactive')

                <a
                    href="{{ route('exams.edit', $exam) }}"
                    class="px-4 py-2 rounded-xl text-sm font-medium
                           bg-yellow-100 text-yellow-700
                           hover:bg-yellow-200 transition
                           dark:bg-yellow-900/30 dark:text-yellow-400">
                    Edit Exam
                </a>

                <form method="POST" action="{{ route('exams.activate', $exam) }}">
                    @csrf
                    <button
                        class="px-4 py-2 rounded-xl text-sm font-medium
                               bg-primary text-white
                               hover:opacity-90 transition">
                        Launch Exam
                    </button>
                </form>

            @elseif($exam->status === 'active')

                <form
                    method="POST"
                    action="{{ route('exams.close', $exam) }}"
                    class="sweet-confirm"
                    data-message="Yakin ingin menutup tryout?">
                    @csrf
                    <button
                        class="px-4 py-2 rounded-xl text-sm font-medium
                               bg-red-600 text-white
                               hover:bg-red-700 transition">
                        Tutup Exam
                    </button>
                </form>

                <a
                    href="{{ route('exams.result.admin', $exam) }}"
                    class="px-4 py-2 rounded-xl text-sm font-medium
                           border border-gray-300
                           text-gray-700
                           hover:bg-gray-100 transition
                           dark:border-gray-600 dark:text-gray-300
                           dark:hover:bg-azwara-darkest">
                    Lihat Hasil
                </a>

            @else

                <a
                    href="{{ route('exams.result.admin', $exam) }}"
                    class="px-4 py-2 rounded-xl text-sm font-medium
                           border border-gray-300
                           text-gray-700
                           hover:bg-gray-100 transition
                           dark:border-gray-600 dark:text-gray-300
                           dark:hover:bg-azwara-darkest">
                    Hasil & Pembahasan
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
            {{-- KETERANGAN PREREQUISITE --}}
            @if($exam->prerequisites->isNotEmpty())
                <div class="mt-2 text-xs text-gray-600">
                    <span class="font-medium">Prerequisite:</span>
                    {{ $exam->prerequisites->pluck('title')->join(', ') }}
                </div>
            @else
                <div class="mt-2 text-xs text-gray-400 italic">
                    Tidak memiliki prerequisite (tryout independen)
                </div>
            @endif
        @endrole

        {{-- ===== SISWA ===== --}}
        @role('siswa')

            {{-- ===== TIDAK PUNYA AKSES ===== --}}
            @cannot('view', $exam)
                <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        Anda belum memiliki akses untuk ujian ini
                    </span>

                    <a
                        href="{{ route('browse.index') }}"
                        class="px-4 py-2 rounded-xl text-sm font-medium
                            bg-primary text-white
                            hover:opacity-90 transition">
                        Lakukan Pembelian
                    </a>
                </div>
            @else

                {{-- ===== SUDAH SUBMIT ===== --}}
                @if($attempt && $attempt->is_submitted)

                    <div class="flex flex-wrap items-center gap-3">

                        <div
                            class="rounded-2xl px-4 py-2
                                bg-green-50 dark:bg-green-900/20
                                border border-green-200 dark:border-green-500/30">

                            <p class="text-xs text-green-700 dark:text-green-400">
                                Skor Anda
                            </p>

                            <p class="text-xl font-bold text-green-700 dark:text-green-400 leading-tight">
                                {{ $attempt->score }}
                            </p>
                        </div>

                        <a
                            href="{{ route('exams.result.student', $exam) }}"
                            class="px-4 py-2 rounded-xl text-sm font-medium
                                border border-gray-300
                                text-gray-700
                                hover:bg-gray-100 transition
                                dark:border-gray-600 dark:text-gray-300
                                dark:hover:bg-azwara-darkest">
                            Lihat Hasil
                        </a>

                    </div>

                {{-- ===== BELUM SUBMIT ===== --}}
                @else

                    @if($exam->status === 'active')

                        @if($unmetPrerequisites->isNotEmpty())

                            <div class="text-sm text-gray-500">
                                Anda harus menyelesaikan terlebih dahulu:
                                <ul class="list-disc ml-5 mt-1">
                                    @foreach($unmetPrerequisites as $req)
                                        <li class="font-medium text-gray-700">
                                            {{ $req->title }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                        @elseif(!$attempt)

                            <form method="POST" action="{{ route('exams.start', $exam) }}">
                                @csrf
                                <button class="px-4 py-2 rounded-xl bg-primary text-white">
                                    Mulai Exam
                                </button>
                            </form>

                        @else
                            <a href="{{ route('exams.attempt', $exam) }}"
                            class="px-4 py-2 rounded-xl bg-primary text-white">
                                Lanjutkan Exam
                            </a>
                        @endif

                    @else
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            Exam belum tersedia
                        </span>
                    @endif

                @endif

            @endcannot

        @endrole

    </div>

</div>
@endsection
