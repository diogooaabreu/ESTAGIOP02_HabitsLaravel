<nav class="border-b border-border px-6">
    <div class="max-w-7xl mx-auto h-16 flex items-center justify-between">
        <div>
         
            <a href="{{ route('habitos.index') }}" class="flex items-center">
    <svg class="h-8 w-8 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <span class="ml-2 text-white font-bold text-xl">HabitsShare</span>
</a>
            
        </div>
        <div class="flex gap-x-6 items-center">
            @auth
                <a href="{{ route('habitos.index') }}" class="text-sm font-medium hover:text-primary">Os Meus Hábitos</a>
                <a href="{{ route('profile.edit') }}" class="text-sm font-medium hover:text-primary">Editar Perfil</a>

                <form method="POST" action="/logout">
                    @csrf
                    <button class="text-sm font-medium text-muted-foreground hover:text-red-500">Sair</button>
                </form>
            @endauth

            @guest
                <a href="/register" class="text-sm font-medium">Registar</a>
                <a href="/login" class="btn">Entrar</a>
            @endguest
        </div>
    </div>
</nav>
