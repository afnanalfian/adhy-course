@extends('layouts.app')

@section('content')
    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h1 class="text-2xl font-bold text-ens-darker dark:text-ens-lighter">
                Daftar Siswa
            </h1>

            <form method="GET" action="{{ route('siswa.index') }}" class="flex gap-2 w-full sm:w-auto">
                <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Cari nama / phone / daerah asal" class="w-full sm:w-80
                           rounded-xl
                           border-gray-300 dark:border-gray-700
                           bg-ens-lightest dark:bg-ens-darker
                           text-sm text-ens-darkest dark:text-ens-lighter
                           focus:ring-primary focus:border-primary">
                <button class="px-4 py-2 rounded-xl
                           bg-primary text-white font-medium
                           hover:opacity-90 transition">
                    Cari
                </button>
            </form>
        </div>

        {{-- Table Card --}}
        <div class="bg-ens-lightest dark:bg-ens-darker
                   border border-gray-200 dark:border-ens-darkest
                   rounded-2xl
                   shadow-lg dark:shadow-black/40
                   overflow-hidden">

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-primary dark:bg-ens-darkest
                               text-white dark:text-ens-light">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">Siswa</th>
                            <th class="px-6 py-4 text-center font-semibold">Status</th>

                            <th class="px-6 py-4 text-left font-semibold hidden sm:table-cell">
                                Kontak
                            </th>
                            <th class="px-6 py-4 text-left font-semibold hidden sm:table-cell">
                                Provinsi
                            </th>
                            <th class="px-6 py-4 text-left font-semibold hidden sm:table-cell">
                                Kab / Kota
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($siswa as $u)
                            <tr onclick="window.location='{{ route('siswa.show', $u->id) }}'" class="cursor-pointer
                                           hover:bg-ens-lighter dark:hover:bg-ens-darkest
                                           transition">

                                {{-- Siswa --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $u->avatar_url }}" class="w-10 h-10 rounded-full object-cover">
                                        <div class="min-w-0">
                                            <div class="font-semibold truncate
                                                           text-ens-darkest dark:text-ens-lighter">
                                                {{ $u->name }}
                                            </div>
                                            <div class="text-xs truncate
                                                           text-gray-500 dark:text-gray-400">
                                                {{ $u->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-4 text-center">
                                    @if($u->is_active)
                                        <span class="px-3 py-1 rounded-full text-xs
                                                             bg-green-100 text-green-700
                                                             dark:bg-green-900/30 dark:text-green-400">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs
                                                             bg-red-100 text-red-600
                                                             dark:bg-red-900/30 dark:text-red-400">
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>

                                {{-- Kontak --}}
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-300 hidden sm:table-cell">
                                    {{ $u->phone ?? '-' }}
                                </td>

                                {{-- Provinsi --}}
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-300 hidden sm:table-cell">
                                    {{ $u->province->name ?? '-' }}
                                </td>

                                {{-- Kab/Kota --}}
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-300 hidden sm:table-cell">
                                    {{ $u->regency->name ?? '-' }}
                                </td>

                            </tr>
                        @empty
                            {{-- EMPTY STATE --}}
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <div class="w-14 h-14 rounded-full
                                                    bg-ens-light/30
                                                    dark:bg-ens-darkest
                                                    flex items-center justify-center text-ens-medium">
                                            👤
                                        </div>

                                        <p class="text-base font-semibold
                                                    text-ens-darkest dark:text-ens-lighter">
                                            Belum Ada Siswa
                                        </p>

                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            Data siswa akan muncul setelah tersedia
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
            {{ $siswa->links() }}
        </div>

    </div>
@endsection
