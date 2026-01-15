<div id="sidebar-backdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-black/40 hidden md:hidden z-40">
</div>

<aside id="sidebar" class="fixed md:static z-50 inset-y-0 left-0 w-64
              min-h-screen
              bg-white md:bg-ens-lighter dark:bg-ens-darker
              border-r border-gray-200 dark:border-ens-darkest
              transform -translate-x-full
              transition-transform duration-300
              flex flex-col">

    <div class="flex-shrink-0 flex flex-col items-center py-6 gap-4">

        {{-- Logo --}}
        <a href="{{ route('dashboard.redirect') }}">
            <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-ens-medium shadow">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="object-cover w-full h-full">
            </div>
        </a>

        {{-- @if(!request()->is('siswa/*'))
        <h2 class="text-lg font-bold text-ens-darkest dark:text-ens-lighter">
            Azwara
        </h2>
        @endif --}}

    </div>

    {{-- Menu --}}
    <nav class="flex-1 overflow-y-auto px-4 pb-6
            scrollbar-thin scrollbar-thumb-ens-medium/40
            scrollbar-track-transparent
            text-ens-darkest dark:text-ens-lighter">

        @role('admin')
        @include('layouts.partials.menus.admin')
        @endrole

        @role('tentor')
        @include('layouts.partials.menus.tentor')
        @endrole

        @role('siswa')
        @include('layouts.partials.menus.siswa')
        @endrole

    </nav>
</aside>
