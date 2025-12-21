@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-8">

    <div>
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
            {{ $course->name }}
        </h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">
            {{ $course->description }}
        </p>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        {{-- FULL COURSE --}}
        <div class="rounded-2xl p-6 bg-white dark:bg-azwara-darkest border dark:border-azwara-darker">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                Full Course
            </h3>

            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                Akses semua pertemuan, tryout, dan quiz
            </p>

            <div class="mt-4">
                <x-purchase.price_badge
                    label="Rp {{ number_format($course->full_price, 0, ',', '.') }}" />
            </div>

            <a href="{{ route('cart.add', $course->product) }}"
               class="mt-6 block text-center bg-primary hover:bg-azwara-medium
                      text-white font-semibold py-3 rounded-xl transition">
                Beli Full Course
            </a>
        </div>

        {{-- PER MEETING --}}
        <div class="rounded-2xl p-6 bg-white dark:bg-azwara-darkest border dark:border-azwara-darker">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                Beli Per Pertemuan
            </h3>

            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                Pilih pertemuan yang ingin kamu ikuti
            </p>

            <a href="{{ route('purchase.products.meetings', $course) }}"
               class="mt-6 block text-center border border-primary
                      text-primary hover:bg-primary hover:text-white
                      font-semibold py-3 rounded-xl transition">
                Pilih Pertemuan
            </a>
        </div>
    </div>

</div>
@endsection
