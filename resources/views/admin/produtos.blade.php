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
                    <a href="/admin/cadastrar/produto" class="waves-effect"><i class="material-icons center large red-text text-red-darken-1">add_shopping_cart</i></a>
                </div>
                <div class="container">
                    Cadastrar produto
                </div>
            </div>
            <div class="col s6 m4 center">
                <div class="container">
                        <a href="/admin/estoque" class="waves-effect"><i class="material-icons center large red-text text-red-darken-1">production_quantity_limits</i></a>
                </div>
                <div class="container">
                    Estoque
                </div>
            </div>
            <div class="col s6 m4 center">
                <div class="container">
                        <a href="/admin/categorias" class="waves-effect"><i class="material-icons center large red-text text-red-darken-1">category</i></a>
                </div>
                <div class="container">
                    Categorias
                </div>
            </div>
            {{-- <div class="col s4 center">
                <div class="container">
                        <a href="/admin/alterar/produto""><i class="material-icons center large red-text text-red-darken-1">edit</i></a>
                </div>
                <div class="container">
                    Alterar produto
                </div>
            </div>
            <div class="col s4 center">
                <div class="container">
                    <a href="/admin/excluir/produto"><i class="material-icons center large red-text text-red-darken-1">remove_shopping_cart</i></a>
                </div>
                <div class="container">
                    Excluir produto
                </div>
            </div> --}}
        </div>
    </div>

    {{-- <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
        <h5>Relacionados</h5>
        <hr>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s6 center">
                <div class="container">
                        <a href="/admin/categorias""><i class="material-icons center large red-text text-red-darken-1">category</i></a>
                </div>
                <div class="container">
                    Categorias
                </div>
            </div>
            <div class="col s6 center">
                <div class="container">
                        <a href="/admin/estoque""><i class="material-icons center large red-text text-red-darken-1">production_quantity_limits</i></a>
                </div>
                <div class="container">
                    Estoque
                </div>
            </div>
        </div>
    </div> --}}
    
@endsection
