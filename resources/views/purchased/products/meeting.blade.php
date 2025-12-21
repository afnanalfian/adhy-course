@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
        Pilih Pertemuan – {{ $course->name }}
    </h1>

    <form method="POST" action="{{ route('cart.add.bulk') }}" class="space-y-4">
        @csrf

        <input type="hidden" name="course_id" value="{{ $course->id }}">

        @foreach($meetings as $meeting)
            <label class="flex items-center justify-between p-4
                          rounded-xl border dark:border-azwara-darker
                          bg-white dark:bg-azwara-darkest cursor-pointer">
                <div>
                    <p class="font-medium text-gray-900 dark:text-white">
                        {{ $meeting->title }}
                    </p>
                    <p class="text-sm text-gray-500">
                        {{ $meeting->date }}
                    </p>
                </div>

                <input type="checkbox"
                       name="meetings[]"
                       value="{{ $meeting->product_id }}"
                       class="rounded text-primary focus:ring-primary">
            </label>
        @endforeach

        <button type="submit"
                class="w-full mt-6 bg-primary hover:bg-azwara-medium
                       text-white font-semibold py-3 rounded-xl transition">
            Tambahkan ke Keranjang
        </button>
    </form>

</div>
@endsection
