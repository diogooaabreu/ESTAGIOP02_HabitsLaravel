<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Habito extends Model
{
    protected $table = 'habitos';
    protected $fillable = ['titulo', 'descricao', 'user_id'];

    /**
     * O utilizador que criou o hábito.
     */
    public function criador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Outros utilizadores com quem este hábito foi partilhado.
     */
    public function partilhadoCom(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'habito_partilhas');
    }

    /**
     * Histórico de todas as vezes que este hábito foi concluído.
     */
    public function conclusoes(): HasMany
    {
        return $this->hasMany(Conclusao::class);
    }

    /**
     * Lógica central: Verifica se existe uma conclusão registada com a data de hoje.
     */
    public function jaConcluidoHoje(): bool
    {
        return $this->conclusoes()->whereDate('completado_em', today())->exists();
    }
}
