@props(['is' => 'div'])

<{{ $is }} {{ $attributes->merge(['class' => 'border border-border rounded-lg bg-card p-5 md:text-sm block transition-all shadow-sm']) }}>
{{ $slot }}
</{{ $is }}>
