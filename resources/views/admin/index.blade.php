@extends('admin.layout')

@section('content')
    <div class='center'>
        <h4>Painel de gestão de produtos</h4>
        <hr>
    </div>

    <div class="row">
        {{ $produtos->links('custom/pagination') }}
    </div>

    <table class="striped">
        <thead>
        <tr>
            <th>Produto</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Slug</th>
            <th>Imagem URI</th>
        </tr>
        </thead>

        <tbody>
            @foreach ($produtos as $produto)
            <tr>
                <td>{{ $produto->nome }}</td>
                <td>{{ $produto->descricao }}</td>
                <td>{{ $produto->preco }}</td>
                <td>{{ $produto->slug }}</td>
                <td>{{ $produto->imagem }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        {{ $produtos->links('custom/pagination') }}
    </div>
    
@endsection
