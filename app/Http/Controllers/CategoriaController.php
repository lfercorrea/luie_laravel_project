<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class CategoriaController extends Controller
{
    public function index () {
        $categorias = Categoria::orderBy('nome', 'asc')->paginate(20);

        return view('admin.categorias', [
            'page_title' => 'Categorias',
            'categorias' => $categorias,
        ]);
    }

    public function create () {
        $title = "Cadastro de categoria";
        $categoria = new Categoria();

        return view('admin.form_categoria', [
            'page_title' => 'Cadastro de categoria',
            'categoria' => $categoria,
            'modo' => 'cadastrar',
        ]);
    }

    public function store (Request $request) {
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

    public function edit ($id) {
        $categoria = Categoria::findOrFail($id);

        return view('admin.form_categoria', [
            'page_title' => 'Alterar categoria - ' . $categoria->nome,
            'categoria' => $categoria,
            'modo' => 'alterar',
        ]);
    }

    public function destroy ($id) {
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
}
