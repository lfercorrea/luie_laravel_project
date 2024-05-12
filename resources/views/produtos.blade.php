@extends('layout')

@section('content')

    <h5>Todos os produtos</h5>
    
    <div class="row">
        <form action="{{ route('site.produtos') }}" method="GET">
            <div class="col s12 m6 input-field">
                <input type="text" name="search" placeholder="Procurar por nome ou descrição"> 
            </div>
            <div class="col s8 m3 input-field">
                <select name="id_tamanho[]" id="id_tamanho" multiple="" tabindex="-1" style="display: none;">
                    <option value="" selected disabled>Tamanhos</option>
                        
                        @foreach ($tamanhos as $tamanho)
                            @php
                                $tamanho_nome[$tamanho->id] = $tamanho->nome
                            @endphp
                            <option value="{{ $tamanho->id }}">{{ $tamanho->nome }}</option>
                        @endforeach
                        
                    </optgroup>
                </select>
            </div>
            <div class="col s4 m3 input-field">
                <button class="btn waves-effect waves-light black" type="submit">Buscar</button> 
            </div>
        </form>
    </div>

    @if ( $count_produtos > 0 )
        <div class="container center">
            <h5><p>{{ $count_produtos }} produtos encontrados</p></h5>
        </div>
    @endif

    @if (count($produtos) > 0)
        <div class="row">
            @foreach ($produtos as $produto)
            
                @include('common.card_produto')

            @endforeach
        </div>
    @else
        <br>
        <div class="container center">
            <h5>Nenhum produto encontrado.</h5>
            <br>
            <a href="{{ route('site.produtos') }}" class="btn waves-effect waves-light black">Voltar</a>
        </div>
    @endif

    <div class="row">
        @if (request()->input('search') OR request()->input('id_tamanho'))
            {{ $produtos->appends([
                'search' => request()->input('search'),
                'id_tamanho' => request()->input('id_tamanho'),
                ])
                ->links('common/pagination') }}
        @else
            {{ $produtos->links('common/pagination') }}
        @endif
    </div>

@endsection
