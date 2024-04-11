<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Produto;

class SiteController extends Controller
{
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
            'produtos' => $produtos,
            'count_produtos' => $count_produtos,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function ver_categoria($id)
    {
        $categoria = Categoria::where('id', $id)->first();
        $produtos = Produto::where('id_categoria', $id)->paginate(20);

        return view('ver_categoria', compact('categoria', 'produtos'));
    }

    /**
     * Display the specified resource.
     */
    public function ver_produto($slug)
    {
        $produto = Produto::where('slug', $slug)->first();

        return view('ver_produto', [
            'quantidade' => $produto->quantidade,
            'nome' => $produto->nome,
            'descricao' => $produto->descricao,
            'preco' => number_format($produto->preco, 2, ',', '.'),
            'slug' => $produto->slug,
            'imagem' => $produto->imagem,
            'categoria' => $produto->categoria->nome,
            'user_produto' => $produto->user->name,
            'id_categoria' => $produto->id_categoria,
        ]);
    }

    public function login () {
        //
    }
}
