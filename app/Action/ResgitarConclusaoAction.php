<?php

namespace App\Actions;

class RegistarConclusaoAction
{
    public function executar(Habito $habito) {
        if (!$habito->jaFoiFeitoHoje()) {
            $habito->conclusoes()->create(['completado_em' => today()]);
        }
    }
}
