@props([
    'title',
    'description' => null,
    'priceLabel' => null,
    'actionUrl' => null,
    'actionText' => 'Tambah ke Keranjang',
    'disabled' => false,
])

<div class="relative rounded-2xl border border-gray-200 dark:border-azwara-darker
            bg-white dark:bg-azwara-darkest
            p-6 shadow-sm transition hover:shadow-md">

    @if($disabled)
        <div class="absolute inset-0 rounded-2xl
                    bg-white/70 dark:bg-black/60
                    flex items-center justify-center z-10">
            <span class="text-sm font-semibold text-gray-600 dark:text-gray-300">
                Sudah Dimiliki
            </span>
        </div>
    @endif

    <div class="space-y-3">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            {{ $title }}
        </h3>

        @if($description)
            <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-3">
                {{ $description }}
            </p>
        @endif

        @if($priceLabel)
            <x-purchase.price_badge :label="$priceLabel" />
        @endif
    </div>

    @if($actionUrl)
        <div class="mt-6">
            <a href="{{ $actionUrl }}"
               class="block text-center rounded-xl
                      {{ $disabled
                            ? 'bg-gray-300 dark:bg-gray-700 cursor-not-allowed'
                            : 'bg-primary hover:bg-azwara-medium'
                      }}
                      text-white font-semibold py-3 transition">
                {{ $actionText }}
            </a>
        </div>
    @endif
</div>
