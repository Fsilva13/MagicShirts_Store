@extends('layouts.app')
@include('layouts.messages')
@section('title', 'Listando todos os registros')
 
@section('content')
<h1>Listagem de Clientes</h1>
<hr>
<div class="container">
    <table class="table table-bordered table-striped table-sm">
        <thead>
      <tr>
          <th>#</th>
          <th>Nome</th>
          <th>Nif</th>
          <th>Tipo de Pagamento</th>
          <th>Ref. Pagamento</th>
          </th>
      </tr>
        </thead>
        <tbody>
      @forelse($cliente as $clt)
      <tr>
          <td>{{ $clt->id }}</td>
          <td>{{ $clt->user->name }}</td>
          <td>{{ $clt->nif }}</td>
          <td>{{ $clt->tipo_pagamento }}</td>
          <td>{{ $clt->ref_pagamento }}</td>
          <td>
          <a href="{{ route('cliente.edit', ['id' => $clt->id]) }}" class="btn btn-warning btn-sm">Editar</a>
        <form method="POST" action="{{ route('cliente.destroy', ['id' => $clt->id]) }}" style="display: inline" onsubmit="return confirm('Deseja excluir este registro?');" >
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
</div>
@endsection