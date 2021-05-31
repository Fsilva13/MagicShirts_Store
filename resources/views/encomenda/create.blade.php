@extends('layouts.app')
<form class="form-horizontal" method="post" action="{{route('encomenda.store')}}">
  @CSRF
  <fieldset>

    <legend>Encomendas</legend>

<div class="form-group">
      <label class="col-md-4 control-label" for="cliente_id">Cliente</label>  
      <div class="col-md-4">
        <input id="cliente_id" name="cliente_id" type="text" placeholder="" class="form-control input-md"  value="{{old('cliente_id')}}">
        @error('ref_pagamento')
        <div class="error">
          {{$message}}
        </div>
        @enderror
        
      </div>
    </div>


    <div class="form-group">
      <label class="col-md-4 control-label" for="estado">Estado</label>
      <div class="col-md-4">
        <select id="estado" name="estado" class="form-control">
          <option value="Pendente">Pendente</option>
          <option value="Paga">Paga</option>
          <option value="Fechada">Fechada</option>
          <option value="Anulada">Anulada</option>
        </select>
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

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="NIF">NIF</label>  
      <div class="col-md-4">
        <input id="NIF" name="NIF" type="text" placeholder="" class="form-control input-md"  value="{{old('NIF')}}">
        @error('NIF')
        <div class="error">
          {{$message}}
        </div>
        @enderror
        
      </div>
    </div>

<div class="form-group">
      <label class="col-md-4 control-label" for="preco_total">Preço</label>  
      <div class="col-md-4">
        <input id="preco_total" name="preco_total" type="number" placeholder="" class="form-control input-md"  value="{{old('preco_total')}}">
        @error('preco_total')
        <div class="error">
          {{$message}}
        </div>
        @enderror
        
      </div>
    </div>



    <div class="form-group">
      <label class="col-md-4 control-label" for="ref_pagamento">Referencia</label>  
      <div class="col-md-4">
        <input id="ref_pagamento" name="ref_pagamento" type="text" placeholder="" class="form-control input-md"  value="{{old('ref_pagamento')}}">
        @error('ref_pagamento')
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

    <!-- Textarea -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="notas">Notas</label>
      <div class="col-md-4">                     
        <input type="text" class="form-control" id="notas" name="notas"></input>
        @error('notas')
        <div class="error">
          {{$message}}
        </div>
        @enderror
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="data">Data</label>
      <div class="col-md-4">                     
       <input type="date" name="data" id="data" placeholder="2021-05-24" class="form-control input-md" value="{{old('data')}}">
       @error('data')
        <div class="error">
          {{$message}}
        </div>
        @enderror
     </div>
   </div>


   <!-- Button (Double) -->
   <div class="form-group">
    <label class="col-md-4 control-label" for="button1id">Double Button</label>
    <div class="col-md-8">
      <button id="button1id" name="Submit" class="btn btn-success">Submit</button>
      <button id="button2id" name="delete" class="btn btn-danger">Delete</button>
    </div>
  </div>


</fieldset>
</form>
