@extends('layout')

@section('content')

    <div class="row">
        <div class="col s12">
            <h4><p>Sobre a {{ $siteconfig_brand }}</p></h4>
            <p>{{ $siteconfig_sobre_empresa }}</p>
        </div>
        <div class="image-padding black z-depth-5">
            <img src="{{ asset('storage/' . $siteconfig_brand_logo) }}" class="responsive-img">
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col s12">
            <h4>Nossos produtos</h4>
            <p>{{ $siteconfig_sobre_produtos }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <div class="carousel carousel-slider center" style="height: 800px;">

                @foreach ($last_items as $item)
                    <div class="card">
                        <div class="card-image">
                            <a class="carousel-item" href="{{ route('site.ver.produto', ['slug' => $item->slug]) }}">
                                <img class="responsive-img" src="{{ empty($item->imagem) ? asset('storage/static/images/no_photo.gif') :  asset('storage/' . $item->imagem) }}">
                                <p><span class="card-title">{{ $item->descricao }}</span></p>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col s6">
            <div class="waves-effect waves-block waves-light">
                <img class="responsive-img image-border black" src="{{ asset('storage/static/images/index_1.jpg') }}">
            </div>
        </div>
        <div class="col s6">
            <div class="waves-effect waves-block waves-light">
                <img class="responsive-img image-border black" src="{{ asset('storage/static/images/index_2.jpg') }}">
            </div>
        </div>
    </div>
    <div class="container center">
        <p><a href="produtos" class="btn waves-effect waves-light black">Link qualquer</a></p>
    </div> --}}
    
@endsection
