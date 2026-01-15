@extends('layouts.app')

@section('content')
@php
    use Carbon\Carbon;
    $current = Carbon::create($year, $month, 1);
    $prev = $current->copy()->subMonth();
    $next = $current->copy()->addMonth();

    $start = $current->copy()->startOfWeek(Carbon::MONDAY);
    $end = $current->copy()->endOfMonth()->endOfWeek(Carbon::SUNDAY);
@endphp

<div class="space-y-6">
    {{-- HEADER --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-lg bg-gray-100 dark:bg-gray-700">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-900 dark:text-white">Jadwal Akademik</h1>
                    <div class="flex items-center gap-3 mt-1">
                        <span class="text-lg font-semibold text-primary">
                            {{ $current->translatedFormat('F Y') }}
                        </span>
                        @if($current->isCurrentMonth())
                        <span class="text-xs font-medium px-2 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                            Bulan Ini
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('schedule.index', ['month' => $prev->month, 'year' => $prev->year]) }}"
                   class="px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    {{ $prev->translatedFormat('M') }}
                </a>

                <a href="{{ route('schedule.index', ['month' => now()->month, 'year' => now()->year]) }}"
                   class="px-4 py-2.5 rounded-lg bg-primary text-white hover:bg-ens-medium transition">
                    Hari Ini
                </a>

                <a href="{{ route('schedule.index', ['month' => $next->month, 'year' => $next->year]) }}"
                   class="px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    {{ $next->translatedFormat('M') }}
                </a>
            </div>
        </div>
    </div>

    {{-- CALENDAR --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
        {{-- Day Headers --}}
        <div class="grid grid-cols-7 border-b border-gray-200 dark:border-gray-700">
            @foreach (['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'] as $day)
                <div class="p-3 text-center">
                    <div class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $day }}</div>
                </div>
            @endforeach
        </div>

        {{-- Calendar Grid --}}
        <div class="grid grid-cols-7">
            @for ($date = $start->copy(); $date <= $end; $date->addDay())
                @php
                    $dateKey = $date->format('Y-m-d');
                    $isCurrentMonth = $date->month === $current->month;
                    $isToday = $date->isToday();
                    $isWeekend = $date->isWeekend();
                    $events = $items[$dateKey] ?? [];
                @endphp

                <div class="min-h-[120px] p-2 border-r border-b border-gray-100 dark:border-gray-700
                         {{ !$isCurrentMonth ? 'bg-gray-50 dark:bg-gray-900' : '' }}
                         {{ $isWeekend ? 'bg-gray-50/50 dark:bg-gray-900/50' : '' }}">

                    {{-- Date --}}
                    <div class="mb-2">
                        <div class="inline-flex items-center justify-center w-7 h-7 text-sm font-medium
                                    {{ $isToday
                                       ? 'bg-primary text-white rounded-full'
                                       : 'text-gray-700 dark:text-gray-300' }}">
                            {{ $date->day }}
                        </div>
                    </div>

                    {{-- Events --}}
                    <div class="space-y-1">
                        @foreach ($events as $item)
                            <a href="{{ $item['url'] }}"
                               class="block p-2 rounded text-xs truncate
                                      {{ $item['type'] === 'meeting'
                                         ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300'
                                         : 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300' }}">
                                <div class="font-medium truncate">{{ $item['title'] }}</div>
                                <div class="flex items-center gap-1 mt-0.5">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $item['time']->format('H:i') }}</span>
                                </div>
                            </a>
                        @endforeach

                        @if(count($events) === 0 && $isCurrentMonth)
                            <div class="text-xs text-gray-400 dark:text-gray-500 p-2">-</div>
                        @endif
                    </div>
                </div>
            @endfor
        </div>
    </div>

    {{-- LEGEND --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
        <div class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Legenda</div>
        <div class="flex flex-wrap gap-4">
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                <span class="text-xs text-gray-600 dark:text-gray-400">Kelas</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                <span class="text-xs text-gray-600 dark:text-gray-400">Tryout</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-primary"></div>
                <span class="text-xs text-gray-600 dark:text-gray-400">Hari Ini</span>
            </div>
        </div>
    </div>
</div>
@endsection
