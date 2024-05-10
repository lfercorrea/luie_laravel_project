@extends('layout')

@section('content')

  <div class="row">
    <div class="col s12 m6">
        <img class="responsive-img" src="{{ empty($imagem) ? asset('storage/static/images/no_photo.gif') :  asset('storage/' . $imagem) }}">
    </div>
    <div class="col s12 m6">
        <h4>{{ $nome }}</h4>

        @if ( $quantidade > 0 )
          <span class="green-text"><h6>R$ {{ $preco }}</h6></span>
        @else
          <span class="red-text"><h6>Indisponível</h6></span>
        @endif

        <h6>{{ $descricao }}</h6>
        <p>Categoria: <b>{{ $categoria }}</b></p>
        <div class="chip">
          Tamanhos: <b>{{ $tamanhos }}</b>
        </div>
    </div>
  </div>
  
@endsection
