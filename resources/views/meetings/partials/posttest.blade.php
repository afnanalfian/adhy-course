<x-toggle-section title="🧪 Post Test">

    @if(!$meeting->postTest)
        <p class="text-gray-500 dark:text-gray-400">
            Post Test belum dibuat.
        </p>

        @role('admin|tentor')
            <button class="mt-4 px-4 py-2 rounded-lg
                           bg-primary text-white hover:bg-primary/90">
                Buat Post Test
            </button>
        @endrole
    @else
        <ul class="text-sm space-y-1
                   text-gray-700 dark:text-gray-300">
            <li>Durasi: {{ $meeting->postTest->duration_minutes }} menit</li>
            <li>Jumlah Soal: {{ $meeting->postTest->questions->count() }}</li>
            <li>Status: {{ ucfirst($meeting->postTest->status) }}</li>
        </ul>

        <div class="flex gap-2 mt-4">
            @role('admin|tentor')
                @if($meeting->postTest->status === 'inactive')
                    <form method="POST" action="{{ route('posttest.launch', $meeting->postTest) }}">
                        @csrf
                        <button class="px-4 py-2 rounded-lg
                                       bg-primary text-white hover:bg-primary/90">
                            Launch
                        </button>
                    </form>
                @elseif($meeting->postTest->status === 'active')
                    <form method="POST"
                          action="{{ route('posttest.close', $meeting->postTest) }}"
                          class="sweet-confirm"
                          data-message="Yakin ingin menutup post test ini?">
                        @csrf
                        <button class="px-4 py-2 rounded-lg
                                       bg-red-600 text-white hover:bg-red-700">
                            Close
                        </button>
                    </form>
                @endif
            @endrole

            <a href="#"
               class="px-4 py-2 rounded-lg
                      bg-gray-200 dark:bg-gray-600
                      text-gray-800 dark:text-white">
                Lihat Hasil
            </a>
        </div>
    @endif

</x-toggle-section>
