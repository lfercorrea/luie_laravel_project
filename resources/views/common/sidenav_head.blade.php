@if ( $user = auth()->user() )
    <li>
        <div class="user-view">
        <div class="background">
            <img src="{{ asset('storage/static/images/brand_logo.jpg') }}">
        </div>
        <img class="circle" src="{{ isset(auth()->user()->foto) ? asset('storage/'. auth()->user()->foto) : asset('storage/static/images/img_avatar.png') }}">
        <a href="#name" class="waves-effect"><span class="white-text name">{{ auth()->user()->name }}</span></a>
        <a href="#email" class="waves-effect"><span class="white-text email">{{ auth()->user()->email }}</span></a>
        <div class="container center">
            <a href="{{ route('logout.auth') }}" class="btn-small pink lighten-1 waves-effect"><span class="white-text">Sair</span></a>
        </div>
        </div>
    </li>
    @if ( auth()->user()->level <= 2 )
        <li><a href="{{ route('admin.index') }}" class="red-text text-darken-4"><i class="material-icons left red-text text-darken-4">build</i>Administração</a></li>
    @endif
@else
    <li>
        <div class="user-view">
        <div class="background">
            <img src="{{ asset('storage/static/images/brand_logo.jpg') }}">
        </div>
        <span class="white-text center"><h4>Bem-vindo</h4></span>
        <div class="container center">
            <a href="{{ route('login') }}" class="btn-small pink lighten-1 waves-effect"><span class="white-text">Entrar</span></a>
        </div>
        </div>
    </li>
    
@endif