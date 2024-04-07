@extends('admin.layout')

@section('content')
    <div class='center'>
        <h4>Gestão de estoque</h4>
        <hr>
    </div>

    <div class="row">
        <div class="col s12">
            <a href="{{ route('admin.cadastrar_produto') }}" class="btn green">Novo produto</a>
        </div>
    </div>

    <div class="row">
        {{ $produtos->links('common/pagination') }}
    </div>

    <div id="confirm-delete-modal" class="modal">
        <div class="modal-content">
            <h4>Confirmar exclusão</h4>
            <p>Tem certeza que deseja EXCLUIR este produto?
                Se quiser apenas diminuir a quantidade deste produto em estoque, 
                você deve clicar em editar (botão azul) e fazer as alterações pelo formulário.</p>
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

    <table class="striped responsive-table">
        <thead>
            <tr>
                <th>Ações</th>
                <th>Qtde.</th>
                <th>Produto</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Categoria</th>
                <th>Imagem</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($produtos as $produto)
            <tr>
                <td>
                    <a href="/admin/alterar/produto/{{ $produto->id }}" class="btn-small waves-effect blue darken-1">
                        <i class="material-icons center">edit</i>
                    </a>
                    <button class="btn-small waves-effect red darken-1 modal-trigger" data-target="confirm-delete-modal" data-product-id="{{ $produto->id }}">
                        <i class="material-icons center">delete</i>
                    </button>
                </td>
                <td>{{ $produto->quantidade }}</td>
                <td><b>{{ $produto->nome }}</b></td>
                <td>{{ $produto->descricao }}</td>
                <td>{{ $produto->preco }}</td>
                <td>{{ $produto->categoria->nome }}</td>
                <td><img src="{{ $produto->imagem }}" class="responsive-img"></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr>

    <div class="row">
        {{ $produtos->links('common/pagination') }}
    </div>
    
    
@endsection
