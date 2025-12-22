@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Discount & Voucher
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Kelola kode promo dan potongan harga
            </p>
        </div>

        <a href="{{ route('discounts.create') }}"
           class="bg-primary hover:bg-azwara-medium
                  text-white font-semibold px-5 py-2.5 rounded-xl transition">
            + Tambah Discount
        </a>
    </div>

    <div class="overflow-x-auto rounded-2xl border dark:border-azwara-darker
                bg-white dark:bg-azwara-darkest">

        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 dark:bg-azwara-darker">
                <tr class="text-left text-gray-600 dark:text-gray-300">
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Kode</th>
                    <th class="px-6 py-4">Tipe</th>
                    <th class="px-6 py-4">Nilai</th>
                    <th class="px-6 py-4">Berlaku</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4"></th>
                </tr>
            </thead>

            <tbody class="divide-y dark:divide-azwara-darker">
                @forelse($discounts as $discount)
                    <tr class="hover:bg-gray-50 dark:hover:bg-azwara-darker/50">
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                            {{ $discount->name }}
                        </td>
                        <td class="px-6 py-4 font-mono font-semibold text-gray-900 dark:text-white">
                            {{ $discount->code }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $discount->type_label }}
                        </td>

                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                            @if($discount->type === 'percentage')
                                {{ $discount->value }}%
                            @else
                                Rp {{ number_format($discount->value, 0, ',', '.') }}
                            @endif
                        </td>

                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                            {{ $discount->starts_at?->format('d M Y') ?? '—' }}
                            –
                            {{ $discount->ends_at?->format('d M Y') ?? '—' }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="inline-flex px-3 py-1 rounded-lg text-xs font-semibold
                                {{ $discount->is_currently_active
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-gray-100 text-gray-600' }}">
                                {{ $discount->is_currently_active ? 'AKTIF' : 'NONAKTIF' }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('discounts.show', $discount) }}"
                               class="text-primary font-semibold hover:underline">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                            Belum ada discount.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
<div class="mt-6">
    {{ $discounts->links() }}
</div>
</div>
@endsection
