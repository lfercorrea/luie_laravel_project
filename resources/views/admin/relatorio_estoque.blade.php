@extends('admin.layout')

@section('content')
    <div class='center'>
        <h5>Extrato</h5>
        <hr>
    </div>

    <div class="print-hidden">
        <form action="{{ route('admin.estoque.imprimir') }}" method="GET">
            <div class="row">
                <div class="col s12 m3 input-field">
                    <input type="text" name="search" placeholder="Buscar produto"> 
                </div>
                <div class="input-field col s4 m2">
                    <select name="id_tamanho[]" id="id_tamanho" multiple="" tabindex="-1" style="display: none;">
                        <option value="" selected disabled>Tamanhos</option>
                        {{-- <optgroup label="Tamanhos"> --}}
                            
                            @foreach ($tamanhos as $tamanho)
                                @php
                                    $tamanho_nome[$tamanho->id] = $tamanho->nome
                                @endphp
                                <option value="{{ $tamanho->id }}">{{ $tamanho->nome }}</option>
                            @endforeach
                            
                        </optgroup>
                    </select>
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
                    <button class="btn waves-effect waves-light black" type="submit">Filtrar relatório</button> 
                </div>
            </div>
        </form>
    </div>

    @if ($count_produtos > 0)
        <div class="row">
            <div class="col s12">
                @php
                    $count_message = [];

                    if (!empty($search_term)) {
                        $count_message[] = "Termo de busca <b><i>\"$search_term\"</i></b>";
                    }

                    if (!empty($search_id_categoria)) {
                        $count_message[] = "Categoria <b><i>\"{$categoria_nome[$search_id_categoria]}\"</i></b>";
                    }

                    if (!empty($search_id_tamanho)) {
                        $arr_tamanhos_selecionados = [];
                        
                        foreach ( $search_id_tamanho as $selected_id) {
                            $arr_tamanhos_selecionados[] = $tamanho_nome[$selected_id];
                        }

                        $tamanhos_selecionados = implode(', ', $arr_tamanhos_selecionados);
                        $count_message[] = "Tamanhos selecionados <b><i>\"{$tamanhos_selecionados}\"</i></b>";
                    }

                    $plural = (count($count_message) > 0) ? ': ' : '';

                    echo implode("<br>", $count_message);
                @endphp
            </div>
        </div>
    @endif
    
    @if (count($produtos) > 0)
        <div class="row">
            <div class="col s12">
                <table class="striped responsive-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Produto</th>
                            <th>Descrição</th>
                            <th>Tamanhos</th>
                            <th>Qtde</th>
                            <th>Preço</th>
                            <th class="center-align">Categoria</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $n = 0;
                        @endphp
                        @foreach ($produtos as $produto)
                        @php
                            $n++;
                        @endphp
                        <tr>
                            <td><i>{{ $n }}</i></td>
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
                                @endforeach
        
                                @php
                                    $tamanhos_disp = implode(', ', $arr_tamanhos);
                                    $arr_tamanhos = [];
                                @endphp
                                {{ $tamanhos_disp }}
                            </td>
                            <td class="center-align">{{ $produto->quantidade }}</td>
                            <td>R$&nbsp;{{ number_format($produto->preco, 2, ',', '.') }}</td>
                            <td class="center-align">{{ $produto->categoria->nome }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @php
            $total_quantidade = 0;
            $total_valor = 0;

            foreach($produtos as $produto){
                $total_quantidade += $produto->quantidade;
                $total_valor += $produto->preco * $produto->quantidade;
            }
        @endphp

        <div class="row">
            <div class="col s12 center">
                <h5>Totais</h5>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <table class="striped responsive-table">
                    <thead>
                        <tr>
                            <th class="center-align">Produtos</th>
                            <th class="center-align">Unidades</th>
                            <th class="center-align">Valor total dos produtos</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="center-align">{{ $n }}</td>
                            <td class="center-align">{{ $total_quantidade }}</td>
                            <td class="center-align">R$&nbsp;{{ number_format($total_valor, 2, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col s12 center">
                <button class="btn black waves-effect waves-light print-hidden" onclick="printPage()">Imprimir relatório</button>
            </div>
        </div>
    @else
        <div class="container center">
            <h5>Nenhum produto encontrado.</h5>
            <br>
            <a href="{{ route('admin.estoque') }}" class="btn waves-effect waves-light black">Voltar</a>
        </div>
    @endif
    
    
@endsection
