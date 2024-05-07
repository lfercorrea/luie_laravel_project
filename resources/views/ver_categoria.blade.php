@extends('layout')

@section('content')

    <div class="background-category-container">
        <div class="row">
            <div class="col s12">
                <div class="background-category-image z-depth-2">
                    <img class="responsive-img" src="{{ empty($categoria->imagem) ? asset('storage/static/images/no_photo.gif') :  asset('storage/' . $categoria->imagem) }}">
                </div>
            </div>
            <div class="col s12">
                <p><div class="background-category-title">{{ $categoria->nome }}</div></p>
                <p><div class="background-category-description">{{ $categoria->descricao }}</div></p>
            </div>
        </div>
    </div>

    @if (count($produtos) === 0)
        <br>
        <p><h5>Não há nenhum produto nesta categoria.</h5></p>
    @endif

    <div class="row">

        @foreach ($produtos as $produto)
            @include('common.card_produto')
        @endforeach

    </div>

    <div class="row">
        {{ $produtos->links('common/pagination') }}
    </div>

@endsection
