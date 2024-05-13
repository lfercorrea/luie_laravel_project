@extends('admin.layout')

@section('content')

<div class="container center">
    @if($modo === 'cadastrar')
        <h5>Cadastrar tamanho</h5>
    @elseif($modo === 'alterar')
        <h5>Alterar tamanho</h5>
    @endif
    <hr>
</div>

<div class="col s12 section-margins">
    <form id="form-tamanho" class="col s12" action="{{ $modo === 'cadastrar' ? route('admin.tamanho_store') : ($modo === 'alterar' ? route('admin.tamanho_update', ['id' => $tamanho->id] ) : '' ) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($modo === 'alterar')
            @method('PUT')
        @endif

        <div class="row">
            <div class="input-field col s12 m6">
                <input id="nome" type="text" class="validate" name="nome" value="{{ old('nome', $tamanho->nome) }}" {{ $modo === 'alterar' ? 'disabled' : '' }}>
                <label for="nome">Nome (símbolo)</label>
            </div>
            <div class="input-field col s12 m6">
                <input id="posicao" type="number" class="validate" name="posicao" value="{{ old('posicao', isset($tamanho->posicao) ? $tamanho->posicao : $prox_posicao) }}">
                <label for="posicao">Posição {{ $modo === 'cadastrar' ? '(preenchido automaticamente com uma posição disponível)' : '' }}</label>
            </div>
        </div>
    </form>

    @if ( $modo === 'alterar' )
    <div class="container center">
        <div class="row">
            <div class="col s12 red lighten-3"><b><p>Posições em uso por outros tamanhos:</p></b></div>
                <div class="col s12 red lighten-3">
                    <ul>
                        <li>{{ $posicoes_ocupadas }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="container center">
        <a class="waves-effect waves-black btn-flat" onclick="history.back()">Voltar</a>
        <button class="btn waves-effect waves-light white-text black" type="submit" form="form-tamanho">{{ $modo }}</button>
    </div>

</div>

@endsection