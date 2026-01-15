@extends('layouts.app')

@section('content')
    <div x-data="{ open: false }" class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            {{-- Title --}}
            <h1 class="text-2xl font-bold text-ens-darker dark:text-ens-lighter">
                Daftar Tryout
            </h1>

            {{-- Action + Search --}}
            <form method="GET" action="{{ route('exams.index') }}" class="flex flex-col gap-2 w-full sm:flex-row sm:w-auto">

                {{-- Search Judul --}}
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul tryout" class="w-full sm:w-64
                        rounded-xl
                        border-gray-300 dark:border-gray-700
                        bg-ens-lightest dark:bg-ens-darker
                        text-md text-ens-darkest dark:text-ens-lighter
                        focus:ring-primary focus:border-primary">

                {{-- Filter Tanggal --}}
                <input type="date" name="date" value="{{ request('date') }}" class="w-full sm:w-44
                        rounded-xl
                        border-gray-300 dark:border-gray-700
                        bg-ens-lightest dark:bg-ens-darker
                        text-md text-ens-darkest dark:text-ens-lighter
                        focus:ring-primary focus:border-primary">

                {{-- Button Cari --}}
                <button type="submit" class="px-4 py-2 rounded-xl
                        bg-primary text-white text-md font-medium
                        hover:opacity-90 transition">
                    Cari
                </button>

                {{-- Tambah Tryout --}}
                @role('admin')
                <button type="button" @click="open = true" class="px-4 py-2 rounded-xl
                        border border-primary dark:text-ens-lighter dark:border-ens-lighter
                        text-primary text-md font-medium
                        hover:bg-primary hover:text-white
                        transition">
                    Tambah Tryout
                </button>
                @endrole
            </form>
        </div>

        {{-- Table Card --}}
        <div class="bg-ens-lightest dark:bg-ens-darker
                   border border-gray-200 dark:border-ens-darkest
                   rounded-2xl
                   shadow-lg dark:shadow-black/40
                   overflow-hidden">

            <div class="overflow-x-auto">
                <table class="min-w-full text-md">

                    {{-- Head --}}
                    <thead class="bg-primary dark:bg-ens-darkest
                               text-white dark:text-ens-light">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">
                                Tryout
                            </th>
                            <th class="px-6 py-4 text-center font-semibold">
                                Status
                            </th>
                            <th class="px-6 py-4 text-left font-semibold hidden sm:table-cell">
                                Tanggal
                            </th>
                        </tr>
                    </thead>

                    {{-- Body --}}
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($exams as $exam)
                            <tr onclick="window.location='{{ route('exams.show', $exam) }}'" class="cursor-pointer
                                           hover:bg-ens-lighter dark:hover:bg-ens-darkest
                                           transition">

                                {{-- Tryout --}}
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <div class="font-semibold
                                                       text-ens-darkest dark:text-ens-lighter">
                                            {{ $exam->title }}
                                        </div>

                                        {{-- tanggal versi mobile --}}
                                        <div class="text-xs text-gray-500 dark:text-gray-400 sm:hidden">
                                            {{ $exam->exam_date->format('d M Y H:i') }}
                                        </div>
                                    </div>
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium
                                                   bg-primary/10 text-primary
                                                   dark:bg-primary/20 dark:text-ens-lighter">
                                        {{ ucfirst($exam->status) }}
                                    </span>
                                </td>

                                {{-- Tanggal --}}
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-300
                                               hidden sm:table-cell">
                                    {{ $exam->exam_date->format('d M Y H:i') }}
                                </td>
                            </tr>
                        @empty
                            {{-- Empty State --}}
                            <tr>
                                <td colspan="3" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <div class="w-14 h-14 rounded-full
                                                       bg-ens-light/30
                                                       dark:bg-ens-darkest
                                                       flex items-center justify-center
                                                       text-ens-medium">
                                            T
                                        </div>

                                        <p class="text-base font-semibold
                                                       text-ens-darkest dark:text-ens-lighter">
                                            Belum Ada Tryout
                                        </p>

                                        <p class="text-md text-gray-500 dark:text-gray-400">
                                            Data tryout akan muncul setelah tersedia
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div>
            {{ $exams->links() }}
        </div>

        @include('exams.partials._create-modal', ['type' => 'tryout'])
    </div>

@endsection
