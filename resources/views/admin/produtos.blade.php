@extends('admin.layout')

@section('content')

    <div class='container center'>
        <h4>Produtos</h4>
    </div>

    <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
        <h5>Gestão de estoque</h5>
        <hr>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s6 m4 center">
                <div class="container">
                    <a href="/admin/cadastrar/produto" class="waves-effect"><i class="material-icons center large large black-text text-darken-4">add_shopping_cart</i></a>
                </div>
                <div class="container">
                    Cadastrar produto
                </div>
            </div>
            <div class="col s6 m4 center">
                <div class="container">
                    <a href="/admin/estoque" class="waves-effect"><i class="material-icons center large large black-text text-darken-4">production_quantity_limits</i></a>
                </div>
                <div class="container">
                    Estoque
                </div>
            </div>
            <div class="col s6 m4 center">
                <div class="container">
                    <a href="/admin/categorias" class="waves-effect"><i class="material-icons center large large black-text text-darken-4">category</i></a>
                </div>
                <div class="container">
                    Categorias
                </div>
            </div>
        </div>
    </div>

    @if ($msg = Session::get('success'))
        
        @include('messages.success')
        
    @endif
    
@endsection
