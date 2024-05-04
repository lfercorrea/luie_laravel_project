<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Produto;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProdutoController extends Controller
{
    /**
     * Produtos
     */
    public function index (Request $request)
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

    public function create ()
    {
        $produto = new Produto();

        return view('admin.form_produto', [
            'page_title' => 'Cadastro de produto',
            'produto' => $produto,
            'modo' => 'cadastrar',
        ]);
    }

    public function decrement ($id) {
        $produto = Produto::FindOrFail($id);
        $produto->quantidade -= 1;
        $produto->save();

        return redirect()->route('admin.estoque')->with('success', 'Produto decrementado.');
    }

    public function increment ($id) {
        $produto = Produto::FindOrFail($id);
        $produto->quantidade += 1;
        $produto->save();

        return redirect()->route('admin.estoque')->with('success', 'Produto incrementado.');
    }
    
    public function store (Request $request)
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

    public function edit ($id)
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

    public function destroy ($id) {
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
}
