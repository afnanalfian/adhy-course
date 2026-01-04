@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    {{-- PAGE HEADER --}}
    <div>
        <h1 class="text-2xl font-semibold text-slate-800 dark:text-slate-100">
            Checkout
        </h1>
        <p class="text-sm text-slate-600 dark:text-slate-400">
            Periksa kembali detail pembelian Anda sebelum melanjutkan ke pembayaran.
        </p>
    </div>

    <form method="POST"
          action="{{ route('checkout.process') }}"
          id="checkout-form"
          class="space-y-6">
        @csrf

        {{-- ================= DETAIL PEMBELIAN ================= --}}
        <div class="bg-white dark:bg-secondary/60
                    border border-slate-200 dark:border-white/10
                    rounded-xl shadow-sm overflow-hidden">

            <div class="px-5 py-4 border-b border-slate-200 dark:border-white/10">
                <h2 class="font-medium text-slate-800 dark:text-slate-100">
                    Detail Pembelian
                </h2>
            </div>

            <div class="divide-y divide-slate-200 dark:divide-white/10">
                @foreach ($cart->items as $item)
                    <div class="px-5 py-4 flex flex-col sm:flex-row sm:items-start gap-3">

                        <div class="flex-1 min-w-0">
                            <div class="font-medium text-slate-800 dark:text-slate-100 truncate">
                                {{ $item->product->name }}
                            </div>

                            <div class="text-sm text-slate-600 dark:text-slate-400">
                                Tipe: {{ ucfirst($item->product->type) }}
                                · Qty: {{ $item->qty }}
                            </div>

                            @if ($item->product->bonuses->isNotEmpty())
                                <div class="mt-2 flex flex-wrap gap-2">
                                    @foreach ($item->product->bonuses as $bonus)

                                        @if ($bonus->bonus_type === 'tryout')
                                            <span class="text-xs px-2 py-1 rounded
                                                        bg-azwara-lightest dark:bg-white/10
                                                        text-azwara-darker dark:text-azwara-lighter">
                                                Bonus Tryout:
                                                <strong>
                                                    {{ $bonus->tryout?->title ?? 'Tryout #' . $bonus->bonus_id }}
                                                </strong>
                                            </span>

                                        @elseif ($bonus->bonus_type === 'course')
                                            <span class="text-xs px-2 py-1 rounded
                                                        bg-azwara-lightest dark:bg-white/10
                                                        text-azwara-darker dark:text-azwara-lighter">
                                                Bonus Course:
                                                <strong>
                                                    {{ $bonus->course?->name ?? 'Course #' . $bonus->bonus_id }}
                                                </strong>
                                            </span>

                                        @elseif ($bonus->bonus_type === 'quiz')
                                            <span class="text-xs px-2 py-1 rounded
                                                        bg-azwara-lightest dark:bg-white/10
                                                        text-azwara-darker dark:text-azwara-lighter">
                                                Bonus Quiz (Semua Quiz)
                                            </span>
                                        @endif

                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="text-sm sm:text-right shrink-0">
                            <div class="font-medium text-slate-800 dark:text-slate-100">
                                Rp {{ number_format($item->price_snapshot * $item->qty, 0, ',', '.') }}
                            </div>
                            <div class="text-xs text-slate-500">
                                Rp {{ number_format($item->price_snapshot, 0, ',', '.') }} / item
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ================= DISKON ================= --}}
        {{-- <div class="bg-white dark:bg-secondary/60
                    border border-slate-200 dark:border-white/10
                    rounded-xl shadow-sm">

            <div class="px-5 py-4 border-b border-slate-200 dark:border-white/10">
                <h2 class="font-medium text-slate-800 dark:text-slate-100">
                    Diskon / Voucher
                </h2>
                <p class="text-sm text-slate-500">
                    Pilih salah satu metode diskon (opsional)
                </p>
            </div>

            <div class="px-5 py-5 space-y-5"> --}}

                {{-- VOUCHER --}}
                {{-- <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        Kode Voucher
                    </label>
                    <input type="text"
                           name="voucher_code"
                           placeholder="Contoh: TAHUNBARU2026"
                           class="w-full rounded-lg
                                  bg-white dark:bg-secondary
                                  border-slate-300 dark:border-white/10
                                  text-slate-800 dark:text-slate-100
                                  focus:ring-primary focus:border-primary">
                    <p class="text-xs text-slate-500 mt-1">
                        Kosongkan jika memilih diskon dari daftar
                    </p>
                </div> --}}

                {{-- OR --}}
                {{-- <div class="flex items-center gap-3">
                    <div class="flex-1 h-px bg-slate-200 dark:bg-white/10"></div>
                    <span class="text-xs text-slate-500">ATAU</span>
                    <div class="flex-1 h-px bg-slate-200 dark:bg-white/10"></div>
                </div> --}}

                {{-- DISCOUNT DROPDOWN --}}
                {{-- <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        Pilih Diskon
                    </label>

                    <select name="discount_id"
                            class="w-full rounded-lg
                                   bg-white dark:bg-secondary
                                   border-slate-300 dark:border-white/10
                                   text-slate-800 dark:text-slate-100
                                   focus:ring-primary focus:border-primary">
                        <option value="">-- Tidak menggunakan diskon --</option>

                        @foreach ($availableDiscounts as $discount)
                            <option value="{{ $discount->id }}"
                                    @disabled(! $discount->is_currently_active)>
                                {{ $discount->name }}
                                (
                                {{ $discount->type_label }}
                                @if($discount->type === 'percentage')
                                    {{ $discount->value }}%
                                @else
                                    Rp {{ number_format($discount->value, 0, ',', '.') }}
                                @endif
                                )
                            </option>
                        @endforeach
                    </select>
                </div> --}}

                {{-- APPLY BUTTON --}}
                {{-- <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                    <button type="button"
                            id="apply-discount"
                            class="w-full sm:w-auto px-4 py-2 rounded-lg
                                   bg-slate-100 dark:bg-white/10
                                   text-slate-700 dark:text-slate-200
                                   hover:bg-slate-200 dark:hover:bg-white/20
                                   transition">
                        Pakai Diskon
                    </button>

                    <div id="discount-info"
                         class="hidden text-sm font-medium text-emerald-600">
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- ================= RINGKASAN ================= --}}
        @php
            $subtotal = $cart->items->sum(fn ($i) => $i->price_snapshot * $i->qty);
        @endphp

        <div class="bg-white dark:bg-secondary/60
                    border border-slate-200 dark:border-white/10
                    rounded-xl shadow-sm divide-y divide-slate-200 dark:divide-white/10">

            <div class="px-5 py-4 flex justify-between text-sm">
                <span class="text-slate-600 dark:text-slate-400">Subtotal</span>
                <span class="text-slate-800 dark:text-slate-100">
                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                </span>
            </div>

            <div id="discount-row"
                 class="hidden px-5 py-4 flex justify-between text-sm">
                <span class="text-slate-600 dark:text-slate-400">Diskon</span>
                <span id="discount-amount"
                      class="text-emerald-600 font-medium">
                </span>
            </div>

            <div class="px-5 py-4 flex justify-between items-center">
                <span class="text-slate-700 dark:text-slate-300 font-medium">
                    Total Pembayaran
                </span>
                <span id="total-amount"
                      class="text-xl font-semibold text-slate-800 dark:text-slate-100">
                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                </span>
            </div>
        </div>

        {{-- ================= ACTION ================= --}}
        <div class="flex justify-end sticky bottom-0 bg-transparent">
            <button type="submit"
                    class="w-full sm:w-auto px-6 py-3 rounded-lg
                           bg-primary hover:bg-azwara-darker
                           text-white font-medium transition">
                Lanjut ke Pembayaran
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('apply-discount').addEventListener('click', async () => {
    const voucher = document.querySelector('[name="voucher_code"]').value;
    const discountId = document.querySelector('[name="discount_id"]').value;

    const res = await fetch("{{ route('checkout.preview-discount') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            voucher_code: voucher || null,
            discount_id: discountId || null
        })
    });

    const json = await res.json();

    if (!json.success) {
        alert(json.message);
        return;
    }

    document.getElementById('discount-row').classList.remove('hidden');
    document.getElementById('discount-amount').textContent =
        '- Rp ' + json.data.discount_amount.toLocaleString('id-ID');

    document.getElementById('discount-info').classList.remove('hidden');
    document.getElementById('discount-info').textContent =
        'Anda hemat Rp ' + json.data.discount_amount.toLocaleString('id-ID');

    document.getElementById('total-amount').textContent =
        'Rp ' + json.data.final_total.toLocaleString('id-ID');
});
</script>
@endpush
