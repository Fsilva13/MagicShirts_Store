@extends('layouts.app')


@section('content')
@include('layouts.messages')

{!! Form::model($cor, ['method' => 'put', 'route' => ['cor.update', $cor->codigo ], 'class' =>'form-horizontal',
'enctype' => "multipart/form-data"]) !!}

@CSRF
<fieldset>
    <div class="row justify-content-center">
        <!-- Text input-->
        <div class="form-group col-7">
        <h2>Editar Cor</h2>
            <label class=" control-label" for="codigo">Codigo Cor</label>
            <input id="codigo" name="codigo" type="text" placeholder="" class="form-control input-md"
                value="{{old('codigo')  ?? $cor->codigo ?? ''}}">
            @error('codigo')
            <div class="error">
                {{$message}}
            </div>
            @enderror

        </div>
        <!-- Text input-->
        <div class="form-group col-7">
            <label class=" control-label" for="nome">Nome</label>
            <input id="nome" name="nome" type="text" placeholder="" class="form-control input-md"
                value="{{old('nome')  ?? $cor->nome ?? ''}}">
            @error('nome')
            <div class="error">
                {{$message}}
            </div>
            @enderror

        </div>


        <!-- Button (Double) -->
        <div class="form-group col-7">
            <label class=" control-label" for="submit"></label>
            <button id="submit" name="submit" class="btn btn-secondary">Guardar</button>
            <a href="{{route('cor.list')}}" class="btn btn-danger">Sair</a>
        </div>
    </div>
</fieldset>
</form>
@endsection