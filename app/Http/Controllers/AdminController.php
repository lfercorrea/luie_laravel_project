<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.index');
    }

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
        $produto = new Produto();
        $categorias = Categoria::all();

        return view('admin.form_produto', [
            'produto' => $produto, 
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

    public function excluir_produto()
    {
        $produtos = Produto::paginate(30);

        return view('admin.excluir_produto', [
            'produtos' => $produtos,
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
        //
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
