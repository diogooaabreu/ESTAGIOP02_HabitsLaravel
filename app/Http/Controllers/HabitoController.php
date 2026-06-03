<?php

namespace App\Http\Controllers;

use App\Models\Habito;
use App\Http\Requests\StoreHabitoRequest; // Importação essencial
use App\Http\Requests\UpdateHabitoRequest; // Importação essencial
use Illuminate\Support\Facades\Gate;

// ESTA É A LINHA QUE DEVES CORRIGIR:
use Illuminate\Http\Request;


class HabitoController extends Controller
{
    /**
     * Lista os hábitos do utilizador.
     */
    public function index() // <--- O Laravel não está a encontrar este método
    {
        // Obtém os hábitos do utilizador logado com as conclusões carregadas
        $habitos = auth()->user()->habitos()->with('conclusoes')->latest()->get();

        return view('habitos.index', compact('habitos'));
    }

    public function store(StoreHabitoRequest $request)
    {
        // Graças ao Request, os dados já chegam validados
        auth()->user()->habitos()->create($request->validated());

        return back()->with('success', 'Hábito criado com sucesso!');
    }



    public function edit(Habito $habito)
    {
        // Verifica se o utilizador tem permissão para editar (usando a Policy)
        Gate::authorize('update', $habito);

        return view('habitos.edit', compact('habito'));
    }

    public function show(Habito $habito)
    {
        // Verifica se o utilizador tem permissão para ver
        Gate::authorize('view', $habito);

        return view('habitos.show', compact('habito'));
    }

//    public function update(Request $request, Habito $habito)
//    {
//        // Verifica se o utilizador é o dono
//        Gate::authorize('update', $habito);
//
//        $validated = $request->validate([
//            'titulo' => 'required|string|max:255',
//            'descricao' => 'nullable|string',
//        ]);
//
//        $habito->update($validated);
//
//        return redirect()->route('habitos.show', $habito)
//            ->with('success', 'Hábito atualizado com sucesso!');
//    }
    public function update(Request $request, Habito $habito)
    {
        // Isto vai chamar o método 'update' da HabitoPolicy que corrigimos acima
        Gate::authorize('update', $habito);

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $habito->update($validated);

        return redirect()->route('habitos.show', $habito)->with('success', 'Hábito atualizado!');
    }

    public function destroy(Habito $habito)
    {
        // Verifica se o utilizador pode apagar
        Gate::authorize('delete', $habito);

        $habito->delete();

        return redirect()->route('habitos.index')->with('success', 'Hábito eliminado!');
    }
}
