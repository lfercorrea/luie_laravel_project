{{-- 
    Este arquivo é compartilhado entre as views ver_categoria e produtos.
    
    Notar que nestas views existe a diretiva @include('card_produto')

    @nando
--}}

<!-- Modal Structure -->
<div id="zoom_img_{{ $produto->slug }}" class="modal">
    <div class="modal-content center">
        <img src="{{ $produto->imagem }}" class="responsive-img">
        {{-- <h4>{{ $produto->nome }}</h4>
        <p>{{ $produto->descricao }}</p> --}}
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-black btn-flat">Fechar</a>
    </div>
</div>

<div class="col s12 m3">
    <div class="card">
        <div class="card-image">
            <a href="{{ route('site.ver.produto', ['slug' => $produto->slug]) }}" class="waves-effect waves-light red">
                <img src="{{ $produto->imagem }}">
                <span class="card-title">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span>
            </a>
            <a href="#zoom_img_{{ $produto->slug }}" class="btn-floating halfway-fab waves-effect waves-light red modal-trigger"><i class="material-icons">zoom_in</i></a>
        </div>
        <div class="card-content">
            {{ Str::limit($produto->nome, 60) }}
        </div>
    </div>
</div>