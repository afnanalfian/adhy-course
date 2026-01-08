@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    {{-- PAGE TITLE --}}
    <div class="text-center space-y-2">
        <h1 class="text-2xl font-semibold text-slate-800 dark:text-slate-100">
            Menunggu Verifikasi Pembayaran
        </h1>
        <p class="text-sm text-slate-600 dark:text-slate-400">
            Pembayaran Anda sedang menunggu verifikasi dari admin.
        </p>
    </div>

    {{-- STATUS CARD --}}
    <div class="bg-white dark:bg-secondary/60
                border border-slate-200 dark:border-white/10
                rounded-xl shadow-sm
                p-6 space-y-4">

        <div class="flex items-center justify-center">
            <div
                class="inline-flex items-center gap-2
                       px-4 py-2 rounded-full
                       bg-blue-100 text-blue-700
                       dark:bg-blue-500/20 dark:text-blue-300
                       text-sm font-medium">
                Status: Menunggu Verifikasi
            </div>
        </div>

        <div class="text-center text-sm text-slate-700 dark:text-slate-300 space-y-2">
            <p>
                Terima kasih. Bukti pembayaran Anda telah berhasil diunggah.
            </p>
            <p>
                Admin akan memverifikasi pembayaran Anda dalam waktu maksimal
                <span class="font-medium">1 × 24 jam</span>.
            </p>
            <p>
                Setelah pembayaran terverifikasi, akses ke produk akan otomatis aktif.
            </p>
        </div>

        {{-- ORDER INFO --}}
        <div class="border-t border-slate-200 dark:border-white/10 pt-4 text-sm">
            <div class="flex justify-between text-slate-600 dark:text-slate-400">
                <span>Nomor Order</span>
                <span class="font-medium text-slate-800 dark:text-slate-100">
                    {{ $order->order_code }}
                </span>
            </div>
        </div>
    </div>

    {{-- ACTION --}}
    <div class="flex justify-center">
        <a
            href="{{ route('my.orders.index') }}"
            class="inline-flex items-center justify-center
                   px-6 py-3 rounded-lg
                   border border-slate-300 dark:border-white/10
                   text-slate-700 dark:text-slate-200
                   hover:bg-slate-100 dark:hover:bg-white/10
                   transition">
            Lihat Riwayat Order
        </a>
    </div>

</div>
@endsection
