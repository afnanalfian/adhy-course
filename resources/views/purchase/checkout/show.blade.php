@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto grid lg:grid-cols-2 gap-10">

    {{-- ORDER DETAIL --}}
    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Checkout
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Silakan lakukan pembayaran melalui QRIS
            </p>
        </div>

        <div class="p-6 rounded-2xl border dark:border-azwara-darker
                    bg-white dark:bg-azwara-darkest space-y-4">

            @foreach($order->items as $item)
                <div class="flex justify-between text-sm">
                    <span class="text-gray-700 dark:text-gray-300">
                        {{ $item->name }}
                    </span>
                    <span class="font-medium text-gray-900 dark:text-white">
                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                    </span>
                </div>
            @endforeach

            {{-- ADDON QUIZ --}}
            @if($quizAddonAvailable)
                <form method="POST"
                      action="{{ route('checkout.process') }}">
                    @csrf
                    <label class="flex items-center gap-3 mt-4">
                        <input type="checkbox"
                               name="quiz_addon"
                               value="1"
                               {{ $order->quiz_addon ? 'checked' : '' }}
                               class="rounded text-primary focus:ring-primary">
                        <span class="text-sm text-gray-700 dark:text-gray-300">
                            Tambah akses Quiz Harian (+Rp {{ number_format($quizAddonPrice, 0, ',', '.') }})
                        </span>
                    </label>
                </form>
            @endif

            <div class="pt-4 border-t dark:border-azwara-darker flex justify-between">
                <span class="font-semibold text-gray-800 dark:text-gray-200">
                    Total Bayar
                </span>
                <span class="text-xl font-bold text-primary">
                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                </span>
            </div>
        </div>
    </div>

    {{-- PAYMENT --}}
    <div class="space-y-6">
        <div class="p-6 rounded-2xl border dark:border-azwara-darker
                    bg-white dark:bg-azwara-darkest space-y-4">

            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                Pembayaran QRIS
            </h2>

            <img src="{{ asset('storage/' . $paymentSetting->qris_image) }}"
                 alt="QRIS"
                 class="mx-auto max-w-xs rounded-xl">

            <p class="text-sm text-gray-600 dark:text-gray-400 text-center">
                Scan QRIS di atas, lalu upload bukti pembayaran
            </p>

            <a href="{{ route('checkout.upload', $order) }}"
               class="block text-center mt-6 bg-primary hover:bg-azwara-medium
                      text-white font-semibold py-3 rounded-xl transition">
                Sudah Bayar
            </a>
        </div>
    </div>

</div>
@endsection
