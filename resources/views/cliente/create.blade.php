@extends('layouts.app')
@include('layouts.messages')

@section('content')
<form class="form-horizontal" method="post" action="{{ route('cliente.store') }}">
  @CSRF

  <fieldset>

    <!-- Form Name -->
    <legend>Clientes</legend>

    <!-- Text input-->
    <div class="form-group">
      <div class="col-md-4">
        <input id="Id" name="Id" type="hidden" placeholder="" class="form-control input-md" required="" value="{{Auth::id()}}" readonly>        
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="NIF">NIF</label>  
      <div class="col-md-4">
        <input id="NIF" name="NIF" type="text" placeholder="" class="form-control input-md" required="" value="{{old('NIF')}}">
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
        <input id="endereco" name="endereco" type="text" placeholder="" class="form-control input-md" required="" value="{{old('endereco')}}">
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
      <option value="VISA" {{old('tipo_pagamento')}} == {{ 'VISA'? 'Selected' : ''}}>VISA</option>
      <option value="MC"{{old('tipo_pagamento')}} == {{'MC'? 'Selected' : ''}}>MC</option>
      <option value="PAYPAL"{{old('tipo_pagamento')}} == {{ 'PAYPAL'? 'Selected' : ''}}>PAYPAL</option>
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
        <input id="ref_pagamento" name="ref_pagamento" type="text" placeholder="" class="form-control input-md" value="{{old('ref_pagamento')}}">
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
        <button id="submit" name="submit" class="btn btn-success">Guardar</button>
        <button id="cancel" name="cancel" class="btn btn-danger">Cancelar</button>
      </div>
    </div>

  </fieldset>
</form>
@endsection
