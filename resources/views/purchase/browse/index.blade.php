@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-10">

    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
        Etalase Pembelajaran
    </h1>

    {{-- COURSE PACKAGE --}}
    <section class="space-y-4">
        <h2 class="text-lg font-semibold">
            Paket Full Course
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($courses as $course)
                <div class="rounded-2xl border border-gray-200 dark:border-azwara-darker
                    bg-white dark:bg-azwara-darkest p-6 shadow-sm">

                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                        {{ $course['name'] }}
                    </h3>

                    @if($course['description'])
                        <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-3 mb-3">
                            {{ $course['description'] }}
                        </p>
                    @endif

                    {{-- PRICE RANGE MEETING --}}
                    <p class="font-semibold text-primary dark:text-azwara-lighter text-sm">
                        Harga Pertemuan:
                        Rp {{ number_format(price_range_meeting()['min'], 0, ',', '.') }} –
                        Rp {{ number_format(price_range_meeting()['max'], 0, ',', '.') }}
                    </p>

                    <div class="mt-5 space-y-2">
                        {{-- MEETING LIST BTN --}}
                        <a href="{{ route('browse.course', $course['id']) }}"
                            class="block text-center rounded-xl
                                bg-gray-200 hover:bg-gray-300
                                dark:bg-azwara-darker dark:hover:bg-azwara-dark
                                text-gray-800 dark:text-gray-200
                                font-semibold py-3 transition">
                            Detail Pertemuan
                        </a>

                    </div>

                </div>

            @endforeach

        </div>
    </section>


    {{-- TRYOUT --}}
    <section class="space-y-4">
        <h2 class="text-lg font-semibold">
            Tryout
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($tryouts as $t)

                <div class="rounded-2xl border border-gray-200 dark:border-azwara-darker
                    bg-white dark:bg-azwara-darkest p-6 shadow-sm">

                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                        {{ $t['title'] }}
                    </h3>

                    @if($t['description'])
                        <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-3 mb-3">
                            {{ $t['description'] }}
                        </p>
                    @endif

                    {{-- TRYOUT PRICE --}}
                    <p class="font-semibold text-primary dark:text-azwara-lighter text-sm">
                        Rp {{ number_format(price_for_tryout(), 0, ',', '.') }}
                    </p>

                    {{-- ADD TO CART BTN --}}
                    @if($t['product'])
                        <form action="{{ route('cart.add', $t['product']->product) }}" method="POST" class="mt-5">
                            @csrf
                            <button type="submit"
                                class="block w-full text-center rounded-xl
                                    bg-primary hover:bg-azwara-medium
                                    text-white font-semibold py-3 transition">
                                Tambah ke Cart
                            </button>
                        </form>
                    @endif

                </div>

            @endforeach

        </div>
    </section>


</div>
@endsection
