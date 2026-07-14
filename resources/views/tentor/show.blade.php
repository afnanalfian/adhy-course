@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    {{-- Back --}}
    <div class="mb-4">
        <a href="{{ route('tentor.index') }}" 
           class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>
    </div>

    {{-- Card --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 sm:p-8">
        {{-- Header --}}
        <div class="flex items-center gap-4">
            <img src="{{ $teacher->user->avatar_url }}"
                 class="w-16 h-16 rounded-full object-cover border-2 border-purple-500/30 flex-shrink-0">

            <div class="flex-1 min-w-0">
                <h1 class="text-xl font-bold text-gray-900 dark:text-white truncate">
                    {{ $teacher->user->name }}
                </h1>
                @role('admin')
                    <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                        {{ $teacher->user->email }}
                    </p>
                    @if($teacher->user->phone)
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $teacher->user->phone }}
                        </p>
                    @endif
                @endrole
            </div>

            {{-- Status --}}
            @if($teacher->user->is_active)
                <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 flex-shrink-0">
                    Aktif
                </span>
            @else
                <span class="px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400 flex-shrink-0">
                    Nonaktif
                </span>
            @endif
        </div>

        {{-- Divider --}}
        <hr class="my-6 border-gray-200 dark:border-gray-700">

        {{-- Domisili --}}
        <h2 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Domisili</h2>
        <div class="grid sm:grid-cols-2 gap-4 text-sm mb-6">
            <div>
                <p class="text-xs text-gray-400 dark:text-gray-500 uppercase tracking-wider">Provinsi</p>
                <p class="font-medium text-gray-900 dark:text-white mt-1">
                    {{ $teacher->user->province->name ?? '-' }}
                </p>
            </div>
            <div>
                <p class="text-xs text-gray-400 dark:text-gray-500 uppercase tracking-wider">Kab / Kota</p>
                <p class="font-medium text-gray-900 dark:text-white mt-1">
                    {{ $teacher->user->regency->name ?? '-' }}
                </p>
            </div>
        </div>

        {{-- Bio --}}
        <h2 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Bio</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
            {{ $teacher->bio ?: '-' }}
        </p>

        {{-- Courses --}}
        <div class="mt-6">
            <h2 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Course yang Diajarkan</h2>
            <div class="flex flex-wrap gap-2">
                @forelse($teacher->courses as $c)
                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400">
                        {{ $c->name }}
                    </span>
                @empty
                    <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada</p>
                @endforelse
            </div>
        </div>

        {{-- Actions --}}
        @role('admin')
        <div class="flex flex-wrap gap-3 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
            {{-- WhatsApp --}}
            <a href="https://wa.me/{{ $teacher->user->whatsapp_phone }}" target="_blank"
               class="px-5 py-2.5 text-sm font-medium text-white bg-green-600 rounded-xl hover:bg-green-700 transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21l1.65-3.3A8.99 8.99 0 1121 12a9 9 0 01-9 9H3z" />
                </svg>
                WhatsApp
            </a>

            {{-- Edit --}}
            <a href="{{ route('tentor.edit', $teacher->id) }}"
               class="px-5 py-2.5 text-sm font-medium text-white bg-purple-600 rounded-xl hover:bg-purple-700 transition">
                Edit
            </a>

            {{-- Toggle Active --}}
            <form method="POST" action="{{ route('tentor.toggle', $teacher->id) }}" 
                  class="sweet-confirm" 
                  data-message="Yakin ingin mengubah status tentor ini?">
                @csrf
                <button type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-white rounded-xl transition
                               {{ $teacher->user->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-blue-600 hover:bg-blue-700' }}">
                    {{ $teacher->user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                </button>
            </form>

            {{-- Delete --}}
            <form method="POST" action="{{ route('tentor.remove', $teacher->id) }}" 
                  class="sweet-confirm" 
                  data-message="Yakin ingin menghapus tentor ini?">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-gray-600 rounded-xl hover:bg-gray-700 transition">
                    Hapus
                </button>
            </form>
        </div>
        @endrole
    </div>
</div>
@endsection