@extends('layouts.app')


@section('content')
@include('layouts.messages')

{!! Form::model($cliente, ['method' => 'put', 'route' => ['cliente.update', $cliente->id ], 'class' =>'form-horizontal', 'enctype' => "multipart/form-data"]) !!}

@CSRF
<fieldset>

    <div class="row justify-content-center">
        <div class="form-group col-7 ">
            <h2>Dados Conta Cliente</h2>
            <img name="foto_url" class="product-imagem"
                data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
                alt="Thumbnail [100%x225]"
                src="{{Auth::user()->foto_url ? asset('storage/fotos/' . Auth::user()->foto_url) : 'https://digimedia.web.ua.pt/wp-content/uploads/2017/05/default-user-image.png' }}"
                data-holder-rendered="true">
        </div>
        <div class="form-group justify-content-md-center col-7">
            <label class="control-label" for="filebutton">Upload Foto</label>
            <input name="foto_url" class="file-input" type="file">

        </div>

        <!-- Text input-->
        <div class="form-group col-7 ">
            <label class="control-label" for="nif">Nif</label>
            <input id="nif" name="nif" type="text" placeholder="" class="form-control input-md" required=""
                value="{{ old('nif') ?? $cliente->nif ?? '' }}">
            @error('nif')
            <div class="error">
                {{$message}}
            </div>
            @enderror

        </div>

        <!-- Text input-->
        <div class="form-group col-7">
            <label class=" control-label" for="endereco">Endereço</label>
            <input id="endereco" name="endereco" type="text" placeholder="" class="form-control input-md" required=""
                value="{{old('endereco') ?? $cliente->endereco ?? ''}}">
            @error('endereco')
            <div class="error">
                {{$message}}
            </div>
            @enderror

        </div>

        <!-- Select Basic -->
        <div class="form-group col-7">
            <label class="control-label" for="tipo_pagamento">Tipo de Pagamento</label>
            <select id="tipo_pagamento" name="tipo_pagamento" class="form-control">
                @if (isset($cliente))
                @foreach(["VISA" => "VISA", "MC" => "MC", "PAYPAL" => "PAYPAL"] AS $tipo_pagamento => $clienteLabel)
                <option value="{{ $tipo_pagamento }}"
                    {{ old("tipo_pagamento", $cliente->tipo_pagamento) == $tipo_pagamento ? "selected" : "" }}>
                    {{ $clienteLabel }}
                </option>
                @endforeach
                @else
                <option value="VISA" {{old('tipo_pagamento')}}=={{ 'VISA'? 'Selected' : ''}}>VISA</option>
                <option value="MC" {{old('tipo_pagamento')}}=={{'MC'? 'Selected' : ''}}>MC</option>
                <option value="PAYPAL" {{old('tipo_pagamento')}}=={{ 'PAYPAL'? 'Selected' : ''}}>PAYPAL</option>
                @endif
            </select>
            @error('tipo_pagamento')
            <div class="error">
                {{$message}}
            </div>
            @enderror

        </div>

        <!-- Text input-->
        <div class="form-group col-7">
            <label class=" control-label" for="ref_pagamento">Ref. Pagamento</label>
            <input id="ref_pagamento" name="ref_pagamento" type="text" placeholder="" class="form-control input-md"
                value="{{old('ref_pagamento')  ?? $cliente->ref_pagamento ?? ''}}">
            @error('ref_pagamento')
            <div class="error">
                {{$message}}
            </div>
            @enderror

        </div>

        <!-- Button (Double) -->
        <div class="form-group col-7">
            <label class=" control-label" for="submit"></label>
            <button id="submit" name="submit" class="btn btn-secondary">Guardar</button>
            <a href="{{route('estampas.list')}}" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
</fieldset>
</form>
@endsection