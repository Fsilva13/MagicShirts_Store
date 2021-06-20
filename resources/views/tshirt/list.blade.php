@extends('layouts.app')



@section('content')
@include('layouts.messages')
<head>
    <link href="{{ asset('css/carrinho.css') }}" rel="stylesheet">
</head>

<div class="container">
    <table class="table table-bordered table-striped table-sm">
        <tbody>
            <div class="row">
                @forelse($tshirt as $tsh)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img class="product-image"
                            data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
                            alt="Thumbnail [100%x225]" style="height: 400px; width: 100%; display: block;"
                            src="{{$tsh->estampa->imagem_url ? asset('storage/estampas/' . $tsh->estampa->imagem_url) : asset('storage/tshirt_base/'. $tsh->cor_codigo .'.jpg') }}"
                            data-holder-rendered="true">
                        <div class="card-body">
                            <p class="text-sm-left">Tamanho: {{ $tsh->tamanho}} | Preço: {{ $tsh->preco_un}}€</p>
                            <p class="text-sm-left">Cor: {{ $tsh->cor->nome}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">

                                    <form action="{{route('carrinho.store')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $tsh->id }}">
                                        <input type="hidden" name="nome" value="{{ $tsh->estampa->nome }}">
                                        <input type="hidden" name="preco_un" value="{{ $tsh->preco_un }}">
                                        <button type="submit" class="button button-plain">Adicionar Carrinho</button>
                                    </form>

                                </div>
                                <small class="text-muted">{{ $tsh->quantidade }} uni</small>
                            </div>
                        </div>
                    </div>
                </div>
                @csrf
                @empty
                <tr>
                    <td colspan="6">Nenhum registo encontrado para listar</td>
                </tr>
                @endforelse
            </div>
        </tbody>
    </table>
    {{ $tshirt->links() }}
</div>
@endsection