<x-layout>
    <x-form title="O Teu Perfil" description="Edita as tuas informações de conta">
        <form action="{{ route('profile.update') }}" method="POST" class="mt-10 space-y-4">
            @csrf
            @method('PATCH')

            <x-form.field name="name" label="Nome" :value="auth()->user()->name" />
            <x-form.field name="email" label="Email" :value="auth()->user()->email" />
            <x-form.field name="password" label="Nova Senha (deixar vazio para manter)" type="password" />

            <button type="submit" class="btn mt-4 w-full">Atualizar Perfil</button>
        </form>

        <form action="/logout" method="POST" class="mt-4">
            @csrf
            <button class="text-red-500 text-sm w-full text-center hover:underline">Sair da Conta (Logout)</button>
        </form>
    </x-form>
</x-layout>
