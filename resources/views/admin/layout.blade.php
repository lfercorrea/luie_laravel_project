<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <header>
      {{-- <nav> <!-- navbar content here  --> </nav> --}}

        <ul id="slide-out" class="sidenav">
          <li>
            <div class="user-view">
              <div class="background">
                <img src="{{ Storage::url('images/office.jpg') }}">
              </div>
              <a href="#user" class="waves-effect"><img class="circle" src="{{ Storage::url('images/img_avatar.png') }}"></a>
              <a href="#name" class="waves-effect"><span class="white-text name">Projeto Integrador</span></a>
              <a href="#email" class="waves-effect"><span class="white-text email">alunos@univesp.br</span></a>
            </div>
          </li>
          <li><a href="/" class="waves-effect"><i class="material-icons">domain</i>Página principal</a></li>
          <li><a href="/categorias" class="waves-effect"><i class="material-icons">category</i>Categorias</a></li>
          <li><a href="/produtos" class="waves-effect"><i class="material-icons">shopping_cart</i>Produtos</a></li>
          <li><a href="/clientes" class="waves-effect"><i class="material-icons">people_alt</i>Clientes</a></li>
          
          <li><div class="divider"></div></li>
          <li><a class="subheader" class="waves-effect"><i class="material-icons">settings</i>Configurações do sistema</a></li>

          <li><a class="waves-effect" href="/admin/config/permissoes" class="waves-effect">Permissões de acesso</a></li>
        </ul>
        <div clas="container">
          <a href="#" data-target="slide-out" class="waves-effect sidenav-trigger red lighten-2 left btn">Abrir painel</a>
        </div>
        </header>

    <main>
        <div class="container">
            @yield('content')<br />
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems);
      });
    </script>
</body>
</html>