<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class UserController extends Controller
{
    public function index (Request $request) {
        $count_usuarios = 0;

        if ($request->search){
            $usuarios = User::search($request->search)->paginate(30);
            $count_usuarios = User::search($request->search)->count();
        }
        else{
            $usuarios = User::orderBy('name')->paginate(30);
        }
        
        return view('admin.usuarios', [
            'page_title' => 'Gestão de usuários',
            'usuarios' => $usuarios,
            'count_usuarios' => $count_usuarios,
        ]);
    }

    public function create () {
        $usuario = new User();

        return view('common.form_usuario', [
            'page_title' => 'Cadastro',
            'usuario' => $usuario,
            'modo' => 'cadastrar',
            'disable_switch' => '',
        ]);
    }

    public function edit ($id) {
        $usuario = User::findOrFail($id);

        return view('common.form_usuario', [
            'page_title' => 'Alterar usuário - ' . $usuario->name,
            'usuario' => $usuario,
            'modo' => 'alterar',
            'disable_switch' => 'disabled',
        ]);
    }
    
    public function store (Request $request) {
        Log::info('Iniciando validação dos campos de formulário de usuário (UserController@store)');
        $rules = [
            'name' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'numero' => 'required|string',
            'cidade' => 'required|string',
            'bairro' => 'required|string',
            'uf' => 'required|string|regex:/^[A-Z]{2}$/',
            'celular' => 'required|regex:/^0\d{2}9\d{8}$/',
            'cep' => 'required|regex:/^\d{5}-\d{3}$/',
            'email' => 'required|email|max:255|string|confirmed|unique:users',
            'email_confirmation' => 'required',
            'password' => 'required|string|confirmed|regex:/^(?=.*[a-zA-Z])(?=.*[\W_]).{8,}$/',
            'password_confirmation' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png|max:2048',
        ];
        $messages = [
            'name.string' => 'O nome precisa ser um texto de até 255 caracteres.',
            'name.required' => 'O nome é obrigatório.',
            'endereco.required' => 'O endereço é obrigatório.',
            'endereco.string' => 'O endereço precisa ser um texto.',
            'endereco.max' => 'O endereço só pode ter até 255 caracteres.',
            'numero.required' => 'O número é obrigatório.',
            'numero.string' => 'O número deve ser uma string.',
            'cidade.required' => 'A cidade é obrigatória.',
            'cidade.string' => 'O campo cidade precisa ser do tipo string.',
            'bairro.required' => 'O bairro é obrigatório',
            'bairro.string' => 'O campo bairro precisa conter um texto.',
            'uf.required' => 'O estado é obrigatório.',
            'uf.string' => 'O estado deve ser do tipo string.',
            'uf.regex' => 'O estado deve conter apenas duas letras.',
            'celular.required' => 'O celular é obrigatório.',
            'celular.regex' => 'O celular deve conter somente números, incluindo o zero e o DDD.',
            'cep.required' => 'O CEP é obrigatório.',
            'cep.regex' => 'O CEP deve seguir o formato 00000-000.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.string' => 'O e-mail deve ser uma string.',
            'email.max' => 'O e-mail deve ter, no máximo, 255 caracteres.',
            'email.email' => 'O e-mail não é válido.',
            'email.confirmed' => 'Os e-mails são diferentes.',
            'email.unique' => 'Este e-mail já está em uso.',
            'email_confirmation.required' => 'É necessário confirmar os e-mails.',
            'password.required' => 'A senha é obrigatória.',
            'password.string' => 'A senha precisa ser uma string.',
            'password.confirmed' => 'As senhas fornecidas são diferentes.',
            'password.regex' => 'A senha precisa ter no mínimo 8 caracteres, incluindo um símbolo ou espaço.',
            'password_confirmation.required' => 'É necessário confirmar a senha.',
            'foto.image' => 'A foto precisa ser uma imagem.',
            'foto.mimes' => 'A foto precisa estar no formato JPEG ou PNG.',
            'foto.max' => 'A foto não pode ser maior do que 2 MB.',
        ];

        if ($request->route()->named('admin.alterar_usuario.store')) {
            $rules['email'] = 'nullable|email|max:255|string|confirmed';
            $rules['email_confirmation'] = 'nullable';
        }

        $request->validate($rules, $messages);
        
        Log::info('Finalizando validação dos campos do formulário de usuário (UserController@store)');

        $arr_user = $request->all();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nome_foto = 'user_' . time() . '.' . $foto->getClientOriginalExtension();
            $caminho_foto = $foto->storeAs('usuarios/fotos', $nome_foto);
            $arr_user['foto'] = $caminho_foto;
        }

        $arr_user['level'] = 3;
        $arr_user['password'] = bcrypt($request->password);

        if ($request->route()->named('users.store')) {
            $user = User::create($arr_user);

            Log::info('Usuário criado com sucesso (UserController@store)', [
                'user_name' => $arr_user['name'],
                'user_email' => $arr_user['email'],
            ]);

            if ( isset(auth()->user()->level) ? auth()->user()->level === 1 : false ) {

                return redirect()->route('admin.usuarios')->with('success', 'Cadastro realizado.');
            }

        }
        elseif ($request->route()->named('admin.alterar_usuario.store')) {
            unset($arr_user['email']);
            $arr_user['level'] = $request->level;
            $user = User::findOrFail($request->id);

            if ($request->hasFile('foto')) {
                $imagem = storage_path('app/public/' . $user->foto);

                if (File::exists($imagem)) {
                    File::delete($imagem);
                }
            }
            
            $user->update($arr_user);
            
            return redirect()->route('admin.usuarios')->with('success', 'Usuário alterado.');
        }
        
        Auth::login($user);

        return redirect()->route('site.index')->with('success', 'Cadastro realizado.');
    }

    public function destroy ($id) {
        $user = User::find($id);
        
        if( $user->level == 1 ) {
            return back()->with('fail', 'O proprietário não pode ser excluído.');
        }
        
        $imagem = storage_path('app/public/' . $user->foto);

        if (File::exists($imagem)) {
            File::delete($imagem);
        }

        $user->delete();

        return redirect()
            ->route('admin.usuarios')
            ->with('success', 'Usuário excluído.');
    }
}
