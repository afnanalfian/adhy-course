@extends('layouts.app')

@section('title', $meeting->title.' | Live Class')
@section('description', 'Live class '.$meeting->title)
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

    {{-- Modal Post Test --}}
    <div id="postTestModal"
        class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

        <div class="bg-white dark:bg-azwara-darker rounded-xl p-6 w-full max-w-sm">
            <h3 class="font-bold text-lg mb-4">
                Pilih Tipe Post Test
            </h3>

            <form method="POST"
                action="{{ route('meetings.posttest.store', $meeting) }}">
                @csrf

                <select name="test_type"
                        required
                        class="w-full rounded-lg border p-2 mb-4">
                    <option value="">-- Pilih Tipe Tes --</option>
                    <option value="skd">SKD</option>
                    <option value="tpa">TPA</option>
                    <option value="tbi">TBI</option>
                    <option value="mtk_stis">Matematika STIS</option>
                    <option value="mtk_tka">Matematika TKA</option>
                    <option value="general">General</option>
                </select>

                <div class="flex justify-end gap-2">
                    <button type="button"
                            onclick="closePostTestModal()"
                            class="px-4 py-2 rounded-lg bg-gray-200">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-4 py-2 rounded-lg bg-primary text-white">
                        Buat
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
    function openPostTestModal() {
        document.getElementById('postTestModal')
            .classList.remove('hidden');
        document.getElementById('postTestModal')
            .classList.add('flex');
    }

    function closePostTestModal() {
        document.getElementById('postTestModal')
            .classList.add('hidden');
    }
    </script>

</div>

@endsection
