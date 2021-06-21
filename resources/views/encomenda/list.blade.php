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
                @if(Auth::user()->tipo == 'C' and Auth::user()->tipo == 'A' )
                <th style="text-align: center;">Fatura PDF</th>
                @endif
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
                <td>
                    @if($enc->recibo_url)
                    <form method="GET" action="{{ route('encomenda.pdf', ['encomenda' => $enc->id]) }}"
                        style="display: inline">
                        <button type="submit" class="btn btn-secondary btn-sm">PDF Fatura</button>
                    </form>
                    @endif
                </td>
                @if(Auth::user()->tipo != 'C')
                <td>
                    <form method="POST" action="{{ route('encomenda.update', ['encomenda' => $enc->id]) }}"
                        style="display: inline">
                        @csrf
                        {{method_field('PATCH')}}
                        @switch($enc->estado)
                        @case('pendente')
                        <input type="hidden" name="estado" value="paga">
                        <button class="btn btn-secondary btn-sm">Paga</button>
                        @break
                        @case('paga')
                        <input type="hidden" name="estado" value="fechada">
                        <button class="btn btn-secondary btn-sm">Fechada</button>
                        @break
                        @endswitch

                </td>
                @if(Auth::user()->tipo == 'A' and $enc->estado != 'anulada')
                <td>
                    <input type="hidden" name="estado" value="anulada">
                    <button class="btn btn-secondary btn-sm">Anulada</button>
                </td>
                @endif
                </form>
                @endif
            </tr>
            @empty
            <tr>
                <td colspan="6">Nenhum registo encontrado para listar</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $encomendas->links() }}
</div>
@endsection