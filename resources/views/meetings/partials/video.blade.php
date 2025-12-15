<x-toggle-section title="🎥 Rekaman Pembelajaran">

    @if(!$meeting->video)
        <p class="text-gray-500 dark:text-gray-400">
            Video belum tersedia.
        </p>

        <button class="mt-4 px-4 py-2 rounded-lg
                       bg-primary text-white hover:bg-primary/90">
            Upload Video
        </button>
    @else
        <iframe
            src="{{ $meeting->video->playback_url }}"
            class="w-full aspect-video rounded-lg">
        </iframe>

        <div class="flex gap-2 mt-4">
            <button class="px-4 py-2 rounded-lg
                           bg-primary text-white hover:bg-primary/90">
                Ganti Video
            </button>

            <form method="POST"
                  action="{{ route('meeting.video.destroy', $meeting) }}"
                  class="sweet-confirm"
                  data-message="Yakin ingin menghapus video ini?">
                @csrf
                @method('DELETE')
                <button
                    class="px-4 py-2 rounded-lg
                           bg-red-600 text-white hover:bg-red-700">
                    Hapus Video
                </button>
            </form>
        </div>
    @endif

</x-toggle-section>
