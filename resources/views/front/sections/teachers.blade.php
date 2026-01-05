{{-- resources/views/front/sections/teachers.blade.php --}}
<section id="teachers" class="scroll-mt-20 py-16 lg:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-azwara-darkest mb-4">
                Tim <span class="text-primary">Tentor</span> Profesional
            </h2>
            <p class="text-lg text-secondary max-w-2xl mx-auto">
                Belajar langsung dari tentor berpengalaman yang akan membimbing Anda
                mencapai hasil belajar terbaik.
            </p>
        </div>

        @if($teachers->count() > 0)
            {{-- Teachers Grid dengan Auto-fit --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
                @foreach($teachers as $teacher)
                    <div class="flex flex-col bg-azwara-lightest rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-azwara-lighter/50 h-full">
                        {{-- Teacher Card Content --}}
                        <div class="flex-1 p-5 md:p-6">
                            {{-- Avatar and Name --}}
                            <div class="flex flex-col sm:flex-row sm:items-center gap-4 mb-5">
                                <div class="h-16 w-16 sm:h-20 sm:w-20 rounded-full overflow-hidden border-2 border-white shadow-md flex-shrink-0 mx-auto sm:mx-0">
                                    @if($teacher->user->avatar)
                                        <img
                                            src="{{ Storage::url($teacher->user->avatar) }}"
                                            alt="{{ $teacher->user->name }}"
                                            class="h-full w-full object-cover"
                                        >
                                    @else
                                        <div class="h-full w-full bg-gradient-to-br from-primary to-azwara-darker flex items-center justify-center">
                                            <span class="text-xl font-bold text-white">
                                                {{ substr($teacher->user->name, 0, 1) }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="text-center sm:text-left">
                                    <h3 class="text-lg md:text-xl font-bold text-azwara-darkest mb-1">
                                        {{ $teacher->user->name }}
                                    </h3>
                                    <p class="text-primary text-xs md:text-sm font-medium">
                                        Tentor Azwara Learning
                                    </p>
                                </div>
                            </div>

                            {{-- Bio --}}
                            <div class="mb-5 flex-1">
                                <p class="text-secondary text-sm leading-relaxed line-clamp-3">
                                    @if($teacher->bio)
                                        {{ $teacher->bio }}
                                    @else
                                        Tentor berpengalaman dengan metode pengajaran yang mudah dipahami dan fokus pada pemahaman konsep dasar.
                                    @endif
                                </p>
                            </div>

                            {{-- Courses They Teach --}}
                            @if($teacher->courses->count() > 0)
                                <div class="pt-4 border-t border-azwara-lighter/50">
                                    <h4 class="text-xs md:text-sm font-semibold text-azwara-darkest mb-2">
                                        Mengajarkan Kelas:
                                    </h4>
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach($teacher->courses->take(3) as $course)
                                            <span class="px-2.5 py-1 bg-primary/10 text-primary text-xs rounded-full font-medium">
                                                {{ $course->name }}
                                            </span>
                                        @endforeach
                                        @if($teacher->courses->count() > 3)
                                            <span class="px-2.5 py-1 bg-azwara-lighter text-secondary text-xs rounded-full font-medium">
                                                +{{ $teacher->courses->count() - 3 }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- CTA Section --}}
            <div class="mt-16 text-center">
                <div class="inline-flex flex-col sm:flex-row items-center gap-4 bg-gradient-to-r from-primary/5 to-azwara-lighter/30 rounded-xl p-6 md:p-8">
                    <div class="text-center sm:text-left">
                        <h3 class="text-lg md:text-xl font-bold text-azwara-darkest mb-2">
                            Siap bergabung dengan kelas?
                        </h3>
                        <p class="text-secondary text-sm">
                            Pilih kelas yang sesuai dan belajar bersama tentor profesional.
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="#courses" class="px-5 py-2.5 bg-primary text-white text-sm font-medium rounded-lg hover:bg-azwara-medium transition duration-300">
                            Lihat Semua Kelas
                        </a>
                        <a href="{{ route('register') }}" class="px-5 py-2.5 border border-primary text-primary text-sm font-medium rounded-lg hover:bg-primary hover:text-white transition duration-300">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        @else
            {{-- Empty State --}}
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-azwara-lighter text-primary mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 0c-.66 0-1.293.092-1.892.262M10.5 21c.66 0 1.293-.092 1.892-.262M7 10.5h.01M21 10.5h.01"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-azwara-darkest mb-2">
                    Tim Tentor Sedang Disiapkan
                </h3>
                <p class="text-secondary max-w-md mx-auto">
                    Tim tentor profesional kami sedang mempersiapkan materi terbaik untuk Anda.
                </p>
            </div>
        @endif
    </div>
</section>
