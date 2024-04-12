@extends('layout')

@section('content')

    <h4>Produtos</h4>

    <div class="row">
        <form action="{{ route('site.produtos') }}" method="GET">
            <div class="col s9">
                <input type="text" name="search"> 
            </div>
            <div class="col s3">
                <button class="btn waves-effect waves-light black" type="submit">Buscar</button> 
            </div>
        </form>
    </div>

    @if ( $count_produtos > 0 )
        <div class="container center">
            <h5><p>{{ $count_produtos }} produtos encontrados</p></h5>
        </div>
    @endif

    @if (count($produtos) > 0)
        <div class="row">
            @foreach ($produtos as $produto)
            
                @include('common.card_produto')

            @endforeach
        </div>
    @else
        <br>
        <div class="container center">
            <h5>Nenhum produto encontrado.</h5>
            <br>
            <a href="{{ route('site.produtos') }}" class="btn waves-effect waves-light black">Voltar</a>
        </div>
    @endif

    <div class="row">
        @if (request()->input('search'))
            {{ $produtos->appends(['search' => request()->input('search')])->links('common/pagination') }}
        @else
            {{ $produtos->links('common/pagination') }}
        @endif
    </div>

@endsection
