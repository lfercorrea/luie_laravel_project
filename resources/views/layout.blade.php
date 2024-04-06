<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Título Padrão' }}</title>
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <header>
    <nav>
        <div class="nav-wrapper black">
            {{-- <a href="#" data-target="mobile-btn" class="sidenav-trigger"><i class="material-icons">menu</i></a> --}}
            <a href="{{ route('site.index') }}" class="brand-logo"><img src="{{ asset('storage/images/brand_logo.jpg') }}" class="responsive-img" style="width: 100px;"></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
              <li><a href="{{ route('admin.index') }}"><i class="material-icons left">build</i>Administração</a></li>
              <!-- Dropdown Trigger -->
              <li><a class='dropdown-trigger' data-target='categorias'><i class="material-icons left">expand_more</i>Categorias</a></li>
              <!-- Dropdown Structure -->
              <ul id='categorias' class='dropdown-content'>
                @foreach ($categorias as $categoria)
                  <li><a href="{{ route('site.ver.categoria', $categoria->id) }}">{{ $categoria->nome }}</a></li>
                @endforeach
              </ul>
              <li><a href="{{ route('site.produtos') }}">Produtos</a></li>
              <li><a href="{{ route('login') }}">Entrar</a></li>
              <li><a href="collapsible.html">Menu</a></li>
            </ul>
            {{-- botão menu para mobile --}}
            <ul id="slide-out" class="sidenav">
              <li>
                <div class="user-view">
                  <div class="background">
                    <img src="{{ asset('storage/images/brand_logo.jpg') }}">
                  </div>
                  <a href="#user" class="waves-effect"><img class="circle" src="{{ asset('storage/images/img_avatar.png') }}"></a>
                  <a href="#name" class="waves-effect"><span class="white-text name">Projeto Integrador</span></a>
                  <a href="#email" class="waves-effect"><span class="white-text email">alunos@univesp.br</span></a>
                </div>
              </li>
              <li><a href="{{ route('login') }}"><i class="material-icons left">login</i>Entrar</a></li>
              <li><div class="divider"></div></li>
              <li><a href="{{ route('site.index') }}"><i class="material-icons left">home</i>Início do site</a></li>
              <li><a href="{{ route('admin.index') }}"><i class="material-icons left">build</i>Administração</a></li>
              <li><div class="divider"></div></li>
              <li><a href="{{ route('site.produtos') }}"><i class="material-icons left">shopping_cart</i>Produtos</a></li>
              <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                  <li>
                    <a class="collapsible-header">Categorias<i class="material-icons">arrow_drop_down</i></a>
                    <div class="collapsible-body">
                      <ul>
                        @foreach ($categorias as $categoria)
                          <li><a href="{{ route('site.ver.categoria', $categoria->id) }}"><span class="black-text">{{ $categoria->nome }}</span></a></li>
                        @endforeach
                      </ul>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
            {{-- <ul class="right hide-on-med-and-down">
              <li><a href="#!">First Sidebar Link</a></li>
              <li><a href="#!">Second Sidebar Link</a></li>
              <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Dropdown<i class="material-icons right">arrow_drop_down</i></a></li>
              <ul id='dropdown1' class='dropdown-content'>
                <li><a href="#!">First</a></li>
                <li><a href="#!">Second</a></li>
                <li><a href="#!">Third</a></li>
                <li><a href="#!">Fourth</a></li>
              </ul>
            </ul> --}}
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            {{-- <ul id="mobile-btn" class="sidenav">
              <li><a href="{{ route('admin.index') }}"><i class="material-icons left">build</i>Administração</a></li>
              <li>
                <ul class="collapsible">
                  <li>
                    <div class="collapsible-header"><i class="material-icons black-text">expand_more</i><span class="black-text">Categorias</span></div>
                    <ul>
                      <div class="collapsible-body">
                        @foreach ($categorias as $categoria)
                          <li><a href="{{ route('site.ver.categoria', $categoria->id) }}"><span class="black-text">{{ $categoria->nome }}</span></a></li>
                        @endforeach
                      </div>
                    </ul>
                  </li>
                </ul>
              </li>
              <li><a href="{{ route('site.produtos') }}"><i class="material-icons">shopping_cart</i>Produtos</a></li>
              <li><a href="{{ route('login') }}">Entrar</a></li>
              <li><a href="collapsible.html">Menu</a></li>
            </ul> --}}
        </div>
    </nav>
    </header>

    <main>
      <div class="row container">
        <p>@yield('content')</p>
      </div>
    </main>
    <footer class="page-footer pink lighten-2">
      <div class="container">
        <div class="row">
          <div class="col l6 s12">
            <h5 class="black-text">luie</h5>
            <p class="black-text">Informações como endereço, contato, etc.</p>
          </div>
          <!-- <div class="col l4 offset-l2 s12">
            <h5 class="white-text">Parceiros</h5>
            <ul>
              <li><a class="grey-text text-black" href="#!">Link 1</a></li>
              <li><a class="grey-text text-black" href="#!">Link 2</a></li>
              <li><a class="grey-text text-black" href="#!">Link 3</a></li>
              <li><a class="grey-text text-black" href="#!">Link 4</a></li>
            </ul>
          </div> -->
        </div>
      </div>
      <div class="footer-copyright red black">
        <div class="container">
        <p>&copy; {{ date('Y') }} luie. Todos os direitos reservados.</p>
        <a class="white-text right" href="#!">Mais links</a>
        </div>
      </div>
    </footer>
    <script src="{{ asset('js/materialize.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>