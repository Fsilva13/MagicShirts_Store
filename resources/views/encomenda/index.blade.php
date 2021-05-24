@extends('layouts.app')
<form class="form-horizontal" action="{{route(encomenda.php)}}">
<fieldset>

<legend>Encomendas</legend>

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
  <label class="col-md-4 control-label" for="endereco">endereco</label>  
  <div class="col-md-4">
  <input id="endereco" name="endereco" type="text" placeholder="endereco..." class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nif">Nif</label>  
  <div class="col-md-4">
  <input id="nif" name="nif" type="text" placeholder="nif..." class="form-control input-md">
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="metpag">Metodo de Pagamento</label>
  <div class="col-md-4">
    <select id="metpag" name="metpag" class="form-control">
      <option value="Visa">Visa</option>
      <option value="MC">MC</option>
      <option value="Paypal">Paypal</option>
    </select>
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="notas">Notas</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="notas" name="notas"></textarea>
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
