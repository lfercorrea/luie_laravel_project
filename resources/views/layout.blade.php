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
        <div class="nav-wrapper black black">
            <a href="/" class="brand-logo"><img class="responsive-img" src="{{ Storage::url('images/brand_logo_62.jpg') }}"></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="/admin"><i class="material-icons left">build</i>Administração</a></li>
                <!-- Dropdown Trigger -->
                  <li><a class='dropdown-trigger' data-target='categorias'><i class="material-icons left">expand_more</i>Categorias</a></li>

                <!-- Dropdown Structure -->
                  <ul id='categorias' class='dropdown-content'>
                    @foreach ($categorias as $categoria)
                      <li><a href="#!">{{ $categoria->nome }}</a></li>
                    @endforeach
                  </ul>
                <li><a href="produtos">Produtos</a></li>
                <li><a href="login">Entrar</a></li>
                <li><a href="collapsible.html">Menu</a></li>
            </ul>
        </div>
    </nav>
    </header>

    <main>
        <div class="container">
            @yield('content')<br />
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