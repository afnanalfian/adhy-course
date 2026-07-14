<div x-show="openAddQuestion" x-cloak class="absolute inset-0 z-50 flex items-center justify-center
           bg-black/40 backdrop-blur-sm">

    <div x-data="examQuestionPicker({
            examCode: '{{ $exam->exam_code }}',
            usedIds: @js($usedQuestionIds ?? []),
            categories: @js($categories)
        })" x-init="init()" @click.outside="openAddQuestion = false" class="bg-white dark:bg-gray-800
               w-full max-w-6xl
               max-h-[90vh]
               rounded-2xl shadow-2xl
               flex flex-col overflow-hidden border border-gray-200 dark:border-gray-700">

        {{-- HEADER --}}
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center bg-gradient-to-r from-purple-50 to-blue-50 dark:from-purple-900/20 dark:to-blue-900/20 flex-shrink-0">
            <div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                    📚 Tambah Soal Ujian
                </h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                    Pilih soal dari bank soal untuk ditambahkan ke ujian
                </p>
            </div>
            <button @click="openAddQuestion = false" class="text-2xl text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition p-1 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg w-8 h-8 flex items-center justify-center">
                ×
            </button>
        </div>

        {{-- INFO BADGE --}}
        <div class="px-6 py-2.5 text-sm bg-blue-50 dark:bg-blue-900/20 border-b border-blue-200 dark:border-blue-800/30 text-blue-700 dark:text-blue-300 flex items-center gap-2 flex-shrink-0">
            <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-blue-200 dark:bg-blue-800 text-blue-800 dark:text-blue-200">INFO</span>
            Soal yang ditampilkan sudah disesuaikan dengan tipe ujian:
            <strong class="uppercase bg-blue-200 dark:bg-blue-800 px-2 py-0.5 rounded text-blue-800 dark:text-blue-200">{{ $exam->test_type }}</strong>
        </div>

        {{-- FILTER --}}
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 dark:bg-gray-900/50 flex-shrink-0">

            {{-- CATEGORY --}}
            <div x-data="{ open:false }" class="relative">
                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Kategori</label>
                <button @click="open=!open" class="w-full text-left px-4 py-2.5 text-sm rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white hover:border-purple-500 transition flex items-center justify-between">
                    <span x-text="categoryId ? categories.find(c => c.id == categoryId)?.name : 'Pilih Kategori'"></span>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open" @click.outside="open=false" class="absolute z-50 mt-1 w-full max-h-48 overflow-y-auto bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg">
                    <template x-for="c in categories" :key="c.id">
                        <div @click="categoryId = c.id; open = false; onCategoryChange();" class="px-4 py-2.5 text-sm cursor-pointer text-gray-800 dark:text-gray-200 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition" x-text="c.name">
                        </div>
                    </template>
                </div>
            </div>

            {{-- MATERIAL --}}
            <div x-data="{ open:false }" class="relative">
                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Materi</label>
                <button :disabled="!materials.length" @click="if(materials.length) open=!open" class="w-full text-left px-4 py-2.5 text-sm rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white hover:border-purple-500 transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-between">
                    <span x-text="materialId ? materials.find(m => m.id == materialId)?.name : 'Pilih Materi'"></span>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open" @click.outside="open=false" class="absolute z-50 mt-1 w-full max-h-48 overflow-y-auto bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg">
                    <template x-for="m in materials" :key="m.id">
                        <div @click="materialId = m.id; open = false; onMaterialChange();" class="px-4 py-2.5 text-sm cursor-pointer text-gray-800 dark:text-gray-200 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition" x-text="m.name">
                        </div>
                    </template>
                </div>
            </div>
        </div>

        {{-- LIST --}}
        <div class="flex-1 overflow-y-auto p-6 space-y-3">
            <template x-if="!materialId && !categoryId">
                <div class="text-center py-12">
                    <span class="text-4xl mb-3 block">🔍</span>
                    <p class="text-gray-500 dark:text-gray-400">Pilih kategori & materi terlebih dahulu</p>
                </div>
            </template>

            <template x-if="categoryId && !materialId">
                <div class="text-center py-12">
                    <span class="text-4xl mb-3 block">📂</span>
                    <p class="text-gray-500 dark:text-gray-400">Pilih materi dari kategori yang dipilih</p>
                </div>
            </template>

            <template x-if="materialId && questions.length > 0">
                <div class="flex items-center justify-between p-3 rounded-xl bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800/30 flex-shrink-0">
                    <span class="text-sm font-medium text-purple-700 dark:text-purple-300">
                        Aksi Materi
                    </span>
                    <div class="flex gap-2">
                        <button @click="selectAllFromMaterial()" :disabled="questions.every(q => q.is_selected)" class="px-4 py-1.5 text-sm rounded-lg bg-purple-600 text-white hover:bg-purple-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
                            ✅ Pilih Semua
                        </button>
                        <button @click="unselectAllFromMaterial()" class="px-4 py-1.5 text-sm rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                            ✖ Batal Pilih
                        </button>
                    </div>
                </div>
            </template>

            <template x-for="q in questions" :key="q.id">
                <label class="block p-4 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-purple-500 hover:bg-purple-50/50 dark:hover:bg-purple-900/10 transition cursor-pointer group">
                    <div class="flex gap-3">
                        <div class="pt-0.5">
                            <input type="checkbox" :checked="q.is_selected" @change="toggleQuestion(q.id)" class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-purple-600 focus:ring-purple-500">
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                                <span class="text-xs font-medium text-gray-500 dark:text-gray-400">
                                    Soal #<span x-text="q.id"></span>
                                </span>
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="text-xs px-2.5 py-1 rounded-full bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400 font-medium">
                                        <span x-text="q.type"></span>
                                        <template x-if="q.type === 'compound' && q.sub_items_count">
                                            <span class="ml-1">(<span x-text="q.sub_items_count"></span> sub)</span>
                                        </template>
                                    </span>
                                    <span class="text-xs px-2.5 py-1 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400" title="Jumlah ujian yang menggunakan soal ini">
                                        📊 <span x-text="q.exam_questions_count"></span>x
                                    </span>
                                </div>
                            </div>

                            <template x-if="q.image_url">
                                <img :src="q.image_url" class="max-h-48 mx-auto mb-3 rounded-lg border border-gray-200 dark:border-gray-700">
                            </template>

                            <div class="prose dark:prose-invert max-w-none text-sm" x-html="q.question_text"></div>
                        </div>
                    </div>
                </label>
            </template>

            <template x-if="questions.length === 0 && materialId">
                <div class="text-center py-12">
                    <span class="text-4xl mb-3 block">📭</span>
                    <p class="text-gray-500 dark:text-gray-400">Tidak ada soal tersedia untuk materi ini</p>
                </div>
            </template>
        </div>

        {{-- PAGINATION --}}
        <div class="px-6 py-3 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center flex-shrink-0" x-show="pagination.last_page > 1 && questions.length > 0">
            <button @click="fetchQuestions(pagination.current_page - 1)" :disabled="pagination.current_page === 1" class="px-4 py-2 text-sm rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition disabled:opacity-50 disabled:cursor-not-allowed">
                ← Sebelumnya
            </button>

            <span class="text-sm text-gray-600 dark:text-gray-400">
                Halaman <span class="font-semibold text-gray-900 dark:text-white" x-text="pagination.current_page"></span>
                dari <span x-text="pagination.last_page"></span>
            </span>

            <button @click="fetchQuestions(pagination.current_page + 1)" :disabled="pagination.current_page === pagination.last_page" class="px-4 py-2 text-sm rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition disabled:opacity-50 disabled:cursor-not-allowed">
                Selanjutnya →
            </button>
        </div>

        {{-- FOOTER --}}
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between bg-gray-50 dark:bg-gray-900/50 flex-shrink-0">
            <span class="text-sm text-gray-500 dark:text-gray-400">
                <span class="font-semibold text-purple-600 dark:text-purple-400" x-text="selected.length"></span> soal dipilih
            </span>
            <div class="flex gap-3">
                <button @click="openAddQuestion = false" class="px-5 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition">
                    Batal
                </button>
                <button @click="save()" :disabled="selected.length === 0" class="px-6 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-xl transition disabled:opacity-50 disabled:cursor-not-allowed shadow-lg shadow-purple-500/30">
                    Tambahkan <span x-text="selected.length"></span> Soal
                </button>
            </div>
        </div>
    </div>
</div>