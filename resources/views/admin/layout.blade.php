<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<header>
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
    <li><a href="/admin" class="waves-effect"><i class="material-icons">home</i>Painel de administração</a></li>
    <li><a href="/" class="waves-effect"><i class="material-icons">domain</i>Índice do site</a></li>

    <li><div class="divider"></div></li>
    <li class="center"><a class="subheader" class="waves-effect">Gestão</a></li>
    <li><a href="/admin/categorias" class="waves-effect"><i class="material-icons">category</i>Categorias</a></li>
    <li><a href="/admin/produtos" class="waves-effect"><i class="material-icons">shopping_cart</i>Produtos</a></li>
    <li><a href="/admin/clientes" class="waves-effect"><i class="material-icons">people_alt</i>Clientes</a></li>
    
    <li><div class="divider"></div></li>
    <li class="center"><a class="subheader" class="waves-effect">Configurações do site</a></li>
    
    <li><a class="waves-effect" href="/admin/config/permissoes" class="waves-effect"><i class="material-icons">lock</i>Permissões de acesso</a></li>
  </ul>
  <div class="container">
      <a href="#" data-target="slide-out" class="ml-3 waves-effect sidenav-trigger red lighten-2 left btn"><i class="material-icons right">arrow_forward</i>Abrir painel</a>
  </div>
</header>

<body>
    <main>
        <div class="container">
            @yield('content')<br />
        </div>
    </main>

    <div class="fixed-action-btn">
      <a class="btn-floating btn-large waves-effect waves-light red" onclick="history.back()">
          <i class="large material-icons">arrow_back</i>
      </a>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems);
      });

      // document.addEventListener('DOMContentLoaded', function() {
      //   var elems = document.querySelectorAll('.modal');
      //   var instances = M.Modal.init(elems);
      // });
    </script>

</body>
</html>