@extends('admin.layout')

@section('content')
    <div class='center'>
        <h4>Gestão de estoque</h4>
        <hr>
    </div>

    <div class="row">
        <div class="col s12 m3">
            <a href="{{ route('admin.cadastrar_produto') }}" class="btn green">Novo produto</a>
        </div>
        <form action="{{ route('admin.estoque') }}" method="GET">
            <div class="col s4 m4 input-field">
                <input type="text" name="search" placeholder="Buscar produto"> 
            </div>
            <div class="col s4 m2 input-field">
                <select name="id_categoria"><option value="">Todas</option>
                    
                    @foreach ($categorias as $categoria)
                        {{ $categoria_nome[$categoria->id] = $categoria->nome }}
                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                    @endforeach
                    
                </select>
                <label>Categoria</label>
            </div>
            <div class="col s4 m3 input-field">
                <button class="btn waves-effect waves-light black" type="submit">Buscar</button> 
            </div>
        </form>
    </div>

    @if ( $count_produtos > 0 )
        <div class="container center">
            @if (!empty($search_term) AND !empty($search_id_categoria))
                <h5>{{ $count_produtos }} itens para "{{ $search_term }}" em {{ $categoria_nome[$search_id_categoria] }}</h5>
            @elseif (!empty($search_term))
                <h5>{{ $count_produtos }} itens encontrados para "{{ $search_term }}"</h5>
            @elseif (!empty($search_id_categoria))
                <h5>{{ $count_produtos }} itens em {{ $categoria_nome[$search_id_categoria] }}</h5>
            @endif
        </div>
    @endif

    <div class="row">
        @if (request()->input('search') OR request()->input('id_categoria'))
            {{ $produtos->appends(['search' => request()->input('search'), 'id_categoria' => request()->input('id_categoria')])->links('common/pagination') }}
        @else
            {{ $produtos->links('common/pagination') }}
        @endif
    </div>

    <div id="confirm-delete-modal" class="modal">
        <div class="modal-content">
            <h4>Confirmar exclusão</h4>
            <p>Tem certeza que deseja excluir este produto?
                <span class="red-text">Isto excluirá <b>todas</b> as unidades do estoque</span>. Se quiser apenas excluir algumas delas, 
                você deve clicar em <span class="btn-small blue"><i class="material-icons center">edit</i></span> e fazer as alterações pelo formulário.
                Você também pode adicionar ou remover unidades de estoque de forma incremental clicando em 
                <span class="btn-small green"><i class="material-icons center">add</i></span> e 
                    <span class="btn-small green"><i class="material-icons center">remove</i></span>.</p>
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
                    <th class="center-align">Ações</th>
                    <th>Qtde</th>
                    <th>Produto</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th class="center-align">Categoria</th>
                    <th class="center-align">Imagem</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($produtos as $produto)
                <tr>
                    <td class="center-align">
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
                    <td>R$&nbsp;{{ number_format($produto->preco, 2, ',', '.') }}</td>
                    <td class="center-align">{{ $produto->categoria->nome }}</td>
                    <td class="center-align"><img src="{{ empty($produto->imagem) ? asset('storage/static/images/no_photo.gif') :  asset('storage/' . $produto->imagem) }}" class="responsive-img image-cell"></td>
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
        @if (request()->input('search') OR request()->input('id_categoria'))
            {{ $produtos->appends(['search' => request()->input('search'), 'id_categoria' => request()->input('id_categoria')])->links('common/pagination') }}
        @else
            {{ $produtos->links('common/pagination') }}
        @endif
    </div>
    
    
@endsection
