@extends('layouts.app')

@section('content')
@php
    use Carbon\Carbon;

    $current = Carbon::create($year, $month, 1);
    $start   = $current->copy()->startOfWeek(Carbon::MONDAY);
    $end     = $current->copy()->endOfMonth()->endOfWeek(Carbon::SUNDAY);

    $prev = $current->copy()->subMonth();
    $next = $current->copy()->addMonth();

    $courseColors = [];
    $palette = [
        'bg-blue-500',
        'bg-green-500',
        'bg-purple-500',
        'bg-pink-500',
        'bg-indigo-500',
        'bg-teal-500',
        'bg-orange-500',
    ];
@endphp

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-azwara-darker dark:text-gray-100">
                Jadwal Meeting
            </h1>

            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ $current->translatedFormat('F Y') }}
            </p>
        </div>

        <div class="flex flex-wrap gap-2">
            <a href="{{ route('schedule.index', ['month' => $prev->month, 'year' => $prev->year]) }}"
               class="px-4 py-2 rounded-lg text-sm
                      bg-azwara-lightest dark:bg-gray-800 dark:text-azwara-lightest
                      border border-gray-200 dark:border-gray-700
                      hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                ← Sebelumnya
            </a>

            <a href="{{ route('schedule.index', ['month' => now()->month, 'year' => now()->year]) }}"
               class="px-4 py-2 rounded-lg text-sm font-medium
                      bg-primary text-white hover:opacity-90 transition">
                Bulan Ini
            </a>

            <a href="{{ route('schedule.index', ['month' => $next->month, 'year' => $next->year]) }}"
               class="px-4 py-2 rounded-lg text-sm
                      bg-azwara-lightest dark:bg-gray-800 dark:text-azwara-lightest
                      border border-gray-200 dark:border-gray-700
                      hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                Selanjutnya →
            </a>
        </div>
    </div>

    {{-- CALENDAR WRAPPER (SCROLL FIX) --}}
    <div class="relative">
        <div class="overflow-x-auto overflow-y-visible pb-4">
            <div class="min-w-[900px] md:min-w-0">

                {{-- DAY HEADERS --}}
                <div class="grid grid-cols-7 gap-px
                            rounded-t-xl overflow-hidden
                            bg-gray-200 dark:bg-gray-700">
                    @foreach (['Sen','Sel','Rab','Kam','Jum','Sab','Min'] as $day)
                        <div class="bg-azwara-darker dark:bg-gray-800
                                    text-center py-3 text-sm font-semibold
                                    text-azwara-lightest dark:text-gray-300">
                            {{ $day }}
                        </div>
                    @endforeach
                </div>

                {{-- DATES GRID --}}
                <div class="grid grid-cols-7 gap-px
                            rounded-b-xl overflow-hidden
                            bg-gray-200 dark:bg-gray-700">

                    @for ($date = $start->copy(); $date <= $end; $date->addDay())
                        @php
                            $dateKey = $date->format('Y-m-d');
                            $isCurrentMonth = $date->month === $current->month;
                        @endphp

                        <div class="min-h-[140px] p-2
                                    bg-azwara-lightest dark:bg-gray-900
                                    flex flex-col
                                    {{ $isCurrentMonth ? '' : 'opacity-40' }}">

                            {{-- DATE --}}
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-xs font-semibold
                                    {{ $date->isToday()
                                        ? 'text-primary'
                                        : 'text-gray-500 dark:text-gray-400' }}">
                                    {{ $date->day }}
                                    @if($date->isToday())
                                        <span class="absolute -top-1 -right-1 w-2 h-2 bg-primary rounded-full"></span>
                                    @endif
                                </span>
                            </div>

                            {{-- MEETINGS / TRYOUTS --}}
                            <div class="space-y-1 overflow-y-auto">
                                @foreach ($items[$dateKey] ?? [] as $item)
                                    @php
                                        if ($item['type'] === 'meeting') {
                                            $courseId = $item['course_id'];

                                            if (! isset($courseColors[$courseId])) {
                                                $courseColors[$courseId] =
                                                    $palette[count($courseColors) % count($palette)];
                                            }

                                            $bgClass = $courseColors[$courseId];
                                        } else {
                                            // TRYOUT → MERAH FIX
                                            $bgClass = 'bg-red-600';
                                        }
                                    @endphp

                                    <a href="{{ $item['url'] }}"
                                    class="block text-xs text-white rounded-md px-2 py-1
                                            {{ $bgClass }}
                                            hover:opacity-90 transition">

                                        <div class="font-semibold truncate">
                                            {{ $item['title'] }}
                                        </div>

                                        <div class="opacity-90 flex items-center justify-between">
                                            <span>{{ $item['time']->format('H:i') }}</span>

                                            @if ($item['type'] === 'tryout')
                                                <span class="ml-2 text-[10px] uppercase tracking-wide font-bold">
                                                    📝
                                                </span>
                                            @endif
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endfor

                </div>
            </div>
        </div>

        {{-- MOBILE SCROLL HINT --}}
        <div class="md:hidden text-xs text-gray-500 dark:text-gray-400 mt-2">
            Geser ke samping untuk melihat jadwal lengkap →
        </div>
    </div>
</div>
@endsection
