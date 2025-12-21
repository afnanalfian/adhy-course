@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            Pengaturan Pembayaran
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            QRIS dan instruksi pembayaran manual
        </p>
    </div>

    <form method="POST"
          action="{{ route('purchase.payment.settings.update') }}"
          enctype="multipart/form-data"
          class="space-y-6 p-6 rounded-2xl border
                 dark:border-azwara-darker
                 bg-white dark:bg-azwara-darkest">
        @csrf

        {{-- QRIS IMAGE --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                QRIS
            </label>

            @if($paymentSetting?->qris_image)
                <img src="{{ asset('storage/' . $paymentSetting->qris_image) }}"
                     class="mt-3 max-w-xs rounded-xl border">
            @endif

            <input type="file" name="qris_image"
                   accept="image/*"
                   class="mt-3 block w-full text-sm
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-xl file:border-0
                          file:bg-primary file:text-white
                          hover:file:bg-azwara-medium">
        </div>

        {{-- INSTRUCTION --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Instruksi Pembayaran
            </label>
            <textarea name="instruction" rows="4"
                      class="mt-1 w-full rounded-xl border-gray-300
                             dark:bg-azwara-darkest dark:border-azwara-darker
                             focus:ring-primary focus:border-primary">{{ old('instruction', $paymentSetting?->instruction) }}</textarea>
        </div>

        <div class="pt-4 flex justify-end">
            <button type="submit"
                    class="px-6 py-2.5 rounded-xl
                           bg-primary hover:bg-azwara-medium
                           text-white font-semibold transition">
                Simpan Pengaturan
            </button>
        </div>

    </form>

</div>
@endsection
