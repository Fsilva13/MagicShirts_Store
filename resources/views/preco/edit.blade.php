@extends('layouts.app')


@section('content')
@include('layouts.messages')

{!! Form::model($preco, ['method' => 'put', 'route' => ['preco.update', $preco->id ], 'class' =>'form-horizontal',
'enctype' => "multipart/form-data"]) !!}

@CSRF
<fieldset>
    <div class="row justify-content-center">
        <!-- Text input-->
        <div class="form-group col-7">
            <h2>Gerir Preços</h2>
            <label class=" control-label" for="preco_un_catalogo">Preço/Unidade Catalogo</label>
            <input id="preco_un_catalogo" name="preco_un_catalogo" type="text" placeholder=""
                class="form-control input-md" value="{{old('preco_un_catalogo')  ?? $preco->preco_un_catalogo ?? ''}}">
            @error('preco_un_catalogo')
            <div class="error">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group col-7">
            <label class=" control-label" for="preco_un_proprio">Preço/Unidade Proprio</label>
            <input id="preco_un_proprio" name="preco_un_proprio" type="text" placeholder=""
                class="form-control input-md" value="{{old('preco_un_proprio')  ?? $preco->preco_un_proprio ?? ''}}">
            @error('preco_un_proprio')
            <div class="error">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group col-7">
            <label class=" control-label" for="preco_un_catalogo_desconto">Preço/Unidade Catalogo com desconto</label>
            <input id="preco_un_catalogo_desconto" name="preco_un_catalogo_desconto" type="text" placeholder=""
                class="form-control input-md" value="{{old('preco_un_catalogo_desconto')  ?? $preco->preco_un_catalogo_desconto ?? ''}}">
            @error('preco_un_catalogo_desconto')
            <div class="error">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group col-7">
            <label class=" control-label" for="preco_un_proprio_desconto">Preço/Unidade Proprio com desconto</label>
            <input id="preco_un_proprio_desconto" name="preco_un_proprio_desconto" type="text" placeholder=""
                class="form-control input-md" value="{{old('preco_un_proprio_desconto')  ?? $preco->preco_un_proprio_desconto ?? ''}}">
            @error('preco_un_proprio_desconto')
            <div class="error">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group col-7">
            <label class=" control-label" for="quantidade_desconto">Quantidade para Desconto</label>
            <input id="quantidade_desconto" name="quantidade_desconto" type="text" placeholder=""
                class="form-control input-md" value="{{old('quantidade_desconto')  ?? $preco->quantidade_desconto ?? ''}}">
            @error('quantidade_desconto')
            <div class="error">
                {{$message}}
            </div>
            @enderror
        </div>


        <!-- Button (Double) -->
        <div class="form-group col-7">
            <label class=" control-label" for="submit"></label>
            <button id="submit" name="submit" class="btn btn-secondary">Guardar</button>
            <a href="{{route('preco.list')}}" class="btn btn-danger">Sair</a>
        </div>
    </div>
</fieldset>
</form>
@endsection