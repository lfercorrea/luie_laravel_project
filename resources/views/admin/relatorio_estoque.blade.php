@extends('admin.layout')

@section('content')
    <div class='center'>
        <h4>Extrato de estoque</h4>
        <hr>
    </div>

    <form action="{{ route('admin.estoque.imprimir') }}" method="GET">
        <div class="row">
            <div class="col s12 m3 input-field">
                <input type="text" name="search" placeholder="Buscar produto"> 
            </div>
            <div class="col s4 m2 input-field">
                <select class="browser-default" name="id_tamanho"><option value="">Tamanho</option>
                    
                    @foreach ($tamanhos as $tamanho)
                        {{ $tamanho_nome[$tamanho->id] = $tamanho->nome }}
                        <option value="{{ $tamanho->id }}">{{ $tamanho->nome }}</option>
                    @endforeach
                    
                </select>
            </div>
            <div class="col s8 m2 input-field">
                <select class="browser-default" name="id_categoria"><option value="">Todas as categorias</option>
                    
                    @foreach ($categorias as $categoria)
                        {{ $categoria_nome[$categoria->id] = $categoria->nome }}
                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                    @endforeach
                    
                </select>
            </div>
            <div class="col s12 m2 input-field">
                <button class="btn waves-effect waves-light black" type="submit">Filtrar relatório</button> 
            </div>
        </div>
    </form>

    @if ($count_produtos > 0)
        <div class="row">
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
                        $count_message[] = "tamanho <b><i>\"{$tamanho_nome[$search_id_tamanho]}\"</i></b>";
                    }

                    $plural = (count($count_message) > 0) ? ': ' : '';

                    echo "<b>$count_produtos</b> itens filtrados$plural " . implode(", ", $count_message) . "";
                @endphp
            </div>
        </div>
    @endif
    
    @if (count($produtos) > 0)
        <table class="striped responsive-table">
            <thead>
                <tr>
                    <th>Qtde</th>
                    <th>Produto</th>
                    <th>Descrição</th>
                    <th>Tamanho</th>
                    <th>Preço</th>
                    <th class="center-align">Categoria</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($produtos as $produto)
                <tr>
                    <td>{{ $produto->quantidade }}</td>
                    <td><b>{{ $produto->nome }}</b></td>
                    <td>{{ $produto->descricao }}</td>
                    <td class="center-align">{{ $produto->tamanho->nome }}</td>
                    <td>R$&nbsp;{{ number_format($produto->preco, 2, ',', '.') }}</td>
                    <td class="center-align">{{ $produto->categoria->nome }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @php
            $total_quantidade = 0;
            $total_valor = 0;

            foreach($produtos as $produto){
                $total_quantidade += $produto->quantidade;
                $total_valor += $produto->preco * $produto->quantidade;
            }
        @endphp
        <div class='center'>
            <h5>Totais</h5>
            <hr>
        </div>
        <div class="container center">
            <table class="striped responsive-table">
                <thead>
                    <tr>
                        <th class="center-align">Unidades totais</th>
                        <th class="center-align">Valor total dos produtos</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="center-align">{{ $total_quantidade }}</td>
                        <td class="center-align">R$&nbsp;{{ number_format($total_valor, 2, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    @else
        <div class="container center">
            <h5>Nenhum produto encontrado.</h5>
            <br>
            <a href="{{ route('admin.estoque') }}" class="btn waves-effect waves-light black">Voltar</a>
        </div>
    @endif
    
    
@endsection
