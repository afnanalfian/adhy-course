<div
    x-show="openAddQuestion"
    x-cloak
    class="absolute inset-0 z-50 flex items-center justify-center
           bg-black/40 backdrop-blur-sm">

    <div
        x-data="examQuestionPicker({
            examId: {{ $exam->id }},
            usedIds: @js($usedQuestionIds ?? [])
        })"
        @click.outside="openAddQuestion = false"
        class="bg-azwara-lightest dark:bg-secondary
               w-full max-w-6xl
               max-h-[90vh]
               rounded-2xl shadow-xl
               flex flex-col overflow-hidden">

        {{-- HEADER --}}
        <div class="px-6 py-4 border-b dark:border-white/10 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                Tambah Soal Ujian
            </h3>
            <button @click="openAddQuestion = false" class="text-xl dark:text-white">&times;</button>
        </div>
        <div class="px-6 py-2 text-sm bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300">
            Soal yang ditampilkan sudah disesuaikan dengan tipe ujian:
            <strong class="uppercase">{{ $exam->test_type }}</strong>
        </div>
        {{-- FILTER --}}
        <div class="px-6 py-4 border-b dark:border-white/10
                    grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- CATEGORY --}}
            <div
                x-data="{
                    open:false,
                    categories: @js($categories->map(fn($c)=>['id'=>$c->id,'name'=>$c->name]))
                }"
                class="relative">

                <button
                    @click="open=!open"
                    class="w-full text-left px-3 py-2 text-sm rounded-lg
                        border bg-white text-gray-800
                        dark:bg-slate-800 dark:text-gray-100
                        dark:border-white/10">

                    <span x-text="
                        categoryId
                        ? categories.find(c => c.id == categoryId)?.name
                        : 'Pilih Kategori'
                    "></span>
                </button>

                <div x-show="open" @click.outside="open=false"
                    class="absolute z-50 mt-1 w-full max-h-48 overflow-y-auto
                        bg-white dark:bg-slate-800
                        border dark:border-white/10 rounded-lg">

                    <template x-for="c in categories" :key="c.id">
                        <div
                            @click="
                                categoryId=c.id;
                                open=false;
                                loadMaterials();
                            "
                            class="px-3 py-2 text-sm cursor-pointer
                                text-gray-800 dark:text-gray-100
                                hover:bg-gray-100 dark:hover:bg-white/10"
                            x-text="c.name">
                        </div>
                    </template>
                </div>
            </div>

            {{-- MATERIAL --}}
            <div x-data="{ open:false }" class="relative">

                <button
                    :disabled="!materials.length"
                    @click="if(materials.length) open=!open"
                    class="w-full text-left px-3 py-2 text-sm rounded-lg
                        border bg-white text-gray-800
                        disabled:opacity-50
                        dark:bg-slate-800 dark:text-gray-100
                        dark:border-white/10">

                    <span x-text="
                        materialId
                        ? materials.find(m => m.id == materialId)?.name
                        : 'Pilih Materi'
                    "></span>
                </button>

                <div x-show="open" @click.outside="open=false"
                    class="absolute z-50 mt-1 w-full max-h-48 overflow-y-auto
                        bg-white dark:bg-slate-800
                        border dark:border-white/10 rounded-lg">

                    <template x-for="m in materials" :key="m.id">
                        <div
                            @click="
                                materialId=m.id;
                                open=false;
                                fetchQuestions(1);
                            "
                            class="px-3 py-2 text-sm cursor-pointer
                                text-gray-800 dark:text-gray-100
                                hover:bg-gray-100 dark:hover:bg-white/10"
                            x-text="m.name">
                        </div>
                    </template>
                </div>
            </div>
        </div>
        {{-- LIST --}}
        <div class="flex-1 overflow-y-auto p-6 space-y-4">

            <template x-if="!materialId">
                <p class="text-center text-gray-500 dark:text-white">
                    Pilih kategori & materi terlebih dahulu
                </p>
            </template>

            <template x-for="q in questions" :key="q.id">
                <label
                    class="block p-4 rounded-xl border
                           hover:bg-gray-50 dark:text-white dark:hover:bg-white/5
                           cursor-pointer">

                    <div class="flex gap-3">
                        <input type="checkbox"
                               :value="q.id"
                               x-model="selected">

                        <div class="flex-1">

                            <div class="flex justify-between mb-2">
                                <span class="font-semibold">Soal</span>
                                <div class="flex items-center gap-2">
                                    {{-- BADGE TYPE --}}
                                    <span class="text-xs px-2 py-1 rounded bg-primary/10 text-primary font-semibold">
                                        <span x-text="q.type"></span>
                                        <template x-if="q.type === 'compound' && q.sub_items_count">
                                            <span class="ml-1">(<span x-text="q.sub_items_count"></span> sub)</span>
                                        </template>
                                    </span>

                                    {{-- BADGE DIPAKAI --}}
                                    <span
                                        class="text-xs px-2 py-1 rounded
                                            bg-gray-100 dark:bg-white/10
                                            text-gray-600 dark:text-gray-300"
                                        title="Jumlah ujian yang menggunakan soal ini">
                                        Dipakai <span x-text="q.exam_questions_count"></span>x
                                    </span>
                                </div>
                            </div>

                            <template x-if="q.image">
                                <img :src="q.image_url"
                                     class="max-h-48 mx-auto mb-3 rounded">
                            </template>

                            <div class="prose dark:prose-invert max-w-none"
                                 x-html="q.question_text"></div>

                            {{-- PREVIEW FOR SHORT ANSWER --}}
                            <template x-if="q.type === 'short_answer'">
                                <div class="mt-2 p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg">
                                    <p class="text-sm text-blue-800 dark:text-blue-300 font-semibold">
                                        Isian Singkat:
                                    </p>

                                    <!-- OPTION 1: Pakai helper function -->
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1"
                                    x-text="getShortAnswerPreview(q)">
                                    </p>

                                    <!-- OPTION 2: Atau tampilkan semua jawaban -->
                                    <template x-if="q.options && q.options.filter(opt => opt.is_correct).length > 0">
                                        <div class="mt-2">
                                            <div class="flex flex-wrap gap-1">
                                                <template x-for="option in q.options.filter(opt => opt.is_correct)" :key="option.id">
                                                    <span class="text-xs px-2 py-1 bg-gray-200 dark:bg-gray-700 rounded">
                                                        <span x-text="option.option_text"></span>
                                                    </span>
                                                </template>
                                            </div>
                                        </div>
                                    </template>

                                    <template x-if="!q.options || q.options.filter(opt => opt.is_correct).length === 0">
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Belum ada jawaban</p>
                                    </template>
                                </div>
                            </template>
                            {{-- PREVIEW FOR COMPOUND --}}
                            <template x-if="q.type === 'compound'">
                                <div class="mt-2 p-3 bg-purple-50 dark:bg-purple-900/30 rounded-lg">
                                    <p class="text-sm text-purple-800 dark:text-purple-300 font-semibold">
                                        Sub Pertanyaan (<span x-text="q.sub_items_count"></span>):
                                    </p>
                                    <div class="mt-2 space-y-2">
                                        <template x-for="(subItem, index) in q.sub_items" :key="subItem.id">
                                            <div class="text-sm">
                                                <span class="font-medium">
                                                    <span x-text="String.fromCharCode(65 + index)"></span>.
                                                </span>
                                                <span x-text="subItem.prompt" class="ml-1"></span>
                                                <span class="ml-2 text-xs px-1 py-0.5 bg-gray-100 dark:bg-gray-700 rounded">
                                                    <span x-text="subItem.type === 'truefalse' ? 'B/S' : 'Isian'"></span>
                                                </span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>

                        </div>
                    </div>
                </label>
            </template>

            <template x-if="questions.length === 0 && materialId">
                <p class="text-center text-gray-500 dark:text-white">
                    Tidak ada soal tersedia
                </p>
            </template>
        </div>

        {{-- PAGINATION --}}
        <div class="flex justify-between items-center pt-4"
            x-show="pagination.last_page > 1">

            <button
                @click="fetchQuestions(pagination.current_page - 1)"
                :disabled="pagination.current_page === 1"
                class="px-3 py-1 rounded bg-gray-200 dark:bg-white/10">
                Prev
            </button>

            <span class="text-sm text-gray-600 dark:text-gray-300">
                Page <span x-text="pagination.current_page"></span>
                of <span x-text="pagination.last_page"></span>
            </span>

            <button
                @click="fetchQuestions(pagination.current_page + 1)"
                :disabled="pagination.current_page === pagination.last_page"
                class="px-3 py-1 rounded bg-gray-200 dark:bg-white/10">
                Next
            </button>
        </div>

        {{-- FOOTER --}}
        <div class="px-6 py-4 border-t dark:border-white/10 flex justify-end gap-3">

            <button @click="openAddQuestion = false"
                    class="px-4 py-2 rounded-lg dark:text-white">
                Batal
            </button>

            <form method="POST"
                  action="{{ route('ajax.exams.questions.attach', $exam) }}">
                @csrf
                <template x-for="id in selected">
                    <input type="hidden" name="question_ids[]" :value="id">
                </template>

                <button type="submit"
                        class="px-5 py-2 rounded-lg bg-primary text-white"
                        :disabled="selected.length === 0">
                    Tambahkan Soal
                </button>
            </form>

        </div>
    </div>
