<x-toggle-section title="📝 Absensi">

    @if($meeting->attendances->isEmpty())
        {{-- No Attendance State --}}
        <div class="mt-4 text-center py-8">
            <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada absensi</p>
            <a href="{{ route('meeting.attendance.index', $meeting) }}"
               class="inline-block mt-3 px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-xl hover:bg-purple-700 transition">
                Buat Absensi
            </a>
        </div>
    @else
        @php
            $hadir = $meeting->attendances->where('is_present', true);
            $total = $meeting->attendances->count();
            $percentage = $total > 0 ? round(($hadir->count() / $total) * 100) : 0;
        @endphp

        <div class="mt-4 space-y-4">
            {{-- Stats --}}
            <div class="grid grid-cols-3 gap-3">
                <div class="text-center p-3 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800">
                    <p class="text-xl font-bold text-green-600 dark:text-green-400">{{ $hadir->count() }}</p>
                    <p class="text-xs text-green-700 dark:text-green-300">Hadir</p>
                </div>
                <div class="text-center p-3 rounded-xl bg-gray-50 dark:bg-gray-900/20 border border-gray-200 dark:border-gray-700">
                    <p class="text-xl font-bold text-gray-600 dark:text-gray-400">{{ $total }}</p>
                    <p class="text-xs text-gray-600 dark:text-gray-400">Total</p>
                </div>
                <div class="text-center p-3 rounded-xl bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800">
                    <p class="text-xl font-bold text-purple-600 dark:text-purple-400">{{ $percentage }}%</p>
                    <p class="text-xs text-purple-700 dark:text-purple-300">Kehadiran</p>
                </div>
            </div>

            {{-- List Hadir --}}
            @if($hadir->isNotEmpty())
                <div class="space-y-1.5">
                    @foreach($hadir as $att)
                        <div class="flex items-center justify-between p-2.5 rounded-xl bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700">
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $att->user->name }}</span>
                            @if($att->check_in_time)
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ \Carbon\Carbon::parse($att->check_in_time)->format('H:i') }}
                                </span>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-400 dark:text-gray-500 text-center py-4">Belum ada siswa yang hadir</p>
            @endif

            {{-- Action --}}
            <div class="flex justify-end">
                <a href="{{ route('meeting.attendance.index', $meeting) }}"
                   class="text-sm text-purple-600 dark:text-purple-400 hover:underline">
                   Kelola Absensi →
                </a>
            </div>
        </div>
    @endif

</x-toggle-section>