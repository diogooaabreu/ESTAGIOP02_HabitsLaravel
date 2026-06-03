<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create() { return view('auth.register'); }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::min(8)],
        ]);

        $user = User::create($attributes);
        Auth::login($user);

        return redirect('/habitos')->with('success', 'Conta criada com sucesso!');
    }
}
