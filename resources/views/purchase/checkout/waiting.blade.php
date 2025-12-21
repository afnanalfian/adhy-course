@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto text-center space-y-6">

    <div class="p-8 rounded-3xl border dark:border-azwara-darker
                bg-white dark:bg-azwara-darkest shadow-sm">

        <div class="mx-auto w-16 h-16 rounded-full
                    bg-primary/10 flex items-center justify-center">
            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor"
                 stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 8v4l3 3" />
            </svg>
        </div>

        <h1 class="mt-6 text-2xl font-bold text-gray-900 dark:text-white">
            Menunggu Verifikasi
        </h1>

        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            Pembayaran kamu sedang diverifikasi oleh admin.
            Proses ini biasanya tidak memakan waktu lama.
        </p>

        <div class="mt-6">
            <span class="inline-block rounded-xl px-4 py-2
                         bg-primary/10 text-primary font-semibold">
                Status: Pending
            </span>
        </div>
    </div>

</div>
@endsection
