@extends('layouts.app')

@section('content')
@include('layouts.messages')
<h1>Lista de Preços</h1>
<hr>
<div class="container">
    <table class="table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th>Preço/Unidade Catalogo</th>
                <th>Preço/Unidade Proprio</th>
                <th>Preço/Unidade Catalogo com desconto</th>
                <th>Preço/Unidade Proprio com desconto</th>
                <th>Quantidade para Desconto</th>
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($precos as $preco)
            <tr>
                <td>{{ $preco->preco_un_catalogo }}€</td>
                <td>{{ $preco->preco_un_proprio }}€</td>
                <td>{{ $preco->preco_un_catalogo_desconto }}€</td>
                <td>{{ $preco->preco_un_proprio_desconto }}€</td>
                <td>{{ $preco->quantidade_desconto }}</td>
                <td>
                    <form method="GET" action="{{ route('preco.edit', ['id' => $preco->id]) }}"
                        style="display: inline">
                        @csrf
                        <input type="hidden" name="_method" value="patch">
                        <button class="btn btn-warning btn-sm">Editar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Nenhum registo encontrado para listar</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection