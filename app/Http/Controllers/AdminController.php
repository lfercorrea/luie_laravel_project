<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Categoria;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Produtos
     */
    public function produtos()
    {
        return view('admin.produtos');
    }

    public function estoque()
    {
        $produtos = Produto::paginate(30);

        return view('admin.estoque', [
            'produtos' => $produtos,
        ]);
    }

    public function cadastrar_produto()
    {
        $title = "Cadastro de produto";
        $produto = new Produto();
        $categorias = Categoria::all();

        return view('admin.form_produto', [
            'produto' => $produto, 
            'id_user' => 1, // referente ao metodo store() abaixo
            'categorias' => $categorias, 
            'modo' => 'cadastrar',
        ]);
    }

    public function alterar_produto($id)
    {
        $produto = Produto::findOrFail($id);
        $produtos = Produto::with('categoria');
        $categorias = Categoria::all();

        return view('admin.form_produto', [
            'produto' => $produto, 
            'produtos' => $produtos,
            'categorias' => $categorias, 
            'modo' => 'alterar',
        ]);
        // return view('admin.alterar_produto', [
        //     'produtos' => $produtos,
        // ]);
    }

    public function excluir_produto () {
        $produtos = Produto::paginate(30);

        return view('admin.excluir_produto', [
            'produtos' => $produtos,
        ]);
    }

    /**
     * Usuários
     */
    public function usuarios () {
        $usuarios = User::paginate(30);

        return view('admin.usuarios', [
            'usuarios' => $usuarios,
        ]);
    }

    public function alterar_usuario ($id) {
        $usuario = User::findOrFail($id);

        return view('common.form_usuario', [
            'usuario' => $usuario,
            'modo' => 'alterar',
        ]);
    }

    public function excluir_usuario () {
        $usuarios = User::paginate(30);

        return view('admin.excluir_usuario', [
            'usuarios' => $usuarios,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->modo === 'cadastrar') {
            $id_user = 1; // enquanto o sistema de cadastro de users não está pronto, id fixa em 1. após, será capturada por um input hidden html
        }
        elseif ($request->modo === 'alterar') {
            $id_user = 1; // aqui, será puxada a id do user cadastrado com User::find($id)
        }

        Log::info('Iniciando método store');

        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric',
            'quantidade' => 'required|integer',
            'id_categoria' => 'required|exists:categorias,id',
            'id_user' => 'required|exists:users,id',
            'descricao' => 'nullable|string',
            'imagem_produto' => 'nullable|image|mimes:jpeg,png|max:2048',
        ]);

        Log::info('Dados do formulário validados');

        // instanciacao produto
        $produto = new Produto();

        $produto->quantidade = abs($request->quantidade);
        $produto->nome = $request->nome;
        $produto->descricao = $request->descricao;
        $produto->preco = $request->preco;
        $produto->slug = Str::slug($request->nome . '-' . substr($request->descricao, 0, 30));
        $produto->id_user = $request->id_user;
        $produto->id_categoria = $request->id_categoria;

        // ajustes da imagem
        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $nomeImagem = time() . '_' . $imagem->getClientOriginalName();
            $caminhoImagem = $imagem->storeAs('imagens', $nomeImagem);
            $produto->imagem = $caminhoImagem;
        }

        
        $produto->save();

        return redirect()->route('admin.produtos')->with('success', 'Produto cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
