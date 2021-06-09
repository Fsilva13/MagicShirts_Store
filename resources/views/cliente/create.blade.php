@extends('layouts.app')
@include('layouts.messages')

@section('content')


    @if(isset($cliente))
 
        {!! Form::model($cliente, ['method' => 'put', 'route' => ['cliente.update', $cliente->id ], 'class' => 'form-horizontal']) !!}
 
    @else
 
        {!! Form::open(['method' => 'post','route' => 'cliente.store', 'class' => 'form-horizontal']) !!}
 
    @endif

    @CSRF
  <fieldset>

    <!-- Form Name -->
    <div class="col-md-4">
      <div class="card-header">
          <span class="card-title">
            @if (isset($cliente))
              Editar registro #{{ $cliente->id }}
            @else
              Criar novo registro
            @endif
          </span>
        </div>
      </div>
    </div>


    <!-- Text input-->
    @if (isset($cliente))
    <div class="form-group">
      <div class="col-md-4">
        <input id="Id" name="Id" type="hidden" placeholder="" class="form-control input-md" required="" value="{{ old('id') ?? $cliente->id ?? '' }}" readonly>        
      </div>
    </div>
    @else
        <div class="form-group">
        <div class="col-md-4">
        <input id="Id" name="Id" type="hidden" placeholder="" class="form-control input-md" required="" value=" {{Auth::id()}}" readonly>        
      </div>
    </div>
    @endif
    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="NIF">NIF</label>  
      <div class="col-md-4">
        <input id="NIF" name="NIF" type="text" placeholder="" class="form-control input-md" required="" value="{{ old('NIF') ?? $cliente->nif ?? '' }}" > 
        @error('NIF')
        <div class="error">
          {{$message}}
        </div>
        @enderror        
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="endereco">Endereço</label>  
      <div class="col-md-4">
        <input id="endereco" name="endereco" type="text" placeholder="" class="form-control input-md" required="" value="{{old('endereco') ?? $cliente->endereco ?? ''}}">
        @error('endereco')
        <div class="error">
          {{$message}}
        </div>
        @enderror
      </div>
    </div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="tipo_pagamento">Tipo de Pagamento</label>
  <div class="col-md-4">
    <select id="tipo_pagamento" name="tipo_pagamento" class="form-control">
      @if (isset($cliente))
          @foreach(["VISA" => "VISA", "MC" => "MC", "PAYPAL" => "PAYPAL"] AS $tipo_pagamento => $clienteLabel)    
          <option value="{{ $tipo_pagamento }}" {{ old("tipo_pagamento", $cliente->tipo_pagamento) == $tipo_pagamento ? "selected" : "" }}>{{ $clienteLabel }}</option>
          @endforeach
      @else
          <option value="VISA" {{old('tipo_pagamento')}} == {{ 'VISA'? 'Selected' : ''}}>VISA</option>
          <option value="MC"{{old('tipo_pagamento')}} == {{'MC'? 'Selected' : ''}}>MC</option>
          <option value="PAYPAL"{{old('tipo_pagamento')}} == {{ 'PAYPAL'? 'Selected' : ''}}>PAYPAL</option>
      @endif
    </select>
    @error('tipo_pagamento')
    <div class="error">
      {{$message}}
    </div>
    @enderror
  </div>
</div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="ref_pagamento">Ref. Pagamento</label>  
      <div class="col-md-4">
        <input id="ref_pagamento" name="ref_pagamento" type="text" placeholder="" class="form-control input-md" value="{{old('ref_pagamento')  ?? $cliente->ref_pagamento ?? ''}}">
        @error('ref_pagamento')
        <div class="error">
          {{$message}}
        </div>
        @enderror
      </div>
    </div>

    <!-- Button (Double) -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="submit"></label>
      <div class="col-md-8">
            @if (isset($cliente))
              <button id="submit" name="submit" class="btn btn-success">Guardar</button>
            @else
              <button id="submit" name="submit" class="btn btn-success">Criar</button>
            @endif
              <a href="{{url()->previous()}}" class="btn btn-danger">Cancelar</a>

      </div>
    </div>

 </form>
</fieldset> 

@endsection