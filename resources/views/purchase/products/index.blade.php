@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Products
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Kelola product yang dapat dijual (meeting, course package, tryout, addon)
            </p>
        </div>

        <a href="{{ route('products.create') }}"
           class="bg-primary hover:bg-azwara-medium
                  text-white font-semibold px-5 py-2.5 rounded-xl transition">
            + Tambah Product
        </a>
    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto rounded-2xl border dark:border-azwara-darker
                bg-white dark:bg-azwara-darkest">

        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 dark:bg-azwara-darker">
                <tr class="text-left text-gray-600 dark:text-gray-300">
                    <th class="px-6 py-4">Nama Product</th>
                    <th class="px-6 py-4">Tipe</th>
                    <th class="px-6 py-4">Konten</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right"></th>
                </tr>
            </thead>

            <tbody class="divide-y dark:divide-azwara-darker">
                @forelse($products as $product)
                    <tr>

                        {{-- NAMA --}}
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $product->name }}
                        </td>

                        {{-- TYPE --}}
                        <td class="px-6 py-4">
                            <span class="uppercase text-xs font-semibold
                                px-2.5 py-1 rounded-lg
                                bg-gray-100 dark:bg-azwara-darker
                                text-gray-700 dark:text-gray-300">
                                {{ str_replace('_', ' ', $product->type) }}
                            </span>
                        </td>

                        {{-- PRODUCTABLE --}}
                        <td class="px-6 py-4 text-gray-700 dark:text-gray-300">
                            @if ($product->productable && $product->productable->productable)
                                @switch($product->type)
                                    @case('meeting')
                                        {{ $product->productable->productable->title }}
                                        @break

                                    @case('course_package')
                                        {{ $product->productable->productable->name }}
                                        @break

                                    @case('tryout')
                                        {{ $product->productable->productable->title }}
                                        @break

                                    @default
                                        —
                                @endswitch
                            @else
                                <span class="italic text-gray-400">
                                    Addon / Global
                                </span>
                            @endif
                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-4">
                            <span class="inline-flex px-3 py-1 rounded-lg text-xs font-semibold
                                {{ $product->is_active
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-gray-100 text-gray-600' }}">
                                {{ $product->is_active ? 'AKTIF' : 'NONAKTIF' }}
                            </span>
                        </td>

                        {{-- ACTIONS --}}
                        <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">

                            {{-- EDIT --}}
                            <a href="{{ route('products.edit', $product) }}"
                               class="text-primary font-semibold hover:underline">
                                Edit
                            </a>

                            {{-- TOGGLE ACTIVE --}}
                            <form method="POST"
                                  action="{{ route('products.toggle', $product) }}"
                                  class="inline sweet-confirm"
                                  data-message="Yakin ingin mengubah status product ini?">
                                @csrf
                                @method('PATCH')

                                <button type="submit"
                                        class="font-semibold
                                            {{ $product->is_active
                                                ? 'text-red-600 hover:underline'
                                                : 'text-green-600 hover:underline' }}">
                                    {{ $product->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </form>

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                            Belum ada product.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