</div>

<script>
function examQuestionPicker(config) {
    return {
        // State
        categoryId: null,
        materialId: null,
        materials: [],
        questions: [],
        selected: [],
        usedIds: [],
        pagination: {},

        // Init
        init() {
            this.usedIds = config.usedIds || [];
            this.selected = [];
        },

        getShortAnswerPreview(question) {
            if (!question.options) return 'Belum ada jawaban';

            const correctOptions = question.options.filter(opt => opt.is_correct);
            if (correctOptions.length === 0) return 'Belum ada jawaban';

            const primary = correctOptions[0];
            if (correctOptions.length === 1) {
                return primary.option_text;
            }

            return primary.option_text + ` (+${correctOptions.length - 1} lainnya)`;
        },

        async loadMaterials() {
            if (!this.categoryId) return;

            try {
                const response = await fetch(`/ajax/categories/${this.categoryId}/materials`);
                const data = await response.json();
                this.materials = data;
                this.materialId = null;
                this.questions = [];
            } catch (error) {
                console.error('Failed to load materials:', error);
            }
        },

        async fetchQuestions(page = 1) {
            if (!this.materialId) return;

            const params = new URLSearchParams({
                page: page,
            });

            try {
                const response = await fetch(`/ajax/exams/${config.examId}/questions/material/${this.materialId}?${params}`);
                const data = await response.json();
                this.questions = data.data || [];
                this.pagination = {
                    current_page: data.current_page || 1,
                    last_page: data.last_page || 1,
                    total: data.total || 0
                };
            } catch (error) {
                console.error('Failed to fetch questions:', error);
            }
        }
    };
}
</script>
