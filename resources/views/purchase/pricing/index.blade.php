@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Pricing Rules
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Atur harga berdasarkan jumlah, tipe produk, dan status aktif
            </p>
        </div>

        <a href="{{ route('purchase.pricing.create') }}"
           class="bg-primary hover:bg-azwara-medium
                  text-white font-semibold px-5 py-2.5 rounded-xl transition">
            + Tambah Rule
        </a>
    </div>

    <div class="overflow-x-auto rounded-2xl border dark:border-azwara-darker
                bg-white dark:bg-azwara-darkest">

        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 dark:bg-azwara-darker">
                <tr class="text-left text-gray-600 dark:text-gray-300">
                    <th class="px-6 py-4">Produk</th>
                    <th class="px-6 py-4">Tipe</th>
                    <th class="px-6 py-4">Range Qty</th>
                    <th class="px-6 py-4">Harga</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4"></th>
                </tr>
            </thead>

            <tbody class="divide-y dark:divide-azwara-darker">
                @forelse($pricingRules as $rule)
                    <tr>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $rule->product_type }}
                        </td>

                        <td class="px-6 py-4">
                            {{ strtoupper($rule->pricing_type) }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $rule->min_qty }} – {{ $rule->max_qty ?? '∞' }}
                        </td>

                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                            Rp {{ number_format($rule->price, 0, ',', '.') }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="inline-flex px-3 py-1 rounded-lg text-xs font-semibold
                                {{ $rule->is_active
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-gray-100 text-gray-600' }}">
                                {{ $rule->is_active ? 'AKTIF' : 'NONAKTIF' }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="{{ route('purchase.pricing.edit', $rule) }}"
                               class="text-primary font-semibold hover:underline">
                                Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                            Belum ada pricing rule.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
