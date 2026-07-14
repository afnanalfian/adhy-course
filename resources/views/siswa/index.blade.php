@extends('layouts.app')

@section('content')
<div class="space-y-5">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            Daftar Siswa
        </h1>

        <form method="GET" action="{{ route('siswa.index') }}" class="flex gap-2 w-full sm:w-auto">
            <input type="text" 
                   name="q" 
                   value="{{ $q ?? '' }}" 
                   placeholder="Cari nama / phone / daerah asal" 
                   class="flex-1 sm:w-72 px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition text-sm">
            <button type="submit" 
                    class="px-5 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-xl transition">
                Cari
            </button>
        </form>
    </div>

    {{-- Table Card --}}
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-900/50 border-b border-gray-200 dark:border-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Siswa</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider hidden sm:table-cell">Kontak</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider hidden md:table-cell">Provinsi</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider hidden lg:table-cell">Kab / Kota</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($siswa as $u)
                        <tr onclick="window.location='{{ route('siswa.show', $u->id) }}'" 
                            class="cursor-pointer hover:bg-purple-50 dark:hover:bg-purple-900/10 transition">
                            
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $u->avatar_url }}" 
                                         class="w-9 h-9 rounded-full object-cover border border-gray-200 dark:border-gray-700">
                                    <div class="min-w-0">
                                        <div class="font-medium text-gray-900 dark:text-white truncate">
                                            {{ $u->name }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                            {{ $u->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-3 text-center">
                                @if($u->is_active)
                                    <span class="inline-block px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-block px-2.5 py-1 text-xs font-medium rounded-full bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400 text-xs hidden sm:table-cell">
                                {{ $u->phone ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400 text-xs hidden md:table-cell">
                                {{ $u->province->name ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400 text-xs hidden lg:table-cell">
                                {{ $u->regency->name ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-12 text-center">
                                <p class="text-gray-500 dark:text-gray-400">Belum ada siswa</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($siswa->hasPages())
        <div>
            {{ $siswa->links() }}
        </div>
    @endif

</div>
@endsection