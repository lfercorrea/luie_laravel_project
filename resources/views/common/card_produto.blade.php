{{-- 
    Este arquivo é compartilhado entre as views ver_categoria e produtos.
    
    Notar que nestas views existe a diretiva @include('common.card_produto')

    @nando
--}}

<div id="zoom_img_{{ $produto->slug }}" class="modal modal-fixed-footer modal-fixed-width modal-fixed-height">
    <div class="modal-content center">
        <img src="{{ empty($produto->imagem) ? asset('storage/static/images/no_photo.gif') :  asset('storage/' . $produto->imagem) }}" class="img-max-width">
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-black btn-flat">Fechar</a>
    </div>
</div>

<div class="col s6 m3">
    <div class="card">
        <div class="card-image">
            <a href="{{ route('site.ver.produto', ['slug' => $produto->slug]) }}" class="waves-effect waves-light red">
                <img src="{{ empty($produto->imagem) ? asset('storage/static/images/no_photo.gif') :  asset('storage/' . $produto->imagem) }}">
                <span class="card-title">{{ $produto->quantidade > 0 ? 'R$ ' . number_format($produto->preco, 2, ',', '.') : 'Indisponível' }}</span>
            </a>
            <a href="#zoom_img_{{ $produto->slug }}" class="btn-floating halfway-fab waves-effect waves-light pink lighten-2 modal-trigger"><i class="material-icons black-text">zoom_in</i></a>
        </div>
        <div class="card-content">
            {{ Str::limit($produto->nome, 60) }}
        </div>
    </div>
</div>