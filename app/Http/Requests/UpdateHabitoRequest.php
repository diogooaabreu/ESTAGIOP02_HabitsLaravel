<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateHabitoRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Importante: Verifica se o utilizador é o dono do hábito
        return Gate::allows('update', $this->route('habito'));
    }

    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
        ];
    }
}
