<div x-show="open" x-cloak @keydown.escape.window="open = false"
     class="fixed inset-0 z-50 flex items-center justify-center px-4">
    
    {{-- Backdrop --}}
    <div @click="open = false" class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

    {{-- Modal --}}
    <form method="POST" action="{{ route('exams.store') }}" x-show="open"
          x-transition:enter="transition ease-out duration-200" 
          x-transition:enter-start="opacity-0 scale-95"
          x-transition:enter-end="opacity-100 scale-100" 
          x-transition:leave="transition ease-in duration-150"
          x-transition:leave-start="opacity-100 scale-100" 
          x-transition:leave-end="opacity-0 scale-95" 
          class="relative w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-2xl p-6">

        @csrf
        <input type="hidden" name="type" value="{{ $type }}">

        {{-- Header --}}
        <div class="mb-6">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                Buat {{ ucfirst($type) }}
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">
                Lengkapi informasi ujian sebelum disimpan
            </p>
        </div>

        {{-- Form --}}
        <div class="space-y-4">
            {{-- Tipe Tes --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Tipe Tes <span class="text-red-500">*</span>
                </label>
                <select name="test_type" required 
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition">
                    <option value="" disabled selected>Pilih tipe tes</option>
                    <option value="skd">SKD</option>
                    <option value="tpa">TPA</option>
                    <option value="tbi">TBI</option>
                </select>
                <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Tipe tes menentukan jenis soal yang boleh dimasukkan</p>
            </div>

            {{-- Judul --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Judul Ujian <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="title" 
                       required
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition">
            </div>

            {{-- Tanggal --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Tanggal & Waktu <span class="text-red-500">*</span>
                </label>
                <input type="datetime-local" 
                       name="exam_date" 
                       required
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition">
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
            <button type="button" @click="open = false" 
                    class="px-5 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition">
                Batal
            </button>
            <button type="submit" 
                    class="px-6 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-xl transition duration-300 focus:ring-2 focus:ring-purple-500/20">
                Simpan
            </button>
        </div>
    </form>
</div>