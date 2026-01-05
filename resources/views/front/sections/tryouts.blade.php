{{-- resources/views/front/sections/tryouts.blade.php --}}
<section id="tryouts" class="scroll-mt-20 py-12 lg:py-16 bg-azwara-lightest">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-azwara-darkest mb-3">
                <span class="text-primary">Tryout</span> Online
            </h2>
            <p class="text-secondary max-w-2xl mx-auto">
                Uji kemampuan Anda dengan tryout berkualitas untuk persiapan ujian.
            </p>
        </div>

        @if($tryouts->count() > 0)
            {{-- Tryouts Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                @foreach($tryouts as $tryout)
                    @php
                        // Get tryout product
                        $tryoutProduct = $products
                            ->get('tryout', collect())
                            ->firstWhere('context.id', $tryout->id);

                        // Get price
                        $price = $tryoutProduct ? $tryoutProduct['pricing']['price'] : 0;

                        // Format exam date
                        $examDate = $tryout->exam_date ? $tryout->exam_date->format('d F Y, H:i') : 'Tanggal Fleksibel';
                    @endphp

                    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-azwara-lighter/50 overflow-hidden">
                        <div class="p-5">
                            {{-- Tryout Header --}}
                            <div class="mb-4">
                                <h3 class="text-lg font-bold text-azwara-darkest mb-2 line-clamp-2">
                                    {{ $tryout->title }}
                                </h3>

                                {{-- Exam Date --}}
                                <div class="flex items-center gap-2 text-sm text-secondary mb-3">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>{{ $examDate }}</span>
                                </div>
                            </div>

                            {{-- Description --}}
                            @if($tryoutProduct && $tryoutProduct['description'])
                                <div class="mb-4">
                                    <p class="text-sm text-secondary line-clamp-2">
                                        {{ $tryoutProduct['description'] }}
                                    </p>
                                </div>
                            @endif

                            {{-- Price & Action --}}
                            <div class="pt-4 border-t border-azwara-lighter/50">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <span class="text-sm font-semibold text-azwara-darkest">Harga Tryout</span>
                                    </div>
                                    <div class="text-right">
                                        @if($price > 0)
                                            <div class="text-lg font-bold text-primary">
                                                Rp {{ number_format($price, 0, ',', '.') }}
                                            </div>
                                        @else
                                            <div class="text-lg font-bold text-green-600">
                                                GRATIS
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Daftar Button --}}
                                <a href="{{ route('browse.index', ['tryout' => $tryout->id]) }}"
                                   class="block w-full px-4 py-2.5 bg-gradient-to-r from-primary to-azwara-darker text-white font-medium rounded-lg hover:opacity-90 transition duration-300 text-center text-sm">
                                    Daftar Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- CTA --}}
            <div class="text-center">
                <a href="{{ route('tryouts.index') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 border border-primary text-primary font-medium rounded-lg hover:bg-primary hover:text-white transition duration-300 text-sm">
                    Lihat Semua Tryout
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>

        @else
            {{-- Empty State --}}
            <div class="text-center py-10">
                <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-azwara-lighter text-primary mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-azwara-darkest mb-2">
                    Tryout Sedang Disiapkan
                </h3>
                <p class="text-secondary max-w-md mx-auto">
                    Kami sedang mempersiapkan tryout berkualitas untuk Anda. Segera hadir!
                </p>
            </div>
        @endif
    </div>
</section>
