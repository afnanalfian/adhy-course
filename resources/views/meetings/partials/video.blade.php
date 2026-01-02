<x-toggle-section title="🎥 Rekaman Pembelajaran">

    @php
        $video = $meeting->video; // MeetingVideo | null
        $user  = auth()->user();
        $isAdminOrTentor = $user && $user->hasAnyRole(['admin', 'tentor']);
    @endphp

    {{-- ================================
        BELUM ADA VIDEO
    ================================= --}}
    @if (! $video)

        <p class="text-sm text-gray-600 dark:text-gray-400">
            Rekaman pembelajaran belum tersedia.
        </p>

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

        <div class="flex flex-col md:flex-row gap-6">

        {{-- Thumbnail (BESAR + RESPONSIVE) --}}
        <div
            class="w-full md:w-[420px]
                aspect-video
                rounded-2xl
                overflow-hidden
                bg-gray-200 dark:bg-gray-700
                shadow">

            @php
                $thumbnail = $video?->thumbnail;
            @endphp

            @if ($thumbnail)
                <img
                    src="{{ $thumbnail }}"
                    alt="Thumbnail video"
                    loading="lazy"
                    class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center text-sm text-gray-500">
                    Thumbnail tidak tersedia
                </div>
            @endif
        </div>


            {{-- Info & Actions --}}
            <div class="flex-1 space-y-3">

                <div>
                    <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
                        {{ $video->title }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Platform: {{ $video->platform }}
                    </p>
                </div>

                <div class="flex flex-wrap gap-3 pt-2">

                    {{-- NONTON --}}
                    <a
                        href="{{ route('meetings.video.playback', $meeting) }}"
                        class="inline-flex items-center justify-center
                               px-5 py-2.5 rounded-lg
                               bg-primary text-white
                               text-sm font-medium
                               hover:bg-primary/90">
                        ▶️ Nonton
                    </a>

                    {{-- ADMIN / TENTOR --}}
                    @if ($isAdminOrTentor)

                        {{-- EDIT --}}
                        <a
                            href="{{ route('meetings.video.edit', $meeting) }}"
                            class="inline-flex items-center justify-center
                                   px-4 py-2.5 rounded-lg
                                   bg-gray-200 dark:bg-gray-700
                                   text-sm font-medium
                                   text-gray-800 dark:text-gray-200
                                   hover:bg-gray-300 dark:hover:bg-gray-600">
                            Edit
                        </a>

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
                                class="inline-flex items-center justify-center
                                       px-4 py-2.5 rounded-lg
                                       bg-red-600 text-white
                                       text-sm font-medium
                                       hover:bg-red-700">
                                Hapus
                            </button>
                        </form>

                    @endif

                </div>

            </div>
        </div>

    @endif

</x-toggle-section>
