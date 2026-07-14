<x-toggle-section title="🎥 Rekaman Pembelajaran">

    @php
        $video = $meeting->video;
        $user  = auth()->user();
        $isAdminOrTentor = $user && $user->hasAnyRole(['admin', 'tentor']);
    @endphp

    @if (!$video)
        {{-- No Video State --}}
        <div class="mt-4 text-center py-6">
            <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada rekaman</p>
            @if ($isAdminOrTentor)
            <a href="{{ route('meetings.video.create', $meeting) }}"
               class="inline-block mt-3 px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-xl hover:bg-purple-700 transition">
                + Tambah Video
            </a>
            @endif
        </div>

    @else
        {{-- Video Available --}}
        <div class="mt-4 space-y-4">
            {{-- Video Player --}}
            <div class="rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden bg-gray-900">
                <div class="relative aspect-video">
                    @if ($video->thumbnail)
                        <img src="{{ $video->thumbnail }}"
                             alt="{{ $video->title }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="flex items-center justify-center h-full bg-gray-800">
                            <svg class="w-16 h-16 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                    
                    <a href="{{ route('meetings.video.playback', $meeting) }}"
                       class="absolute inset-0 flex items-center justify-center bg-black/30 hover:bg-black/40 transition group">
                        <div class="w-14 h-14 rounded-full bg-white/90 flex items-center justify-center group-hover:scale-105 transition">
                            <svg class="w-7 h-7 text-gray-900 ml-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>

            {{-- Video Info --}}
            <div class="flex flex-wrap items-start justify-between gap-3">
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">{{ $video->title }}</h3>
                    <div class="flex flex-wrap items-center gap-3 mt-1 text-xs text-gray-500 dark:text-gray-400">
                        <span>{{ $video->created_at->translatedFormat('d F Y') }}</span>
                        <span class="text-gray-300 dark:text-gray-600">•</span>
                        <span class="capitalize">{{ $video->platform }}</span>
                        @if($video->duration)
                            <span class="text-gray-300 dark:text-gray-600">•</span>
                            <span>{{ $video->duration }}</span>
                        @endif
                    </div>
                </div>
                
                <a href="{{ route('meetings.video.playback', $meeting) }}"
                   class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition">
                    Tonton
                </a>
            </div>

            {{-- Description --}}
            @if($video->description)
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $video->description }}</p>
            @endif

            {{-- Admin/Tentor Actions --}}
            @if ($isAdminOrTentor)
            <div class="flex flex-wrap gap-2 pt-2 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('meetings.video.edit', $meeting) }}"
                   class="px-4 py-1.5 text-sm font-medium text-gray-600 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                    Edit
                </a>
                <form method="POST"
                      action="{{ route('meetings.video.destroy', $meeting) }}"
                      class="sweet-confirm"
                      data-message="Yakin ingin menghapus rekaman video ini?">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-4 py-1.5 text-sm font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 rounded-xl hover:bg-red-100 dark:hover:bg-red-900/30 transition">
                        Hapus
                    </button>
                </form>
            </div>
            @endif
        </div>
    @endif

</x-toggle-section>