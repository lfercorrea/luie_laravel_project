{{-- 
    Este arquivo é compartilhado entre as views ver_categoria e produtos.
    
    Notar que nestas views existe a diretiva @include('card_produto')

    @nando
--}}

<!-- Modal Structure -->
<div id="zoom_img_{{ $produto->slug }}" class="modal modal-fixed-footer">
    <div class="modal-content center">
        <img src="{{ empty($produto->imagem) ? asset('storage/static/images/no_photo.gif') :  asset('storage/' . $produto->imagem) }}" class="responsive-img">
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
                <img src="{{ empty($produto->imagem) ? asset('storage/static/images/no_photo.gif') :  asset('storage/' . $produto->imagem) }}">
                <span class="card-title">{{ $produto->quantidade == 0 ? 'Indisponível' : 'R$ ' . number_format($produto->preco, 2, ',', '.') }}</span>
            </a>
            <a href="#zoom_img_{{ $produto->slug }}" class="btn-floating halfway-fab waves-effect waves-light pink lighten-2 modal-trigger"><i class="material-icons black-text">zoom_in</i></a>
        </div>
        <div class="card-content">
            {{ Str::limit($produto->nome, 60) }}
        </div>
    </div>
</div>