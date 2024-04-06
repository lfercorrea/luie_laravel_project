@extends('layout')

@section('content')

    <h2>{{ $categoria->nome }}</h2>
    <h6><p>{{ $categoria->descricao }}</p></h6>

    <div class="row">
        @foreach ($produtos as $produto)
        
            @include('card_produto')

        @endforeach
    </div>

    <div class="row">
        {{ $produtos->links('custom/pagination') }}
    </div>

@endsection
