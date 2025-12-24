@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div>
        <h1 class="text-2xl font-bold text-azwara-darkest dark:text-white">
            📊 Leaderboard Detail
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Pilih jenis evaluasi untuk melihat peringkat siswa
        </p>
    </div>

    {{-- FILTER --}}
    <div class="grid sm:grid-cols-2 gap-4">

        {{-- TYPE --}}
        <select id="examType"
                class="rounded-lg border-gray-300 dark:border-white/10
                       dark:bg-secondary dark:text-white">
            <option value="">Pilih Tipe Evaluasi</option>
            <option value="post_test">Post Test</option>
            <option value="quiz">Quiz Harian</option>
            <option value="tryout">Tryout</option>
        </select>

        {{-- EXAM --}}
        <select id="examSelect"
                disabled
                class="rounded-lg border-gray-300 dark:border-white/10
                       dark:bg-secondary dark:text-white">
            <option value="">Pilih Evaluasi</option>
        </select>
    </div>

    {{-- RESULT --}}
    <div id="rankingResult">
        <div class="py-12 text-center text-gray-500">
            Silakan pilih tipe dan evaluasi terlebih dahulu
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
    const typeSelect = document.getElementById('examType');
    const examSelect = document.getElementById('examSelect');
    const resultBox  = document.getElementById('rankingResult');

    typeSelect.addEventListener('change', async () => {
        examSelect.innerHTML = '<option value="">Memuat...</option>';
        examSelect.disabled = true;
        resultBox.innerHTML = '';

        if (!typeSelect.value) return;

        const res = await fetch(`{{ route('leaderboard.load-exams') }}?type=${typeSelect.value}`);
        const exams = await res.json();

        examSelect.innerHTML = '<option value="">Pilih Evaluasi</option>';
        exams.forEach(exam => {
            examSelect.innerHTML += `
                <option value="${exam.id}">
                    ${exam.title ?? 'Tanpa Judul'}
                </option>
            `;
        });

        examSelect.disabled = false;
    });

    examSelect.addEventListener('change', async () => {
        resultBox.innerHTML = '<div class="py-10 text-center">Memuat leaderboard...</div>';

        const res = await fetch(
            `{{ route('leaderboard.load-ranking') }}?exam_id=${examSelect.value}`
        );

        resultBox.innerHTML = await res.text();
    });
</script>
@endpush
