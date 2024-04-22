@extends('admin.layout')

@section('content')

<div class="container center" style="margin-top: 50px; margin-bottom: 50px;">
    @if($modo === 'cadastrar')
        <h4>Cadastrar produto</h4>
    @elseif($modo === 'alterar')
        <h4>Alterar produto</h4>
    @endif
    <hr>
</div>

    <div class="col s12">
        <form id="form-produto" action="{{ $modo === 'cadastrar' ? route('admin.cadastrar_produto_store') : route('admin.alterar_produto.store', ['id' => $produto->id] ) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($modo === 'alterar')
                @method('PUT')
            @endif

            @if($modo === 'alterar')
                <div class="row">
                    <div class="s12">
                        <span class="grey-text"><i>Última alteração feita por <b>{{ $produto->user->name }}</b></i></span>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="input-field col s6 m6">
                    <input id="nome" type="text" class="validate" name="nome" value="{{ old('nome', $produto->nome) }}" required>
                    <label for="nome">Nome do produto</label>
                </div>
                <div class="input-field col s6 m2">
                    <input id="preco" type="number" placeholder="R$ 123,45" class="validate" name="preco" min="0" step="0.01" value="{{ old('preco', $produto->preco) }}" required>
                    <label for="preco">Preço (R$)</label>
                </div>
                <div class="input-field col s6 m1">
                    <input id="quantidade" type="number" placeholder="123" class="validate" name="quantidade" value="{{ old('quantidade', $produto->quantidade) }}" required>
                    <label for="quantidade">Quantidade</label>
                </div>
                <div class="input-field col s6 m3">
                    <select name="id_categoria" class="browser-default" required>

                        <option value="{{ old('id_categoria', $produto->id_categoria) }}" selected>{{ $modo == 'cadastrar' ? 'Categoria' : old('id_categoria', $produto->categoria->nome) }}</option>
                
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="descricao" class="materialize-textarea" name="descricao" required>{{ old('descricao', $produto->descricao) }}</textarea>
                    <label for="descricao">Descrição do produto</label>
                </div>
            </div>

            @if ($modo === 'alterar')
                Imagem atual: 
                <div class="row center">
                    <div class="col s12">
                        <img src="{{ empty($produto->imagem) ? asset('storage/static/images/no_photo.gif') :  asset('storage/' . $produto->imagem) }}" class="responsive-img">
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="file-field input-field col s12">
                    <div class="waves-effect btn red black">
                        <span>Enviar arquivo</span>
                        <input id="imagem" type="file" name="imagem">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                        <label for="imagem">Imagens podem ser do tipo JPG ou PNG</label>
                    </div>
                </div>
            </div>
        </form>

        <div class="container center">
            <a class="waves-effect waves-black btn-flat" onclick="history.back()">Voltar</a>
            <button class="btn waves-effect waves-light white-text black" type="submit" form="form-produto">{{ $modo }}</button>
        </div>

    </div>

@endsection