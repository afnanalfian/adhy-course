@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            Produk Saya
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Daftar course, pertemuan, tryout, dan quiz yang sudah kamu miliki
        </p>
    </div>

    {{-- COURSES --}}
    <section class="space-y-4">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
            Course
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($ownedCourses as $course)
                @include('purchase.components.product_card', [
                    'title' => $course->name,
                    'description' => $course->description,
                    'priceLabel' => 'Dimiliki',
                    'actionUrl' => route('courses.show', $course),
                    'actionText' => 'Masuk Course',
                ])
            @empty
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Kamu belum memiliki course.
                </p>
            @endforelse
        </div>
    </section>

    {{-- TRYOUT --}}
    <section class="space-y-4">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
            Tryout
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($ownedTryouts as $tryout)
                @include('purchase.components.product_card', [
                    'title' => $tryout->name,
                    'description' => $tryout->description,
                    'priceLabel' => 'Akses Aktif',
                    'actionUrl' => route('exams.show', $tryout),
                    'actionText' => 'Mulai Tryout',
                ])
            @empty
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Tidak ada tryout aktif.
                </p>
            @endforelse
        </div>
    </section>

    {{-- QUIZ --}}
    @if($hasQuizAccess)
        <div class="rounded-2xl p-6 bg-primary/10 dark:bg-primary/20">
            <h3 class="text-lg font-semibold text-primary">
                Akses Quiz Harian Aktif
            </h3>
            <p class="text-sm text-gray-700 dark:text-gray-300">
                Kamu dapat mengakses seluruh quiz harian.
            </p>
        </div>
    @endif

</div>
@endsection
