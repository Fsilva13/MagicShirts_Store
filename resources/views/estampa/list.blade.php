@extends('layouts.app')
@section('content')
@include('layouts.messages')

<div class="container">
    <div>
        @if(!$privada)
        @if(Auth::check())
        <a id="btn_estampas" href="{{route('estampas.privadas')}}" class="btn btn-secondary btn-block btn-lg">Estampas
            Privadas</a>
        @endif
        @else
        <div class="row" id="btn_estampas">
            <div class="col-md-6">
                <a href="{{route('estampas.list')}}" class="btn btn-secondary btn-block btn-lg">Catalogo de Estampas</a>
            </div>
            <div class="col-md-6">
                <a href="{{route('estampa.create')}}" class="btn btn-secondary btn-block btn-lg">Criar Estampa</a>
            </div>
        </div>
        @endif
    </div>

    <form action="{{route('estampas.list')}}" method="GET">
        <div class="input-group justify-content-center">
            <div class="form-outline">
                <input name="inputsearch" id="input_search" type="search" class="form-control" />
            </div>
            @if(!$privada)
            <div id="search_div_categoria" class="col-md justify-content-md-center">
                <select id="search_categoria" name="categoria_id" class="form-control " onchange="">
                    <option value="" selected >--Categoria--</option>
                    @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}" {{ old("categoria_id") == $categoria->id ? "selected" : "" }}>
                        {{$categoria->nome}}
                    </option>
                    @endforeach
                </select>
            </div>
            @endif
            <button id="btn_search" type="submit" class="btn btn-secondary">
                <i class="fas fa-search"></i>
            </button>

        </div>

    </form>

    <table class="table table-bordered table-striped table-sm">
        <tbody>
            <div class="row">
                @forelse($estampas as $estampa)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">

                        <img class="product-imagem" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" src="{{$estampa->cliente_id ? route('estampas.privadas.imagem', $estampa->id) : asset('storage/estampas/' . $estampa->imagem_url) }}" data-holder-rendered="true">

                        <div class="card-body">
                            <p class="text-sm-left">Nome: {{ $estampa->nome}}</p>

                            <p class="card-text">Descricao: {{ $estampa->descricao}}</p><br>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">

                                    <form action="{{route('carrinho.store')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$estampa->id}}">

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal{{$estampa->id}}">
                                            Escolher Tshirt
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal{{$estampa->id}}" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Escolher
                                                            Tshirt
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <label class="col-md control-label" for="tamanho">Tamanho</label>
                                                        <div class="col-md">
                                                            <select required name="tamanho" class="form-control">
                                                                <option value="" selected disabled hidden>--</option>
                                                                <option value="XS">
                                                                    XS
                                                                </option>
                                                                <option value="S">
                                                                    S
                                                                </option>
                                                                <option value="M">
                                                                    M
                                                                </option>
                                                                <option value="L">
                                                                    L
                                                                </option>
                                                                <option value="XL">
                                                                    XL
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <label class="col-md control-label" for="cor_codigo">Cor</label>
                                                        <div class="col-md">
                                                            <select required name="cor_codigo" class="form-control">
                                                                <option value="" selected disabled hidden>--</option>
                                                                @foreach($cores as $cor)
                                                                <option value="{{$cor->codigo}}">
                                                                    {{$cor->nome}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <label class="col-md control-label" for="tamanho">Quantidade</label>
                                                        <div class="col-md">
                                                            <input type="number" name="quantidade" value="1" class="form-control" min="1">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-secondary">Adicionar
                                                            Carrinho</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </form>

                                </div>
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
    {{ $estampas->links() }}
</div>
@endsection