@props([
    'label',
    'variant' => 'primary', 
])

@php
    $base = $variant === 'secondary'
        ? 'bg-azwara-lighter text-secondary dark:bg-azwara-darker dark:text-azwara-lighter'
        : 'bg-primary/10 text-primary dark:bg-primary/20 dark:text-azwara-lighter';
@endphp

<span class="inline-flex items-center rounded-lg px-3 py-1
             text-sm font-semibold {{ $base }}">
    {{ $label }}
</span>
