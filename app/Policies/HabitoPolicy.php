<?php

namespace App\Policies;

use App\Models\Habito;
use App\Models\User;
use Illuminate\Support\Facades\Gate; // Adiciona no topo do ficheir

class HabitoPolicy
{
//    public function update(Request $request, Habito $habito)
//    {
//        // Em vez de $this->authorize(...), usa o Gate:
//        if (! Gate::allows('update', $habito)) {
//            abort(403, 'Não tens permissão para editar este hábito.');
//        }
//
//        $validated = $request->validate([
//            'titulo' => 'required|string|max:255',
//            'descricao' => 'nullable|string',
//        ]);
//
//        $habito->update($validated);
//
//        return redirect()->route('habitos.show', $habito)->with('success', 'Hábito atualizado!');
//    }
    public function update(User $user, Habito $habito): bool
    {
        // O utilizador só pode editar se for o dono do hábito
        return $user->id === $habito->user_id;
    }

    public function delete(User $user, Habito $habito): bool {
        return $user->id === $habito->user_id;
    }

    public function view(User $user, Habito $habito): bool {
        return $user->id === $habito->user_id ||
            $habito->partilhadoCom()->where('user_id', $user->id)->exists();
    }



}
