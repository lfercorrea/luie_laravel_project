@extends('layout')

@section('content')

    <br>
    <div class="container center">
        <div class="row">
            <h4>Entrar</h4>
            <div class="col s12">

                @if ($msg = Session::get('fail') || $errors->any())

                    @include('messages.fail')
                    
                @endif

                <form action="{{ route('login.auth') }}" method="POST">
                @csrf
                    <div class="container">
                        <div class="row">
                            <input id="email" type="email" name="email" value="" class="validate" required><br>
                            <label for="email">Email</label>

                            <input type="password" name="password" value="" class="validate" required><br>
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