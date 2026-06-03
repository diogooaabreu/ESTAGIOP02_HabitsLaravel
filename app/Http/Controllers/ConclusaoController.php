<?php

namespace App\Http\Controllers;

use App\Models\Habito;
use Illuminate\Http\Request;

class ConclusaoController extends Controller
{
    public function store(Habito $habito)
    {
        // Usamos o metodo que criaste no Model Habito
        if ($habito->jaConcluidoHoje()) {
            return back()->with('error', 'Já marcaste este hábito hoje!');
        }

        $habito->conclusoes()->create([
            'completado_em' => today()
        ]);

        return back()->with('success', 'Hábito concluído! Bom trabalho.');
    }
}
