@extends('layouts.app')

@section('content')
@include('layouts.messages')
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
      @forelse($encomendas as $enc)
      <tr>
        <td>{{ $enc->id }}</td>
        <td>{{ $enc->estado }}</td>
        <td>{{ $enc->cliente_id}}</td>
        <td>{{ $enc->data }}</td>
        <td>{{ $enc->preco_total}}</td>
        <td>{{ $enc->notas }}</td>
        <td>{{ $enc->nif }}</td>
        <td>{{ $enc->endereco }}</td>
        <td>{{ $enc->tipo_pagamento }}</td>
        <td>{{ $enc->ref_pagamento }}</td>
        @if(Auth::user()->tipo != 'C')
        <td>
          <form method="POST" action="{{ route('encomenda.update', ['encomenda' => $enc->id]) }}" style="display: inline">
            @csrf
            {{method_field('PATCH')}}
            @if($enc->estado == 'pendente')
            <input type="hidden" name="estado" value="paga">
            <button class="btn btn-secondary btn-sm">Paga</button>
            @else
            <input type="hidden" name="estado" value="fechada">
            <button class="btn btn-secondary btn-sm">Fechada</button>
            @endif
          </form>
        </td>
        @endif
      </tr>
      @empty
      <tr>
        <td colspan="6">Nenhum registro encontrado para listar</td>
      </tr>
      @endforelse
    </tbody>
  </table>
  {{ $encomendas->links() }}
</div>
@endsection