@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- PAGE TITLE --}}
    <div>
        <h1 class="text-2xl font-semibold text-slate-800 dark:text-slate-100">
            {{-- Pembayaran --}}
            Upload Bukti Syarat Tryout
        </h1>
        <p class="text-sm text-slate-600 dark:text-slate-400">
            Silakan upload bukti syarat sebelum waktu berakhir.
        </p>
    </div>

    {{-- ORDER INFO --}}
    <div class="bg-white dark:bg-secondary/60
                border border-slate-200 dark:border-white/10
                rounded-xl shadow-sm">

        <div class="px-6 py-4 border-b border-slate-200 dark:border-white/10">
            <div class="flex justify-between items-center">
                <div class="font-medium text-slate-800 dark:text-slate-100">
                    Order #{{ $order->id }}
                </div>
                <div
                    class="text-xs px-2 py-1 rounded
                           bg-amber-100 text-amber-700
                           dark:bg-amber-500/20 dark:text-amber-300">
                    Menunggu
                </div>
            </div>
        </div>

        <div class="px-6 py-4 space-y-3 text-sm text-slate-700 dark:text-slate-300">
            <div class="flex justify-between">
                <span>Total Pembayaran</span>
                <span class="font-medium">
                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                </span>
            </div>

            <div class="flex justify-between">
                <span>Batas Waktu</span>
                <span class="font-medium">
                    {{ $order->expires_at->format('d M Y, H:i') }}
                </span>
            </div>
        </div>
    </div>

    {{-- PAYMENT METHOD
    <div class="bg-white dark:bg-secondary/60
                border border-slate-200 dark:border-white/10
                rounded-xl shadow-sm">

        <div class="px-6 py-4 border-b border-slate-200 dark:border-white/10">
            <h2 class="font-medium text-slate-800 dark:text-slate-100">
                Pembayaran via QRIS
            </h2>
        </div>

        <div class="px-6 py-6 grid grid-cols-1 md:grid-cols-2 gap-6 items-start">

            QRIS IMAGE
            <div class="flex justify-center">
                @if ($qrisImage)
                    <img
                        src="{{ asset('storage/' . $qrisImage) }}"
                        alt="QRIS"
                        class="max-w-[260px] rounded-lg
                               border border-slate-200 dark:border-white/10
                               bg-white p-2"
                    >
                @else
                    <div
                        class="text-sm text-slate-500
                               border border-dashed border-slate-300
                               rounded-lg p-6 text-center">
                        QRIS belum tersedia
                    </div>
                @endif
            </div>

            INSTRUCTION
            <div class="space-y-3 text-sm text-slate-700 dark:text-slate-300">
                {!! nl2br(e($instruction)) !!}
            </div>
        </div>
    </div> --}}

    {{-- UPLOAD PROOF --}}
    <div class="bg-white dark:bg-secondary/60
                border border-slate-200 dark:border-white/10
                rounded-xl shadow-sm">

        <div class="px-6 py-4 border-b border-slate-200 dark:border-white/10">
            <h2 class="font-medium text-slate-800 dark:text-slate-100">
                {{-- Upload Bukti Pembayaran --}}
                Upload Syarat Tryout
            </h2>
        </div>

        {{-- <form
            method="POST"
            action="{{ route('checkout.uploadProof', $order) }}"
            enctype="multipart/form-data"
            class="px-6 py-4 space-y-4">
            @csrf

            <div>
                <input
                    type="file"
                    name="proof_image"
                    required
                    class="block w-full text-sm
                           text-slate-600 dark:text-slate-300
                           file:mr-4 file:py-2 file:px-4
                           file:rounded-lg file:border-0
                           file:bg-azwara-lightest file:text-azwara-darker
                           dark:file:bg-white/10 dark:file:text-azwara-lighter"
                >
                @error('proof_image')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button
                    type="submit"
                    class="inline-flex items-center justify-center
                           px-6 py-3 rounded-lg
                           bg-primary hover:bg-azwara-darker
                           text-white font-medium
                           transition">
                    Saya Sudah Bayar
                </button>
            </div>
        </form> --}}
        <form
            method="POST"
            action="{{ route('checkout.uploadProof', $order) }}"
            enctype="multipart/form-data"
            class="px-6 py-4 space-y-6">
            @csrf

            {{-- ================= BUKTI 1 (WAJIB) ================= --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                    Bukti Syarat 1 <span class="text-red-500">*</span>
                </label>

                <input
                    type="file"
                    name="proof_images[]"
                    required
                    class="block w-full text-sm
                        text-slate-600 dark:text-slate-300
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-lg file:border-0
                        file:bg-azwara-lightest file:text-azwara-darker
                        dark:file:bg-white/10 dark:file:text-azwara-lighter"
                >

                <p class="text-xs text-slate-500 mt-1">
                    Screenshot - Follow akun instagram azwara_learning.
                </p>
            </div>

            {{-- ================= BUKTI 2 (OPSIONAL) ================= --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                    Bukti Syarat 2 <span class="text-red-500">*</span>
                </label>

                <input
                    type="file"
                    name="proof_images[]"
                    class="block w-full text-sm
                        text-slate-600 dark:text-slate-300
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-lg file:border-0
                        file:bg-azwara-lightest file:text-azwara-darker
                        dark:file:bg-white/10 dark:file:text-azwara-lighter"
                >

                <p class="text-xs text-slate-500 mt-1">
                    Screenshoot - Repost postingan Tryout ke story instagram.
                </p>
            </div>

            {{-- ================= BUKTI 3 (OPSIONAL) ================= --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                    Bukti Syarat 3 <span class="text-red-500">*</span>
                </label>

                <input
                    type="file"
                    name="proof_images[]"
                    class="block w-full text-sm
                        text-slate-600 dark:text-slate-300
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-lg file:border-0
                        file:bg-azwara-lightest file:text-azwara-darker
                        dark:file:bg-white/10 dark:file:text-azwara-lighter"
                >

                <p class="text-xs text-slate-500 mt-1">
                    Screenshoot - Mention 5 teman di kolom komentar.
                </p>
            </div>

            {{-- ================= ERROR GLOBAL ================= --}}
            @error('proof_images')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror

            @error('proof_images.*')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror

            {{-- ================= ACTION ================= --}}
            <div class="flex justify-end pt-2">
                <button
                    type="submit"
                    class="inline-flex items-center justify-center
                        px-6 py-3 rounded-lg
                        bg-primary hover:bg-azwara-darker
                        text-white font-medium
                        transition">
                    Upload Syarat
                </button>
            </div>
        </form>

    </div>

</div>
@endsection
