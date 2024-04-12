<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $brand }} {{ isset($page_title) ? ' - ' . $page_title : '' }}</title>
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<header>
  <ul id="slide-out" class="sidenav">
    @include('common.sidenav_head')
    
    <li><a href="{{ route('site.index') }}" class="waves-effect"><i class="material-icons">home</i>Índice do site</a></li>

    <li><div class="divider"></div></li>
    <li class="center"><a class="subheader" class="waves-effect">Produtos</a></li>
    <li class="no-padding">
      <li><a href="{{ route('admin.categorias') }}"><i class="material-icons">category</i>Categorias</a></li>
      <li><a href="{{ route('admin.estoque') }}"><i class="material-icons">production_quantity_limits</i>Estoque</a></li>
    </li>
    
    <li><div class="divider"></div></li>
    <li class="center"><a class="subheader" class="waves-effect">Gestão do site</a></li>
    <li><a href="{{ route('admin.usuarios') }}" class="waves-effect"><i class="material-icons">people_alt</i>Usuários/clientes</a></li>
  </ul>
  <!-- <div class="container">
      <a href="#" data-target="slide-out" class="ml-3 waves-effect sidenav-trigger red black left btn"><i class="material-icons right">arrow_forward</i>Abrir painel</a>
  </div> -->
</header>

<body>
    <main>
        <div class="row">
          <div class="col s12">
              <p><a href="#" data-target="slide-out" class="ml-3 waves-effect waves-light sidenav-trigger red black left btn"><i class="material-icons right">chevron_right</i>Abrir menu</a></p>
              @yield('content')
          </div>
        </div>

        @if ( $msg = Session::get('fail') || $errors->any() )
            @include('messages.fail')
        @elseif ( $msg = Session::get('success') )
            @include('messages.success')
        @endif

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