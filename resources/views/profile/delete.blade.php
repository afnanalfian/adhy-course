@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto">
    {{-- Tombol Kembali --}}
    <div class="mb-4">
        <a href="{{ route('profile.show') }}" 
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
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-red-600 dark:text-red-400">Hapus Akun</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Tindakan ini bersifat permanen. Data Anda akan dihapus.
            </p>
        </div>

        <form method="POST" action="{{ route('profile.destroy') }}" x-data="{ other: false }"
              class="space-y-5 sweet-confirm"
              data-message="Yakin ingin menghapus akun? Tindakan ini tidak dapat dibatalkan.">
            @csrf

            {{-- Reason --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Alasan Penghapusan
                </label>
                <select name="reason_option" 
                        x-on:change="other = ($event.target.value === 'Lainnya')"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none transition">
                    <option value="">Pilih alasan</option>
                    <option value="Terlalu mahal">Terlalu mahal</option>
                    <option value="Tidak sesuai kebutuhan">Tidak sesuai kebutuhan</option>
                    <option value="Jarang digunakan">Jarang digunakan</option>
                    <option value="Pindah platform lain">Pindah platform lain</option>
                    <option value="Lainnya">Lainnya...</option>
                </select>

                <input type="text" 
                       x-show="other" 
                       x-transition 
                       name="reason_custom"
                       placeholder="Tuliskan alasan Anda..."
                       class="w-full mt-3 px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none transition">
            </div>

            {{-- Warning --}}
            <div class="rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/30 p-3.5 text-sm text-red-600 dark:text-red-400">
                ⚠️ Pastikan Anda benar-benar yakin sebelum melanjutkan.
            </div>

            {{-- Submit --}}
            <button type="submit" 
                    class="w-full py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-xl transition duration-300 focus:ring-2 focus:ring-red-500/20">
                Hapus Akun
            </button>
        </form>
    </div>
</div>
@endsection