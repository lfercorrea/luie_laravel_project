@extends('admin.layout')

@section('content')
    <div class='center'>
        <h4>Gestão de estoque</h4>
        <hr>
    </div>

    <div class="row">
        <div class="col s3">
            <a href="{{ route('admin.cadastrar_produto') }}" class="btn green">Novo produto</a>
        </div>
        <form action="{{ route('admin.estoque') }}" method="GET">
            <div class="col s6">
                <input type="text" name="search"> 
            </div>
            <div class="col s3">
                <button class="btn waves-effect waves-light black" type="submit">Buscar produto</button> 
            </div>
        </form>
    </div>

    @if ( $count_produtos > 0 )
        <div class="container center">
            <h5>{{ $count_produtos }} produtos encontrados</h5>
        </div>
    @endif

    <div class="row">
        @if (request()->input('search'))
            {{ $produtos->appends(['search' => request()->input('search')])->links('common/pagination') }}
        @else
            {{ $produtos->links('common/pagination') }}
        @endif
    </div>

    <div id="confirm-delete-modal" class="modal">
        <div class="modal-content">
            <h4>Confirmar exclusão</h4>
            <p>Tem certeza que deseja <b>excluir</b> este produto?
                Isto excluirá <b>todos</b> os produtos deste tipo. Se quiser apenas excluir algumas unidades em estoque, 
                você deve clicar em <i class="material-icons center">edit</i> e fazer as alterações pelo formulário.</p>
        </div>
        <div class="modal-footer">
            <form id="delete-form" action="/admin/excluir/produto" method="POST">
                @csrf
                @method('DELETE')
                <a href="#!" class="modal-close waves-effect waves-black btn-flat">Cancelar</a>
                <button type="submit" class="btn waves-effect waves-light red lighten-1">Excluir</button>
            </form>
        </div>
    </div>
    
    @if (count($produtos) > 0)
        <table class="striped responsive-table">
            <thead>
                <tr>
                    <th>Ações</th>
                    <th>Qtde.</th>
                    <th>Produto</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                    <th class="center">Imagem</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($produtos as $produto)
                <tr>
                    <td>
                        <form action="{{ route('admin.decrement_produto', $produto->id) }}" method="POST">
                            @csrf
                            <button class="btn-small waves-effect green" type="submit">
                                <i class="material-icons center">remove</i>
                            </button>
                        </form>
                        <a href="/admin/alterar/produto/{{ $produto->id }}" class="btn-small waves-effect blue darken-1">
                            <i class="material-icons center">edit</i>
                        </a>
                        <button class="btn-small waves-effect red darken-1 modal-trigger" data-target="confirm-delete-modal" data-target-url="/admin/excluir/produto/" data-target-id="{{ $produto->id }}">
                            <i class="material-icons center">delete</i>
                        </button>
                        <form action="{{ route('admin.increment_produto', $produto->id) }}" method="POST">
                            @csrf
                            <button class="btn-small waves-effect green" type="submit">
                                <i class="material-icons center">add</i>
                            </button>
                        </form>
                    </td>
                    <td>{{ $produto->quantidade }}</td>
                    <td><b>{{ $produto->nome }}</b></td>
                    <td>{{ $produto->descricao }}</td>
                    <td>{{ $produto->preco }}</td>
                    <td>{{ $produto->categoria->nome }}</td>
                    <td><img src="{{ empty($produto->imagem) ? asset('storage/static/images/no_photo.gif') :  asset('storage/' . $produto->imagem) }}" class="responsive-img image-cell"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
    @else
        <div class="container center">
            <h5>Nenhum produto encontrado.</h5>
            <br>
            <a href="{{ route('admin.estoque') }}" class="btn waves-effect waves-light black">Voltar</a>
        </div>
    @endif

    <div class="row">
        @if (request()->input('search'))
            {{ $produtos->appends(['search' => request()->input('search')])->links('common/pagination') }}
        @else
            {{ $produtos->links('common/pagination') }}
        @endif
    </div>
    
    
@endsection
