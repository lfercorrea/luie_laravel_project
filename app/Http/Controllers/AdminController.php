<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Categoria;
use App\Models\Produto;
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
    public function index()
    {
        return view('admin.index', [
            'page_title' => 'ACP',
        ]);
    }

    /**
     * categorias
     */
    public function categorias () {
        $categorias = Categoria::orderBy('nome', 'asc')->paginate(20);

        return view('admin.categorias', [
            'page_title' => 'Categorias',
            'categorias' => $categorias,
        ]);
    }

    public function cadastrar_categoria () {
        $title = "Cadastro de categoria";
        $categoria = new Categoria();

        return view('admin.form_categoria', [
            'page_title' => 'Cadastro de categoria',
            'categoria' => $categoria,
            'modo' => 'cadastrar',
        ]);
    }

    public function categoria_store (Request $request) {
        $categoria = $request->all();
        Log::info('Iniciando validação de cadastro de categoria... (AdminController@cadastrar_categoria_store)');
        
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'imagem' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
        ], [
            'nome.string' => 'O nome precisa ser um texto de até 255 caracteres.',
            'nome.required' => 'O nome é obrigatório e precisa ser um texto de até 255 caracteres.',
            'descricao.required' => 'A descrição é obrigatório e precisa ser um texto de até 255 caracteres.',
            'descricao.string' => 'A descrição precisa ser um texto de até 255 caracteres.',
            'imagem.image' => 'O arquivo enviado não não é uma imagem.',
            'imagem.mimes' => 'A imagem deve ser do tipo JPEG, PNG ou WEBP.',
            'imagem.max' => 'A imagem deve ter até 2 MB de tamanho.',
        ]);
        
        Log::info('Completada validação de cadastro de categoria... (AdminController@cadastrar_categoria_store)');
        
        if ($request->route()->named('admin.cadastrar_categoria_store')) {
            $categoria = new Categoria();
        }
        elseif ($request->route()->named('admin.alterar_categoria_store')) {
            $categoria = Categoria::findOrFail($request->id);
            
            if ($request->hasFile('imagem')) {
                $imagem = storage_path('app/public/' . $categoria->imagem);

                if (File::exists($imagem)) {
                    File::delete($imagem);
                }
            }
        }
        
        $categoria->nome = $request->nome;
        $categoria->descricao = $request->descricao;
        
        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $nomeImagem = 'categoria_' . time() . '.' . $imagem->getClientOriginalExtension();
            $caminhoImagem = $imagem->storeAs('categorias/imagens', $nomeImagem);
            $categoria->imagem = $caminhoImagem;
        }
        
        $categoria->save();

        Log::info('Categoria cadastrada. (AdminController@cadastrar_categoria_store)');

        return redirect()->route('admin.categorias')->with('success', 'Categoria salva.');
    }

    public function alterar_categoria ($id) {
        $categoria = Categoria::findOrFail($id);

        return view('admin.form_categoria', [
            'page_title' => 'Alterar categoria - ' . $categoria->nome,
            'categoria' => $categoria,
            'modo' => 'alterar',
        ]);
    }

    public function excluir_categoria ($id) {
        $categoria = Categoria::find($id);
        $imagem = storage_path('app/public/' . $categoria->imagem);

        foreach ($categoria->produtos as $produto) {
            $produto_imagem = storage_path('app/public/' . $produto->imagem);

            if (File::exists($produto_imagem)) {
                File::delete($produto_imagem);
            }
        }

        if (File::exists($imagem)) {
            File::delete($imagem);
        }
        
        $categoria->delete();

        return redirect()
            ->route('admin.categorias')
            ->with('success', 'Categoria excluída.');
    }

    /**
     * Produtos
     */
    public function estoque(Request $request)
    {
        $count_produtos = 0;

        if ($request->has('search') OR $request->has('id_categoria') OR $request->has('id_tamanho')){
            $produtos = Produto::search($request->search, $request->id_categoria, $request->id_tamanho)->orderBy('updated_at', 'desc')->paginate(30);
            $count_produtos = Produto::search($request->search, $request->id_categoria, $request->id_tamanho)->count();
        }
        else{
            $produtos = Produto::orderBy('updated_at', 'desc')->paginate(30);
        }

        $vars = [
            'page_title' => 'Estoque',
            'produtos' => $produtos,
            'count_produtos' => $count_produtos,
            'search_term' => $request->search,
            'search_id_categoria' => $request->id_categoria,
            'search_id_tamanho' => $request->id_tamanho,
        ];

        if ( $request->route()->named('admin.estoque.imprimir') ){
            $vars['page_title'] = "Extrato de estoque";

            if ($request->has('search') OR $request->has('id_categoria') OR $request->has('id_tamanho')){
                $produtos = Produto::search($request->search, $request->id_categoria, $request->id_tamanho)->orderBy('updated_at', 'desc');
                $count_produtos = Produto::search($request->search, $request->id_categoria, $request->id_tamanho)->count();
                $vars['produtos'] = $produtos->get();
                $vars['count_produtos'] = $produtos->count();
            }
            else{
                $produtos = Produto::orderBy('updated_at', 'desc');
                $vars['produtos'] = $produtos->get();
            }

            return view('admin.relatorio_estoque', $vars);
        }
        
        return view('admin.estoque', $vars);
    }

    public function cadastrar_produto()
    {
        $produto = new Produto();

        return view('admin.form_produto', [
            'page_title' => 'Cadastro de produto',
            'produto' => $produto,
            'modo' => 'cadastrar',
        ]);
    }

    public function decrement_produto ($id) {
        $produto = Produto::FindOrFail($id);
        $produto->quantidade -= 1;
        $produto->save();

        return redirect()->route('admin.estoque')->with('success', 'Produto decrementado.');
    }

    public function increment_produto ($id) {
        $produto = Produto::FindOrFail($id);
        $produto->quantidade += 1;
        $produto->save();

        return redirect()->route('admin.estoque')->with('success', 'Produto incrementado.');
    }
    
    public function produto_store(Request $request)
    {
        Log::info('Iniciando validação de cadastro de produto... (AdminController@store)', [
            'usuario' => auth()->user()->name,
        ]);
        
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric',
            'quantidade' => 'required|integer',
            'id_categoria' => 'required|exists:categorias,id',
            'id_tamanho' => 'required|exists:tamanhos,id',
            'descricao' => 'required|string',
            'imagem' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
        ], [
            'nome.string' => 'O nome precisa ser um texto de até 255 caracteres.',
            'nome.required' => 'O nome é obrigatório e precisa ser um texto de até 255 caracteres.',
            'preco.required' => 'O preço é obrigatório e precisa ser numérico.',
            'preco.numeric' => 'O preço precisa ser numérico.',
            'quantidade.required' => 'A quantidade é obrigatória e precisa ser numérica.',
            'quantidade.integer' => 'A quantidade precisa ser um número inteiro.',
            'id_categoria.required' => 'É obrigatório selecionar uma categoria.',
            'descricao.required' => 'A descrição é obrigatória e precisa ser um texto de até 255 caracteres.',
            'descricao.string' => 'A descrição precisa ser um texto de até 255 caracteres.',
            'imagem.image' => 'O arquivo enviado não é uma imagem.',
            'imagem.mimes' => 'A imagem deve estar nos formatos JPG, PNG ou WEBP.',
            'imagem.max' => 'A imagem deve ser menor do que 2 MB.',
        ]);
        
        if ($request->route()->named('admin.cadastrar_produto_store')) {
            $produto = new Produto();
        }
        elseif ($request->route()->named('admin.alterar_produto.store')) {
            $produto = Produto::findOrFail($request->id);

            if ($request->hasFile('imagem')) {
                $imagem = storage_path('app/public/' . $produto->imagem);

                if (File::exists($imagem)) {
                    File::delete($imagem);
                }
            }
        }

        $produto->quantidade = abs($request->quantidade);
        $produto->nome = $request->nome;
        $produto->descricao = $request->descricao;
        $produto->preco = $request->preco;
        $produto->slug = Str::slug($request->nome . '-' . substr($request->descricao, 0, 30));
        $produto->id_user = auth()->user()->id;
        $produto->id_categoria = $request->id_categoria;
        
        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $nomeImagem = 'produto_' . time() . '.' . $imagem->getClientOriginalExtension();
            $caminhoImagem = $imagem->storeAs('produtos/imagens', $nomeImagem);
            $produto->imagem = $caminhoImagem;
        }
        
        $produto->save();

        if ($request->has('id_tamanho')) {
            $produto->tamanho()->sync($request->input('id_tamanho'));
        }
        else {
            $produto->tamanho()->detach();
        }

        Log::info('Produto cadastrado. (AdminController@store)', [
            'usuario' => auth()->user()->name,
            'produto (id)' => $produto->id,
            'produto (slug)' => $produto->slug,
        ]);

        return redirect()->route('admin.estoque')->with('success', 'Produto salvo com sucesso.');
    }

    public function alterar_produto($id)
    {
        $produto = Produto::findOrFail($id);
        $produtos = Produto::with('categoria');

        return view('admin.form_produto', [
            'page_title' => 'Alterar produto - ' . $produto->nome,
            'produto' => $produto, 
            'produtos' => $produtos,
            'modo' => 'alterar',
        ]);
    }

    public function excluir_produto ($id) {
        $produto = Produto::find($id);
        $imagem = storage_path('app/public/' . $produto->imagem);
        
        if (File::exists($imagem)) {
            File::delete($imagem);
        }

        $produto->delete();
        
        return redirect()
            ->route('admin.estoque')
            ->with('success', 'Produto excluído com sucesso.');
    }

    /**
     * Usuários
     */
    public function usuarios (Request $request) {
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

    public function alterar_usuario ($id) {
        $usuario = User::findOrFail($id);

        return view('common.form_usuario', [
            'page_title' => 'Alterar usuário - ' . $usuario->name,
            'usuario' => $usuario,
            'modo' => 'alterar',
            'disable_switch' => 'disabled',
        ]);
    }

    public function excluir_usuario ($id) {
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
