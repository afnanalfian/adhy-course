@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            Atur Bonus – {{ $product->name }}
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Bonus akan otomatis diberikan setelah pembayaran diverifikasi
        </p>
    </div>

    <form method="POST"
          action="{{ route('purchase.bonuses.update', $product) }}"
          class="space-y-6 p-6 rounded-2xl border
                 dark:border-azwara-darker
                 bg-white dark:bg-azwara-darkest">
        @csrf
        @method('PUT')

        {{-- QUIZ --}}
        <div class="flex items-start gap-3">
            <input type="checkbox" name="bonuses[]"
                   value="quiz"
                   @checked($product->hasBonus('quiz'))
                   class="rounded text-primary focus:ring-primary mt-1">
            <div>
                <p class="font-medium text-gray-900 dark:text-white">
                    Akses Quiz
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Memberikan akses penuh ke seluruh quiz
                </p>
            </div>
        </div>

        {{-- TRYOUT --}}
        <div class="flex items-start gap-3">
            <input type="checkbox" name="bonuses[]"
                   value="tryout"
                   @checked($product->hasBonus('tryout'))
                   class="rounded text-primary focus:ring-primary mt-1">
            <div>
                <p class="font-medium text-gray-900 dark:text-white">
                    Semua Tryout
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Akses gratis ke semua tryout
                </p>
            </div>
        </div>

        <div class="pt-4 flex justify-end gap-3">
            <a href="{{ route('purchase.bonuses.index') }}"
               class="px-5 py-2.5 rounded-xl border
                      text-gray-700 dark:text-gray-300">
                Batal
            </a>

            <button type="submit"
                    class="px-6 py-2.5 rounded-xl
                           bg-primary hover:bg-azwara-medium
                           text-white font-semibold transition">
                Simpan Bonus
            </button>
        </div>

    </form>

</div>
@endsection
