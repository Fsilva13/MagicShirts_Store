@extends('layouts.app')

@section('content')
<form class="form-horizontal" method="post" action="{{route('estampa.store')}}">
@CSRF
  <fieldset>

    <legend>Nova Estampa</legend>

    <div class="form-group">
      <label class="col-md-4 control-label" for="textinput">Nome</label>
      <div class="col-md-4">
        <input id="textinput" name="nome" type="text" placeholder="- Nome Estampa -" class="form-control input-md" value="{{old('nome')}}">
        @error('nome')
        <div class="error">
          {{$message}}
        </div>
        @enderror
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="textarea">Descrição</label>
      <div class="col-md-4">
        <textarea class="form-control" id="textarea" name="descricao" value="{{old('descricao')}}">- Descrição Estampa</textarea>
        @error('descricao')
        <div class="error">
          {{$message}}
        </div>
        @enderror
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="filebutton">Upload Estampa</label>
      <div class="col-md-4">
        <input id="filebutton" name="filebutton" class="input-file" type="file">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="singlebutton"></label>
      <div class="col-md-4">
        <button id="singlebutton" name="singlebutton" class="btn btn-primary">Guardar</button>
      </div>
    </div>

  </fieldset>
</form>
@endsection