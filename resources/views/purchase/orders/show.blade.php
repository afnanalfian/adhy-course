@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-8">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Order #{{ $order->code }}
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Detail transaksi pembelian
            </p>
        </div>

        <span class="inline-flex px-4 py-2 rounded-xl text-sm font-semibold
            {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' :
               ($order->status === 'verified' ? 'bg-green-100 text-green-700' :
               'bg-red-100 text-red-700') }}">
            {{ strtoupper($order->status) }}
        </span>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">

        {{-- ORDER ITEMS --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="p-6 rounded-2xl border dark:border-azwara-darker
                        bg-white dark:bg-azwara-darkest">

                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    Item Pembelian
                </h2>

                @foreach($order->items as $item)
                    <div class="flex justify-between py-2 border-b dark:border-azwara-darker last:border-none">
                        <span class="text-gray-700 dark:text-gray-300">
                            {{ $item->name }}
                        </span>
                        <span class="font-medium text-gray-900 dark:text-white">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </span>
                    </div>
                @endforeach

                <div class="flex justify-between pt-4 mt-4 border-t dark:border-azwara-darker">
                    <span class="font-semibold text-gray-800 dark:text-gray-200">
                        Total
                    </span>
                    <span class="text-lg font-bold text-primary">
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

        {{-- PAYMENT & ACTION --}}
        <div class="space-y-6">

            {{-- PAYMENT PROOF --}}
            <div class="p-6 rounded-2xl border dark:border-azwara-darker
                        bg-white dark:bg-azwara-darkest">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    Bukti Pembayaran
                </h2>

                @if($order->payment_proof)
                    <img src="{{ asset('storage/' . $order->payment_proof) }}"
                         alt="Bukti Pembayaran"
                         class="rounded-xl border">
                @else
                    <p class="text-sm text-gray-500">
                        Bukti pembayaran belum diupload.
                    </p>
                @endif
            </div>

            {{-- ACTION --}}
            @if($order->status === 'pending')
                <div class="p-6 rounded-2xl border dark:border-azwara-darker
                            bg-white dark:bg-azwara-darkest space-y-4">

                    <form method="POST"
                          action="{{ route('orders.approve', $order) }}">
                        @csrf
                        <button type="submit"
                                class="w-full bg-green-600 hover:bg-green-700
                                       text-white font-semibold py-3 rounded-xl transition">
                            ACC Pembayaran
                        </button>
                    </form>

                    <form method="POST"
                          action="{{ route('orders.reject', $order) }}">
                        @csrf
                        <button type="submit"
                                class="w-full bg-red-600 hover:bg-red-700
                                       text-white font-semibold py-3 rounded-xl transition">
                            Reject Pembayaran
                        </button>
                    </form>
                </div>
            @endif

        </div>
    </div>

</div>
@endsection
