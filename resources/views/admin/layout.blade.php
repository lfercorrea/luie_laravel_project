<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $siteconfig_brand }} {{ isset($page_title) ? ' - ' . $page_title : '' }}</title>
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/static/images/favicon.ico') }}">
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
      <li><a href="{{ route('admin.tamanhos') }}"><i class="material-icons">height</i>Tamanhos</a></li>
      <li><a href="{{ route('admin.estoque') }}"><i class="material-icons">production_quantity_limits</i>Estoque</a></li>
    </li>
    
    @if ( auth()->user()->level === 1 )
      <li><div class="divider"></div></li>
      <li class="center"><a class="subheader" class="waves-effect">Gestão do site</a></li>
      <li><a href="{{ route('admin.siteconfig') }}" class="waves-effect"><i class="material-icons">settings</i>Configurações do site</a></li>
      <li><a href="{{ route('admin.usuarios') }}" class="waves-effect"><i class="material-icons">people_alt</i>Usuários</a></li>
    @endif
  </ul>
</header>

<body>
    <main>
        <div class="row">
          <div class="col s12">
              <p class="print-hidden"><a href="#" data-target="slide-out" class="ml-3 waves-effect waves-light sidenav-trigger red black left btn"><i class="material-icons right">chevron_right</i>Menu</a></p>
              @yield('content')
          </div>
        </div>

        @if ( $msg = Session::get('fail') || $errors->any() )
            @include('messages.fail')
        @elseif ( $msg = Session::get('success') )
            @include('messages.success')
        @endif

    </main>
    
    <div class="fixed-action-btn print-hidden">
      <a class="btn-floating btn-large red">
        <i class="large material-icons red black">menu</i>
      </a>
      <ul>
        <li><a class="btn-floating blue btn waves-effect waves-light" href="/"><i class="large material-icons">home</i></a></li>
        <li><a class="btn-floating green btn waves-effect waves-light" href="/admin"><i class="large material-icons">build</i></a></li>
        <li><a class="btn-floating btn waves-effect waves-light red" onclick="history.back()"><i class="large material-icons">arrow_back</i></a></li>
      </ul>
    </div>

    <script src="{{ asset('js/materialize.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>

</body>
</html>