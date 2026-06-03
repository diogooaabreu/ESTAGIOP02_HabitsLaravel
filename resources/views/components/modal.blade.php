@props(['name', 'title'])

<div
    x-data="{ show: false }"
    x-on:open-modal.window="if ($event.detail === @js($name)) show = true"
    x-on:close-modal.window="show = false"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm"
    role="dialog"
    aria-modal="true"
>
    <div @click.away="show = false" class="bg-card border border-border shadow-2xl max-w-xl w-full rounded-xl overflow-hidden animate-in fade-in zoom-in duration-200">
        <div class="px-6 py-4 border-b border-border flex justify-between items-center bg-muted/30">
            <h2 class="text-xl font-bold">{{ $title }}</h2>
            <button @click="show = false" class="text-muted-foreground hover:text-foreground">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div class="p-6">
            {{ $slot }}
        </div>
    </div>
</div>
