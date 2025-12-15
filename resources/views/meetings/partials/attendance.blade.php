<x-toggle-section title="📝 Absensi">

    @if($meeting->attendances->isEmpty())
        <div class="space-y-3 mt-5">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Absensi belum dibuat untuk pertemuan ini.
            </p>

            <a href="{{ route('meeting.attendance.index', $meeting) }}"
               class="inline-flex items-center gap-2
                      px-4 py-2 rounded-lg
                      bg-primary text-white
                      hover:bg-primary/90 transition">
                Buat Absensi
            </a>
        </div>
    @else
        @php
            $hadir = $meeting->attendances->where('is_present', true);
        @endphp

        <div class="space-y-4">

            {{-- SUMMARY --}}
            <div class="flex items-center gap-2 text-sm mt-5">
                <span class="px-3 py-1 rounded-full
                             bg-green-100 text-green-700
                             dark:bg-green-500/20 dark:text-green-300">
                    Hadir: {{ $hadir->count() }}
                </span>

                <span class="text-gray-500 dark:text-gray-400">
                    dari {{ $meeting->attendances->count() }} siswa
                </span>
            </div>

            {{-- LIST HADIR --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                @foreach($hadir as $att)
                    <div class="flex items-center gap-2
                                p-3 rounded-lg
                                bg-azwara-lighter dark:bg-secondary/60
                                border border-gray-200 dark:border-white/10">

                        <span class="h-2 w-2 rounded-full bg-green-500"></span>

                        <span class="text-sm text-gray-800 dark:text-gray-200">
                            {{ $att->user->name }}
                        </span>
                    </div>
                @endforeach
            </div>

            {{-- ACTION --}}
            <div class="pt-3">
                <a href="{{ route('meeting.attendance.index', $meeting) }}"
                   class="inline-flex items-center gap-2
                          px-4 py-2 rounded-lg
                          bg-primary text-white
                          hover:bg-primary/90 transition">
                    Edit Absensi
                </a>
            </div>

        </div>
    @endif

</x-toggle-section>
