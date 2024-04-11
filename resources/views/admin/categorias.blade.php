@extends('admin.layout')

@section('content')
    <div class='center'>
        <h4>Categorias</h4>
        <hr>
    </div>

    <div class="row">
        <div class="col s12">
            <a href="{{ route('admin.cadastrar_categoria') }}" class="btn green">Nova categoria</a>
        </div>
    </div>

    <div class="row">
        {{ $categorias->links('common/pagination') }}
    </div>

    <div id="confirm-delete-modal" class="modal">
        <div class="modal-content">
            <h4>Confirmar exclusão</h4>
            <p>Tem certeza que deseja <b>excluir</b> esta categoria?</p>
        </div>
        <div class="modal-footer">
            <form id="delete-form" action="/admin/excluir/categoria" method="POST">
                @csrf
                @method('DELETE')
                <a href="#!" class="modal-close waves-effect waves-black btn-flat">Cancelar</a>
                <button type="submit" class="btn waves-effect waves-light red lighten-1">Excluir</button>
            </form>
        </div>
    </div>

    <table class="striped responsive-table">
        <thead>
            <tr>
                <th>Ações</th>
                <th>Categoria</th>
                <th>Descrição</th>
                <th>Imagem</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($categorias as $categoria)
            <tr>
                <td>
                    <a href="{{ route('admin.alterar_categoria', $categoria->id) }}" class="btn-small waves-effect blue darken-1">
                        <i class="material-icons center">edit</i>
                    </a>
                    <button class="btn-small waves-effect red darken-1 modal-trigger" data-target="confirm-delete-modal" data-target-url="/admin/excluir/categoria/" data-target-id="{{ $categoria->id }}">
                        <i class="material-icons center">delete</i>
                    </button>
                </td>
                <td><b>{{ $categoria->nome }}</b></td>
                <td>{{ $categoria->descricao }}</td>
                <td><img src="{{ asset('storage/' . $categoria->imagem) }}" class="responsive-img image-cell"></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr>

    <div class="row">
        {{ $categorias->links('common/pagination') }}
    </div>
    
    
@endsection
