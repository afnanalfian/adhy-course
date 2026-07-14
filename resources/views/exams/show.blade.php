@extends('layouts.app')

@section('title', $exam->title.' | Tryout ENS Makassar')
@section('description', 'Ikuti tryout '.$exam->title.' lengkap dengan pembahasan.')

@section('content')
<div class="max-w-6xl mx-auto">
    {{-- Back Button --}}
    <div class="mb-4">
        <a href="{{ $exam->backRoute() }}" 
           class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Daftar Ujian
        </a>
    </div>

    {{-- Hero Section --}}
    <div class="relative mb-8 overflow-hidden rounded-2xl bg-gradient-to-r from-purple-600 via-blue-600 to-pink-600 p-8 md:p-10">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute -top-20 -right-20 w-64 h-64 bg-white rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-white rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>
        
        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div>
                <div class="flex flex-wrap items-center gap-2 mb-3">
                    <span class="text-xs font-medium px-3 py-1 rounded-full bg-white/20 text-white backdrop-blur-sm">
                        {{ strtoupper($exam->test_type) }}
                    </span>
                    @if($exam->status === 'inactive')
                        <span class="text-xs font-medium px-3 py-1 rounded-full bg-yellow-500/30 text-yellow-100 backdrop-blur-sm">
                            ⏳ Belum Dimulai
                        </span>
                    @elseif($exam->status === 'active')
                        <span class="text-xs font-medium px-3 py-1 rounded-full bg-green-500/30 text-green-100 backdrop-blur-sm animate-pulse">
                            🔴 Berlangsung
                        </span>
                    @else
                        <span class="text-xs font-medium px-3 py-1 rounded-full bg-gray-500/30 text-gray-200 backdrop-blur-sm">
                            ✅ Selesai
                        </span>
                    @endif
                </div>

                <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">
                    {{ $exam->title }}
                </h1>

                @if($exam->exam_date)
                    <div class="flex flex-wrap items-center gap-4 text-white/80 text-sm">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ $exam->exam_date->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ $exam->exam_date->format('H:i') }} WITA</span>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Admin Actions --}}
            @role('admin|tentor')
            <div class="flex flex-wrap gap-2">
                @if($exam->status === 'inactive')
                    <a href="{{ route('exams.edit', $exam) }}"
                       class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white/90 backdrop-blur-sm rounded-xl hover:bg-white transition shadow-lg">
                        ✏️ Edit
                    </a>
                    <form method="POST" action="{{ route('exams.activate', $exam) }}" class="sweet-confirm"
                          data-message="Yakin ingin memulai ujian ini?">
                        @csrf
                        <button type="submit"
                                class="px-5 py-2.5 text-sm font-medium text-white bg-green-500 rounded-xl hover:bg-green-600 transition shadow-lg">
                            🚀 Launch
                        </button>
                    </form>
                @elseif($exam->status === 'active')
                    <form method="POST" action="{{ route('exams.close', $exam) }}" class="sweet-confirm"
                          data-message="Yakin ingin menutup tryout?">
                        @csrf
                        <button type="submit"
                                class="px-5 py-2.5 text-sm font-medium text-white bg-red-500 rounded-xl hover:bg-red-600 transition shadow-lg">
                            ⏹ Tutup
                        </button>
                    </form>
                    <a href="{{ route('exams.results', $exam) }}"
                       class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white/90 backdrop-blur-sm rounded-xl hover:bg-white transition shadow-lg">
                        📊 Hasil
                    </a>
                @else
                    <a href="{{ route('exams.results', $exam) }}"
                       class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white/90 backdrop-blur-sm rounded-xl hover:bg-white transition shadow-lg">
                        📊 Pembahasan
                    </a>
                @endif

                @if(in_array($exam->status, ['inactive', 'closed']))
                    <form method="POST" action="{{ route('exams.destroy', $exam) }}" class="sweet-confirm"
                          data-message="Yakin ingin menghapus exam ini?">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-5 py-2.5 text-sm font-medium text-red-600 bg-white/90 backdrop-blur-sm rounded-xl hover:bg-white transition shadow-lg">
                            🗑 Hapus
                        </button>
                    </form>
                @endif
            </div>
            @endrole
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-5 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
            <div class="w-10 h-10 mx-auto mb-2 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $exam->duration_minutes ?? '-' }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">Menit</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-5 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
            <div class="w-10 h-10 mx-auto mb-2 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $exam->questions->count() }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">Soal</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-5 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
            <div class="w-10 h-10 mx-auto mb-2 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $exam->exam_date?->format('d M Y') ?? '-' }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">Tanggal</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-5 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
            <div class="w-10 h-10 mx-auto mb-2 rounded-full bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center">
                <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $exam->exam_date?->format('H:i') ?? '-' }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">WITA</p>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left / Main --}}
        <div class="lg:col-span-2">
            @role('siswa')
                @cannot('view', $exam)
                    {{-- No Access --}}
                    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-8 text-center">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">🔒 Akses Dibatasi</h3>
                        <p class="text-gray-500 dark:text-gray-400 mb-6">Anda belum memiliki akses untuk mengikuti ujian ini. Silakan lakukan pembelian terlebih dahulu.</p>
                        <a href="{{ route('browse.index') }}"
                           class="inline-block px-6 py-3 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition shadow-lg shadow-purple-500/30">
                            🛒 Lakukan Pembelian
                        </a>
                    </div>
                @else
                    @if($attempt && $attempt->is_submitted)
                        {{-- Has Attempted --}}
                        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-sm font-medium text-green-600 dark:text-green-400">✅ Selesai</span>
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Ujian telah diselesaikan</p>
                                </div>
                                <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl px-8 py-4 text-center shadow-lg shadow-purple-500/30">
                                    <p class="text-xs text-white/80 mb-0.5">Skor Anda</p>
                                    <p class="text-3xl font-bold text-white">{{ $attempt->score }}</p>
                                </div>
                            </div>
                            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <a href="{{ route('exams.result.student', $exam) }}"
                                   class="block w-full text-center px-6 py-3 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition shadow-lg shadow-purple-500/30">
                                    📊 Lihat Hasil Lengkap
                                </a>
                            </div>
                        </div>
                    @else
                        {{-- Not Attempted --}}
                        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6">
                            @if($exam->status === 'active')
                                @if($unmetPrerequisites->isNotEmpty())
                                    {{-- Unmet Prerequisites --}}
                                    <div class="text-center py-4">
                                        <div class="flex items-center justify-center gap-2 mb-3">
                                            <span class="text-2xl">📋</span>
                                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Prerequisite Belum Terpenuhi</h3>
                                        </div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                                            Anda harus menyelesaikan tryout berikut terlebih dahulu:
                                        </p>
                                        <div class="space-y-3 text-left max-w-md mx-auto">
                                            @foreach($unmetPrerequisites as $req)
                                                <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl border border-gray-200 dark:border-gray-700">
                                                    <span class="font-medium text-gray-700 dark:text-gray-300">{{ $req->title }}</span>
                                                    <span class="text-xs px-3 py-1 bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 rounded-full">
                                                        ⏳ Belum Selesai
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @elseif(!$attempt)
                                    {{-- Start Exam --}}
                                    <div class="text-center py-4">
                                        <div class="flex items-center justify-center gap-2 mb-3">
                                            <span class="text-3xl">🚀</span>
                                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Siap Mulai Ujian?</h3>
                                        </div>
                                        <div class="flex justify-center gap-6 mb-6 text-sm">
                                            <div class="text-center">
                                                <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $exam->duration_minutes }}</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Menit</p>
                                            </div>
                                            <div class="text-center">
                                                <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $exam->questions->count() }}</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Soal</p>
                                            </div>
                                        </div>
                                        <form method="POST" action="{{ route('exams.start', $exam) }}"
                                              class="max-w-sm mx-auto sweet-confirm"
                                              data-message="Yakin ingin mengerjakan? Anda tidak dapat mengulang ujian jika sudah mulai.">
                                            @csrf
                                            <div class="mb-4">
                                                <input type="text"
                                                       name="access_code"
                                                       required
                                                       maxlength="7"
                                                       placeholder="Masukkan Access Code"
                                                       class="w-full text-center font-mono uppercase tracking-widest px-4 py-3 rounded-xl border-2 border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/20 outline-none transition text-lg">
                                            </div>
                                            <button type="submit"
                                                    class="w-full px-6 py-3.5 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-xl hover:from-purple-700 hover:to-pink-700 transition shadow-lg shadow-purple-500/30 text-lg font-medium">
                                                Mulai Ujian →
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    {{-- Continue Exam --}}
                                    <div class="text-center py-8">
                                        <div class="flex items-center justify-center gap-2 mb-3">
                                            <span class="text-3xl">⏳</span>
                                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Ujian dalam Progres</h3>
                                        </div>
                                        <p class="text-gray-500 dark:text-gray-400 mb-6">Anda memiliki ujian yang belum diselesaikan.</p>
                                        <a href="{{ route('exams.attempt', $exam) }}"
                                           class="inline-block px-8 py-3.5 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-xl hover:from-purple-700 hover:to-pink-700 transition shadow-lg shadow-purple-500/30 text-lg font-medium">
                                            ⏩ Lanjutkan Ujian
                                        </a>
                                    </div>
                                @endif
                            @else
                                {{-- Not Active --}}
                                <div class="text-center py-8">
                                    <span class="text-4xl mb-3 block">📅</span>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Ujian Belum Tersedia</h3>
                                    <p class="text-gray-500 dark:text-gray-400">
                                        Ujian ini {{ $exam->status === 'inactive' ? 'belum dimulai' : 'telah selesai' }}.
                                    </p>
                                </div>
                            @endif
                        </div>
                    @endif
                @endcannot
            @endrole
        </div>

        {{-- Sidebar --}}
        <div class="space-y-4">
            {{-- Info Panel --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-5">
                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-4 flex items-center gap-2">
                    <span>📋</span> Informasi Ujian
                </h4>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-gray-500 dark:text-gray-400">Tipe</span>
                        <span class="font-medium text-gray-900 dark:text-white capitalize">{{ $exam->type }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-gray-500 dark:text-gray-400">Kategori</span>
                        <span class="font-medium text-gray-900 dark:text-white uppercase">{{ $exam->test_type }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-gray-500 dark:text-gray-400">Status</span>
                        @if($exam->status === 'inactive')
                            <span class="text-xs px-3 py-1 bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400 rounded-full">⏳ Belum</span>
                        @elseif($exam->status === 'active')
                            <span class="text-xs px-3 py-1 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 rounded-full animate-pulse">🔴 Aktif</span>
                        @else
                            <span class="text-xs px-3 py-1 bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400 rounded-full">✅ Selesai</span>
                        @endif
                    </div>
                    @role('admin|tentor')
                    <div class="flex justify-between items-center pt-2 border-t border-gray-200 dark:border-gray-700">
                        <span class="text-gray-500 dark:text-gray-400">Access Code</span>
                        <div class="flex items-center gap-2">
                            <span class="font-mono text-sm font-bold text-purple-600 dark:text-purple-400 tracking-wider">{{ $exam->access_code }}</span>
                            <button onclick="navigator.clipboard.writeText('{{ $exam->access_code }}')"
                                    class="text-xs text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 transition p-1 hover:bg-purple-50 dark:hover:bg-purple-900/30 rounded">
                                📋
                            </button>
                        </div>
                    </div>
                    @endrole
                </div>
            </div>

            {{-- Quick Stats --}}
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl p-5 text-white">
                <h4 class="text-sm font-medium text-white/80 mb-3">📊 Statistik</h4>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-white/70">Total Peserta</span>
                        <span class="font-bold">{{ $exam->attempts->count() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-white/70">Rata-rata Skor</span>
                        <span class="font-bold">{{ $exam->attempts->avg('score') ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-white/70">Tertinggi</span>
                        <span class="font-bold">{{ $exam->attempts->max('score') ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection