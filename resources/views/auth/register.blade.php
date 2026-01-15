@extends('layouts.guest')

@section('title', 'Register – ENS Makassar')
@section('content')

<div class="min-h-[80vh] flex items-center justify-center p-4">
    <div class="w-full max-w-2xl">
        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-ens-darker dark:text-white mb-2">
                Buat Akun Baru
            </h1>
            <p class="text-gray-500 dark:text-gray-400 text-sm">
                Mulai perjalanan belajarmu bersama kami
            </p>
        </div>

        {{-- Card --}}
        <div class="bg-ens-lighter dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700">
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800">
                    <ul class="text-sm text-red-600 dark:text-red-400 space-y-1">
                        @foreach ($errors->all() as $err)
                            <li>• {{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- Nama --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Nama Lengkap
                        </label>
                        <input type="text"
                               name="name"
                               required
                               placeholder="Nama lengkap"
                               class="w-full px-4 py-3 rounded-lg bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Email
                        </label>
                        <input type="email"
                               name="email"
                               required
                               placeholder="email@example.com"
                               class="w-full px-4 py-3 rounded-lg bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition">
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            No. HP
                        </label>
                        <input type="text"
                               name="phone"
                               placeholder="08xxxxxxxxxx"
                               class="w-full px-4 py-3 rounded-lg bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition">
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Password
                        </label>
                        <input type="password"
                               name="password"
                               required
                               placeholder="••••••••"
                               class="w-full px-4 py-3 rounded-lg bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition">
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Konfirmasi Password
                        </label>
                        <input type="password"
                               name="password_confirmation"
                               required
                               placeholder="••••••••"
                               class="w-full px-4 py-3 rounded-lg bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition">
                    </div>

                    {{-- Province --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Provinsi
                        </label>
                        <select id="province_id"
                                name="province_id"
                                class="w-full px-4 py-3 rounded-lg bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition">
                            <option value="">Pilih provinsi</option>
                            @foreach ($provinces as $prov)
                                <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Regency --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Kabupaten / Kota
                        </label>
                        <select id="regency_id"
                                name="regency_id"
                                class="w-full px-4 py-3 rounded-lg bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition">
                            <option value="">Pilih kabupaten/kota</option>
                        </select>
                    </div>

                    {{-- Avatar --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Foto Profil (Opsional)
                        </label>
                        <input type="file"
                               name="avatar"
                               class="w-full text-sm text-gray-500
                                      file:mr-4 file:py-2.5 file:px-4
                                      file:rounded-lg file:border-0
                                      file:bg-primary file:text-white
                                      file:hover:bg-ens-medium file:transition
                                      hover:file:cursor-pointer
                                      cursor-pointer">
                        <p class="mt-1 text-xs text-gray-400">Format: JPG, PNG, maks 2MB</p>
                    </div>
                </div>

                {{-- Submit Button --}}
                <button type="submit"
                        class="w-full py-3 bg-primary text-white font-medium rounded-lg hover:bg-ens-medium transition focus:ring-2 focus:ring-primary/20 focus:outline-none mt-2">
                    Daftar
                </button>
            </form>

            {{-- Login Link --}}
            <div class="mt-6 pt-5 border-t border-gray-100 dark:border-gray-700 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Sudah punya akun?
                    <a href="{{ route('login') }}"
                       class="text-primary font-medium hover:text-ens-medium transition">
                        Masuk
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const provinceSelect = document.getElementById('province_id');
        const regencySelect = document.getElementById('regency_id');

        provinceSelect.addEventListener('change', function() {
            const provinceId = this.value;
            regencySelect.innerHTML = '<option value="">Loading...</option>';
            regencySelect.disabled = true;

            if (!provinceId) {
                regencySelect.innerHTML = '<option value="">Pilih kabupaten/kota</option>';
                regencySelect.disabled = false;
                return;
            }

            fetch(`/api/regencies/${provinceId}`)
                .then(response => response.json())
                .then(data => {
                    regencySelect.innerHTML = '<option value="">Pilih kabupaten/kota</option>';
                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id;
                        option.textContent = item.name;
                        regencySelect.appendChild(option);
                    });
                    regencySelect.disabled = false;
                })
                .catch(error => {
                    console.error('Error:', error);
                    regencySelect.innerHTML = '<option value="">Gagal memuat data</option>';
                    regencySelect.disabled = false;
                });
        });
    });
</script>
@endpush
