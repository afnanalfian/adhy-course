@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-8">

    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
        Pilih Tryout
    </h1>

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

</div>
@endsection
