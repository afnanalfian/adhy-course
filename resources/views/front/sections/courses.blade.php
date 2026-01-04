{{-- resources/views/front/sections/courses.blade.php --}}
<section id="courses" class="scroll-mt-20 py-16 lg:py-20 bg-azwara-lightest">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-azwara-darkest mb-4">
                Jelajahi <span class="text-primary">Kelas</span> Premium Kami
            </h2>
            <p class="text-lg text-secondary max-w-2xl mx-auto">
                Pilih kelas yang sesuai dengan kebutuhan belajar Anda.
                Materi terstruktur dan pembelajaran interaktif.
            </p>
        </div>

        @if($courses->count() > 0)
            {{-- Courses Grid dengan Design Modern --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16">
                @foreach($courses as $index => $course)
                    @php
                        // Get course package product
                        $coursePackage = $products
                            ->get('course_package', collect())
                            ->firstWhere('context.id', $course->id);

                        // Get all meetings for this course
                        $allCourseMeetings = $course->meetings ?? collect();

                        // Get meetings count
                        $meetingsCount = $course->meetings_count;

                        // Calculate course package price
                        $coursePrice = $coursePackage ? $coursePackage['pricing']['price'] : 0;

                        // Get pricing rules for meetings in this course
                        $meetingPricingRules = \App\Models\PricingRule::active()
                            ->forProductType('meeting')
                            ->forPriceable($course)
                            ->orderBy('min_qty')
                            ->get();

                        // Determine layout pattern
                        $isEven = $index % 2 == 0;
                        $bgGradient = $isEven
                            ? 'from-primary/5 to-azwara-lighter/30'
                            : 'from-azwara-darker/5 to-primary/10';
                    @endphp

                    <div class="relative group">
                        {{-- Modern Card dengan Background Gradient --}}
                        <div class="relative bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden border border-azwara-lighter/50">
                            {{-- Decorative Corner --}}
                            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl {{ $bgGradient }} rounded-bl-full"></div>

                            {{-- Content --}}
                            <div class="relative p-8">
                                {{-- Course Header --}}
                                <div class="mb-6">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex-1">
                                            <h3 class="text-2xl font-bold text-azwara-darkest mb-2">
                                                {{ $course->name }}
                                            </h3>

                                            {{-- Teachers Badge --}}
                                            @if($course->teachers->count() > 0)
                                                <div class="flex items-center gap-2 mb-3">
                                                    <div class="flex -space-x-2">
                                                        @foreach($course->teachers->take(2) as $teacher)
                                                            <div class="h-8 w-8 rounded-full border-2 border-white bg-azwara-lighter flex items-center justify-center overflow-hidden">
                                                                @if($teacher->user->avatar)
                                                                    <img src="{{ Storage::url($teacher->user->avatar) }}"
                                                                         alt="{{ $teacher->user->name }}"
                                                                         class="h-full w-full object-cover">
                                                                @else
                                                                    <span class="text-xs font-bold text-primary">
                                                                        {{ substr($teacher->user->name, 0, 1) }}
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                        @if($course->teachers->count() > 2)
                                                            <div class="h-8 w-8 rounded-full border-2 border-white bg-primary flex items-center justify-center">
                                                                <span class="text-xs font-bold text-white">
                                                                    +{{ $course->teachers->count() - 2 }}
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <span class="text-sm text-secondary">
                                                        {{ $course->teachers->count() }} Tentor
                                                    </span>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Meetings Badge --}}
                                        <div class="text-center">
                                            <div class="px-4 py-2 bg-primary/10 rounded-lg">
                                                <div class="text-2xl font-bold text-primary">{{ $meetingsCount }}</div>
                                                <div class="text-xs text-secondary">Pertemuan</div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Course Description --}}
                                    @if($course->description)
                                        <div class="mb-6">
                                            <p class="text-secondary leading-relaxed line-clamp-2">
                                                {{ Str::limit($course->description, 150) }}
                                            </p>
                                        </div>
                                    @endif
                                </div>

                                {{-- Features Grid --}}
                                <div class="grid grid-cols-2 gap-4 mb-8">
                                    {{-- Product Description --}}
                                    @if($coursePackage && $coursePackage['description'])
                                        <div class="col-span-2">
                                            <div class="p-3 bg-azwara-lightest/50 rounded-lg border border-azwara-lighter">
                                                <h4 class="text-sm font-semibold text-azwara-darkest mb-1 flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Yang Anda Dapatkan
                                                </h4>
                                                <p class="text-xs text-secondary">
                                                    {{ Str::limit($coursePackage['description'], 80) }}
                                                </p>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Bonuses --}}
                                    @if($coursePackage && $coursePackage['bonuses']->count() > 0)
                                        <div class="col-span-2">
                                            <div class="p-3 bg-green-50 rounded-lg border border-green-100">
                                                <h4 class="text-sm font-semibold text-green-800 mb-1 flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Bonus Gratis
                                                </h4>
                                                <p class="text-xs text-green-700">
                                                    {{ $coursePackage['bonuses']->count() }} bonus tambahan
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                {{-- Pricing Section --}}
                                <div class="pt-6 border-t border-azwara-lighter/50">
                                    {{-- Package Price --}}
                                    @if($coursePrice > 0)
                                        <div class="mb-6">

                                            <div class="flex items-center justify-between mb-4">
                                                <div>
                                                    <span class="text-sm font-semibold text-azwara-darkest">
                                                        Paket Lengkap
                                                    </span>
                                                    <div class="text-xs text-secondary">
                                                        {{ $meetingsCount }} pertemuan + bonus
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <div class="text-2xl font-bold text-primary">
                                                        Rp {{ number_format($coursePrice, 0, ',', '.') }}
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Hanya tampilkan untuk siswa --}}
                                            @auth
                                                @if(auth()->user()->hasRole('siswa'))
                                                    <a href="{{ route('browse.index', ['course' => $course->id]) }}"
                                                       class="block w-full px-6 py-3 bg-gradient-to-r from-primary to-azwara-darker text-white font-medium rounded-xl hover:opacity-90 transition duration-300 text-center group relative overflow-hidden">
                                                        <span class="relative z-10">Beli Sekarang</span>
                                                        <div class="absolute inset-0 bg-white/10 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                                                    </a>
                                                @endif
                                            @endauth

                                            @guest
                                                <a href="{{ route('browse.index', ['course' => $course->id]) }}"
                                                   class="block w-full px-6 py-3 bg-gradient-to-r from-primary to-azwara-darker text-white font-medium rounded-xl hover:opacity-90 transition duration-300 text-center group relative overflow-hidden">
                                                    <span class="relative z-10">Beli Sekarang</span>
                                                    <div class="absolute inset-0 bg-white/10 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                                                </a>
                                            @endguest
                                        </div>
                                    @endif

                                    {{-- Meeting Pricing Rules --}}
                                    @if($meetingPricingRules->count() > 0)
                                        <div class="mb-6">
                                            <h4 class="text-sm font-semibold text-azwara-darkest mb-3 flex items-center gap-2">
                                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Beli Per Pertemuan
                                            </h4>
                                            <div class="space-y-2">
                                                @foreach($meetingPricingRules as $rule)
                                                    <div class="flex justify-between items-center p-3 bg-white border border-azwara-lighter rounded-lg hover:border-primary/30 transition-colors">
                                                        <div>
                                                            @if($rule->min_qty == 1 && $rule->max_qty == 1)
                                                                <span class="text-sm font-medium text-azwara-darkest">1 pertemuan</span>
                                                            @elseif($rule->max_qty === null)
                                                                <span class="text-sm font-medium text-azwara-darkest">≥ {{ $rule->min_qty }} pertemuan</span>
                                                            @else
                                                                <span class="text-sm font-medium text-azwara-darkest">{{ $rule->min_qty }} - {{ $rule->max_qty }} pertemuan</span>
                                                            @endif
                                                        </div>
                                                        <div class="text-right">
                                                            <div class="font-bold text-primary">
                                                                Rp {{ number_format($rule->price_per_unit, 0, ',', '.') }}/pertemuan
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="mb-6 p-3 bg-azwara-lightest rounded-lg">
                                            <p class="text-sm text-gray-500 text-center">
                                                Akan Hadir
                                            </p>
                                        </div>
                                    @endif

                                    {{-- View Meetings Button --}}
                                    @if($allCourseMeetings->count() > 0)
                                        <button class="view-meetings-btn w-full px-4 py-3 border-2 border-primary/30 text-primary font-medium rounded-xl hover:bg-primary hover:text-white transition duration-300 group"
                                                data-course-id="{{ $course->id }}"
                                                data-course-name="{{ $course->name }}"
                                                data-course-price="{{ $coursePrice }}"
                                                data-meeting-rules='@json($meetingPricingRules)'>
                                            <div class="flex items-center justify-center gap-2">
                                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                                <span>Lihat Detail Pertemuan ({{ $allCourseMeetings->count() }})</span>
                                            </div>
                                        </button>
                                    @endif
                                </div>
                            </div>

                            {{-- Hover Effect --}}
                            <div class="absolute inset-0 bg-gradient-to-r from-primary/0 to-primary/0 group-hover:from-primary/5 group-hover:to-primary/5 transition-all duration-500 pointer-events-none"></div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Additional Info Section --}}
            <div class="bg-gradient-to-r from-azwara-darker/5 to-primary/10 rounded-2xl p-8 lg:p-12 mb-16">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="h-16 w-16 mx-auto bg-primary/10 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-azwara-darkest mb-2">Materi Terstruktur</h4>
                        <p class="text-sm text-secondary">Kurikulum yang selalu update</p>
                    </div>

                    <div class="text-center">
                        <div class="h-16 w-16 mx-auto bg-primary/10 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-azwara-darkest mb-2">Tentor Profesional</h4>
                        <p class="text-sm text-secondary">Pengajar berpengalaman dan berprestasi</p>
                    </div>

                    <div class="text-center">
                        <div class="h-16 w-16 mx-auto bg-primary/10 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-azwara-darkest mb-2">Fleksibel</h4>
                        <p class="text-sm text-secondary">Akses kapan saja, di mana saja</p>
                    </div>
                </div>
            </div>

        @else
            {{-- Empty State --}}
            <div class="text-center py-16">
                <div class="inline-flex items-center justify-center h-24 w-24 rounded-full bg-gradient-to-r from-primary/10 to-azwara-darker/10 text-primary mb-6">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-azwara-darkest mb-3">
                    Kelas Sedang Disiapkan
                </h3>
                <p class="text-secondary max-w-md mx-auto">
                    Kami sedang mempersiapkan kelas-kelas terbaik untuk Anda.
                    Segera hadir!
                </p>
            </div>
        @endif
    </div>
