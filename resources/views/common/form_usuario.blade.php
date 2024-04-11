@extends(auth()->check() ? 'admin.layout' : 'layout')

@section('content')

    <div class="container center" style="margin-top: 50px; margin-bottom: 50px;">
        @if($modo === 'cadastrar')
            <h4>Cadastro</h4>
        @elseif($modo === 'alterar')
            <h4>Alterar usuário</h4>
        @endif
        <hr>
    </div>

    <div class="col s12">

        <form action="{{ $modo === 'cadastrar' ? route('users.store') : route('admin.alterar_usuario.store', ['id' => $usuario->id] ) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($modo === 'alterar')
                @method('PUT')
            @endif
            <input type="hidden" name="modo" value="{{ $modo }}">

            @if($modo === 'alterar')
                <div class="row">
                    <div class="s12">
                        <span class="grey-text"><i>Usuário cadastrado em <b>{{ $usuario->created_at }}</b></i></span>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="input-field col s12 m5">
                    <input id="nome" type="text" name="name" class="validate" value="{{ old('name', $usuario->name) }}">
                    <label for="nome">Nome completo</label>
                </div>
                <div class="input-field col s10 m5">
                    <input id="endereco" type="text" name="endereco" class="validate" value="{{ old('endereco', $usuario->endereco) }}">
                    <label for="endereco">Endereço</label>
                </div>
                <div class="input-field col s2 m2">
                    <input id="numero" type="text" name="numero" class="validate" value="{{ old('numero', $usuario->numero) }}">
                    <label for="numero">Número</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s10 m4">
                    <input id="cidade" type="text" name="cidade" class="validate" value="{{ old('cidade', $usuario->cidade) }}">
                    <label for="cidade">Cidade</label>
                </div>
                <div class="input-field col s2 m2">
                    <input id="uf" type="text" name="uf" class="validate" value="{{ old('uf', $usuario->uf) }}">
                    <label for="uf">Estado</label>
                </div>
                <div class="input-field col s9 m4">
                    <input id="bairro" type="text" name="bairro" class="validate" value="{{ old('bairro', $usuario->bairro) }}">
                    <label for="bairro">Bairro</label>
                </div>
                <div class="input-field col s3 m2">
                    <input id="cep" type="text" name="cep" placeholder="19123-000" class="validate"  value="{{ old('cep', $usuario->cep) }}">
                    <label for="cep">CEP</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m2">
                    <input id="celular" type="tel" name="celular" class="validate" value="{{ old('celular', $usuario->celular) }}">
                    <label for="celular">Celular</label>
                </div>
                <div class="input-field col s6 m3">
                    <input id="email" type="email" name="email" class="validate" value="{{ old('email', $usuario->email) }}">
                    <label for="email">E-mail</label>
                </div>
                <div class="input-field col s6 m3">
                    <input id="confirmar_email" type="email" name="email_confirmation" class="validate" value="{{ old('email', $usuario->email) }}">
                    <label for="confirmar_email">Confirme o e-mail</label>
                </div>
                <div class="input-field col s6 m2">
                    <input id="senha" type="password" name="password" class="validate">
                    <label for="senha">Senha</label>
                </div>
                <div class="input-field col s6 m2">
                    <input id="confirmar_senha" type="password" name="password_confirmation" class="validate">
                    <label for="confirmar_senha">Confirme a senha</label>
                </div>
            </div>

            @if ($modo === 'alterar')
            <div class="row">
                <div class="col s12">
                    <h5><p>Foto atual:</p></h5> 
                    <div class="row center">
                        <div class="col s12">
                            <img src="{{ empty($usuario->foto) ? asset('storage/static/images/img_avatar.png') :  asset('storage/' . $usuario->foto) }}" class="responsive-img">
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="col s12">
                <h5><p>Enviar {{ $modo === 'alterar' ? 'nova' : 'uma' }} foto</p></h5>
            </div>

            <div class="col s12">
                <div class="file-field input-field">
                    <div class="waves-effect btn red black">
                        <span>Enviar arquivo</span>
                        <input type="file" id="foto" name="foto">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                        <label for="foto">Imagens podem ser do tipo JPG ou PNG</label>
                    </div>
                </div>
            </div>

            @if ( $modo === 'alterar' )
                @if ( $usuario->id !== auth()->user()->id && $usuario->id !== 1 )
                                
                    <div class="col s12">
                        <h5>Tipo de usuário</h5>
                        <p>O tipo de usuário determina o que ele pode fazer no sistema.</p>

                        <div class="row">
                            <div class="col s12 m8 red lighten-3"><b>Proprietário</b></div>
                            <div class="col s12 m8 red lighten-3">Tem poder total no site e não pode ser excluído.</div>
                        </div>
                        <div class="row">
                            <div class="col s12 m8 green lighten-3"><b>Administrador</b></div>
                            <div class="col s12 m8 green lighten-3">Pode cadastrar, alterar e excluir produtos, mas não pode excluir clientes nem alterar configurações do site.</div>
                        </div>
                        <div class="row">
                            <div class="col s12 m8 blue lighten-3"><b>Cliente</b></div>
                            <div class="col s12 m8 blue lighten-3">Podem se cadastrar e fazer qualquer coisa que um usuário não cadastrado faz.</div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col s12 m3">
                            <select id="level" name="level">
                            <option value="{{ old('level', $usuario->level) }}" selected>{{ $levels[$usuario->level] }}</option>
                    
                            @foreach ($levels as $level_id => $level_name)
                                <option value="{{ $level_id }}">{{ $level_name }}</option>
                            @endforeach
                            
                            </select>
                            <label for="level">Tipo de usuário</label>
                        </div>
                    </div>

                @else

                    <div class="row">
                        <div class="col 12">
                            <div class="col s12 red lighten-3"><b>Proprietário</b></div>
                            <div class="col s12 red lighten-3">
                                Este usuário não pode ser excluído nem ter sua credencial alterada. Há duas situações em que isso ocorre:
                                <ul>
                                    <li>Usuário com a ID 1, isto é, o primeiro usuário cadastrado no sistema, que também é proprietário;</li>
                                    <li>Usuário com credencial de proprietário que esteja tentando alterar a sua própria credencial.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                
                @endif
            @endif

            <div class="container center">
                <div class="col s12 center">
                    <a class="waves-effect waves-black btn-flat" onclick="history.back()">Voltar</a>
                    <button type="submit" class="btn waves-effect waves-light black">{{ $modo }}</button>
                </div>
            </div>
        </form>

    </div>
    
@endsection