@extends('layouts.app')

@section('content')
<div class="min-h-screen py-8">
    <div class="max-w-3xl mx-auto px-4">
        {{-- Back Button --}}
        <div class="mb-4">
            <a href="{{ route('profile.show') }}"
               class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-primary transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>

        {{-- Card --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 sm:p-8">
            {{-- Header --}}
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Edit Profil
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Perbarui informasi akun Anda
                </p>
            </div>

            <form method="POST" enctype="multipart/form-data" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf

                {{-- Name --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nama Lengkap
                    </label>
                    <input type="text"
                           name="name"
                           value="{{ auth()->user()->name }}"
                           required
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition">
                </div>

                {{-- Phone --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        No. HP
                    </label>
                    <input type="text"
                           name="phone"
                           value="{{ auth()->user()->phone }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition">
                </div>

                {{-- Province --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Provinsi <span class="text-gray-500 text-xs">(opsional)</span>
                    </label>
                    <select id="province_id"
                            name="province_id"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition">
                        <option value="">Pilih provinsi</option>
                        @foreach ($provinces as $prov)
                            <option value="{{ $prov->id }}" {{ auth()->user()->province_id == $prov->id ? 'selected' : '' }}>
                                {{ $prov->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Regency --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Kabupaten / Kota <span class="text-gray-500 text-xs">(opsional)</span>
                    </label>
                    <select id="regency_id"
                            name="regency_id"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition">
                        <option value="">Pilih provinsi terlebih dahulu</option>
                    </select>
                </div>

                {{-- Avatar --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Foto Profil
                    </label>
                    <input type="file"
                           name="avatar"
                           class="w-full text-sm text-gray-500
                                  file:mr-4 file:py-2.5 file:px-4
                                  file:rounded-lg file:border-0
                                  file:bg-primary file:text-white
                                  file:hover:bg-ens-medium file:transition
                                  cursor-pointer">
                </div>

                {{-- Submit --}}
                <div class="pt-4">
                    <button type="submit"
                            class="w-full py-3 bg-primary text-white font-medium rounded-lg hover:bg-ens-medium transition focus:ring-2 focus:ring-primary/20">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const provinceSelect = document.getElementById("province_id");
        const regencySelect = document.getElementById("regency_id");
        const userRegency = "{{ auth()->user()->regency_id }}";

        function loadRegencies() {
            const provinceId = provinceSelect.value;
            regencySelect.innerHTML = `<option value="">Loading...</option>`;
            regencySelect.disabled = true;

            if (!provinceId) {
                regencySelect.innerHTML = `<option value="">Pilih provinsi terlebih dahulu</option>`;
                regencySelect.disabled = false;
                return;
            }

            fetch(`/get-regencies/${provinceId}`)
                .then(res => res.json())
                .then(data => {
                    regencySelect.innerHTML = `<option value="">Pilih kabupaten/kota</option>`;
                    data.forEach(reg => {
                        const option = document.createElement('option');
                        option.value = reg.id;
                        option.textContent = reg.name;
                        if (reg.id == userRegency) option.selected = true;
                        regencySelect.appendChild(option);
                    });
                    regencySelect.disabled = false;
                });
        }

        provinceSelect.addEventListener("change", loadRegencies);

        if ("{{ auth()->user()->province_id }}") {
            loadRegencies();
        }
    });
</script>
@endpush
