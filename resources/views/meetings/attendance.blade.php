@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Tombol Kembali --}}
    <div class="mb-4">
        <a href="{{ route('meeting.show', $meeting) }}" 
           class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>
    </div>

    {{-- Card --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 sm:p-8">
        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Absensi Pertemuan</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                {{ $meeting->title }}
            </p>
            @if($meeting->scheduled_at)
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">
                    {{ $meeting->scheduled_at->translatedFormat('l, d F Y • H:i') }} WITA
                </p>
            @endif
        </div>

        {{-- Statistik --}}
        @php
            $total = $eligibleStudents->total();
            $hadir = $attendances->where('is_present', true)->count();
            $tidakHadir = $total - $hadir;
        @endphp

        <div class="grid grid-cols-3 gap-3 mb-6">
            <div class="text-center p-3 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800">
                <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $hadir }}</p>
                <p class="text-xs text-green-700 dark:text-green-300">Hadir</p>
            </div>
            <div class="text-center p-3 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800">
                <p class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $tidakHadir }}</p>
                <p class="text-xs text-red-700 dark:text-red-300">Tidak Hadir</p>
            </div>
            <div class="text-center p-3 rounded-xl bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800">
                <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $total }}</p>
                <p class="text-xs text-blue-700 dark:text-blue-300">Total</p>
            </div>
        </div>

        {{-- Search --}}
        <form method="GET" action="{{ route('meeting.attendance.index', $meeting) }}" class="mb-6">
            <div class="flex gap-2">
                <input type="text"
                       name="search"
                       value="{{ $search }}"
                       placeholder="Cari nama siswa..."
                       class="flex-1 px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition">
                <button type="submit"
                        class="px-5 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-xl transition">
                    Cari
                </button>
                @if($search)
                    <a href="{{ route('meeting.attendance.index', $meeting) }}"
                       class="px-5 py-2.5 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-xl transition">
                        Reset
                    </a>
                @endif
            </div>
        </form>

        {{-- Form Absensi --}}
        <form method="POST" action="{{ route('meeting.attendance.store', $meeting) }}">
            @csrf

            {{-- Action Bar --}}
            <div class="flex flex-wrap items-center justify-between gap-3 mb-4 p-3 bg-gray-50 dark:bg-gray-900/50 rounded-xl">
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $eligibleStudents->count() }} siswa ditampilkan
                </span>
                <div class="flex gap-2">
                    <button type="button"
                            onclick="checkAll()"
                            class="px-3 py-1.5 text-sm text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/20 rounded-lg transition">
                        ✓ Semua Hadir
                    </button>
                    <button type="button"
                            onclick="uncheckAll()"
                            class="px-3 py-1.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition">
                        ✗ Semua Tidak
                    </button>
                </div>
            </div>

            {{-- List Siswa --}}
            <div class="space-y-2 mb-6">
                @forelse ($eligibleStudents as $student)
                    @php
                        $attendance = $attendances[$student->id] ?? null;
                        $checked = optional($attendance)->is_present ? 'checked' : '';
                    @endphp

                    <label class="flex items-center gap-4 p-3 rounded-xl border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900/50 transition cursor-pointer">
                        <input type="checkbox"
                               name="attendances[{{ $student->id }}]"
                               value="1"
                               {{ $checked }}
                               class="h-5 w-5 rounded border-gray-300 dark:border-gray-600 text-purple-600 focus:ring-purple-500">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $student->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $student->email }}</p>
                        </div>
                        @if($attendance)
                            <span class="text-xs text-gray-400 dark:text-gray-500">
                                {{ optional($attendance->marked_at)->format('H:i') }}
                            </span>
                        @endif
                    </label>
                @empty
                    <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                        @if($search)
                            Tidak ditemukan siswa dengan nama "{{ $search }}"
                        @else
                            Belum ada siswa terdaftar
                        @endif
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($eligibleStudents->hasPages())
                <div class="mb-6">
                    {{ $eligibleStudents->withQueryString()->links() }}
                </div>
            @endif

            {{-- Submit --}}
            <div class="flex gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('meeting.show', $meeting) }}"
                   class="px-5 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition">
                    Batal
                </a>
                <button type="submit"
                        class="flex-1 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-xl transition">
                    Simpan Absensi
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function checkAll() {
        document.querySelectorAll('input[name^="attendances["]').forEach(cb => cb.checked = true);
    }

    function uncheckAll() {
        document.querySelectorAll('input[name^="attendances["]').forEach(cb => cb.checked = false);
    }
</script>
@endpush