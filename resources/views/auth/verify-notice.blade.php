@extends('layouts.guest')

@section('content')
<div class="w-full min-h-[80vh] flex items-center justify-center px-4">

    <div class="
        bg-white dark:bg-azwara-darker
        shadow-xl dark:shadow-none
        rounded-2xl p-10 w-full max-w-lg
        border border-gray-100 dark:border-azwara-medium/20
        transition-colors
    ">

        {{-- Icon --}}
        <div class="flex justify-center mb-6">
            <div class="
                w-20 h-20 rounded-full
                bg-azwara-light dark:bg-azwara-darkest
                flex items-center justify-center
                shadow-inner dark:shadow-none
                border border-azwara-light/50 dark:border-azwara-medium/20
            ">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-12 h-12 text-azwara-darker dark:text-azwara-lighter"
                     fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25H4.5a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5H4.5a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-.72 1.657l-7.47 7.196a2.25 2.25 0 01-3.14 0L2.97 8.657a2.25 2.25 0 01-.72-1.657V6.75" />
                </svg>
            </div>
        </div>

        {{-- Title --}}
        <h2 class="
            text-2xl font-bold text-center
            text-azwara-darker dark:text-azwara-lighter
        ">
            Verifikasi Email Anda
        </h2>

        {{-- Message --}}
        <p class="
            mt-4 text-center leading-relaxed
            text-gray-600 dark:text-white
        ">
            Kami telah mengirimkan tautan verifikasi ke email Anda.
            <br>
            Silakan periksa <strong>Inbox</strong> atau <strong>folder Spam</strong>.
        </p>

        {{-- Resend status --}}
        @if (session('status') == 'verification-link-sent')
            <div class="
                bg-green-100 dark:bg-green-900
                text-green-700 dark:text-green-300
                p-3 rounded text-sm text-center mt-4
                border border-green-300/40 dark:border-green-600/30
            ">
                Link verifikasi baru telah dikirim.
            </div>
        @endif

        {{-- Resend button --}}
        <form method="POST" action="{{ route('verification.send') }}" class="mt-8">
            @csrf
            <button
                class="
                    w-full py-3 rounded-lg font-bold
                    text-white bg-primary hover:bg-azwara-medium
                    dark:bg-azwara-medium dark:hover:bg-primary
                    shadow hover:shadow-lg
                    transition
                ">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        {{-- Back to home --}}
        <a href="{{ route('home') }}"
           class="
                block text-center mt-4 font-medium
                text-primary dark:text-azwara-light hover:underline
            ">
            ← Kembali ke halaman utama
        </a>

    </div>

</div>
@endsection
