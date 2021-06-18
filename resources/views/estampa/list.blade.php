@extends('layouts.app')



@section('content')
@include('layouts.messages')

<div class="container">
    <table class="table table-bordered table-striped table-sm">
        <tbody>
            <div class="row">
                @forelse($estampas as $estampa)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img class="product-image"
                            data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
                            alt="Thumbnail [100%x225]" style="height: 400px; width: 100%; display: block;"
                            src="{{$estampa->imagem_url ? asset('storage/estampas/' . $estampa->imagem_url) : '' }}"
                            data-holder-rendered="true">
                        <div class="card-body">
                            <p class="text-sm-left">Nome: {{ $estampa->nome}}</p>
                            
                            <p class="card-text">Descricao: {{ $estampa->descricao}}</p><br>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">

                                    <form action="{{route('carrinho.store')}}" method="POST">
                                        @csrf                                       
                                        <input type="hidden" name="id" value="{{$estampa->id}}">
                                        
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-secondary" data-toggle="modal"
                                            data-target="#modal{{$estampa->id}}">
                                            Escolher Tshirt
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal{{$estampa->id}}" tabindex="-1" role="dialog"
                                            aria-labelledby="ModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Escolher
                                                            Tshirt
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    
                                                    <div class="modal-body">
                                                        <label class="col-md control-label"
                                                            for="tamanho">Tamanho</label>
                                                        <div class="col-md">
                                                            <select required id="tamanho" name="tamanho"
                                                                class="form-control">
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
                                                            <select required id="cor_codigo" name="cor_codigo"
                                                                class="form-control">
                                                                <option value="" selected disabled hidden>--</option>
                                                                @foreach($cores as $cor)
                                                                <option value="{{$cor->codigo}}">
                                                                    {{$cor->nome}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <label class="col-md control-label"
                                                            for="tamanho">Tamanho</label>
                                                        <div class="col-md">
                                                            <input type="number" name="quantidade" class="form-control"
                                                                min="1">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
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
                    <td colspan="6">Nenhum registro encontrado para listar</td>
                </tr>
                @endforelse
            </div>
        </tbody>
    </table>
    {{ $estampas->links() }}
</div>
@endsection