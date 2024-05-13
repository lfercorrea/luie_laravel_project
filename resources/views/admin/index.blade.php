@extends('admin.layout')

@section('content')

    <div class="container center">
        <h5>Administração</h5>
    </div>

    <div class="container section-margins">
        <h5>Produtos</h5>
        <hr>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s6 m3 center waves-effect">
                <a href="{{ route('admin.cadastrar_produto') }}" class="black-text">
                    <i class="material-icons  medium black-text">add_shopping_cart</i>
                    <div class="container">
                        Cadastrar produto
                    </div>
                </a>
            </div>
            <div class="col s6 m3 center waves-effect">
                <a href="{{ route('admin.categorias') }}" class="black-text">
                    <i class="material-icons  medium black-text">category</i>
                    <div class="container">
                        Categorias
                    </div>
                </a>
            </div>
            <div class="col s6 m3 center waves-effect">
                <a href="{{ route('admin.estoque') }}" class="black-text">
                    <i class="material-icons  medium black-text">production_quantity_limits</i>
                    <div class="container">
                        Estoque
                    </div>
                </a>
            </div>
            <div class="col s6 m3 center waves-effect">
                <a href="{{ route('admin.tamanhos') }}" class="black-text">
                    <i class="material-icons  medium black-text">height</i>
                    <div class="container">
                        Tamanhos
                    </div>
                </a>
            </div>
        </div>
    </div>

    @if ( auth()->user()->level === 1 )
        <div class="container section-margins">
            <h5>Site</h5>
            <hr>
        </div>

        <div class="container">
            <div class="row">
                <div class="col s6 m3 center waves-effect">
                    <a href="{{ route('admin.siteconfig') }}" class="black-text">
                        <i class="material-icons  medium black-text">settings</i>
                        <div class="container">
                            Configurações do site
                        </div>
                    </a>
                </div>
                <div class="col s6 m3 center waves-effect">
                    <a href="{{ route('admin.usuarios') }}" class="black-text">
                        <i class="material-icons  medium black-text">people_alt</i>
                        <div class="container">
                            Usuários
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @endif
    
@endsection
