@extends('admin.layout')

@section('content')

<div class="container center" style="margin-top: 50px; margin-bottom: 50px;">
    
        <h4>Configurações do site</h4>
    <hr>
</div>

<div class="col s12">
    <form id="form-categoria" class="col s12" action="{{ route('admin.siteconfig_store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="input-field col s6">
                <input id="brand" type="text" class="validate" name="brand" value="{{ $siteconfig_brand }}">
                <label for="brand">Nome da empresa</label>
            </div>
            <div class="input-field col s6">
                <input id="email" type="text" class="validate" name="email" value="{{ $siteconfig_email }}">
                <label for="email">E-mail da empresa</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input id="telefone" type="text" class="validate" name="telefone" value="{{ $siteconfig_telefone }}">
                <label for="telefone">Telefone fixo da empresa</label>
            </div>
            <div class="input-field col s6">
                <input id="celular" type="text" class="validate" name="celular" value="{{ $siteconfig_celular }}">
                <label for="celular">Celular da empresa</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <textarea id="endereco" class="materialize-textarea" name="endereco">{{ $siteconfig_endereco }}</textarea>
                <label for="endereco">Endereço da empresa</label>
            </div>
        </div>
        
        <h5><p>Logotipo:</p></h5> 
        <div class="row center">
            <div class="col s12">
                <img src="{{ asset('storage/' . $siteconfig_brand_logo) }}" class="responsive-img">
            </div>
        </div>
        
        <div class="row">
            <div class="file-field input-field">
                <div class="waves-effect btn red black">
                    <span>Substituir logotipo</span>
                    <input id="brand_logo" type="file" name="brand_logo">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                    <label for="brand_logo">A imagem deve ser do tipo JPG</label>
                </div>
            </div>
        </div>
    </form>

    <div class="container center">
        <a class="waves-effect waves-black btn-flat" href="{{ route('admin.index') }}">Voltar ao ACP</a>
        <button class="btn waves-effect waves-light white-text black" type="submit" form="form-categoria">Salvar configurações</button>
    </div>

</div>

@endsection