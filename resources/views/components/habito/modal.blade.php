@props(['habito' => new App\Models\Habito()])

<x-modal name="{{ $habito->exists ? 'editar-habito' : 'criar-habito' }}"
         title="{{ $habito->exists ? 'Editar Hábito' : 'Novo Hábito' }}">

    <form method="POST" action="{{ $habito->exists ? route('habitos.update', $habito) : route('habitos.store') }}">
        @csrf
        @if($habito->exists) @method('PATCH') @endif

        <div class="space-y-6 p-6">
            <x-form.field
                label="Título do Hábito"
                name="titulo"
                required
                :value="old('titulo', $habito->titulo)"
            />

            <x-form.field
                label="Descrição / Motivação"
                name="descricao"
                type="textarea"
                :value="old('descricao', $habito->descricao)"
            />

            <div class="flex justify-end gap-x-3 mt-6">
                <button type="button" class="btn btn-outlined" @click="show = false">Cancelar</button>
                <button type="submit" class="btn">
                    {{ $habito->exists ? 'Atualizar' : 'Guardar Hábito' }}
                </button>
            </div>
        </div>
    </form>
</x-modal>
