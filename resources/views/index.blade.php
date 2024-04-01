@extends('layout')

@section('content')

    <h2>Index</h2>

    <div class="row">
        <div class="col s6">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator responsive-img" src="{{ Storage::url('images/s-l1600.jpg') }}">
            </div>
        </div>
        <div class="col s6">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator responsive-img" src="{{ Storage::url('images/pijama-feminino-americano-curto-com-botoes-preto-02.webp') }}">
            </div>
        </div>
        <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">Lingeries<i class="material-icons right">detalhes</i></span>
            <p><a href="produtos" class="red-text">Conheça nossas coleções</a></p>
        </div>
    </div>
    
@endsection
