@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            Order Pembelian
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Daftar transaksi siswa yang masuk
        </p>
    </div>

    <div class="overflow-x-auto rounded-2xl border dark:border-azwara-darker
                bg-white dark:bg-azwara-darkest">

        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 dark:bg-azwara-darker">
                <tr class="text-left text-gray-600 dark:text-gray-300">
                    <th class="px-6 py-4">Order ID</th>
                    <th class="px-6 py-4">Siswa</th>
                    <th class="px-6 py-4">Total</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Waktu</th>
                    <th class="px-6 py-4"></th>
                </tr>
            </thead>

            <tbody class="divide-y dark:divide-azwara-darker">
                @forelse($orders as $order)
                    <tr class="hover:bg-gray-50 dark:hover:bg-azwara-darker/50">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            #{{ $order->code }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900 dark:text-white">
                                {{ $order->user->name }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $order->user->email }}
                            </div>
                        </td>

                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </td>

                        <td class="px-6 py-4">
                            @php
                                $statusColor = match($order->status) {
                                    'pending'  => 'bg-yellow-100 text-yellow-700',
                                    'verified' => 'bg-green-100 text-green-700',
                                    'rejected' => 'bg-red-100 text-red-700',
                                    default    => 'bg-gray-100 text-gray-700',
                                };
                            @endphp

                            <span class="inline-flex px-3 py-1 rounded-lg text-xs font-semibold {{ $statusColor }}">
                                {{ strtoupper($order->status) }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                            {{ $order->created_at->format('d M Y H:i') }}
                        </td>

                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('purchase.orders.show', $order) }}"
                               class="text-primary hover:underline font-semibold">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                            Belum ada order masuk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div>
        {{ $orders->links() }}
    </div>

</div>
@endsection
