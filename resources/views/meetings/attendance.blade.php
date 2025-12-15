@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- =====================
        HEADER
    ====================== --}}
    <div>
        <h1 class="text-2xl font-bold text-azwara-darker dark:text-azwara-lighter">
            Absensi Pertemuan
        </h1>

        <p class="mt-1 text-gray-600 dark:text-gray-300">
            {{ $meeting->title }}
        </p>

        @if ($meeting->scheduled_at)
            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ $meeting->scheduled_at
                    ->timezone('Asia/Jakarta')
                    ->translatedFormat('l, d F Y • H:i') }} WIB
            </p>
        @endif
    </div>

    {{-- =====================
        FORM
    ====================== --}}
    <form method="POST"
          action="{{ route('meeting.attendance.store', $meeting) }}"
          class="space-y-4
                 bg-azwara-lightest dark:bg-secondary/80
                 p-6 rounded-2xl
                 border border-azwara-light/30 dark:border-white/10">

        @csrf

        {{-- =====================
            LIST SISWA
            (SINGLE CHECKBOX / USER)
        ====================== --}}
        @forelse ($students as $i => $student)
            @php
                $attendance = $attendances[$student->id] ?? null;
            @endphp

            <div
                class="flex items-center justify-between
                       p-4 rounded-xl
                       border border-gray-200 dark:border-white/10
                       bg-white dark:bg-secondary
                       hover:bg-azwara-lighter dark:hover:bg-azwara-lightest/5
                       transition
                       md:grid md:grid-cols-12 md:gap-4">

                {{-- NO (DESKTOP) --}}
                <div class="hidden md:block md:col-span-1 text-sm text-gray-500">
                    {{ $i + 1 }}
                </div>

                {{-- NAMA --}}
                <div class="md:col-span-9 min-w-0">
                    <p class="font-medium text-gray-800 dark:text-gray-100 truncate">
                        {{ $student->name }}
                    </p>
                    <p class="text-xs text-gray-500 md:hidden">
                        Siswa
                    </p>
                </div>

                {{-- CHECKBOX --}}
                <div class="md:col-span-2 flex justify-end">
                    <input type="checkbox"
                           name="attendances[{{ $student->id }}]"
                           value="1"
                           @checked(optional($attendance)->is_present)
                           class="h-5 w-5 rounded
                                  border-gray-300
                                  text-primary
                                  focus:ring-primary">
                </div>
            </div>
        @empty
            <div class="py-8 text-center text-gray-500 dark:text-gray-400">
                Tidak ada siswa terdaftar.
            </div>
        @endforelse

        {{-- =====================
            ACTION
        ====================== --}}
        <div class="flex flex-col sm:flex-row
                    items-stretch sm:items-center
                    justify-end gap-3 pt-4
                    border-t border-gray-200 dark:border-white/10">

            <a href="{{ route('meeting.show', $meeting) }}"
               class="px-4 py-2 rounded-lg
                      text-center
                      text-gray-600 dark:text-gray-300
                      hover:bg-azwara-lighter dark:hover:bg-azwara-lightest/5">
                Kembali
            </a>

            <button type="submit"
                    class="px-6 py-2 rounded-lg
                           bg-primary text-white
                           hover:bg-primary/90
                           transition">
                Simpan Absensi
            </button>
        </div>
    </form>
</div>
@endsection
