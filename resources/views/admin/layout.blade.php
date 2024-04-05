<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin' }}</title>
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
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
    <li><a href="{{ route('site.index') }}" class="waves-effect"><i class="material-icons">home</i>Índice do site</a></li>
    <li><a href="{{ route('admin.index') }}" class="waves-effect"><i class="material-icons">build</i>Administração</a></li>

    <li><div class="divider"></div></li>
    <li class="center"><a class="subheader" class="waves-effect">Gestão</a></li>
    <li><a href="{{ route('admin.categorias') }}" class="waves-effect"><i class="material-icons">category</i>Categorias</a></li>
    <li><a href="{{ route('admin.produtos') }}" class="waves-effect"><i class="material-icons">shopping_cart</i>Produtos</a></li>
    <li><a href="{{ route('admin.clientes') }}" class="waves-effect"><i class="material-icons">people_alt</i>Clientes</a></li>
    
    <li><div class="divider"></div></li>
    <li class="center"><a class="subheader" class="waves-effect">Configurações do site</a></li>
    
    <li><a class="waves-effect" href="{{ route('admin.permissoes') }}" class="waves-effect"><i class="material-icons">lock</i>Permissões de acesso</a></li>
  </ul>
  <!-- <div class="container">
      <a href="#" data-target="slide-out" class="ml-3 waves-effect sidenav-trigger red black left btn"><i class="material-icons right">arrow_forward</i>Abrir painel</a>
  </div> -->
</header>

<body>
    <main>
        <div class="container">
          <div class="left">
              <a href="#" data-target="slide-out" class="ml-3 waves-effect sidenav-trigger red black left btn"><i class="material-icons right">arrow_forward</i>Menu</a>
          </div>
            @yield('content')<br />
        </div>
    </main>
    
    <div class="fixed-action-btn">
      <a class="btn-floating btn-large red">
        <i class="large material-icons red black">menu</i>
      </a>
      <ul>
        <!-- <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
        <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
        <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
        <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li> -->
        <li><a class="btn-floating blue btn waves-effect waves-light" href="/"><i class="large material-icons">home</i></a></li>
        <li><a class="btn-floating green btn waves-effect waves-light" href="/admin"><i class="large material-icons">build</i></a></li>
        <li><a class="btn-floating btn waves-effect waves-light red" onclick="history.back()"><i class="large material-icons">arrow_back</i></a></li>
      </ul>
    </div>
    <!-- teste -->

    <script src="{{ asset('js/materialize.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

</body>
</html>