</section>

{{-- Meetings Modal --}}
<div id="meetingsModal" class="fixed inset-0 z-[60] overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        {{-- Background overlay --}}
        <div class="fixed inset-0 bg-azwara-darkest/90 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>

        {{-- Modal content --}}
        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            {{-- Modal Header --}}
            <div class="bg-gradient-to-r from-primary/10 to-azwara-darker/5 px-6 py-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 id="modalCourseName" class="text-2xl font-bold text-azwara-darkest"></h3>
                        <div class="flex items-center gap-4 mt-1">
                            <div id="modalPackagePrice" class="text-primary font-medium"></div>
                            <div id="modalMeetingsCount" class="text-secondary text-sm"></div>
                        </div>
                    </div>
                    <button type="button" id="closeModal" class="text-azwara-darkest hover:text-primary p-2 rounded-lg hover:bg-azwara-lightest transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 pt-6 pb-4">
                {{-- Pricing Rules Display --}}
                <div id="modalPricingRules" class="mb-8 p-4 bg-azwara-lightest rounded-xl border border-azwara-lighter"></div>

                {{-- Modal Body --}}
                <div class="max-h-[50vh] overflow-y-auto pr-2">
                    <div id="modalMeetingsList" class="space-y-4">
                        {{-- Meetings will be loaded here via JS --}}
                    </div>
                </div>
            </div>

            {{-- Modal Footer --}}
            <div class="bg-azwara-lightest px-6 py-4 border-t border-azwara-lighter">
                <div class="flex flex-col sm:flex-row gap-3 justify-end">
                    @auth
                        @if(auth()->user()->hasRole('siswa'))
                            <button type="button" id="modalBuyPackage" class="px-6 py-3 bg-gradient-to-r from-primary to-azwara-darker text-white font-medium rounded-lg hover:opacity-90 transition duration-300">
                                Beli Paket Lengkap
                            </button>
                        @endif
                    @endauth
                    @guest
                        <button type="button" id="modalBuyPackage" class="px-6 py-3 bg-gradient-to-r from-primary to-azwara-darker text-white font-medium rounded-lg hover:opacity-90 transition duration-300">
                            Beli Paket Lengkap
                        </button>
                    @endguest
                    <button type="button" id="modalClose" class="px-6 py-3 border border-azwara-lighter bg-white text-azwara-darkest font-medium rounded-lg hover:bg-azwara-lightest transition duration-300">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript untuk Meetings Modal dengan Fix --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.view-meetings-btn');
    const meetingsModal = document.getElementById('meetingsModal');
    const closeButtons = document.querySelectorAll('#closeModal, #modalClose');

    // Open modal
    viewButtons.forEach(button => {
        button.addEventListener('click', async function() {
            const courseId = this.getAttribute('data-course-id');
            const courseName = this.getAttribute('data-course-name');
            const coursePrice = this.getAttribute('data-course-price');
            const meetingRules = JSON.parse(this.getAttribute('data-meeting-rules'));

            try {
                // AJAX request untuk mendapatkan SEMUA meetings (tidak difilter)
                const response = await fetch(`/api/courses/${courseId}/all-meetings`);
                const data = await response.json();

                if (data.success && data.meetings.length > 0) {
                    // Update modal header
                    document.getElementById('modalCourseName').textContent = courseName;

                    const packagePriceDiv = document.getElementById('modalPackagePrice');
                    if (parseInt(coursePrice) > 0) {
                        packagePriceDiv.innerHTML = `
                            <div class="flex items-center gap-1">
                                <span class="text-xl font-bold">Rp ${parseInt(coursePrice).toLocaleString('id-ID')}</span>
                                <span class="text-xs">(paket lengkap)</span>
                            </div>
                        `;
                    } else {
                        packagePriceDiv.textContent = '';
                    }

                    document.getElementById('modalMeetingsCount').textContent =
                        `${data.meetings.length} pertemuan`;

                    // Update pricing rules display
                    const pricingRulesDiv = document.getElementById('modalPricingRules');
                    if (meetingRules.length > 0) {
                        let pricingRulesHtml = `
                            <h4 class="text-sm font-semibold text-azwara-darkest mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Aturan Harga Per Pertemuan:
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-${meetingRules.length > 2 ? '3' : meetingRules.length} gap-3">
                        `;

                        meetingRules.forEach(rule => {
                            let rangeText = '';
                            if (rule.min_qty == 1 && rule.max_qty == 1) {
                                rangeText = '1 pertemuan';
                            } else if (rule.max_qty === null) {
                                rangeText = `≥ ${rule.min_qty} pertemuan`;
                            } else {
                                rangeText = `${rule.min_qty} - ${rule.max_qty} pertemuan`;
                            }

                            pricingRulesHtml += `
                                <div class="bg-white p-3 rounded-lg border border-azwara-lighter text-center">
                                    <div class="text-xs text-secondary mb-1">${rangeText}</div>
                                    <div class="font-bold text-primary text-lg">
                                        Rp ${parseInt(rule.price_per_unit).toLocaleString('id-ID')}/pertemuan
                                    </div>
                                </div>
                            `;
                        });

                        pricingRulesHtml += '</div>';
                        pricingRulesDiv.innerHTML = pricingRulesHtml;
                    } else {
                        pricingRulesDiv.innerHTML = `
                            <div class="text-center py-3">
                                <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-gray-500">Akan Segera Hadir</p>
                            </div>
                        `;
                    }

                    // Update meetings list - TAMPILKAN SEMUA
                    const meetingsList = document.getElementById('modalMeetingsList');
                    meetingsList.innerHTML = '';

                    // Kelompokkan meetings per bulan
                    const meetingsByMonth = {};
                    data.meetings.forEach(meeting => {
                        const monthYear = meeting.scheduled_at_formatted.split(' ')[1] + ' ' + meeting.scheduled_at_formatted.split(' ')[2];
                        if (!meetingsByMonth[monthYear]) {
                            meetingsByMonth[monthYear] = [];
                        }
                        meetingsByMonth[monthYear].push(meeting);
                    });

                    // Tampilkan meetings per bulan
                    Object.entries(meetingsByMonth).forEach(([monthYear, monthMeetings]) => {
                        // Header bulan
                        const monthHeader = document.createElement('div');
                        monthHeader.className = 'mb-3';
                        monthHeader.innerHTML = `
                            <h4 class="text-lg font-bold text-azwara-darkest mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                ${monthYear}
                            </h4>
                        `;
                        meetingsList.appendChild(monthHeader);

                        // Meetings per bulan
                        monthMeetings.forEach((meeting, index) => {
                            const meetingElement = document.createElement('div');
                            meetingElement.className = 'p-4 bg-white border border-azwara-lighter rounded-xl mb-3 hover:border-primary/30 transition-colors';

                            meetingElement.innerHTML = `
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0">
                                        <div class="h-12 w-12 bg-primary/10 rounded-xl flex items-center justify-center">
                                            <span class="text-lg font-bold text-primary">${index + 1}</span>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h5 class="font-semibold text-azwara-darkest mb-1">${meeting.title}</h5>
                                        <div class="flex items-center gap-2 text-sm text-secondary">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span>${meeting.scheduled_at_formatted}</span>
                                            <span class="px-2 py-0.5 text-xs rounded-full bg-azwara-lighter text-azwara-darkest">
                                                ${meeting.status === 'live' ? 'Sedang Berlangsung' :
                                                  meeting.status === 'done' ? 'Selesai' : 'Akan Datang'}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            `;

                            meetingsList.appendChild(meetingElement);
                        });
                    });

                    // Show modal
                    meetingsModal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }
            } catch (error) {
                console.error('Error fetching meetings:', error);
                alert('Gagal memuat data pertemuan');
            }
        });
    });

    // Close modal
    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            meetingsModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        });
    });

    // Close modal on background click
    meetingsModal.addEventListener('click', function(e) {
        if (e.target === meetingsModal) {
            meetingsModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    });

    // Buy package button
    document.getElementById('modalBuyPackage')?.addEventListener('click', function() {
        // Redirect ke halaman checkout/browse
        window.location.href = "{{ route('browse.index') }}";
    });
});
</script>
