<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user_logged_in = auth()->user()->name;

            return redirect()->intended(route('site.index'))->with('success', 'Login feito com sucesso.');
        }
        else{
            return redirect()->back()->with('fail', 'Email ou senha incorretos.');
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('site.index')->with('success', 'Logout realizado com sucesso.');
    }
}
