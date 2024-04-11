@extends('admin.layout')

@section('content')
    <div class='center'>
        <h4>Usuários cadastrados</h4>
        <hr>
    </div>

    <div class="row">
        {{ $usuarios->links('common/pagination') }}
    </div>

    <div id="confirm-delete-modal" class="modal">
        <div class="modal-content">
            <h4>Confirmar exclusão</h4>
            <p>Tem certeza que deseja <b>excluir</b> este usuario?</p>
        </div>
        <div class="modal-footer">
            <form id="delete-form" action="/admin/excluir/usuario" method="POST">
                @csrf
                @method('DELETE')
                <a href="#!" class="modal-close waves-effect waves-black btn-flat">Cancelar</a>
                <button type="submit" class="btn waves-effect waves-light red lighten-1">Excluir</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <a href="{{ route('user.create') }}" class="btn green">Novo usuário</a>
        </div>
    </div>

    <table class="striped responsive-table">
        <thead>
            <tr>
                <th>Ações</th>
                <th>ID</th>
                <th>Nome</th>
                <th>Foto</th>
                <th>Nível</th>
                <th>Endereço</th>
                <th>Cidade</th>
                <th>Celular</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($usuarios as $usuario)
            <tr>
                <td>
                    <a href="{{ route('admin.alterar_usuario', $usuario->id) }}" class="btn-small waves-effect blue darken-1">
                        <i class="material-icons center">edit</i>
                    </a>
                    @if ($usuario->level >= 1)
                        <button class="btn-small waves-effect red darken-1 modal-trigger" data-target="confirm-delete-modal" data-target-url="/admin/excluir/usuario/" data-target-id="{{ $usuario->id }}">
                            <i class="material-icons center">delete</i>
                        </button>
                    @endif
                </td>
                <td>{{ $usuario->id }}</td>
                <td><b>{{ $usuario->name }}</b></td>
                <td><img src="{{ asset('storage/' . $usuario->foto) }}" class="responsive-img circle" style="width: 80px; height: 80px;"></td>
                <td>{{ $levels[$usuario->level] }}</td>
                <td>{{ $usuario->endereco }}</td>
                <td>{{ $usuario->cidade }}</td>
                <td>{{ $usuario->celular }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr>

    <div class="row">
        {{ $usuarios->links('common/pagination') }}
    </div>
    
@endsection
