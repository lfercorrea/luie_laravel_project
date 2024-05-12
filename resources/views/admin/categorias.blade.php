@extends('admin.layout')

@section('content')
    <div class='center'>
        <h5>Categorias</h5>
        <hr>
    </div>

    <div class="row">
        <div class="col s12">
            <a href="{{ route('admin.cadastrar_categoria') }}" class="btn green waves-effect waves-light">Nova</a>
        </div>
    </div>

    <div class="row">
        {{ $categorias->links('common/pagination') }}
    </div>

    <div id="confirm-delete-modal" class="modal">
        <div class="modal-content">
            <h5>Confirmar</h5>
            <p>Tem certeza que deseja excluir esta categoria? <span class="red-text text-darken-1">Todos os produtos dela também serão removidos.</span></p>
        </div>
        <div class="modal-footer">
            <form id="delete-form" action="/admin/excluir/categoria" method="POST">
                @csrf
                @method('DELETE')
                <a href="#!" class="modal-close waves-effect waves-black btn-flat">Cancelar</a>
                <button type="submit" class="btn waves-effect waves-light red darken-1">Excluir</button>
            </form>
        </div>
    </div>

    <table class="striped responsive-table">
        <thead>
            <tr>
                <th class="center-align">Ações</th>
                <th>Categoria</th>
                <th>Descrição</th>
                <th class="center-align">Imagem</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($categorias as $categoria)
                <tr>
                    <td class="center-align">
                        <a href="{{ route('admin.alterar_categoria', $categoria->id) }}" class="btn-small waves-effect blue darken-1">
                            <i class="material-icons center">edit</i>
                        </a>
                        <button class="btn-small waves-effect red darken-1 modal-trigger" data-target="confirm-delete-modal" data-target-url="/admin/excluir/categoria/" data-target-id="{{ $categoria->id }}">
                            <i class="material-icons center">delete</i>
                        </button>
                    </td>
                    <td><h6>{{ $categoria->nome }}</h6></td>
                    <td>{{ $categoria->descricao }}</td>
                    <td class="center-align"><img src="{{ empty($categoria->imagem) ? asset('storage/static/images/no_photo.gif') :  asset('storage/' . $categoria->imagem) }}" class="responsive-img image-cell"></td>
                </tr>
            @endforeach
            
        </tbody>
    </table>

    <div class="row">
        {{ $categorias->links('common/pagination') }}
    </div>
    
    
@endsection
