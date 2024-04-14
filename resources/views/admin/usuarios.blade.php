@extends('admin.layout')

@section('content')
    <div class='center'>
        <h4>Usuários cadastrados</h4>
        <hr>
    </div>

    <div class="row">
        <div class="input-field col s3">
            <a href="{{ route('user.create') }}" class="btn green">Novo usuário</a>
        </div>
        <form action="{{ route('admin.usuarios') }}" method="GET">
            <div class="input-field col s6">
                <input type="text" name="search"> 
            </div>
            <div class="input-field col s3">
                <button class="btn waves-effect waves-light black" type="submit">Buscar</button> 
            </div>
        </form>
    </div>

    @if ( $count_usuarios > 0 )
        <div class="container center">
            <h5>{{ $count_usuarios }} usuários encontrados</h5>
        </div>
    @endif

    <div class="row">
        @if (request()->input('search'))
            {{ $usuarios->appends(['search' => request()->input('search')])->links('common/pagination') }}
        @else
            {{ $usuarios->links('common/pagination') }}
        @endif
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

    @if ( count($usuarios) > 0 )
        <table class="striped responsive-table">
            <thead>
                <tr>
                    <th>Ações</th>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Foto</th>
                    <th>Nível</th>
                    <th>Endereço</th>
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
                    @if ( $usuario->id === 1)
                        <td><i class="material-icons left">stars</i><b>{{ $usuario->name }}</b><br>{{ $usuario->email }}</td>
                    @else
                        <td><b>{{ $usuario->name }}</b><br>{{ $usuario->email }}</td>
                    @endif
                    <td><img src="{{ empty($usuario->foto) ? asset('storage/static/images/img_avatar.png') :  asset('storage/' . $usuario->foto) }}" class="responsive-img circle avatar-cell"></td>
                    <td>{{ $levels[$usuario->level] }}</td>
                    <td>{{ $usuario->endereco }}, {{ $usuario->numero }} - {{ $usuario->bairro }} - {{ $usuario->cidade }} ({{ $usuario->uf }})</td>
                    <td>{{ $usuario->celular }}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
        <hr>
    @else
    <div class="container center">
        <p><h5>Nenhum usuário encontrado.</h5></p>
        <br>
        <a href="{{ route('admin.usuarios') }}" class="btn waves-effect waves-light black">Voltar</a>
    </div>
    @endif


    <div class="row">
        @if (request()->input('search'))
            {{ $usuarios->appends(['search' => request()->input('search')])->links('common/pagination') }}
        @else
            {{ $usuarios->links('common/pagination') }}
        @endif
    </div>
    
@endsection
