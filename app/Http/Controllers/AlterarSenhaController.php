<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AlterarSenhaController extends Controller
{
    public function alterar_senha ($id) {
        $usuario = User::findOrFail($id);
        return view('alterar_senha', [
                'page_title' => 'Alterar senha - ' . $usuario->name,
                'usuario' => $usuario,
                'modo' => 'alterar',
        ]);
    }

    public function store (Request $request) {
        $user = User::findOrFail($request->id);

        $rules = [
            'password' => 'required|string|confirmed|regex:/^(?=.*[a-zA-Z])(?=.*[\W_]).{8,}$/',
            'password_confirmation' => 'required',
        ];
        
        $messages = [
            'password.required' => 'A senha é obrigatória.',
            'password.string' => 'A senha precisa ser uma string.',
            'password.confirmed' => 'As senhas fornecidas são diferentes.',
            'password.regex' => 'A senha precisa ter no mínimo 8 caracteres, incluindo um símbolo ou espaço.',
            'password_confirmation.required' => 'É necessário confirmar a senha.',
        ];

        $request->validate($rules, $messages);

        $arr_user = $request->all();
        $arr_user['password'] = bcrypt($request->password);
        $user->update($arr_user);

        return redirect()->route('site.index')->with('success', 'Senha alterada.');
    }
}
