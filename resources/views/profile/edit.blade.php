@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    {{-- Back Button --}}
    <div class="mb-4">
        <a href="{{ route('profile.show') }}"
           class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>
    </div>

    {{-- Card --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 sm:p-8">
        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Profil</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Perbarui informasi akun Anda</p>
        </div>

        <form method="POST" enctype="multipart/form-data" action="{{ route('profile.update') }}" class="space-y-5">
            @csrf

            {{-- Name --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Nama Lengkap
                </label>
                <input type="text"
                       name="name"
                       value="{{ auth()->user()->name }}"
                       required
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition">
            </div>

            {{-- Phone --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    No. HP
                </label>
                <input type="text"
                       name="phone"
                       value="{{ auth()->user()->phone }}"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition">
            </div>

            {{-- Province --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Provinsi
                </label>
                <select id="province_id"
                        name="province_id"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition">
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
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Kabupaten / Kota
                </label>
                <select id="regency_id"
                        name="regency_id"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition">
                    <option value="">Pilih provinsi terlebih dahulu</option>
                </select>
            </div>

            {{-- Avatar --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Foto Profil
                </label>
                <input type="file"
                       name="avatar"
                       class="w-full text-sm text-gray-500 dark:text-gray-400
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-xl file:border-0
                              file:bg-purple-600 file:text-white
                              file:hover:bg-purple-700 file:transition
                              cursor-pointer">
                <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Format: JPG, PNG, maks 2MB</p>
            </div>

            {{-- Submit --}}
            <button type="submit"
                    class="w-full py-2.5 bg-purple-600 text-white font-medium rounded-xl hover:bg-purple-700 transition duration-300 focus:ring-2 focus:ring-purple-500/20">
                Simpan Perubahan
            </button>
        </form>
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
                })
                .catch(() => {
                    regencySelect.innerHTML = `<option value="">Gagal memuat data</option>`;
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