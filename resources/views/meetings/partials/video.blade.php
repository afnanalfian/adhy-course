<x-toggle-section title="🎥 Rekaman Pembelajaran">

    @php
        $video = $meeting->video; // MeetingVideo | null
        $user  = auth()->user();
        $isAdminOrTentor = $user && $user->hasAnyRole(['admin', 'tentor']);

        // thumbnail youtube
        $thumbnailUrl = $video
            ? "https://img.youtube.com/vi/{$video->youtube_video_id}/hqdefault.jpg"
            : null;
    @endphp

    {{-- ================================
        BELUM ADA VIDEO
    ================================= --}}
    @if (! $video)

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

        <div class="flex items-start gap-4">

            {{-- Thumbnail --}}
            <div class="w-48 aspect-video bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden">
                <img
                    src="{{ $thumbnailUrl }}"
                    alt="Thumbnail video"
                    class="w-full h-full object-cover">
            </div>

            {{-- Info & Actions --}}
            <div class="flex-1 space-y-2">

                <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
                    {{ $video->title }}
                </p>

                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Platform: YouTube
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
                        {{-- <a
                            href="{{ route('meetings.video.edit', $meeting) }}"
                            class="px-4 py-2 rounded-lg
                                   bg-gray-200 dark:bg-gray-700
                                   text-gray-800 dark:text-gray-200
                                   hover:bg-gray-300 dark:hover:bg-gray-600">
                            ✏️ Edit
                        </a> --}}

                        {{-- HAPUS --}}
                        <form
                            method="POST"
                            action="{{ route('meetings.video.destroy', $meeting) }}"
                            class="sweet-confirm"
                            data-message="Yakin ingin menghapus rekaman video ini? Tindakan ini tidak dapat dibatalkan.">
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="px-4 py-2 rounded-lg
                                    bg-red-600 text-white
                                    hover:bg-red-700">
                                🗑️ Hapus
                            </button>
                        </form>
                    @endif

                </div>

            </div>
        </div>

    @endif

</x-toggle-section>
