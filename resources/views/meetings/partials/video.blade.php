<x-toggle-section title="🎥 Rekaman Pembelajaran">

    @php
        $video = $meeting->video; // MeetingVideo | null
        $user  = auth()->user();
        $isAdminOrTentor = $user && $user->hasAnyRole(['admin', 'tentor']);
    @endphp

    {{-- ================================
        BELUM ADA VIDEO
    ================================= --}}
    @if (!$video)

        <p class="text-sm text-gray-600 dark:text-gray-400">
            Rekaman pembelajaran belum tersedia.
        </p>

        {{-- ADMIN / TENTOR --}}
        @if ($isAdminOrTentor)
            <a
                href="{{ route('meetings.video.create', $meeting) }}"
                class="inline-block mt-4 px-4 py-2 rounded-lg
                       bg-primary text-white hover:bg-primary/90">
                ➕ Tambah Video
            </a>
        @endif

    {{-- ================================
        VIDEO SUDAH ADA
    ================================= --}}
    @else

        {{-- Thumbnail --}}
        <div class="flex items-start gap-4">

            <div class="w-48 aspect-video bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden">
                @if ($video->thumbnail_url)
                    <img
                        src="{{ $video->thumbnail_url }}"
                        alt="Thumbnail video"
                        class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-500 text-sm">
                        No Thumbnail
                    </div>
                @endif
            </div>

            {{-- Info & Actions --}}
            <div class="flex-1 space-y-2">

                <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
                    Rekaman tersedia
                </p>

                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Durasi:
                    {{ $video->duration ? gmdate('H:i:s', $video->duration) : '-' }}
                </p>

                <div class="flex flex-wrap gap-2 pt-2">

                    {{-- NONTON (SEMUA ROLE) --}}
                    <a
                        href="{{ route('meetings.video.playback', $meeting) }}"
                        class="px-4 py-2 rounded-lg
                               bg-primary text-white hover:bg-primary/90">
                        ▶️ Nonton
                    </a>

                    {{-- EDIT (ADMIN / TENTOR) --}}
                    @if ($isAdminOrTentor)
                        <a
                            href="{{ route('meetings.video.edit', $meeting) }}"
                            class="px-4 py-2 rounded-lg
                                   bg-gray-200 dark:bg-gray-700
                                   text-gray-800 dark:text-gray-200
                                   hover:bg-gray-300 dark:hover:bg-gray-600">
                            ✏️ Edit
                        </a>
                    @endif

                </div>

            </div>
        </div>

    @endif

</x-toggle-section>
