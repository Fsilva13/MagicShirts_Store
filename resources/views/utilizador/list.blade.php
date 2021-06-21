@extends('layouts.app')


@section('content')
@include('layouts.messages')
<h1>Listagem de Clientes</h1>
<hr>
<div class="container">
    <table class="table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Tipo de Utilizador</th>
                <th>Bloqueado</th>
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->tipo }}</td>
                <td>{{$user->bloqueado == '1'? 'Bloqueado' : ''}}</td>
                <td>
                    <form method="POST" action="{{ route('utilizador.bloquear', ['user' => $user->id]) }}"
                        style="display: inline">
                        @csrf
                        <input type="hidden" name="_method" value="patch">
                        <button class="btn btn-warning btn-sm">{{$user->bloqueado == '1'? 'Desbloquear' : 'Bloquear'}}</button>
                    </form>
                </td>
                <td>
                    <form method="POST" action="{{ route('utilizador.destroy', ['user' => $user->id]) }}"
                        style="display: inline" onsubmit="return confirm('Deseja excluir este utilizador?');">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-danger btn-sm">Excluir</button>
                    </form>

                </td>
                @if($user->tipo != 'C')
                <td>
                    <form method="GET" action="{{ route('utilizador.edit', $user->id) }}"
                        style="display: inline">
                        @csrf
                        <input type="hidden" name="_method" value="get">
                        <button class="btn btn-secondary btn-sm">Editar</button>
                    </form>
                @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Nenhum registo encontrado para listar</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection