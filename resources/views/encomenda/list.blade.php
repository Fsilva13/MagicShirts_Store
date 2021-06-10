@extends('layouts.app')
@include('layouts.messages')
@section('title', 'Listar todos os registros')
 
@section('content')
<h1>Listagem de Ecomendas</h1>
<hr>
<div class="container">
    <table class="table table-bordered table-striped table-sm">
        <thead>
      <tr>
          <th>#</th>
          <th>Estado</th>
          <th>Cliente</th>
          <th>Data</th>
          <th>Preço Total</th>
          <th>Notas</th>
          <th>Nif</th>
          <th>Endereço</th>
          <th>Tipo de Pagamento</th>
          <th>Ref. Pagamento</th>
          </th>
      </tr>
        </thead>
        <tbody>
      @forelse($encomenda as $enc)
      <tr>
          <td>{{ $enc->id }}</td>
          <td>{{ $enc->estado }}</td>
          <td>{{ $enc->clientes}}</td>
          <td>{{ $enc->data }}</td>
          <td>{{ $enc->preco_total}}</td>
          <td>{{ $enc->notas }}</td>
          <td>{{ $enc->nif }}</td>
          <td>{{ $enc->endereco }}</td>
          <td>{{ $enc->tipo_pagamento }}</td>
          <td>{{ $enc->ref_pagamento }}</td>
          <td>
        <a href="{{ route('encomenda.edit', ['id' => $enc->id]) }}" class="btn btn-warning btn-sm">Editar</a>
        <form method="POST" action="{{ route('encomenda.destroy', ['id' => $enc->id]) }}" style="display: inline" onsubmit="return confirm('Deseja excluir este registro?');" >
            @csrf
            <input type="hidden" name="_method" value="delete" >
            <button class="btn btn-danger btn-sm">Excluir</button>
        </form>
          </td>
      </tr>
      @empty
      <tr>
          <td colspan="6">Nenhum registro encontrado para listar</td>
      </tr>
      @endforelse
        </tbody>
    </table>
    {{ $encomenda->links() }}
</div>
@endsection
