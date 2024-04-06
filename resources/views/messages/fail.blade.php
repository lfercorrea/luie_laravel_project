@if ( $msg = Session::get('fail') || $errors->any() )
    
    <div class="popup card red darken-1">
        <div class="card-content white-text">
            <span class="card-title">Ops!</span>

            @if (Session::has('fail'))
                <p>{{ Session::get('fail') }}</p>
            @endif
            
            @if ($errors->any())
                <p>Houveram erros. Detalhes:</p>
                
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            @endif

        </div>

        <div class="container center">
            <p><a href="{{ url()->current() }}" class="btn waves-effect waves-teal blue">Voltar</a></p>
        </div>
    </div>

@endif

