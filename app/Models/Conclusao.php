<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Conclusao extends Model
{
    // O Laravel por padrão procura a tabela "conclusaos", mas a nossa migration usa "conclusoes"
    protected $table = 'conclusoes';

    protected $fillable = ['habito_id', 'completado_em'];

    /**
     * Cast para garantir que o completado_em é tratado como data.
     */
    protected $casts = [
        'completado_em' => 'date',
    ];

    /**
     * Relação inversa: Uma conclusão pertence a um hábito.
     */
    public function habito(): BelongsTo
    {
        return $this->belongsTo(Habito::class);
    }
}
