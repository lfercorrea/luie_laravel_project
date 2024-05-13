@extends('layout')

@section('content')

    <br>
    <div class="container center">
        <div class="row">
            <h5>Alteração de senha</h5>
            <div class="col s12">

                <form action="{{ route('users.alterar_senha.store', ['id' => $usuario->id]) }}" method="POST">
                @csrf
                    <div class="container">
                        <div class="row">
                            <input id="senha" type="password" name="password" pattern="(?=.*[a-zA-Z])(?=.*[\W_]).{8,}" title="A senha precisa ter no mínimo 8 caracteres, incluindo um símbolo ou espaço." class="validate" required>
                            <label for="senha">Nova senha</label>

                            <input id="confirmar_senha" type="password" name="password_confirmation" pattern="(?=.*[a-zA-Z])(?=.*[\W_]).{8,}" title="A senha precisa ter no mínimo 8 caracteres, incluindo um símbolo ou espaço." class="validate" required>
                            <label for="confirmar_senha">Confirme a nova senha</label>
                        </div>
                        <div class="row">      
                            <button type="submit" class="btn waves-effect black">Alterar senha</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection