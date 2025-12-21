@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            Bonus Produk
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Atur bonus otomatis yang didapat saat membeli produk
        </p>
    </div>

    <div class="overflow-x-auto rounded-2xl border dark:border-azwara-darker
                bg-white dark:bg-azwara-darkest">

        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 dark:bg-azwara-darker">
                <tr class="text-left text-gray-600 dark:text-gray-300">
                    <th class="px-6 py-4">Produk</th>
                    <th class="px-6 py-4">Tipe</th>
                    <th class="px-6 py-4">Bonus</th>
                    <th class="px-6 py-4"></th>
                </tr>
            </thead>

            <tbody class="divide-y dark:divide-azwara-darker">
                @forelse($products as $product)
                    <tr>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $product->name }}
                        </td>

                        <td class="px-6 py-4">
                            {{ strtoupper($product->type) }}
                        </td>

                        <td class="px-6 py-4">
                            @if($product->bonuses->isEmpty())
                                <span class="text-gray-500">—</span>
                            @else
                                <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">
                                    @foreach($product->bonuses as $bonus)
                                        <li>{{ strtoupper($bonus->bonus_type) }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('purchase.bonuses.edit', $product) }}"
                               class="text-primary font-semibold hover:underline">
                                Atur Bonus
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                            Belum ada produk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>
@endsection
