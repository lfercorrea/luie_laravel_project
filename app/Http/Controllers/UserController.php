<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function create () {
        $usuario = new User();

        return view('common.form_usuario', [
            'usuario' => $usuario,
            'modo' => 'cadastrar',
        ]);
    }

    public function store (Request $request) {
        Log::info('Iniciando validação dos campos de formulário de usuário (UserController@store)');
        $request->validate([
            'name' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'numero' => 'required|numeric|integer',
            'cidade' => 'required|string',
            'bairro' => 'required|string',
            'uf' => 'required|string|max:2',
            'celular' => 'required|numeric|integer',
            'cep' => 'required|numeric|integer',
            'email' => 'required|email|confirmed',
            'email_confirmation' => 'required',
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png|max:2048',
        ], [
            'name.string' => 'O nome precisa ser um texto de até 255 caracteres',
            'name.required' => 'O nome é obrigatório e precisa ser um texto de até 255 caracteres',
            'endereco.required' => 'O endereço é obrigatório e precisa ser um texto de até 255 caracteres',
            'endereco.string' => 'O nome é obrigatório e precisa ser um texto de até 255 caracteres',
            'numero.required' => 'O número é obrigatório e não deve ser por extenso',
            'numero.numeric' => 'O número não deve ser por extenso',
            'numero.integer' => 'O número precisa ser um número inteiro',
            'cidade.required' => 'É obrigatório informar a cidade',
            'cidade.string' => 'O campo cidade precisa ser em forma de texto',
            'bairro.required' => 'É obrigatório informar o bairro',
            'bairro.string' => 'O campo bairro precisa conter um texto',
            'uf.max' => 'O campo estado é obrigatório e deve conter apenas uma UF (SP, RJ, DF, PR, SC, etc)',
            'uf.required' => 'O campo estado é obrigatório e deve conter apenas uma UF (SP, RJ, DF, PR, SC, etc)',
            'uf.string' => 'O campo estado deve conter apenas uma UF (SP, RJ, DF, PR, SC, etc)',
            'celular.required' => 'É obrigatório fornecer o número de celular e não pode ser por extenso',
            'celular.numeric' => 'O número de celular deve ser numérico',
            'celular.integer' => 'O número de celular deve ser um número inteiro',
            'cep.required' => 'É obrigatório fornecer o CEP e não pode ser por extenso',
            'cep.numeric' => 'O CEP deve ser numérico',
            'cep.integer' => 'O CEP deve ser um número inteiro',
            'email.required' => 'O e-mail é obrigatório',
            'email.email' => 'O e-mail não é válido',
            'email.confirmed' => 'Os e-mails são diferentes',
            'email_confirmation.required' => 'É necessário confirmar os e-mails',
            'password.required' => 'Você precisa fornecer uma senha',
            'password.string' => 'A senha precisa ser uma string',
            'password.confirmed' => 'As senhas fornecidas são diferentes',
            'password_confirmation.required' => 'É necessário confirmar a senha',
            'foto.image' => 'O arquivo enviado não está no formato de imagem aceito (JPEG, PNG) ou ultrapassa 2 MB',
        ]);
        Log::info('Finalizando validação dos campos do formulário de usuário (UserController@store)');

        $arr_user = $request->all();
        $arr_user['level'] = 3;
        $arr_user['password'] = bcrypt($request->password);

        if ($request->modo === 'cadastrar') {
            $user = User::create($arr_user);

            Log::info('Usuário criado com sucesso (UserController@store)');
        }
        elseif ($request->modo === 'alterar') {
            $arr_user['level'] = $request->level;
            $user = User::findOrFail($request->id);

            $user->update($arr_user);

            return redirect()->route('admin.usuarios')->with('success', 'Usuário alterado.');
        }

        // Auth::login($user);

        return redirect()->route('site.index')->with('success', 'Cadastro realizado. Agora você já pode fazer login com seu e-mail e senha.');
    }
}
