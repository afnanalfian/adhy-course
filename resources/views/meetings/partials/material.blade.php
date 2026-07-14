<x-toggle-section title="📚 Materi">

    @if(!$meeting->material)
        {{-- No Material State --}}
        <div class="mt-4 text-center py-6">
            <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada materi</p>
            
            @role('admin|tentor')
            <form method="POST"
                  action="{{ route('meeting.material.store', $meeting) }}"
                  enctype="multipart/form-data"
                  class="mt-3 max-w-xs mx-auto">
                @csrf
                <div class="flex gap-2">
                    <input type="file"
                           name="material"
                           accept="application/pdf"
                           required
                           class="flex-1 text-sm text-gray-500 dark:text-gray-400
                                  file:mr-3 file:py-2 file:px-4
                                  file:rounded-xl file:border-0
                                  file:bg-purple-600 file:text-white
                                  file:hover:bg-purple-700 file:transition
                                  cursor-pointer">
                    <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-xl hover:bg-purple-700 transition">
                        Upload
                    </button>
                </div>
                <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Format: PDF, maks 10MB</p>
            </form>
            @endrole
        </div>
    @else
        {{-- Material Preview --}}
        <div class="mt-4 space-y-3">
            {{-- File Info --}}
            <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">Materi PDF</span>
                </div>
                <a href="{{ asset('storage/'.$meeting->material->file_path) }}"
                   target="_blank"
                   class="text-sm text-purple-600 dark:text-purple-400 hover:underline">
                    Buka →
                </a>
            </div>

            {{-- PDF Preview --}}
            <div class="hidden sm:block rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <iframe src="{{ asset('storage/'.$meeting->material->file_path) }}"
                        class="h-[400px] w-full"
                        title="Materi PDF - {{ $meeting->title }}">
                </iframe>
            </div>

            {{-- Actions --}}
            @role('admin|tentor')
            <div class="flex flex-wrap gap-2 pt-2">
                {{-- Replace --}}
                <form method="POST"
                      action="{{ route('meeting.material.store', $meeting) }}"
                      enctype="multipart/form-data"
                      class="flex items-center gap-2">
                    @csrf
                    <input type="file"
                           name="material"
                           accept="application/pdf"
                           required
                           class="text-sm text-gray-500 dark:text-gray-400
                                  file:mr-2 file:py-1.5 file:px-3
                                  file:rounded-xl file:border-0
                                  file:bg-purple-600 file:text-white
                                  file:hover:bg-purple-700 file:transition
                                  cursor-pointer">
                    <button type="submit"
                            class="px-4 py-1.5 text-sm font-medium text-white bg-purple-600 rounded-xl hover:bg-purple-700 transition">
                        Ganti
                    </button>
                </form>

                {{-- Delete --}}
                <form method="POST"
                      action="{{ route('meeting.material.destroy', $meeting) }}"
                      class="sweet-confirm"
                      data-message="Yakin ingin menghapus materi ini?">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-4 py-1.5 text-sm font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 rounded-xl hover:bg-red-100 dark:hover:bg-red-900/30 transition">
                        Hapus
                    </button>
                </form>
            </div>
            @endrole
        </div>
    @endif

</x-toggle-section>