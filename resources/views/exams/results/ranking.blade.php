@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- ================= HEADER ================= --}}
    <div class="mb-6">
        <a href="{{ route('exams.result.student', $exam) }}"
           class="text-sm text-azwara-medium hover:underline">
            ← Kembali ke Hasil
        </a>

        <h1 class="text-2xl font-semibold text-azwara-darkest dark:text-azwara-lightest mt-2">
            Peringkat Peserta
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
            {{ $exam->title }} · {{ strtoupper($exam->test_type) }}
        </p>
    </div>

    {{-- ================= INFO RANKING SENDIRI ================= --}}
    @if ($myRank)
        <div class="mb-6">
            <div class="rounded-lg border border-azwara-lighter dark:border-azwara-darker
                        bg-azwara-lightest dark:bg-azwara-darker p-4">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    Peringkat Anda
                </div>
                <div class="text-xl font-semibold text-azwara-darkest dark:text-azwara-lightest">
                    #{{ $myRank }}
                </div>
            </div>
        </div>
    @endif

    {{-- ================= TABEL RANKING ================= --}}
    <div class="overflow-x-auto rounded-lg border border-azwara-lighter dark:border-azwara-darker">
        <table class="min-w-full text-sm">
            <thead class="bg-azwara-lightest dark:bg-azwara-darker">
                <tr>
                    <th class="px-4 py-3 text-left">Peringkat</th>
                    <th class="px-4 py-3 text-left">Nama Peserta</th>
                    <th class="px-4 py-3 text-center">Skor</th>

                    @if ($exam->type === 'tryout' && in_array($exam->test_type, ['skd', 'mtk_stis']))
                        <th class="px-4 py-3 text-center">Keterangan</th>
                    @endif
                </tr>
            </thead>

            <tbody class="divide-y divide-azwara-lighter dark:divide-azwara-darker">
                @forelse ($attempts as $attempt)
                    @php
                        $isMe = $attempt->id === $myAttemptId;
                    @endphp

                    <tr class="{{ $isMe ? 'bg-azwara-lighter/40 dark:bg-azwara-medium/30' : '' }}">
                        <td class="px-4 py-2 font-medium">
                            @if ($attempt->rank <= 3)
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold
                                    {{ $attempt->rank === 1 ? 'bg-yellow-400 text-black' :
                                       ($attempt->rank === 2 ? 'bg-gray-300 text-black' :
                                       'bg-amber-600 text-white') }}">
                                    #{{ $attempt->rank }}
                                </span>
                            @else
                                {{ $attempt->rank }}
                            @endif
                        </td>

                        <td class="px-4 py-2">
                            <span class="{{ $isMe ? 'font-semibold text-azwara-darkest dark:text-azwara-lightest' : '' }}">
                                {{ $attempt->user->name }}
                            </span>
                            @if ($isMe)
                                <span class="ml-1 text-xs text-azwara-medium">(Anda)</span>
                            @endif
                        </td>

                        <td class="px-4 py-2 text-center font-semibold">
                            {{ $attempt->score }}
                        </td>

                        @if ($exam->type === 'tryout' && in_array($exam->test_type, ['skd', 'mtk_stis']))
                            <td class="px-4 py-2 text-center">
                                @if ($attempt->is_passed)
                                    <span class="text-green-600 font-medium">
                                        Lulus
                                    </span>
                                @else
                                    <span class="text-red-600 font-medium">
                                        Belum Lulus
                                    </span>
                                @endif
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                            Belum ada data ranking.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
