@extends('layouts.app')


@section('content')
@include('layouts.messages')
<h1>Lista de Cores</h1>
<hr>
<div class="container">
    <table class="table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th>Codigo da Cor</th>
                <th>Nome</th>
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($cores as $cor)
            <tr>
                <td>{{ $cor->codigo }}</td>
                <td>{{ $cor->nome }}</td>
                <td>
                    <form method="GET" action="{{ route('cor.edit', ['id' => $cor->codigo]) }}"
                        style="display: inline">
                        @csrf
                        <input type="hidden" name="_method" value="patch">
                        <button class="btn btn-warning btn-sm">Editar</button>
                    </form>
                </td>
                <td>
                    <form method="POST" action="{{ route('cor.destroy', ['id' => $cor->codigo]) }}"
                        style="display: inline" onsubmit="return confirm('Deseja excluir esta cor?');">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-danger btn-sm">Excluir</button>
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