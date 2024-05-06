<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Produto;

class SiteController extends Controller
{
    public function index () {
        $last_items = Produto::orderBy('updated_at', 'desc')
            ->where('quantidade', '>', 0)
            ->take(10)
            ->get();

        return view('index', [
            'last_items' => $last_items,
        ]);
    }

    public function produtos(Request $request)
    {
        $count_produtos = 0;

        if ($request->search){
            $produtos = Produto::search($request->search)->paginate(15);
            $count_produtos = Produto::search($request->search)->count();
        }
        else{
            $produtos = Produto::orderBy('updated_at', 'desc')->paginate(15);
        }
        
        return view('produtos', [
            'page_title' => 'Produtos',
            'produtos' => $produtos,
            'count_produtos' => $count_produtos,
        ]);
    }
    
    public function ver_categoria($id)
    {
        $categoria = Categoria::where('id', $id)->first();
        $produtos = Produto::where('id_categoria', $id)->paginate(30);

        return view('ver_categoria', [
            'page_title' => $categoria->nome,
            'categoria' => $categoria,
            'produtos' => $produtos,
        ]);
    }
    
    public function ver_produto($slug)
    {
        $produto = Produto::where('slug', $slug)->first();

        $arr_tamanhos = [];

        foreach ( $produto->tamanho as $tamanho ) {
            $arr_tamanhos[] = $tamanho->nome;
        }

        $tamanhos = implode(', ', $arr_tamanhos);

        return view('ver_produto', [
            'page_title' => $produto->nome,
            'quantidade' => $produto->quantidade,
            'nome' => $produto->nome,
            'descricao' => $produto->descricao,
            'tamanhos' => $tamanhos,
            'preco' => number_format($produto->preco, 2, ',', '.'),
            'slug' => $produto->slug,
            'imagem' => $produto->imagem,
            'categoria' => $produto->categoria->nome,
            'user_produto' => $produto->user->name,
            'id_categoria' => $produto->id_categoria,
        ]);
    }
}
