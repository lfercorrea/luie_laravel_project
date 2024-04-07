@extends(auth()->check() ? 'admin.layout' : 'layout')

@section('content')

    <div class="container center" style="margin-top: 50px; margin-bottom: 50px;">
        @if($modo === 'cadastrar')
            <h4>Cadastro</h4>
        @elseif($modo === 'alterar')
            <h4>Alterar usuário</h4>
        @endif
        <hr>
    </div>

    <div class="col s12">

        @if ($msg = Session::get('fail') || $errors->any())
            @include('messages.fail')
        @endif

        <form action="{{ $modo === 'cadastrar' ? route('users.store') : route('admin.alterar_usuario', ['id' => $usuario->id] ) }}" method="POST">
            @csrf
            @if($modo === 'alterar')
                @method('PUT')
            @endif
            <input type="hidden" name="modo" value="{{ $modo }}">

            @if($modo === 'alterar')
                <div class="row">
                    <div class="s12">
                        <span class="grey-text"><i>Usuário cadastrado em <b>{{ $usuario->created_at }}</b></i></span>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="nome" type="text" name="name" class="validate" value="{{ old('name', $usuario->name) }}">
                    <label for="nome">Nome completo</label>
                </div>
                <div class="input-field col s12 m6">
                    <input id="endereco" type="text" name="endereco" class="validate" value="{{ old('endereco', $usuario->endereco) }}">
                    <label for="endereco">Endereço</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m1">
                    <input id="numero" type="text" name="numero" class="validate" value="{{ old('numero', $usuario->numero) }}">
                    <label for="numero">Número</label>
                </div>
                <div class="input-field col s12 m4">
                    <input id="cidade" type="text" name="cidade" class="validate" value="{{ old('cidade', $usuario->cidade) }}">
                    <label for="cidade">Cidade</label>
                </div>
                <div class="input-field col s12 m1">
                    <input id="uf" type="text" name="uf" class="validate" value="{{ old('uf', $usuario->uf) }}">
                    <label for="uf">Estado</label>
                </div>
                <div class="input-field col s12 m4">
                    <input id="bairro" type="text" name="bairro" class="validate" value="{{ old('bairro', $usuario->bairro) }}">
                    <label for="bairro">Bairro</label>
                </div>
                <div class="input-field col s12 m2">
                    <input id="cep" type="text" name="cep" placeholder="19123-000" class="validate"  value="{{ old('cep', $usuario->cep) }}">
                    <label for="cep">CEP</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m2">
                    <input id="celular" type="tel" name="celular" class="validate" value="{{ old('celular', $usuario->celular) }}">
                    <label for="celular">Celular</label>
                </div>
                <div class="input-field col s12 m3">
                    <input id="email" type="email" name="email" class="validate" value="{{ old('email', $usuario->email) }}">
                    <label for="email">E-mail</label>
                </div>
                <div class="input-field col s12 m3">
                    <input id="confirmar_email" type="email" name="email_confirmation" class="validate" value="{{ old('email', $usuario->email) }}">
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
                    <button type="submit" class="btn waves-effect black">{{ $modo }}</button>
                </div>
            </div>
        </form>

    </div>
    
@endsection