@extends('layout')

@section('content')

    <h2>Produtos</h2>

    <div class="row">
        @foreach ($produtos as $produto)
        
            @include('common.card_produto')

        @endforeach
    </div>

    <div class="row">
        {{ $produtos->links('common/pagination') }}
    </div>

@endsection
