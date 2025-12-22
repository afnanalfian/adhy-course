@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    {{-- HEADER --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            {{ $course->name }}
        </h1>

        @if($course->description)
            <p class="text-gray-600 dark:text-gray-400 mt-2">
                {{ $course->description }}
            </p>
        @endif
    </div>

    {{-- HARGA FULL COURSE --}}
    <div class="p-6 rounded-2xl border border-gray-200 dark:border-azwara-darker
        bg-white dark:bg-azwara-darkest space-y-4">

        <p class="font-semibold text-primary dark:text-azwara-lighter">
            Harga Full Course:
            Rp {{ number_format(price_for_course_package(), 0, ',', '.') }}
        </p>

        {{-- BTN BELI FULL COURSE --}}
        @if($course->product)
            <form action="{{ route('cart.add', $course->product->product) }}" method="POST">
                @csrf
                <button type="submit"
                    class="block w-full text-center rounded-xl
                        bg-primary hover:bg-azwara-medium
                        text-white font-semibold py-3 transition">
                    Beli Full Course + Full Akses Tryout & Quiz
                </button>
            </form>
        @endif

    </div>


    {{-- LIST MEETING --}}
    <div class="space-y-4">

        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
            Daftar Pertemuan
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($meetings as $m)

                <div class="rounded-2xl border border-gray-200 dark:border-azwara-darker
                    bg-white dark:bg-azwara-darkest p-6 shadow-sm">

                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                        {{ $m->title }}
                    </h3>

                    {{-- TANGGAL --}}
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                        {{ $m->scheduled_at->format('d M Y, H:i') }}
                    </p>

                    {{-- HARGA MEETING --}}
                    <p class="font-semibold text-primary dark:text-azwara-lighter text-sm">
                        Rp {{ number_format(meeting_price($m->id), 0, ',', '.') }}
                    </p>

                    {{-- TOMBOL ADD TO CART --}}
                    @if($m->product)
                        <form action="{{ route('cart.add', $m->product) }}" method="POST" class="mt-5">
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

            @empty
                <p class="text-gray-600 dark:text-gray-400">
                    Belum ada pertemuan.
                </p>
            @endforelse

        </div>

    </div>

</div>
@endsection
