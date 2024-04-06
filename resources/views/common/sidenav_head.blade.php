@if ( $user = auth()->user() )
    <li>
        <div class="user-view">
        <div class="background">
            <img src="{{ asset('storage/images/brand_logo.jpg') }}">
        </div>
        <img class="circle" src="{{ asset('storage/images/img_avatar.png') }}">
        <a href="#name" class="waves-effect"><span class="white-text name">{{ auth()->user()->name }}</span></a>
        <a href="#email" class="waves-effect"><span class="white-text email">{{ auth()->user()->email }}</span></a>
        <div class="container center">
            <a href="{{ route('logout.auth') }}" class="btn-small pink lighten-1 waves-effect"><span class="white-text">Sair</span></a>
        </div>
        </div>
    </li>
    <li><a href="{{ route('admin.index') }}"><i class="material-icons left">build</i>Administração</a></li>
    @else
    <li>
        <div class="user-view">
        <div class="background">
            <img src="{{ asset('storage/images/brand_logo.jpg') }}">
        </div>
        <span class="white-text center"><h4>Bem-vindo</h4></span>
        <div class="container center">
            <a href="{{ route('login') }}" class="btn-small pink lighten-1 waves-effect"><span class="white-text">Entrar</span></a>
        </div>
        </div>
    </li>
    
@endif