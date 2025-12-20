@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    {{-- TOP ACTION BAR --}}
    @role('admin|tentor')
        <div class="flex justify-start">

            @if ($meeting->status === 'upcoming')
                <form method="POST"
                    action="{{ route('meeting.start', $meeting) }}"
                    class="sweet-confirm"
                    data-message="Mulai pertemuan sekarang?">
                    @csrf
                    <button
                        class="px-6 py-3 rounded-xl
                            text-base font-semibold
                            bg-green-600 text-white
                            hover:bg-green-700
                            shadow-md
                            transition">
                        Mulai Pertemuan
                    </button>
                </form>

            @elseif ($meeting->status === 'live')
                <form method="POST"
                    action="{{ route('meeting.finish', $meeting) }}"
                    class="sweet-confirm"
                    data-message="Selesaikan pertemuan ini?">
                    @csrf
                    <button
                        class="px-6 py-3 rounded-xl
                            text-base font-semibold
                            bg-red-600 text-white
                            hover:bg-red-700
                            shadow-md
                            transition">
                        Selesaikan Pertemuan
                    </button>
                </form>
            @endif

        </div>
    @endrole

    {{-- INFO MEETING --}}
    @include('meetings.partials.info')

    {{-- ABSENSI --}}
    @role('admin|tentor')
        @include('meetings.partials.attendance')
    @endrole

    @include('meetings.partials.material')
    @include('meetings.partials.video')
    @include('meetings.partials.posttest')

</div>

@endsection
