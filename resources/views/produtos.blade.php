@extends('layout')

@section('content')

    <h2>Produtos</h2>

    <div class="row">
        @foreach ($produtos as $produto)        
        <div class="col s12 m3">
            <div class="card">
                <div class="card-image">
                    <img src="{{ $produto->imagem }}">
                    <span class="card-title">{{ $produto->nome }}</span>
                    <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">zoom_in</i></a>
                </div>
                <div class="card-content">
                    <p>{{ Str::limit($produto->descricao, 120) }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row">
        {{ $produtos->links('custom/pagination') }}
    </div>

@endsection
