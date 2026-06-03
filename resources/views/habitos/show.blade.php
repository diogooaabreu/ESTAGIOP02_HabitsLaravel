<x-layout>
    <div class="py-8 max-w-4xl mx-auto">
        {{-- Cabeçalho e Navegação --}}
        <div class="flex justify-between items-center">
            <a href="{{ route('habitos.index') }}" class="flex items-center gap-x-2 text-sm font-medium text-muted-foreground hover:text-foreground">
                &larr; Voltar aos Meus Hábitos
            </a>

            <div class="gap-x-3 flex items-center">
                {{-- Botão que dispara o modal de edição corrigido --}}
                {{-- 1. O BOTÃO --}}
                <button
                    type="button"
                    class="btn btn-outlined"
                    onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'editar-habito' }))"
                >
                    Editar Hábito
                </button>

                {{-- Botão Eliminar --}}
                <form method="POST" action="{{ route('habitos.destroy', $habito) }}" onsubmit="return confirm('Tens a certeza?')">
                    @csrf
                    @method('DELETE') {{-- ESSENCIAL --}}
                    <button class="btn text-red-500">Eliminar Hábito</button>
                </form>
            </div>
        </div>

        <div class="mt-8 space-y-6">
            {{-- Detalhes do Hábito --}}
            <x-card>
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold text-foreground">{{ $habito->titulo }}</h1>
                        <p class="text-muted-foreground mt-2">{{ $habito->descricao ?? 'Sem descrição adicional.' }}</p>
                    </div>

                    {{-- Status Label corrigido --}}
                    <x-habito.status-label :status="$habito->jaConcluidoHoje() ? 'completed' : 'pending'">
                        {{ $habito->jaConcluidoHoje() ? 'Concluído Hoje' : 'Pendente' }}
                    </x-habito.status-label>
                </div>

                <div class="mt-6 pt-6 border-t border-border flex items-center gap-x-4">
                    <div class="text-sm">
                        <span class="text-muted-foreground">Criado em:</span>
                        <span class="font-medium">{{ $habito->created_at->format('d/m/Y') }}</span>
                    </div>
                    @if(!$habito->jaConcluidoHoje())
                        <form method="POST" action="{{ route('habitos.concluir', $habito) }}">
                            @csrf
                            <button class="btn btn-sm">Marcar como concluído agora</button>
                        </form>
                    @endif
                </div>
            </x-card>

            {{-- Secção de Estatísticas Simples --}}
            <div>
                <h3 class="font-bold text-xl mb-4">Histórico Recente</h3>
                <div class="grid grid-cols-7 gap-2">
                    @foreach(range(6, 0) as $i)
                        @php $data = now()->subDays($i); @endphp
                        <div class="flex flex-col items-center">
                            <span class="text-[10px] uppercase text-muted-foreground mb-1">{{ $data->isoFormat('ddd') }}</span>
                            <div class="w-10 h-10 rounded-md border flex items-center justify-center {{ $habito->conclusoes()->whereDate('completado_em', $data)->exists() ? 'bg-primary border-primary text-white' : 'bg-muted border-border' }}">
                                {{ $data->day }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- 2. O COMPONENTE (No fim do ficheiro, substitui o teu <x-habito.modal> antigo por este) --}}
    <x-habito.modal :habito="$habito" />
</x-layout>
