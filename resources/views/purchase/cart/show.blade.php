@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto grid lg:grid-cols-3 gap-8">

    {{-- CART ITEMS --}}
    <div class="lg:col-span-2 space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Keranjang
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Periksa kembali item sebelum checkout
            </p>
        </div>

        @forelse($cart->items as $item)
            <div class="flex items-center justify-between gap-4
                        p-5 rounded-2xl border dark:border-azwara-darker
                        bg-white dark:bg-azwara-darkest">

                <div>
                    <p class="font-semibold text-gray-900 dark:text-white">
                        {{ $item->product->name }}
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ ucfirst($item->product->type) }}
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    {{-- QTY --}}
                    <span class="inline-flex items-center px-3 py-1
                                rounded-full text-xs font-medium
                                bg-slate-100 dark:bg-white/10
                                text-slate-700 dark:text-slate-200">
                        Qty: {{ $item->qty }}
                    </span>

                    {{-- PRICE --}}
                    <span class="font-semibold text-gray-900 dark:text-white">
                        Rp {{ number_format($item->price_snapshot * $item->qty, 0, ',', '.') }}
                    </span>

                    {{-- REMOVE --}}
                    <form method="POST"
                          action="{{ route('cart.remove', $item) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-sm text-red-600 hover:underline">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500 dark:text-gray-400">
                Keranjang masih kosong.
            </p>
        @endforelse
    </div>

    {{-- SUMMARY --}}
    <div>
        @include('components.purchase.cart_summary', [
            'cart' => $cart,
            'showAction' => true,
        ])
    </div>

</div>
@endsection
