<x-layout>
    <div class="py-8">
        <header class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-bold">Os Meus Hábitos</h1>
                <p class="text-muted-foreground">Mantém a tua consistência diária.</p>
            </div>

            <button
                onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'criar-habito' }))"
                class="btn">
                Novo Hábito
            </button>
        </header>

        <div class="grid md:grid-cols-2 gap-6">
            @forelse($habitos as $habito)
                {{-- Removemos o href do x-card para evitar conflito com o form interno --}}
                <x-card class="relative flex flex-col justify-between">
                    <div class="flex justify-between items-start">
                        <div>
                            {{-- O link agora fica apenas no Título para ser seguro --}}
                            <a href="{{ route('habitos.show', $habito) }}" class="hover:underline">
                                <h3 class="text-lg font-bold {{ $habito->jaConcluidoHoje() ? 'line-through text-muted-foreground' : '' }}">
                                    {{ $habito->titulo }}
                                </h3>
                            </a>
                            <p class="text-sm mt-1 text-muted-foreground">{{ Str::limit($habito->descricao, 50) }}</p>
                        </div>

                        <x-habito.status-label :status="$habito->jaConcluidoHoje() ? 'completed' : 'pending'">
                            {{ $habito->jaConcluidoHoje() ? 'Concluído' : 'Pendente' }}
                        </x-habito.status-label>
                    </div>

                    <div class="mt-4 flex gap-x-2">
                        @if(!$habito->jaConcluidoHoje())
                            {{-- Certifica-te que a rota 'habitos.concluir' existe nas tuas routes/web.php --}}
                            <form method="POST" action="{{ route('habitos.concluir', $habito) }}">
                                @csrf
                                <button type="submit" class="btn text-xs py-1 px-3">Marcar como feito</button>
                            </form>
                        @else
                            <span class="text-xs text-green-600 font-medium italic">✓ Concluído por hoje</span>
                        @endif

                        {{-- Botão discreto para editar --}}
                        <a href="{{ route('habitos.show', $habito) }}" class="btn-outlined text-xs py-1 px-3">Ver Detalhes</a>
                    </div>
                </x-card>
            @empty
                <div class="col-span-2 text-center p-12 border-2 border-dashed rounded-lg">
                    <p class="text-muted-foreground">Ainda não criaste nenhum hábito.</p>
                </div>
            @endforelse
        </div>

        <x-habito.modal name="criar-habito" />
    </div>
</x-layout>
