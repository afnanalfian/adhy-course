@props([
    'cart',        // Cart model (with items.product)
    'showAction' => true,
])

<div class="rounded-2xl border border-gray-200 dark:border-azwara-darker
            bg-white dark:bg-azwara-darkest
            p-6 shadow-sm">

    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
        Ringkasan Pembelian
    </h3>

    @if($cart->items->isEmpty())
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Keranjang masih kosong.
        </p>
    @else
        <ul class="space-y-3">
            @foreach($cart->items as $item)
                <li class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-100">
                            {{ $item->product->name }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Qty: {{ $item->qty }}
                        </p>
                    </div>

                    <div class="text-sm font-semibold text-gray-900 dark:text-white">
                        Rp {{ number_format($item->price_snapshot * $item->qty, 0, ',', '.') }}
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="mt-6 pt-4 border-t border-gray-200 dark:border-azwara-darker
                    flex items-center justify-between">
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                Total
            </span>
            <span class="text-lg font-bold text-primary">
                Rp {{ number_format(
                    $cart->items->sum(fn($i) => $i->price_snapshot * $i->qty),
                    0, ',', '.'
                ) }}
            </span>
        </div>

        @if($showAction)
            <div class="mt-5">
                <a href="{{ route('checkout.process') }}"
                   class="block w-full text-center rounded-xl
                          bg-primary hover:bg-azwara-medium
                          text-white font-semibold py-3 transition">
                    Checkout
                </a>
            </div>
        @endif
    @endif
</div>
