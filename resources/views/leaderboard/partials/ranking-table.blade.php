<div class="bg-white/80 dark:bg-secondary/80
            rounded-2xl p-6
            border border-azwara-light/30 dark:border-white/10 dark:text-azwara-lightest">

    {{-- TITLE --}}
    <h2 class="text-lg font-semibold mb-6 flex items-center gap-2">
        🏆
        {{ $exam->type === 'post_test'
            ? optional($exam->owner)->title
            : $exam->title
        }}
    </h2>

    <table class="w-full text-sm">
        {{-- ================= HEADER DESKTOP ================= --}}
        <thead class="hidden md:table-header-group border-b border-gray-200 dark:border-white/10">
            <tr class="text-left">
                <th class="py-3 pr-4 w-16">Rank</th>
                <th class="pr-6">Nama</th>
                <th class="pr-6 text-left w-24">Nilai</th>
                <th class="text-left w-32">Durasi</th>
            </tr>
        </thead>

        {{-- ================= BODY ================= --}}
        <tbody class="divide-y divide-gray-200 dark:divide-white/10">
            @forelse($attempts as $i => $attempt)
                <tr class="block md:table-row py-4 md:py-0">

                    {{-- RANK (DESKTOP) --}}
                    <td class="hidden md:table-cell py-3 font-semibold">
                        #{{ $i + 1 }}
                    </td>

                    {{-- NAMA + INFO MOBILE --}}
                    <td class="block md:table-cell space-y-2">

                        {{-- NAMA --}}
                        <div class="font-medium text-gray-900 dark:text-white">
                            {{ $attempt->user->name }}
                        </div>

                        {{-- INFO MOBILE --}}
                        <div class="flex flex-wrap gap-x-4 gap-y-1
                                    text-xs text-gray-600 dark:text-gray-400
                                    md:hidden">

                            <span>
                                Rank:
                                <strong>#{{ $i + 1 }}</strong>
                            </span>

                            <span>
                                Nilai:
                                <strong class="text-primary dark:text-azwara-lighter">
                                    {{ $attempt->score }}
                                </strong>
                            </span>

                            <span>
                                {{ floor($attempt->work_duration_seconds / 60) }} m
                                {{ $attempt->work_duration_seconds % 60 }} d
                            </span>
                        </div>
                    </td>

                    {{-- NILAI (DESKTOP) --}}
                    <td class="hidden md:table-cell pr-6 font-semibold text-primary dark:text-azwara-lighter">
                        {{ $attempt->score }}
                    </td>

                    {{-- DURASI (DESKTOP) --}}
                    <td class="hidden md:table-cell text-gray-700 dark:text-gray-200">
                        {{ floor($attempt->work_duration_seconds / 60) }} menit
                        {{ $attempt->work_duration_seconds % 60 }} detik
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-8 text-center text-gray-500">
                        Belum ada peserta
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
