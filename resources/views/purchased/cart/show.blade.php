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
                    <form method="POST"
                          action="{{ route('cart.update', $item) }}">
                        @csrf
                        @method('PATCH')
                        <input type="number"
                               name="qty"
                               min="1"
                               value="{{ $item->qty }}"
                               class="w-20 rounded-lg border-gray-300
                                      dark:bg-azwara-darkest
                                      dark:border-azwara-darker
                                      focus:ring-primary focus:border-primary">
                    </form>

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
        @include('purchase.components.cart_summary', [
            'cart' => $cart,
            'showAction' => true,
        ])
    </div>

</div>
@endsection
