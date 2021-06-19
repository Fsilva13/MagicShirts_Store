@extends('layouts.app')


@section('content')
@include('layouts.messages')

{!! Form::model($cliente, ['method' => 'put', 'route' => ['cliente.update', $cliente->id ], 'class' =>
'form-horizontal']) !!}
@CSRF
<fieldset>

    <div class="row justify-content-center">






        <!-- Text input-->
        <div class="form-group col-7 ">
            <h2>Dados Conta Cliente</h2>
            <label class="control-label" for="NIF">NIF</label>

            <input id="NIF" name="NIF" type="text" placeholder="" class="form-control input-md" required=""
                value="{{ old('NIF') ?? $cliente->nif ?? '' }}">
            @error('NIF')
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
            <a href="{{url()->previous()}}" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
</fieldset>
</form>
@endsection