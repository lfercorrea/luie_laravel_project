@extends('admin.layout')

@section('content')

<div class="container center" style="margin-top: 50px; margin-bottom: 50px;">
    @if($modo === 'cadastrar')
        <h4>Cadastrar categoria</h4>
    @elseif($modo === 'alterar')
        <h4>Alterar categoria</h4>
    @endif
    <hr>
</div>

<div class="col s12">
    <form id="form-categoria" class="col s12" action="{{ $modo === 'cadastrar' ? route('admin.cadastrar_categoria_store') : route('admin.alterar_categoria_store', ['id' => $categoria->id] ) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($modo === 'alterar')
            @method('PUT')
        @endif

        <div class="row">
            <div class="input-field col s6 m6">
                <input id="nome" type="text" class="validate" name="nome" value="{{ old('nome', $categoria->nome) }}">
                <label for="nome">Nome da categoria</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <textarea id="descricao" class="materialize-textarea" name="descricao">{{ old('descricao', $categoria->descricao) }}</textarea>
                <label for="descricao">Descrição da categoria</label>
            </div>
        </div>

        @if ($modo === 'alterar')
            Imagem atual: 
            <div class="row center">
                <div class="col s12">
                    <img src="{{ empty($categoria->imagem) ? asset('storage/static/images/no_photo.gif') :  asset('storage/' . $categoria->imagem) }}" class="responsive-img">
                </div>
            </div>
        @endif

        <div class="row">
            <div class="file-field input-field">
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
        <button class="btn waves-effect waves-light white-text black" type="submit" form="form-categoria">{{ $modo }}</button>
    </div>

</div>

@endsection