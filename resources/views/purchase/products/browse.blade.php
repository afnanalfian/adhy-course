@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-10">

    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            Beli Produk
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Pilih course atau tryout sesuai kebutuhanmu
        </p>
    </div>

    {{-- COURSE --}}
    <section class="space-y-4">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
            Course
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($courses as $course)
                @include('purchase.components.product_card', [
                    'title' => $course->name,
                    'description' => $course->description,
                    'priceLabel' => 'Mulai Rp ' . number_format($course->price, 0, ',', '.'),
                    'actionUrl' => route('purchase.products.course.show', $course),
                    'actionText' => 'Lihat Detail',
                    'disabled' => $course->owned,
                ])
            @endforeach
        </div>
    </section>

    {{-- TRYOUT --}}
    <section class="space-y-4">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
            Tryout
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($tryouts as $tryout)
                @include('purchase.components.product_card', [
                    'title' => $tryout->name,
                    'description' => $tryout->description,
                    'priceLabel' => 'Rp ' . number_format($tryout->price, 0, ',', '.'),
                    'actionUrl' => route('cart.add', $tryout->product),
                    'disabled' => $tryout->owned,
                ])
            @endforeach
        </div>
    </section>

</div>
@endsection
