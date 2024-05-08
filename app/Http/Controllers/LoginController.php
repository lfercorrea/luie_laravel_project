<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function index () {
        return view('login.form', [
            'page_title' => 'Entrar',
        ]);
    }

    public function auth(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ], [
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email fornecido não é válido.',
            'password.required' => 'A senha é obrigatória.',
        ]);

        $remember = $request->has('remember');

        if(Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $user_logged_in = auth()->user()->name;

            Log::info('Usuário fez login.', [
                'user_ip' => $request->ip(),
                'username' => $user_logged_in,
            ]);

            return redirect()->intended(route('site.index'))->with('success', 'Login feito com sucesso.');
        }
        else{
            Log::info('Usuário errou a senha ao tentar fazer login.', [
                'user_ip' => $request->ip(),
            ]);

            return redirect()->back()->with('fail', 'E-mail ou senha incorretos.');
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('site.index')->with('success', 'Logout feito com sucesso.');
    }
}
