@extends('layout')

@section('content')

    <div class="row">
        <div class="col s12">
            <h4><p>Sobre a {{ $siteconfig_brand }}</p></h4>
            <p>{{ $siteconfig_sobre_empresa }}</p>
        </div>
        <div class="col s12 image-padding black z-depth-5">
            <img src="{{ asset('storage/' . $siteconfig_brand_logo) }}" class="responsive-img">
        </div>

        <div class="col s12">
            <h4>Nossos produtos</h4>
            <p>{{ $siteconfig_sobre_produtos }}</p>
        </div>
        <div class="col s12">
            <div class="carousel">
                @foreach ($last_items as $item)
                    <div class="carousel-item">
                        <div class="col s12">
                            <a href="{{ route('site.ver.produto', ['slug' => $item->slug]) }}">
                                <img class="responsive-img z-depth-2" src="{{ empty($item->imagem) ? asset('storage/static/images/no_photo.gif') :  asset('storage/' . $item->imagem) }}">
                            </a>
                        </div>
                        <div class="col s12 center">
                            <span class="photo-legend">{{ $item->nome }}</span>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        <div class="col s12">
            <h4>Categorias</h4>
        </div>
        <div class="col s12">
            <div class="carousel carousel-slider center">

                @foreach ($categorias as $categoria)
                    <div class="carousel-item">
                        <div class="col s12">
                            <a href="{{ route('site.ver.categoria', ['id' => $categoria->id]) }}">
                                <img class="responsive-img" src="{{ empty($categoria->imagem) ? asset('storage/static/images/no_photo.gif') :  asset('storage/' . $categoria->imagem) }}">
                            </a>
                        </div>
                        <div class="col s12 center">
                            <p><span class="background-category-title">{{ $categoria->nome }}</span></p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </div>
    
@endsection
