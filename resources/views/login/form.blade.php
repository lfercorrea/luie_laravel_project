@extends('layout')

@section('content')

    <br>
    <div class="container center">
        <div class="row">
            <h4>Entrar</h4>
            <div class="col s12">

                <form action="{{ route('login.auth') }}" method="POST">
                @csrf
                    <div class="container">
                        <div class="row">
                            <input id="email" type="email" name="email" class="validate" required><br>
                            <label for="email">E-mail</label>

                            <input id="password" type="password" name="password" class="validate" required><br>
                            <label for="password">Senha</label>
                        </div>
                        <div class="row">      
                            <button type="submit" class="btn waves-effect black">Entrar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection