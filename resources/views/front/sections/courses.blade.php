<section id="courses" class="scroll-mt-20 py-16 lg:py-20 bg-azwara-lightest">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ================= SECTION HEADER ================= --}}
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-azwara-darkest mb-4">
                Jelajahi <span class="text-primary">Kelas</span> Kami
            </h2>
            <p class="text-lg text-secondary max-w-2xl mx-auto">
                Kelas gratis dan premium dengan materi terstruktur dan interaktif.
            </p>
        </div>

        @if($courses->count() > 0)

        {{-- ================= HORIZONTAL SWIPE ================= --}}
        <div class="flex gap-6 overflow-x-auto snap-x snap-mandatory pb-6 mb-16 courses-slider">

            @foreach($courses as $course)
                @php
                    $isCourseFree = $course->isFree();

                    $coursePackage = $products
                        ->get('course_package', collect())
                        ->firstWhere('context.id', $course->id);

                    $meetingsCount = $course->meetings_count;
                    $coursePrice   = $coursePackage ? $coursePackage['pricing']['price'] : 0;

                    $meetingPricingRules = \App\Models\PricingRule::active()
                        ->forProductType('meeting')
                        ->forPriceable($course)
                        ->orderBy('min_qty')
                        ->get();
                @endphp

                {{-- ================= COURSE CARD ================= --}}
                <div class="min-w-[90%] md:min-w-[620px] lg:min-w-[720px] snap-start">
                    <div class="bg-white rounded-2xl shadow-xl border border-azwara-lighter overflow-hidden hover:shadow-2xl transition">

                        {{-- Thumbnail --}}
                        @if($course->thumbnail)
                            <div class="h-56 overflow-hidden">
                                <img src="{{ Storage::url($course->thumbnail) }}"
                                     alt="{{ $course->name }}"
                                     class="w-full h-full object-cover">
                            </div>
                        @endif

                        <div class="p-8">

                            {{-- FREE BADGE --}}
                            @if($isCourseFree)
                                <span class="inline-flex items-center gap-2 mb-4 px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Gratis
                                </span>
                            @endif

                            {{-- Title --}}
                            <h3 class="text-2xl font-bold text-azwara-darkest mb-2">
                                {{ $course->name }}
                            </h3>

                            {{-- Teachers --}}
                            @if($course->teachers->count() > 0)
                                <div class="flex items-center gap-2 text-sm text-secondary mb-4">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2
                                                 c0-.656-.126-1.283-.356-1.857M7 20H2v-2
                                                 a3 3 0 015.356-1.857M7 20v-2
                                                 c0-.656.126-1.283.356-1.857
                                                 m0 0a5.002 5.002 0 019.288 0
                                                 M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span>{{ $course->teachers->count() }} Tentor</span>
                                </div>
                            @endif

                            {{-- Description --}}
                            @if($course->description)
                                <p class="text-secondary leading-relaxed mb-6">
                                    {{ $course->description }}
                                </p>
                            @endif

                            {{-- ================= PRICING ================= --}}
                            <div class="border-t border-azwara-lighter pt-6">

                                {{-- FREE COURSE --}}
                                @if($isCourseFree)
                                    <div class="text-center mb-6">
                                        <div class="flex justify-center items-center gap-2 text-green-600 text-3xl font-bold">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M12 8c-1.657 0-3 .895-3 2
                                                         s1.343 2 3 2
                                                         s3 .895 3 2
                                                         -1.343 2 -3 2
                                                         m0-8c1.11 0 2.08.402 2.599 1
                                                         M12 8V7
                                                         m0 1v8
                                                         m0 0v1
                                                         m0-1c-1.11 0-2.08-.402-2.599-1
                                                         M21 12a9 9 0 11-18 0
                                                         9 9 0 0118 0z"/>
                                            </svg>
                                            <span>Gratis</span>
                                        </div>
                                        <p class="text-sm text-secondary">
                                            Akses {{ $meetingsCount }} pertemuan
                                        </p>

                                        <a href="{{ route('browse.index', ['course' => $course->id]) }}"
                                           class="mt-4 block w-full px-6 py-3 bg-green-500 text-white font-medium rounded-xl hover:bg-green-600 transition">
                                            Ikuti Kelas
                                        </a>
                                    </div>

                                {{-- PAID COURSE --}}
                                @elseif($coursePrice > 0)
                                    <div class="flex justify-between items-center mb-4">
                                        <div>
                                            <div class="text-sm font-semibold text-azwara-darkest">
                                                Paket Lengkap
                                            </div>
                                            <div class="text-xs text-secondary">
                                                {{ $meetingsCount }} pertemuan + bonus
                                            </div>
                                        </div>
                                        <div class="text-2xl font-bold text-primary">
                                            Rp {{ number_format($coursePrice,0,',','.') }}
                                        </div>
                                    </div>

                                    <a href="{{ route('browse.index', ['course' => $course->id]) }}"
                                       class="block w-full px-6 py-3 bg-gradient-to-r from-primary to-azwara-darker text-white font-medium rounded-xl hover:opacity-90 transition text-center">
                                        Beli Sekarang
                                    </a>
                                @endif

                                {{-- ================= MEETING PRICING ================= --}}
                                @if(!$isCourseFree && $meetingPricingRules->count() > 0)
                                    <div class="mt-6">
                                        <h4 class="flex items-center gap-2 text-sm font-semibold mb-3">
                                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M12 8c-1.657 0-3 .895-3 2
                                                         s1.343 2 3 2
                                                         s3 .895 3 2
                                                         -1.343 2 -3 2
                                                         m0-8c1.11 0 2.08.402 2.599 1
                                                         M12 8V7
                                                         m0 1v8
                                                         m0 0v1
                                                         m0-1c-1.11 0-2.08-.402-2.599-1
                                                         M21 12a9 9 0 11-18 0
                                                         9 9 0 0118 0z"/>
                                            </svg>
                                            Beli Per Pertemuan
                                        </h4>

                                        <div class="space-y-2">
                                            @foreach($meetingPricingRules as $rule)
                                                <div class="flex justify-between p-3 bg-azwara-lightest rounded-lg">
                                                    <span class="text-sm">
                                                        @if($rule->min_qty == 1 && $rule->max_qty == 1)
                                                            1 pertemuan
                                                        @elseif($rule->max_qty === null)
                                                            ≥ {{ $rule->min_qty }} pertemuan
                                                        @else
                                                            {{ $rule->min_qty }} - {{ $rule->max_qty }} pertemuan
                                                        @endif
                                                    </span>
                                                    <span class="font-bold text-primary">
                                                        Rp {{ number_format($rule->price_per_unit,0,',','.') }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                {{-- VIEW MEETINGS --}}
                                <button
                                    class="view-meetings-btn w-full mt-6 px-4 py-3 border-2 border-primary/30 text-primary rounded-xl hover:bg-primary hover:text-white transition"
                                    data-course-id="{{ $course->id }}"
                                    data-course-name="{{ $course->name }}"
                                    data-course-price="{{ $coursePrice }}"
                                    data-meeting-rules='@json($meetingPricingRules)'
                                >
                                    Lihat Detail Pertemuan ({{ $meetingsCount }})
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @else
            <div class="text-center py-20">
                <h3 class="text-2xl font-bold text-azwara-darkest">
                    Kelas Sedang Disiapkan
                </h3>
                <p class="text-secondary">
                    Silakan kembali lagi nanti.
                </p>
            </div>
        @endif
    </div>
</section>
