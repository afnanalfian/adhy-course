export default function examQuestionPicker({
    examId,
    usedIds = [],
}) {
    return {
        /* ================= STATE ================= */
        categoryId: '',
        materialId: '',
        type: '',

        materials: [],
        questions: [],
        selected: [...usedIds],

        pagination: {
            current_page: 1,
            last_page: 1,
        },

        /* ================= WATCHER ================= */

        onCategoryChange() {
            this.materialId = ''
            this.materials = []
            this.questions = []
            this.pagination.current_page = 1

            if (this.categoryId) {
                this.loadMaterials()
            }
        },

        onMaterialChange() {
            this.questions = []
            this.pagination.current_page = 1

            if (this.materialId) {
                this.fetchQuestions()
            }
        },

        onTypeChange() {
            this.pagination.current_page = 1
            this.fetchQuestions()
        },

        /* ================= LOAD MATERIAL ================= */

        async loadMaterials() {
            try {
                const res = await fetch(
                    `/ajax/categories/${this.categoryId}/materials`
                )

                if (!res.ok) throw new Error('Load material gagal')

                this.materials = await res.json()
            } catch (e) {
                console.error(e)
                alert('Gagal memuat materi')
            }
        },

        /* ================= FETCH QUESTIONS ================= */

        async fetchQuestions(page = 1) {
            if (!this.materialId) return

            try {
                let url =
                    `/ajax/${examId}/questions/by-material/${this.materialId}?page=${page}`

                if (this.type) {
                    url += `&type=${this.type}`
                }

                const res = await fetch(url)

                if (!res.ok) throw new Error('Load question gagal')

                const data = await res.json()

                this.questions = data.data.map(q => ({
                    ...q,
                    image_url: q.image ? `/storage/${q.image}` : null,
                    is_selected: this.selected.includes(q.id),
                }))

                this.pagination.current_page = data.current_page
                this.pagination.last_page = data.last_page

                this.$nextTick(() => {
                    if (window.MathJax) MathJax.typesetPromise()
                })
            } catch (e) {
                console.error(e)
                alert('Gagal memuat soal')
            }
        },

        /* ================= SELECT ================= */

        toggleQuestion(questionId) {
            if (this.selected.includes(questionId)) {
                this.selected = this.selected.filter(id => id !== questionId)
            } else {
                this.selected.push(questionId)
            }

            // update state lokal
            this.questions = this.questions.map(q => ({
                ...q,
                is_selected: this.selected.includes(q.id),
            }))
        },

        /* ================= SAVE ================= */

        async save() {
            try {
                const res = await fetch(
                    `/ajax/exams/${examId}/questions/attach`,
                    {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                        },
                        body: JSON.stringify({
                            question_ids: this.selected,
                        }),
                    }
                )

                if (!res.ok) throw new Error('Attach gagal')

                alert('Soal berhasil disimpan')
                window.location.reload()
            } catch (e) {
                console.error(e)
                alert('Gagal menyimpan soal')
            }
        },
    }
}
