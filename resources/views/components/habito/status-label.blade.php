@props(['status' => 'pending'])

@php
    $classes = 'inline-block rounded-full border px-2.5 py-0.5 text-xs font-semibold ';

    if ($status === 'pending') {
        $classes .= 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20';
    }

    if ($status === 'completed') {
        $classes .= 'bg-primary/10 text-primary border-primary/20';
    }
@endphp

<span {{ $attributes(['class' => $classes]) }}>
    {{ $slot }}
</span>
