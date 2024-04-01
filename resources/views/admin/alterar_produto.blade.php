@extends('admin.layout')

@section('content')

    <div class="container center" style="margin-top: 50px; margin-bottom: 50px;">
        <h4>Cadastrar produto</h4>
        <hr>
    </div>

    <div class="row">
        <form class="col s12">
          <div class="row">
            <div class="input-field col s6">
              <input id="nome_produto" type="text" class="validate">
              <label for="nome_produto">Nome do produto</label>
            </div>
            <div class="input-field col s6">
                <input id="preco_produto" type="number" placeholder="R$ 123,45" class="validate">
                <label for="preco_produto">Preço</label>
              </div>
          </div>
          <div class="row">
              <div class="row">
                <div class="input-field col s12">
                  <textarea id="descricao_produto" class="materialize-textarea"></textarea>
                  <label for="descricao_produto">Descrição do produto</label>
                </div>
              </div>
          </div>
          {{-- <div class="row">
            <div class="input-field col s12">
              <input disabled value="Campo desativado" id="disabled" type="text" class="validate">
              <label for="disabled">Desativado</label>
            </div>
          </div> --}}
          <div class="row">
            <form action="#">
                <div class="file-field input-field">
                  <div class="waves-effect btn red lighten-2">
                    <span>Imagem do produto</span>
                    <input type="file" name="imagem_produto">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                    <label for="imagem_produto">Imagens podem ser do tipo JPG ou PNG</label>
                  </div>
                </div>
              </form>
          </div>
          {{-- <div class="row">
            <div class="input-field col s12">
              <input id="email" type="email" class="validate">
              <label for="email">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              This is an inline input field:
              <div class="input-field inline">
                <input id="email_inline" type="email" class="validate">
                <label for="email_inline">Email</label>
                <span class="helper-text" data-error="wrong" data-success="right">Helper text</span>
              </div>
            </div>
          </div> --}}
        </form>
        <div class="conatiner center">
            <a class="btn red lighten-2 white-text" href="/admin">Painel principal</a>
            <button class="btn waves-effect waves-white white-text teal darken-1" type="submit" name="action">Cadastrar
                <i class="material-icons right">check</i>
            </button>
        </div>
    </div>
    
@endsection
