@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            Tambah Discount
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Buat kode voucher atau potongan harga baru
        </p>
    </div>

    <form method="POST"
          action="{{ route('purchase.discounts.store') }}"
          class="space-y-6
                 p-6 rounded-2xl border dark:border-azwara-darker
                 bg-white dark:bg-azwara-darkest">
        @csrf

        {{-- CODE --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Kode Voucher
            </label>
            <input type="text" name="code" required
                   class="mt-1 w-full rounded-xl border-gray-300
                          dark:bg-azwara-darkest dark:border-azwara-darker
                          focus:ring-primary focus:border-primary">
        </div>

        {{-- TYPE --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Tipe Discount
            </label>
            <select name="type"
                    class="mt-1 w-full rounded-xl border-gray-300
                           dark:bg-azwara-darkest dark:border-azwara-darker
                           focus:ring-primary focus:border-primary">
                <option value="percentage">Persentase (%)</option>
                <option value="fixed">Nominal (Rp)</option>
            </select>
        </div>

        {{-- VALUE --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Nilai Discount
            </label>
            <input type="number" name="value" min="0" required
                   class="mt-1 w-full rounded-xl border-gray-300
                          dark:bg-azwara-darkest dark:border-azwara-darker
                          focus:ring-primary focus:border-primary">
        </div>

        {{-- DATE RANGE --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Mulai Berlaku
                </label>
                <input type="date" name="starts_at"
                       class="mt-1 w-full rounded-xl border-gray-300
                              dark:bg-azwara-darkest dark:border-azwara-darker">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Berakhir
                </label>
                <input type="date" name="ends_at"
                       class="mt-1 w-full rounded-xl border-gray-300
                              dark:bg-azwara-darkest dark:border-azwara-darker">
            </div>
        </div>

        {{-- ACTIVE --}}
        <div class="flex items-center gap-3">
            <input type="checkbox" name="is_active" value="1"
                   checked
                   class="rounded text-primary focus:ring-primary">
            <span class="text-sm text-gray-700 dark:text-gray-300">
                Aktifkan discount
            </span>
        </div>

        <div class="pt-4 flex justify-end gap-3">
            <a href="{{ route('purchase.discounts.index') }}"
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
