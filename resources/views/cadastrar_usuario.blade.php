@extends('layout')

@section('content')

<br>
<div class="row">
    <h4>Cadastro</h4>
    <div class="col s12">

        @if ($msg = Session::get('fail') || $errors->any())
            @include('messages.fail')
        @endif

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="nome" type="text" name="name" class="validate">
                    <label for="nome">Nome completo</label>
                </div>
                <div class="input-field col s12 m6">
                    <input id="endereco" type="text" name="endereco" class="validate">
                    <label for="endereco">Endereço</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m1">
                    <input id="numero" type="text" name="numero" class="validate">
                    <label for="numero">Número</label>
                </div>
                <div class="input-field col s12 m4">
                    <input id="cidade" type="text" name="cidade" class="validate">
                    <label for="cidade">Cidade</label>
                </div>
                <div class="input-field col s12 m1">
                    <input id="uf" type="text" name="uf" class="validate">
                    <label for="uf">Estado</label>
                </div>
                <div class="input-field col s12 m4">
                    <input id="bairro" type="text" name="bairro" class="validate">
                    <label for="bairro">Bairro</label>
                </div>
                <div class="input-field col s12 m2">
                    <input id="cep" type="text" name="cep" placeholder="19123-000" class="validate">
                    <label for="cep">CEP</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m2">
                    <input id="celular" type="tel" name="celular" class="validate">
                    <label for="celular">Celular</label>
                </div>
                <div class="input-field col s12 m3">
                    <input id="email" name="email" class="validate">
                    <label for="email">E-mail</label>
                </div>
                <div class="input-field col s12 m3">
                    <input id="confirmar_email" name="email_confirmation" class="validate">
                    <label for="confirmar_email">Confirme o e-mail</label>
                </div>
                <div class="input-field col s12 m2">
                    <input id="senha" type="password" name="password" class="validate">
                    <label for="senha">Senha</label>
                </div>
                <div class="input-field col s12 m2">
                    <input id="confirmar_senha" type="password" name="password_confirmation" class="validate">
                    <label for="confirmar_senha">Confirme a senha</label>
                </div>
            </div>
            <div class="container center">
                <div class="col s12 center">      
                    <button type="submit" class="btn waves-effect black">Finalizar cadastro</button>
                </div>
            </div>
        </form>

    </div>
</div>

  
@endsection