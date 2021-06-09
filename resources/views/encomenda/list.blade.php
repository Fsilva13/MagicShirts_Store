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
          <th>Nome</th>
          <th>Sobrenome</th>
          <th>email</th>
          <th>telefone</th>
          </th>
      </tr>
        </thead>
        <tbody>
      @forelse($encomenda as $enc)
      <tr>
          <td>{{ $enc->id }}</td>
          <td>{{ $enc->first_name }}</td>
          <td>{{ $enc->last_name }}</td>
          <td>{{ $enc->email }}</td>
          <td>{{ $enc->phone }}</td>
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
    {{ $cliente->links() }}
</div>
@endsection
