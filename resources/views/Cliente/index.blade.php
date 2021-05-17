@extends('layouts.app')

@section('content')
<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>ClientsForm</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="NIF">NIF</label>  
  <div class="col-md-4">
  <input id="NIF" name="NIF" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="endereco">Endereço</label>  
  <div class="col-md-4">
  <input id="endereco" name="endereco" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="tipo_pagamento">Tipo de Pagamento</label>
  <div class="col-md-4">
    <select id="tipo_pagamento" name="tipo_pagamento" class="form-control">
      <option value="">VISA</option>
      <option value="">MC</option>
      <option value="">PAYPAL</option>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="ref_pagamento">Ref. Pagamento</label>  
  <div class="col-md-4">
  <input id="ref_pagamento" name="ref_pagamento" type="text" placeholder="" class="form-control input-md">
    
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
