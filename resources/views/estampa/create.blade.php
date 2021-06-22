@extends('layouts.app')

@section('content')
@include('layouts.messages')

@if(isset($estampa))
<form enctype="multipart/form-data" class="form-horizontal" method="POST"
    action="{{route('estampa.update', $estampa->id)}}">
    {{method_field('PUT')}}
    @else
    <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{route('estampa.store')}}">
        @endif
        @CSRF
        <fieldset>


            <div class="row justify-content-center">

                <div class="form-group col-7">
                    <h2>Nova Estampa</h2>
                    <label class=" control-label" for="nome">Nome</label>
                    <div>
                        <input name="nome" type="text" placeholder="" class="form-control input-md"
                            value="{{old('nome') ?? $estampa->nome ?? ''}}">
                        @error('nome')
                        <div class="error">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group col-7">
                    <label class=" control-label" for="descricao">Descrição</label>
                    <div>
                        <textarea rows="4" style="resize:none;" type="text-area" class="form-control" id="descricao"
                            name="descricao" value="">{{old('descricao') ?? $estampa->descricao ?? '' }}</textarea>
                        @error('descricao')
                        <div class="error">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group justify-content-md-center col-7">
                    <label style="display:block" class="control-label" for="filebutton">Upload Estampa</label>
                    <input name="imagem" class="file-input" type="file">

                </div>

                <div class="form-group justify-content-md-center col-7">
                    <label class=" control-label" for="singlebutton"></label>

                    <button type="submit" class="btn btn-secondary">Guardar Estampa</button>

                </div>
            </div>
        </fieldset>
    </form>
    @endsection