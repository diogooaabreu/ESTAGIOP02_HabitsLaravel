<?php

namespace App\Http\Controllers;

use App\Notifications\EmailChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Notification; // <--- ADICIONA ESTA


use Illuminate\Validation\Rules\Password;



class ProfileController extends Controller{
    public function edit()
    {
        return view('profile.edit',[
            'user' => Auth::user(),
            ]);
    }

    public function update(Request $request) {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => ['nullable', 'confirmed', Password::min(8)], // Simplificado para teste
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password
        ]);

        // Importante: Redirecionar para o nome da rota correto com mensagem
        return redirect()->route('profile.edit')->with('success', 'Perfil atualizado!');
    }

//    public function update(Request $request) {
//        $user = Auth::user();
//
//        $request->validate([
//            'name' => ['required', 'string', 'max:255'],
//            'email' => [
//                'required', 'string', 'email', 'max:255',
//                Rule::unique('users', 'email')->ignore(Auth::id()),
//            ],
//            // Agora o Password::defaults() vai funcionar porque importaste a regra de validação
//            'password' => ['nullable', 'confirmed', Password::defaults()],
//        ]);
//
//        $originalEmail = $user->email;
//
//        // DICA: Encripta a password se ela for enviada!
//        $user->update([
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password
//        ]);
//
//        if ($originalEmail !== $request->email) {
//            // Agora funciona porque importaste a Facade Notification no topo
//            Notification::route('mail', $originalEmail)
//                ->notify(new EmailChanged($user, $originalEmail));
//        }
//
//        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully');
//    }

}
