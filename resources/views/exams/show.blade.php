@extends('layouts.app')

@section('title', $exam->title.' | Tryout ENS Makassar')
@section('description', 'Ikuti tryout '.$exam->title.' lengkap dengan pembahasan.')

@section('content')
<div class="min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- HEADER --}}
        <div class="mb-8">
            <div class="mb-4">
                <a href="{{ $exam->backRoute() }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-primary">
                    ← Kembali ke Daftar Ujian
                </a>
            </div>

            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xs font-medium px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300">
                            {{ strtoupper($exam->test_type) }}
                        </span>

                        @if($exam->status === 'inactive')
                            <span class="text-xs font-medium px-3 py-1 rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300">
                                Belum Dimulai
                            </span>
                        @elseif($exam->status === 'active')
                            <span class="text-xs font-medium px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                Berlangsung
                            </span>
                        @else
                            <span class="text-xs font-medium px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                                Selesai
                            </span>
                        @endif
                    </div>

                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                        {{ $exam->title }}
                    </h1>

                    @if($exam->exam_date)
                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-medium">{{ $exam->exam_date->format('d M Y') }}</span>
                            <span class="font-medium">{{ $exam->exam_date->format('H:i') }} WITA</span>
                        </div>
                    @endif
                </div>

                {{-- ADMIN ACTIONS --}}
                @role('admin|tentor')
                <div class="flex flex-wrap gap-2">
                    @if($exam->status === 'inactive')
                        <a href="{{ route('exams.edit', $exam) }}"
                           class="px-4 py-2 text-sm font-medium rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('exams.activate', $exam) }}" class="sweet-confirm"
                              data-message="Yakin ingin memulai ujian ini? Anda tidak dapat edit atau hapus jika telah mulai">
                            @csrf
                            <button type="submit"
                                    class="px-4 py-2 text-sm font-medium rounded-lg bg-primary text-white hover:bg-ens-medium">
                                Launch
                            </button>
                        </form>
                    @elseif($exam->status === 'active')
                        <form method="POST" action="{{ route('exams.close', $exam) }}" class="sweet-confirm"
                              data-message="Yakin ingin menutup tryout?">
                            @csrf
                            <button type="submit"
                                    class="px-4 py-2 text-sm font-medium rounded-lg bg-red-600 text-white hover:bg-red-700">
                                Tutup
                            </button>
                        </form>

                        <a href="{{ route('exams.results', $exam) }}"
                           class="px-4 py-2 text-sm font-medium rounded-lg border bg-ens-light border-gray-300 dark:border-gray-700 text-white dark:text-gray-300 hover:text-black hover:bg-gray-50 dark:hover:bg-gray-700">
                            Hasil
                        </a>
                    @else
                        <a href="{{ route('exams.results', $exam) }}"
                           class="px-4 py-2 text-sm font-medium rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                            Pembahasan
                        </a>
                    @endif

                    @if(in_array($exam->status, ['inactive', 'closed']))
                        <form method="POST" action="{{ route('exams.destroy', $exam) }}" class="sweet-confirm"
                              data-message="Yakin ingin menghapus exam ini? Data akan diarsipkan.">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-4 py-2 text-sm font-medium rounded-lg bg-red-100 text-red-700 hover:bg-red-200 dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-900/50">
                                Hapus
                            </button>
                        </form>
                    @endif
                </div>
                @endrole
            </div>
        </div>

        {{-- INFO CARDS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Durasi</p>
                <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $exam->duration_minutes ?? '-' }} menit</p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Jumlah Soal</p>
                <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $exam->questions->count() }} soal</p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Tanggal Ujian</p>
                <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $exam->exam_date?->format('d M Y') ?? '-' }}</p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Jam Mulai</p>
                <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $exam->exam_date?->format('H:i') ?? '-' }} WITA</p>
            </div>
        </div>

        {{-- MAIN CONTENT --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                {{-- STUDENT VIEW --}}
                @role('siswa')
                    @cannot('view', $exam)
                        {{-- NO ACCESS --}}
                        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6 text-center">
                            <div class="text-lg font-medium text-gray-900 dark:text-white mb-2">Akses Dibatasi</div>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">Anda belum memiliki akses untuk mengikuti ujian ini.</p>
                            <a href="{{ route('browse.index') }}"
                               class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-ens-medium">
                                Lakukan Pembelian
                            </a>
                        </div>
                    @else
                        {{-- HAS ATTEMPTED --}}
                        @if($attempt && $attempt->is_submitted)
                            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6 mb-6">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Status Ujian</p>
                                        <p class="text-lg font-medium text-green-600 dark:text-green-400">Telah Diselesaikan</p>
                                    </div>
                                    <div class="bg-primary rounded-lg p-4">
                                        <p class="text-sm text-white mb-1">Skor Anda</p>
                                        <p class="text-2xl font-bold text-white">{{ $attempt->score }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('exams.result.student', $exam) }}"
                                   class="px-4 py-2.5 w-full text-center bg-primary text-white rounded-lg hover:bg-ens-medium">
                                    Lihat Hasil Lengkap
                                </a>
                            </div>
                        {{-- NOT ATTEMPTED --}}
                        @else
                            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                                @if($exam->status === 'active')
                                    @if($unmetPrerequisites->isNotEmpty())
                                        {{-- UNMET PREREQUISITES --}}
                                        <div class="mb-6">
                                            <div class="text-lg font-medium text-gray-900 dark:text-white mb-3">
                                                Prerequisite Belum Terpenuhi
                                            </div>
                                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                                Anda harus menyelesaikan tryout berikut terlebih dahulu:
                                            </p>
                                            <div class="space-y-2">
                                                @foreach($unmetPrerequisites as $req)
                                                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                                                        <span class="font-medium text-gray-700 dark:text-gray-300">{{ $req->title }}</span>
                                                        <span class="text-xs px-2 py-1 bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 rounded-full">
                                                            Belum Selesai
                                                        </span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @elseif(!$attempt)
                                        {{-- START EXAM --}}
                                        <div class="text-center py-4">
                                            <div class="text-xl font-bold text-gray-900 dark:text-white mb-3">Siap Mulai Ujian?</div>
                                            <p class="text-gray-600 dark:text-gray-400 mb-6">
                                                Durasi: {{ $exam->duration_minutes }} menit, {{ $exam->questions->count() }} soal
                                            </p>

                                            <form method="POST" action="{{ route('exams.start', $exam) }}"
                                                class="sweet-confirm"
                                                data-message="Yakin ingin mengerjakan? Anda tidak dapat reset waktu maupun mengulang ujian jika mulai mengerjakan">
                                                @csrf

                                                <div class="mb-4 max-w-xs mx-auto">
                                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                        Access Code
                                                    </label>
                                                    <input
                                                        type="text"
                                                        name="access_code"
                                                        required
                                                        maxlength="7"
                                                        autocomplete="off"
                                                        placeholder="Masukkan kode ujian"
                                                        class="w-full text-center font-mono uppercase px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700">
                                                </div>

                                                <button type="submit"
                                                        class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-ens-medium text-lg">
                                                    Mulai Ujian
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        {{-- CONTINUE EXAM --}}
                                        <div class="text-center py-4">
                                            <div class="text-xl font-bold text-gray-900 dark:text-white mb-3">Ujian dalam Progres</div>
                                            <p class="text-gray-600 dark:text-gray-400 mb-6">
                                                Anda memiliki ujian yang belum diselesaikan.
                                            </p>
                                            <a href="{{ route('exams.attempt', $exam) }}"
                                               class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-ens-medium text-lg">
                                                Lanjutkan Ujian
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    {{-- NOT ACTIVE --}}
                                    <div class="text-center py-4">
                                        <div class="text-lg font-medium text-gray-900 dark:text-white mb-2">Ujian Belum Tersedia</div>
                                        <p class="text-gray-600 dark:text-gray-400">
                                            Ujian ini {{ $exam->status === 'inactive' ? 'belum dimulai' : 'telah selesai' }}.
                                        </p>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endcannot
                @endrole
            </div>

            {{-- SIDEBAR --}}
            <div class="space-y-4">
                {{-- INFO PANEL --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                    <div class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Informasi</div>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Tipe Ujian</span>
                            <span class="text-sm font-medium">{{ $exam->type === 'tryout' ? 'Tryout' : 'Latihan' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Kategori</span>
                            <span class="text-sm font-medium">{{ strtoupper($exam->test_type) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Status</span>
                            @if($exam->status === 'inactive')
                                <span class="text-xs px-2 py-1 bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300 rounded-full">Belum Dimulai</span>
                            @elseif($exam->status === 'active')
                                <span class="text-xs px-2 py-1 bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300 rounded-full">Berlangsung</span>
                            @else
                                <span class="text-xs px-2 py-1 bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300 rounded-full">Selesai</span>
                            @endif
                        </div>
                        @role('admin|tentor')
                        <div class="flex justify-between items-center pt-2 border-t border-gray-200 dark:border-gray-700">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Access Code</span>
                            <div class="flex items-center gap-2">
                                <span class="font-mono text-sm text-primary dark:text-blue-300">
                                    {{ $exam->access_code }}
                                </span>
                                <button onclick="navigator.clipboard.writeText('{{ $exam->access_code }}')"
                                        class="text-xs text-gray-500 hover:text-primary">
                                    Copy
                                </button>
                            </div>
                        </div>
                        @endrole
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
