<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tamanho;

class TamanhoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tamanhos = Tamanho::orderBy('posicao', 'asc')->paginate(30);

        return view('admin.tamanhos', [
            'page_title' => 'Tamanhos',
            'tamanhos' => $tamanhos,
            'modo' => 'ver',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Cadastro de tamanho";
        $tamanho = new Tamanho();
        $prox_posicao = Tamanho::max('posicao') + 1;

        return view('admin.form_tamanho', [
            'page_title' => 'Cadastro de tamanho',
            'tamanho' => $tamanho,
            'modo' => 'cadastrar',
            'prox_posicao' => $prox_posicao,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tamanho = $request->all();

        $rules = [
            'posicao' => 'required|integer|unique:tamanhos',
        ];

        $messages = [
            'nome.string' => 'O nome precisa ser um texto de até 255 caracteres.',
            'nome.required' => 'O nome é obrigatório e precisa ser um texto de até 255 caracteres.',
            'posicao.integer' => 'Valor precisa ser um número inteiro.',
            'posicao.required' => 'A posição deve ser fornecida.',
            'posicao.unique' => 'A posição escolhida já está ocupada.',
        ];
        
        if ($request->route()->named('admin.tamanho_store')) {
            $tamanho = new Tamanho();

            $rules['nome'] = 'required|string|max:255';
        }
        elseif ($request->route()->named('admin.tamanho_update')) {
            $tamanho = Tamanho::findOrFail($request->id);
        }

        $request->validate($rules, $messages);
        
        $tamanho->fill($request->only(['nome', 'posicao']));
        
        $tamanho->save();

        return redirect()->route('admin.tamanhos')->with('success', 'Tamanho salvo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tamanho = Tamanho::findOrFail($id);
        $posicoes = Tamanho::all();
        $posicoes_ocupadas = [];

        foreach ($posicoes as $ordenada) {
            $posicoes_ocupadas[] = $ordenada->posicao;
        }

        $posicoes_ocupadas = implode(', ', $posicoes_ocupadas);

        return view('admin.form_tamanho', [
            'page_title' => 'Alterar tamanho - ' . $tamanho->nome,
            'tamanho' => $tamanho,
            'modo' => 'alterar',
            'posicoes_ocupadas' => $posicoes_ocupadas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tamanho = Tamanho::find($id);
        
        $tamanho->delete();

        return redirect()
            ->route('admin.tamanhos')
            ->with('success', 'Tamanho excluído.');
    }
}
