<?php

use App\Http\Controllers\HabitoController;
use App\Http\Controllers\ConclusaoController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController; // Importa o nome correto

/*
|--------------------------------------------------------------------------
| Rotas Públicas (Visitantes)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Registo de novos utilizadores
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

    // Login de utilizadores existentes
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store'])->name('login.store');


});
Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');
/*
|--------------------------------------------------------------------------
| Rotas Protegidas (Apenas Utilizadores Autenticados)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Redireciona a raiz para a lista de hábitos
    Route::get('/', function () {
        return redirect()->route('habitos.index');
    });

    /**
     * CRUD de Hábitos
     * Gera automaticamente:
     * - GET /habitos (index) -> habitos.index
     * - POST /habitos (store) -> habitos.store
     * - GET /habitos/{habito} (show) -> habitos.show
     * - PATCH /habitos/{habito} (update) -> habitos.update
     * - DELETE /habitos/{habito} (destroy) -> habitos.destroy
     */
    Route::resource('habitos', HabitoController::class);

    /**
     * Ação de Conclusão Diária
     * Rota para marcar que o hábito foi feito "hoje"
     */
    Route::post('/habitos/{habito}/concluir', [ConclusaoController::class, 'store'])
        ->name('habitos.concluir');

    /**
     * Perfil do Utilizador
     * Utiliza o teu componente x-form para edição
     */
    Route::get('/profile', [PerfilController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [PerfilController::class, 'update'])->name('profile.update');

    // Logout
    Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');
});

// Páginas Auxiliares
Route::view('/sobre', 'about')->name('about');
Route::view('/contacto', 'contact')->name('contact');





Route::middleware('auth')->group(function () {
    // Altera de PerfilController para ProfileController
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware('auth')->group(function () {
    Route::resource('habitos', HabitoController::class);
    // O 'resource' já cria automaticamente a rota 'habitos.edit'
});

Route::post('/habitos/{habito}/concluir', [ConclusaoController::class, 'store'])
    ->name('habitos.concluir')
    ->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::resource('habitos', HabitoController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});



Route::middleware('auth')->group(function () {
    Route::get('/habitos', [HabitoController::class, 'index'])->name('habitos.index');
    Route::post('/habitos', [HabitoController::class, 'store'])->name('habitos.store');
    Route::get('/habitos/{habito}', [HabitoController::class, 'show'])->name('habitos.show');

    // ESTA É A ROTA QUE FALTA PARA O EDITAR FUNCIONAR
    Route::patch('/habitos/{habito}', [HabitoController::class, 'update'])->name('habitos.update');

    Route::delete('/habitos/{habito}', [HabitoController::class, 'destroy'])->name('habitos.destroy');
});


