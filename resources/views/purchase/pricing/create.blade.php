@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            Tambah Pricing Rule
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Tentukan harga berdasarkan kuantitas atau tipe produk
        </p>
    </div>

    <form method="POST"
          action="{{ route('pricing.store') }}"
          class="space-y-6
                 p-6 rounded-2xl border dark:border-azwara-darker
                 bg-white dark:bg-azwara-darkest">
        @csrf

        {{-- PRODUCT TYPE --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Tipe Produk
            </label>
            <select name="product_type"
                    class="mt-1 w-full rounded-xl border-gray-300
                           dark:bg-azwara-darkest dark:border-azwara-darker
                           focus:ring-primary focus:border-primary">
                <option value="meeting">Meeting</option>
                <option value="tryout">Tryout</option>
                <option value="course_package">Course</option>
                <option value="addon">Addon</option>
            </select>
        </div>

        {{-- PRICING TYPE --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Tipe Harga
            </label>
            <select name="pricing_type" id="pricing_type"
                    class="mt-1 w-full rounded-xl border-gray-300
                           dark:bg-azwara-darkest dark:border-azwara-darker
                           focus:ring-primary focus:border-primary">
                <option value="per_unit">Per Unit</option>
                <option value="fixed">Harga Tetap</option>
            </select>
        </div>

        {{-- QTY RANGE --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Minimum Qty
                </label>
                <input type="number" name="min_qty" min="1"
                       class="mt-1 w-full rounded-xl border-gray-300
                              dark:bg-azwara-darkest dark:border-azwara-darker
                              focus:ring-primary focus:border-primary">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Maksimum Qty (opsional)
                </label>
                <input type="number" name="max_qty" min="1"
                       class="mt-1 w-full rounded-xl border-gray-300
                              dark:bg-azwara-darkest dark:border-azwara-darker
                              focus:ring-primary focus:border-primary">
            </div>
        </div>

        {{-- PRICE --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Harga
            </label>
            <input type="number" name="price" id="price" min="0" step="0.01"
                   class="mt-1 w-full rounded-xl border-gray-300
                          dark:bg-azwara-darkest dark:border-azwara-darker
                          focus:ring-primary focus:border-primary">
        </div>

        {{-- ACTIVE --}}
        <div class="flex items-center gap-3">
            <input type="checkbox" name="is_active" value="1"
                   checked
                   class="rounded text-primary focus:ring-primary">
            <span class="text-sm text-gray-700 dark:text-gray-300">
                Aktifkan pricing rule
            </span>
        </div>

        <div class="pt-4 flex justify-end gap-3">
            <a href="{{ route('pricing.index') }}"
               class="px-5 py-2.5 rounded-xl border
                      text-gray-700 dark:text-gray-300">
                Batal
            </a>

            <button type="submit"
                    class="px-6 py-2.5 rounded-xl
                           bg-primary hover:bg-azwara-medium
                           text-white font-semibold transition">
                Simpan
            </button>
        </div>

    </form>

</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const pricingType = document.getElementById('pricing_type');
    const priceInput  = document.getElementById('price');

    function updatePlaceholder() {
        if (pricingType.value === 'per_unit') {
            priceInput.placeholder = 'Harga per unit';
        } else {
            priceInput.placeholder = 'Harga total (fixed)';
        }
    }

    pricingType.addEventListener('change', updatePlaceholder);
    updatePlaceholder();
});
</script>
@endpush
