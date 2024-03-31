<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Título Padrão' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <header>
    <nav>
        <div class="nav-wrapper">
            <a href="/" class="brand-logo">&nbsp;luie</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="/admin"><i class="material-icons left">login</i>Gestão de estoque</a></li>
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
    <footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">luie</h5>
                <p class="grey-text text-lighten-4">Informações como endereço, contato, etc.</p>
              </div>
              <!-- <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Parceiros</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
                </ul>
              </div> -->
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            <p>&copy; {{ date('Y') }} luie. Todos os direitos reservados.</p>
            <a class="grey-text text-lighten-4 right" href="#!">Mais links</a>
            </div>
          </div>
        </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>