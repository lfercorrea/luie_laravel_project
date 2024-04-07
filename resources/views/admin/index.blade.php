@extends('admin.layout')

@section('content')

    <div class="container center">
        <h4>Painel de administração</h4>
    </div>

    <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
        <h5>Gestão de produtos</h5>
        <hr>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s6 m4 center">
                <div class="container">
                    <a href="{{ route('admin.categorias') }}" class="waves-effect"><i class="material-icons center large black-text text-darken-4">category</i></a>
                </div>
                <div class="container">
                    Categorias de produtos
                </div>
            </div>
            <div class="col s6 m4 center">
                <div class="container">
                    <a href="{{ route('admin.produtos') }}" class="waves-effect"><i class="material-icons center large black-text text-darken-4">shopping_cart</i></a>
                </div>
                <div class="container">
                    Produtos
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
        <h5>Gestão de pessoas</h5>
        <hr>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s6 m4 center">
                <div class="container">
                    <a href="{{ route('admin.usuarios') }}" class="waves-effect"><i class="material-icons center large black-text text-darken-4">people_alt</i></a>
                </div>
                <div class="container">
                    Usuários/clientes
                </div>
            </div>
        </div>
    </div>
    
@endsection
