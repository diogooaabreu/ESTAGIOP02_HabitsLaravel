<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create() { return view('auth.login'); }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'As credenciais introduzidas não coincidem.'
            ]);
        }

        session()->regenerate();
        return redirect('/habitos')->with('success', 'Bem-vindo de volta!');
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Sessão terminada.');
    }
}
