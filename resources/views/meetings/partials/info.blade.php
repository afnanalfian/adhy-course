<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-5">
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        {{-- Left Content --}}
        <div class="flex-1 min-w-0">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h1 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ $meeting->title }}
                    </h1>
                    <div class="mt-1 flex flex-wrap items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
                        <span>{{ $meeting->scheduled_at->translatedFormat('l, d F Y') }}</span>
                        <span class="text-gray-300 dark:text-gray-600">•</span>
                        <span>{{ $meeting->scheduled_at->format('H:i') }} WITA</span>
                    </div>
                </div>

                {{-- Status Badge --}}
                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-medium rounded-full flex-shrink-0
                    @if($meeting->status === 'live')
                        bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400
                    @elseif($meeting->status === 'upcoming')
                        bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400
                    @else
                        bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400
                    @endif">
                    @if($meeting->status === 'live')
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                    @endif
                    {{ ucfirst($meeting->status) }}
                </span>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex flex-wrap items-center gap-2">
            {{-- Edit (Admin only) --}}
            @role('admin')
            <a href="{{ route('meeting.edit', $meeting) }}"
               class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                Edit
            </a>
            @endrole

            {{-- Zoom Button --}}
            @if($meeting->status !== 'done')
                @if($meeting->zoom_link)
                    <a href="{{ route('meeting.joinZoom', $meeting) }}" target="_blank"
                       class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-xl hover:bg-green-700 transition">
                        Join Zoom
                    </a>
                @else
                    <span class="px-4 py-2 text-sm font-medium text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-700 rounded-xl cursor-not-allowed">
                        No Zoom
                    </span>
                @endif
            @endif

            {{-- Delete (Admin only) --}}
            @role('admin')
            <form method="POST" action="{{ route('meeting.destroy', $meeting) }}" class="sweet-confirm"
                  data-message="Yakin ingin menghapus pertemuan ini?">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 rounded-xl hover:bg-red-100 dark:hover:bg-red-900/30 transition">
                    Hapus
                </button>
            </form>
            @endrole
        </div>
    </div>
</div>