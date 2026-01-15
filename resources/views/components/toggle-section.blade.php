@props(['title'])

<div x-data="{ open: false }" class="rounded-xl
           bg-ens-lightest dark:bg-secondary/70
           border border-ens-light/30 dark:border-white/10">

    <button @click="open = !open" class="w-full px-6 py-4
               flex items-center justify-between
               text-left
               hover:bg-ens-lighter
               dark:hover:bg-white/5
               transition">

        <span class="font-semibold text-ens-darker dark:text-ens-lighter">
            {{ $title }}
        </span>

        <span class="text-xl font-bold text-ens-medium" x-text="open ? '−' : '+'">
        </span>
    </button>

    <div x-show="open" x-collapse class="px-6 pb-6">
        {{ $slot }}
    </div>
</div>
