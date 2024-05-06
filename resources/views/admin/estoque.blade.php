@extends('admin.layout')

@section('content')
    <div class='center'>
        <h4>Estoque</h4>
        <hr>
    </div>

    <div class="row">
        <div class="col s12 m3 input-field">
            <a href="{{ route('admin.cadastrar_produto') }}" class="btn green waves-effect waves-light">Novo produto</a>
            <a href="{{ route('admin.estoque.imprimir') }}" class="btn black waves-effect waves-light"><i class="material-icons">print</i></a>
        </div>
        <form action="{{ route('admin.estoque') }}" method="GET">
            <div class="col s12 m3 input-field">
                <input type="text" name="search" placeholder="Buscar produto"> 
            </div>
            <div class="input-field col s4 m2">
                <select name="id_tamanho[]" id="id_tamanho" multiple="" tabindex="-1" style="display: none;">
                    <option value="" selected disabled>Tamanhos</option>
                    <optgroup label="Tamanhos">
                        
                        @foreach ($tamanhos as $tamanho)
                            @php
                                $tamanho_nome[$tamanho->id] = $tamanho->nome
                            @endphp
                            <option value="{{ $tamanho->id }}">{{ $tamanho->nome }}</option>
                        @endforeach
                        
                    </optgroup>
                </select>
                <label for="id_tamanho">Tamanhos</label>
            </div>
            <div class="col s8 m2 input-field">
                <select class="browser-default" name="id_categoria"><option value="">Todas as categorias</option>
                    
                    @foreach ($categorias as $categoria)
                        @php
                            $categoria_nome[$categoria->id] = $categoria->nome
                        @endphp 
                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                    @endforeach
                    
                </select>
            </div>
            <div class="col s12 m2 input-field">
                <button class="btn waves-effect waves-light black" type="submit">Buscar</button> 
            </div>
        </form>
    </div>

    @if ($count_produtos > 0)
        <div class="container center">
            @php
                $count_message = [];

                if (!empty($search_term)) {
                    $count_message[] = "termo <b><i>\"$search_term\"</i></b>";
                }

                if (!empty($search_id_categoria)) {
                    $count_message[] = "categoria <b><i>\"{$categoria_nome[$search_id_categoria]}\"</i></b>";
                }

                if (!empty($search_id_tamanho)) {
                    $arr_tamanhos_selecionados = [];
                    
                    foreach ( $search_id_tamanho as $selected_id) {
                        $arr_tamanhos_selecionados[] = $tamanho_nome[$selected_id];
                    }

                    $tamanhos_selecionados = implode(', ', $arr_tamanhos_selecionados);
                    $count_message[] = "tamanhos selecionados <b><i>\"{$tamanhos_selecionados}\"</i></b>";
                }

                $plural = (count($count_message) > 0) ? ': ' : '';

                echo "<h5>$count_produtos itens encontrados$plural " . implode(", ", $count_message) . "</h5>";
            @endphp
        </div>
    @endif


    <div class="row">
        @if (request()->input('search') OR request()->input('id_categoria') OR request()->input('id_tamanho'))
            {{ $produtos->appends([
                'search' => request()->input('search'), 
                'id_categoria' => request()->input('id_categoria'),
                'id_tamanho' =>request()->input('id_tamanho'),
                ])
                ->links('common/pagination') }}
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
                    <th>Tamanhos</th>
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
                    <td>
                        @php
                            $arr_tamanhos = [];
                        @endphp

                        @foreach ($produto->tamanho as $tamanho)
                            @php
                                $arr_tamanhos[] = $tamanho->nome;
                            @endphp
                            {{-- @if (!$loop->last)
                                ,
                                @endif --}}
                        @endforeach

                        @php
                            $tamanhos_disp = implode(', ', $arr_tamanhos);
                            $arr_tamanhos = [];
                        @endphp
                        {{ $tamanhos_disp }}
                    </td>
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
        @if (request()->input('search') OR request()->input('id_categoria') OR request()->input('id_tamanho'))
            {{ $produtos->appends([
                'search' => request()->input('search'), 
                'id_categoria' => request()->input('id_categoria'),
                'id_tamanho' => request()->input('id_tamanho'),
                ])
                ->links('common/pagination') }}
        @else
            {{ $produtos->links('common/pagination') }}
        @endif
    </div>
    
    
@endsection
