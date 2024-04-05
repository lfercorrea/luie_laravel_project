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

<div class="row">
    <form id="form-produto" class="col s12" action="{{ $modo === 'cadastrar' ? '/admin/cadastrar/produto/store' : '/admin/alterar/produto/' . $produto->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($modo === 'alterar')
            @method('PUT')
        @endif
        <input type="hidden" name="modo" value="{{ $modo }}">

        @if($modo === 'alterar')
        <div class="row">
            <div class="s12">
                <span class="grey-text"><i>Produto cadastrado por <b>{{ $produto->user->name }}</b></i></span>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="input-field col s6 m3">
                {{-- referente ao id_user passado pelo AdminController.php --}}
                <input type="hidden" name="id_user" value="1" />
                <input id="nome" type="text" class="validate" name="nome" value="{{ old('nome', $produto->nome) }}">
                <label for="nome">Nome do produto</label>
            </div>
            <div class="input-field col s6 m3">
                <input id="preco" type="number" placeholder="R$ 123,45" class="validate" name="preco" value="{{ old('preco', $produto->preco) }}">
                <label for="preco">Preço</label>
            </div>
            <div class="input-field col s6 m3">
                <input id="quantidade" type="number" placeholder="123" class="validate" name="quantidade" value="{{ old('quantidade', $produto->quantidade) }}">
                <label for="quantidade">Quantidade</label>
            </div>
            <div class="input-field col s6 m3">
                <select name="id_categoria">
                  <option value="{{ old('id_categoria', $produto->id_categoria) }}" disabled selected>{{ $modo == 'cadastrar' ? 'Selecione' : old('id_categoria', $produto->categoria->nome) }}</option>
                  @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                  @endforeach
                </select>
                <label>Categoria</label>
            </div>
        </div>
        <div class="row">
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="descricao" class="materialize-textarea" name="descricao">{{ old('descricao', $produto->descricao) }}</textarea>
                    <label for="descricao">Descrição do produto</label>
                </div>
            </div>
        </div>

        @if ($modo === 'alterar')
            Imagem atual: 
            <div class="row center">
                <div class="col s12">
                    <img src="{{ $produto->imagem }}" class="responsive-img">
                </div>
            </div>
        @endif

        <div class="row">
            <div class="file-field input-field">
                <div class="waves-effect btn red black">
                    <span>Enviar arquivo</span>
                    <input type="file" name="imagem">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                    <label for="imagem">Imagens podem ser do tipo JPG ou PNG</label>
                </div>
            </div>
        </div>
    </form>

    <div class="container center">
        <a class="waves-effect waves-teal btn-flat" onclick="history.back()">Voltar</a>
        <a class="btn red black white-text" href="/admin">Painel principal</a>
        <button class="btn waves-effect waves-white white-text teal darken-1" type="submit" form="form-produto">
            <i class="material-icons right">check</i>{{ $modo }}
        </button>
    </div>

    @if ($msg = Session::get('fail') || $errors->any() )
        
        @include('messages.fail')

    @endif

</div>

@endsection