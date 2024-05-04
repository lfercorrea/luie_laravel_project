<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Categoria;
use App\Models\Produto;
use App\Models\Siteconfig;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * aplica o middleware para restrição de acesso a todos os métodos do controlador, mas tambem
     * é possivel criar uma lista negra de métodos deste controlador encadeando ->only('metodo')
     * ou uma lista branca encadeando ->except('metodo').
     */
    // public function __construct () {
    //     $this->middleware('auth')->except('index');
    // }
    public function index () {
        return view('admin.index', [
            'page_title' => 'ACP',
        ]);
    }
    
    public function siteconfig () {
        return view('admin.siteconfig');
    }
    
    public function store (Request $request) {
        $site_configs = $request->all();
        Log::info('Iniciando validação de campos (AdminController@store)');
        
        $request->validate([
            'brand' => 'required|string|max:255',
            'endereco' => 'required|string',
            'sobre_empresa' => 'required|string',
            'sobre_produtos' => 'required|string',
            'email' => 'required|email',
            'telefone' => 'nullable|numeric',
            'celular' => 'nullable|numeric',
            'brand_logo' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
        ], [
            'brand.string' => 'O nome da empresa precisa ser um texto de até 255 caracteres.',
            'brand.required' => 'O nome da empresa é obrigatório e precisa ser um texto de até 255 caracteres.',
            'endereco.required' => 'O endereço é obrigatório e precisa ser um texto de até 255 caracteres.',
            'endereco.string' => 'O endereço precisa ser um texto de até 255 caracteres.',
            'sobre_empresa.required' => 'Preencha o campo de apresentação da empresa.',
            'sobre_empresa.string' => 'O texto do campo "Texto de apresentação da empresa" deve ser uma string.',
            'sobre_produtos.required' => 'Preencha o campo de apresentação dos produtos.',
            'sobre_produtos.string' => 'O texto do campo "Texto de apresentação dos produtos" deve ser uma string.',
            'email.required' => 'O email da empresa é obrigatório.',
            'email.email' => 'O email fornecido não é válido.',
            'telefone.numeric' => 'O telefone só pode conter números.',
            'celular.numeric' => 'O celular só pode conter números.',
            'brand_logo.image' => 'O arquivo enviado não é uma imagem.',
            'brand_logo.mimes' => 'A imagem deve ser do tipo JPEG, PNG ou WEBP.',
            'brand_logo.max:2048' => 'O tamanho da imagem ultrapassa 2 MB.',
        ]);
        
        Log::info('Validação de campos concluída (AdminController@store)');
        
        $site_configs = Siteconfig::first();
        
        if ($request->hasFile('brand_logo')) {
            $imagem = storage_path('app/public/' . $site_configs->brand_logo);

            if (File::exists($imagem)) {
                File::delete($imagem);
            }
        }

        $site_configs->brand = $request->brand;
        $site_configs->endereco = $request->endereco;
        $site_configs->sobre_empresa = $request->sobre_empresa;
        $site_configs->sobre_produtos = $request->sobre_produtos;
        $site_configs->email = $request->email;
        $site_configs->telefone = $request->telefone;
        $site_configs->celular = $request->celular;
        
        if ($request->hasFile('brand_logo')) {
            $imagem = $request->file('brand_logo');
            $nomeImagem = 'brand_logo_' . time() . '.' . $imagem->getClientOriginalExtension();
            $caminhoImagem = $imagem->storeAs('static/images', $nomeImagem);
            $site_configs->brand_logo = $caminhoImagem;
        }
        
        $site_configs->save();

        Log::info('Configurações salvas. (AdminController@store)');

        return redirect()->route('admin.index')->with('success', 'Configurações salvas.');
    }
}
