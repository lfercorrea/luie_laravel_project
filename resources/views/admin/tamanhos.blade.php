@extends('admin.layout')

@section('content')

    <div class='center'>
        <h5>Tamanhos</h5>
        <hr>
    </div>

    <div class="row">
        <div class="col s12">
            <a href="{{ route('admin.tamanho_create') }}" class="btn green waves-effect waves-light">Novo</a>
        </div>
    </div>

    <div class="row">
        {{ $tamanhos->links('common/pagination') }}
    </div>

    <div id="confirm-delete-modal" class="modal">
        <div class="modal-content">
            <h5>Confirmar</h5>
            <p>Tem certeza que deseja excluir? <span class="red-text text-darken-1">Todos os produtos com este tamanho serão desvinculados dele.</span></p>
        </div>
        <div class="modal-footer">
            <form id="delete-form" action="/admin/excluir/tamanho" method="POST">
                @csrf
                @method('DELETE')
                <a href="#!" class="modal-close waves-effect waves-black btn-flat">Cancelar</a>
                <button type="submit" class="btn waves-effect waves-light red darken-1">Excluir</button>
            </form>
        </div>
    </div>

    <table class="striped">
        <thead>
            <tr>
                <th class="center-align">Ações</th>
                <th>Símbolo</th>
                <th>Ordenamento</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($tamanhos as $tamanho)
                <tr>
                    <td class="center-align">
                        <a href="{{ route('admin.tamanho_edit', $tamanho->id) }}" class="btn-small waves-effect blue darken-1">
                            <i class="material-icons center">edit</i>
                        </a>
                        <button class="btn-small waves-effect red darken-1 modal-trigger" data-target="confirm-delete-modal" data-target-url="/admin/excluir/tamanho/" data-target-id="{{ $tamanho->id }}">
                            <i class="material-icons center">delete</i>
                        </button>
                    </td>
                    <td><h6>{{ $tamanho->nome }}</h6></td>
                    <td><h6>Posição {{ $tamanho->posicao }}</h6></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        {{ $tamanhos->links('common/pagination') }}
    </div>
    
    
@endsection
