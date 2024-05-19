@extends('layout')

@section('content')

  <div id="zoom_img_{{ $slug }}" class="modal modal-fixed-footer modal-fixed-width modal-fixed-height">
    <div class="modal-content center">
        <img src="{{ empty($imagem) ? asset('storage/static/images/no_photo.gif') :  asset('storage/' . $imagem) }}" class="img-max-width">
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-black btn-flat">Fechar</a>
    </div>
  </div>

  <div class="row">
    <div class="card">
      <div class="col s12 m6">
        <div class="card-image">
          <img class="responsive-img z-depth-2" src="{{ empty($imagem) ? asset('storage/static/images/no_photo.gif') :  asset('storage/' . $imagem) }}">
          <a href="#zoom_img_{{ $slug }}" class="btn-floating halfway-fab waves-effect waves-light pink lighten-2 modal-trigger"><i class="material-icons black-text">zoom_in</i></a>
        </div>
        <div class="row center">
          <span class="photo-legend">Clique na lupa para ampliar</span>
        </div>
      </div>
    </div>
    
    <div class="col s12 m6">
      <h4>{{ $nome }}</h4>

      @if ( $quantidade > 0 )
        <span class="green-text"><h6>R$ {{ $preco }}</h6></span>
      @else
        <span class="red-text"><h6>Indisponível</h6></span>
      @endif

      <h6>{{ $descricao }}</h6>
      <p>Categoria: <b><a href="{{ route('site.ver.categoria', ['id' => $id_categoria]) }}">{{ $categoria }}</a></b></p>
      <div class="chip">
        Tamanhos: <b>{{ $tamanhos }}</b>
      </div>
    </div>
  </div>
  
@endsection
