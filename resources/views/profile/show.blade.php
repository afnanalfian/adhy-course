@extends('layouts.app')

@section('content')
    <div class="min-h-screen">

        <div class="max-w-3xl mx-auto">

            {{-- Card --}}
            <div class="relative bg-ens-lightest dark:bg-ens-darker
                       rounded-3xl shadow-xl dark:shadow-black/30
                       border border-gray-200 dark:border-ens-darkest
                       p-6 sm:p-8">

                {{-- Header --}}
                <div class="mb-8">
                    <h1 class="text-2xl sm:text-3xl font-bold
                               text-ens-darkest dark:text-ens-lighter">
                        Profil Saya
                    </h1>

                    <p class="text-sm mt-1 text-ens-medium dark:text-ens-light">
                        Informasi akun pribadi Anda
                    </p>
                </div>

                {{-- Profile Row --}}
                <div class="flex flex-col sm:flex-row items-center gap-6">

                    {{-- Avatar --}}
                    <div class="relative shrink-0">
                        <img src="{{ auth()->user()->avatar_url }}" alt="Avatar" class="w-24 h-24 rounded-full object-cover
                            border-4 border-primary
                            shadow-lg" />
                    </div>

                    {{-- Identity --}}
                    <div class="text-center sm:text-left">
                        <p class="text-xl font-semibold
                                  text-ens-darkest dark:text-white">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-sm text-gray-500 dark:text-gray-300">
                            {{ auth()->user()->email }}
                        </p>
                    </div>

                </div>

                {{-- Divider --}}
                <hr class="my-8 border-gray-200 dark:border-ens-darkest">

                {{-- Info Grid --}}
                <div class="grid sm:grid-cols-2 gap-4 text-sm">

                    <div class="p-4 rounded-xl
                                bg-gray-50 dark:bg-ens-darkest/50
                                border border-gray-200 dark:border-ens-darkest">
                        <p class="text-xs uppercase tracking-wide
                                  text-gray-500 dark:text-ens-light">
                            Phone
                        </p>
                        <p class="font-medium text-ens-darkest dark:text-white">
                            {{ auth()->user()->phone ?? '-' }}
                        </p>
                    </div>

                    <div class="p-4 rounded-xl
                                bg-gray-50 dark:bg-ens-darkest/50
                                border border-gray-200 dark:border-ens-darkest">
                        <p class="text-xs uppercase tracking-wide
                                  text-gray-500 dark:text-ens-light">
                            Provinsi
                        </p>
                        <p class="font-medium text-ens-darkest dark:text-white">
                            {{ auth()->user()->province->name ?? '-' }}
                        </p>
                    </div>

                    <div class="p-4 rounded-xl
                                bg-gray-50 dark:bg-ens-darkest/50
                                border border-gray-200 dark:border-ens-darkest">
                        <p class="text-xs uppercase tracking-wide
                                  text-gray-500 dark:text-ens-light">
                            Kabupaten / Kota
                        </p>
                        <p class="font-medium text-ens-darkest dark:text-white">
                            {{ auth()->user()->regency->name ?? '-' }}
                        </p>
                    </div>

                </div>

                {{-- Actions --}}
                <div class="flex flex-wrap gap-3 mt-10">

                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center justify-center gap-2
                              px-5 py-3 rounded-xl font-semibold
                              text-white
                              bg-gradient-to-r from-primary to-ens-medium
                              hover:shadow-lg hover:scale-[1.02]
                              transition">
                        Edit Profil
                    </a>

                    <a href="{{ route('profile.password') }}" class="inline-flex items-center justify-center gap-2
                              px-5 py-3 rounded-xl font-semibold
                              text-white
                              bg-ens-darker hover:bg-ens-medium
                              transition">
                        Ganti Password
                    </a>

                    <a href="{{ route('profile.delete') }}" class="inline-flex items-center justify-center gap-2
                              px-5 py-3 rounded-xl font-semibold
                              text-red-700 dark:text-red-400
                              bg-red-100 dark:bg-red-950/30
                              hover:bg-red-200 dark:hover:bg-red-950/60
                              transition">
                        Hapus Akun
                    </a>

                </div>

            </div>
            {{-- End Card --}}

        </div>
    </div>
@endsection
