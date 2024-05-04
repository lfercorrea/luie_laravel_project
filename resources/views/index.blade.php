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
            Estilo 1
            <div class="carousel">

                @foreach ($last_items as $item)
                    <div class="carousel-item">
                        <a href="{{ route('site.ver.produto', ['slug' => $item->slug]) }}">
                            <img class="responsive-img z-depth-2" src="{{ empty($item->imagem) ? asset('storage/static/images/no_photo.gif') :  asset('storage/' . $item->imagem) }}">
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="col s12">
            Estilo 2
            <div class="carousel carousel-slider">

                @foreach ($last_items as $item)
                    <a class="carousel-item" href="{{ route('site.ver.produto', ['slug' => $item->slug]) }}">
                        <img class="responsive-img" src="{{ empty($item->imagem) ? asset('storage/static/images/no_photo.gif') :  asset('storage/' . $item->imagem) }}">
                    </a>
                @endforeach

            </div>
        </div>

        <div class="col s12">
            <h4>Categorias</h4>
        </div>
        <div class="col s12">
            <div class="carousel carousel-slider center">

                @foreach ($categorias as $categoria)
                    <div class="card">
                        <div class="card-image">
                            <a class="carousel-item" href="{{ route('site.ver.categoria', ['id' => $categoria->id]) }}">
                                <img class="responsive-img" src="{{ empty($categoria->imagem) ? asset('storage/static/images/no_photo.gif') :  asset('storage/' . $categoria->imagem) }}">
                                <p><span class="card-title">{{ $categoria->nome }}</span></p>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </div>
    
@endsection
