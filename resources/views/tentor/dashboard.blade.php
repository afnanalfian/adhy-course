@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-6 p-4">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-white">
                Tentor Dashboard
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                Welcome back, {{ auth()->user()->name }}! Manage your teaching activities.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <span class="px-4 py-2 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-300 rounded-lg font-medium">
                {{ now()->format('d M Y') }}
            </span>
        </div>
    </div>

    {{-- ================= STATS CARDS ================= --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-xl p-5 border border-blue-200 dark:border-blue-700/30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-blue-600 dark:text-blue-400 font-medium">Total Courses</p>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">
                        {{ $stats['total_courses'] }}
                    </h3>
                </div>
                <div class="p-3 bg-blue-100 dark:bg-blue-800/30 rounded-lg">
                    <span class="text-xl">📚</span>
                </div>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Courses you teach</p>
        </div>

        <div class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 rounded-xl p-5 border border-purple-200 dark:border-purple-700/30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-purple-600 dark:text-purple-400 font-medium">Total Meetings</p>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">
                        {{ $stats['total_meetings'] }}
                    </h3>
                </div>
                <div class="p-3 bg-purple-100 dark:bg-purple-800/30 rounded-lg">
                    <span class="text-xl">🎯</span>
                </div>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">All meetings created</p>
        </div>

        <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 rounded-xl p-5 border border-green-200 dark:border-green-700/30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-green-600 dark:text-green-400 font-medium">Live Now</p>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">
                        {{ $stats['live_meetings'] }}
                    </h3>
                </div>
                <div class="p-3 bg-green-100 dark:bg-green-800/30 rounded-lg">
                    <span class="text-xl">🔴</span>
                </div>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Active meetings</p>
        </div>

        <div class="bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 rounded-xl p-5 border border-orange-200 dark:border-orange-700/30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-orange-600 dark:text-orange-400 font-medium">Attendance This Week</p>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">
                        {{ $totalAttendance }}
                    </h3>
                </div>
                <div class="p-3 bg-orange-100 dark:bg-orange-800/30 rounded-lg">
                    <span class="text-xl">👥</span>
                </div>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Students attended</p>
        </div>
    </div>

    {{-- ================= COURSES YOU TEACH ================= --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Courses</h3>
            <a href="{{ route('course.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">View all</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @forelse($coursesTaught as $course)
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 rounded-xl p-4 border border-gray-200 dark:border-gray-700 hover:border-purple-300 dark:hover:border-purple-600 transition cursor-pointer"
                     onclick="window.location='{{ route('course.show', $course->slug) }}'">
                    <div class="h-32 bg-gray-200 dark:bg-gray-700 rounded-lg mb-3 flex items-center justify-center">
                        @if($course->thumbnail)
                            <img src="{{ asset($course->thumbnail) }}" alt="{{ $course->name }}" class="h-full w-full object-cover rounded-lg">
                        @else
                            <span class="text-4xl">📘</span>
                        @endif
                    </div>
                    <h4 class="font-semibold text-gray-800 dark:text-white truncate">{{ $course->name }}</h4>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $course->meetings_count }} meetings</p>
                </div>
            @empty
                <div class="col-span-4 py-8 text-center text-gray-500 dark:text-gray-400">
                    <div class="flex flex-col items-center justify-center">
                        <span class="text-3xl mb-3">📚</span>
                        <p>No courses assigned yet</p>
                        <a href="{{ route('course.index') }}" class="mt-2 text-blue-600 dark:text-blue-400 hover:underline">Browse courses</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    {{-- ================= TABLES ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- MEETINGS THIS WEEK --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Meetings This Week</h3>
                <span class="text-sm text-gray-500">{{ $weeklyMeetings->count() }} meetings</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th class="text-left py-3 px-4 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Meeting</th>
                            <th class="text-left py-3 px-4 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Course</th>
                            <th class="text-left py-3 px-4 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="text-left py-3 px-4 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($weeklyMeetings as $meeting)
                            <tr class="border-b border-gray-100 dark:border-gray-700/50 hover:bg-gray-50 dark:hover:bg-gray-700/30 cursor-pointer transition"
                                onclick="window.location='{{ route('meeting.show', $meeting) }}'">
                                <td class="py-3 px-4">
                                    <div class="font-medium text-gray-800 dark:text-white">{{ $meeting->title }}</div>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ $meeting->course->name ?? '-' }}</div>
                                </td>
                                <td class="py-3 px-4">
                                    @php
                                        $statusColors = [
                                            'live' => 'bg-green-100 text-green-800 dark:bg-green-500/20 dark:text-green-300',
                                            'upcoming' => 'bg-blue-100 text-blue-800 dark:bg-blue-500/20 dark:text-blue-300',
                                            'done' => 'bg-gray-100 text-gray-800 dark:bg-gray-500/20 dark:text-gray-300',
                                            'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-500/20 dark:text-red-300'
                                        ];
                                        $color = $statusColors[$meeting->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="px-3 py-1 text-xs font-medium rounded-full {{ $color }}">
                                        {{ ucfirst($meeting->status) }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $meeting->scheduled_at->format('d M H:i') }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-gray-500 dark:text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <span class="text-2xl mb-2">📅</span>
                                        No meetings this week
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- RIGHT COLUMN --}}
        <div class="space-y-6">
            {{-- UPCOMING MEETINGS --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Upcoming Meetings</h3>
                    <span class="px-3 py-1 bg-blue-100 dark:bg-blue-500/20 text-blue-800 dark:text-blue-300 text-sm font-medium rounded-full">
                        {{ $upcomingMeetings->count() }} upcoming
                    </span>
                </div>

                <div class="space-y-3">
                    @forelse($upcomingMeetings as $meeting)
                        <div class="flex items-center justify-between p-3 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">
                            <div>
                                <h4 class="font-medium text-gray-800 dark:text-white">{{ $meeting->title }}</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $meeting->course->name ?? 'No Course' }} •
                                    {{ $meeting->scheduled_at->format('d M H:i') }}
                                </p>
                            </div>
                            <a href="{{ route('meeting.show', $meeting) }}" class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition">
                                View
                            </a>
                        </div>
                    @empty
                        <div class="text-center py-4 text-gray-500 dark:text-gray-400">
                            <span class="text-2xl mb-2 block">📅</span>
                            No upcoming meetings
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- RECENT STUDENTS --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Recent Students</h3>
                    <span class="px-3 py-1 bg-purple-100 dark:bg-purple-500/20 text-purple-800 dark:text-purple-300 text-sm font-medium rounded-full">
                        {{ $recentStudents->count() }} attended
                    </span>
                </div>

                <div class="space-y-3">
                    @forelse($recentStudents as $student)
                        <div class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">
                            <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                <span class="text-lg">👤</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-medium text-gray-800 dark:text-white truncate">{{ $student->name }}</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $student->email }}</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                    Attended {{ \Carbon\Carbon::parse($student->attended_at)->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-gray-500 dark:text-gray-400">
                            <span class="text-2xl mb-2 block">👥</span>
                            No attendance yet
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
    tr {
        transition: background-color 0.2s ease;
    }

    .overflow-x-auto::-webkit-scrollbar {
        height: 6px;
    }

    .overflow-x-auto::-webkit-scrollbar-track {
        @apply bg-gray-100 dark:bg-gray-700;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb {
        @apply bg-gray-300 dark:bg-gray-600 rounded-full;
    }
</style>
@endpush
