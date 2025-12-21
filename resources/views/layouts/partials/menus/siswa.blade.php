<a href="{{ route('dashboard.redirect') }}" class="menu-item">
  <!-- Dashboard (home) -->
  <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
       viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M3 9.75L12 4.5l9 5.25V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.75z"/>
  </svg>
  Dashboard
</a>

<a href="{{ route('course.index') }}" class="menu-item">
  <!-- Course (book-closed) -->
  <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
       viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M3 5a2 2 0 012-2h11a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"/>
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M7 5v16"/>
  </svg>
  Course
</a>

<a href="{{ route('tryouts.index') }}" class="menu-item">
  <!-- Tryout (clipboard-document-check) -->
  <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
       viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h3.5a2 2 0 004 0H17a2 2 0 012 2v12a2 2 0 01-2 2z"/>
  </svg>
  Tryout
</a>

<a href="{{ route('quizzes.index') }}" class="menu-item">
  <!-- Daily Quiz (question-mark-circle) -->
  <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
       viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M12 18h.01M12 6a6 6 0 00-6 6h2a4 4 0 118 0c0 1.5-.5 2.5-2 3.5"/>
  </svg>
  Daily Quiz
</a>

<a href="{{ route('tentor.index') }}" class="menu-item">
  <!-- Tentor (user-group) -->
  <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
       viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M17 20h5v-2a4 4 0 00-4-4h-1m-6 6H4v-2a4 4 0 014-4h1m0-4a4 4 0 118 0 4 4 0 01-8 0z"/>
  </svg>
  Tentor
</a>

{{-- Menu Pembelian dengan Dropdown (SISWA) --}}
<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" class="menu-item w-full text-left flex justify-between items-center">
        <div class="flex items-center gap-2">
            <!-- Purchasing (shopping-cart) -->
            <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.6 8h13.2L17 13H7z"/>
            </svg>
            Pembelian
        </div>
        <!-- Arrow icon -->
        <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <!-- Dropdown Menu -->
    <div x-show="open" @click.outside="open = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-2"
         class="ml-6 mt-1 space-y-1 border-l border-gray-300 dark:border-gray-600 pl-3">

        <a href="{{ route('purchase.products.browse') }}" class="menu-subitem flex items-center gap-2">
            <span class="w-1 h-1 rounded-full bg-current"></span>
            Beli Course
        </a>

        <a href="{{ route('cart.show') }}" class="menu-subitem flex items-center gap-2">
            <span class="w-1 h-1 rounded-full bg-current"></span>
            Keranjang
            @if($cartItemsCount ?? 0 > 0)
                <span class="badge ml-auto">{{ $cartItemsCount }}</span>
            @endif
        </a>

        <a href="{{ route('purchase.products.index') }}" class="menu-subitem flex items-center gap-2">
            <span class="w-1 h-1 rounded-full bg-current"></span>
            Riwayat Pembelian
        </a>
    </div>
</div>
