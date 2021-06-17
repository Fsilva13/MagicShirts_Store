@extends('layouts.app')


@section('content')
@include('layouts.messages')
<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<div class="container">

    @if(isset($encomenda))

    {!! Form::model($encomenda, ['method' => 'put', 'route' => ['encomenda.update', $encomenda->id ], 'class' =>
    'form-horizontal']) !!}

    @else

    {!! Form::open(['method' => 'post','route' => 'encomenda.store', 'class' => 'form-horizontal']) !!}

    @endif

    @CSRF

    <fieldset>

        <!-- Form Name -->
        <div class="col-md-4">
            <div class="card-header">
                <span class="card-title">
                    @if (isset($encomenda))
                    Editar encomenda #{{ $encomenda->id }}
                    @else
                    Criar nova encomenda
                    @endif
                </span>
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-4 control-label" for="estado">Estado</label>
            <div class="col-md-4">
                <select id="estado" name="estado" class="form-control">
                    @if (isset($encomenda))
                    @foreach(["pendente" => "Pendente", "paga" => "Paga", "fechada" => "Fechada" , "anulada" =>
                    "Anulada"]
                    AS $estado => $encomendaLabel)
                    <option value="{{ $estado }}" {{ old("estado", $encomenda->estado) == $estado ? "selected" : "" }}>
                        {{ $encomendaLabel }}</option>
                    @endforeach
                    @else
                    <option value="VISA" {{old('estado')}}=={{ 'Pendente'? 'Selected' : ''}}>Pendente</option>
                    <option value="MC" {{old('estado')}}=={{'Paga'? 'Selected' : ''}}>Paga</option>
                    <option value="PAYPAL" {{old('estado')}}=={{ 'Fechada'? 'Selected' : ''}}>Fechada</option>
                    <option value="PAYPAL" {{old('estado')}}=={{ 'Anulada'? 'Selected' : ''}}>Anulada</option>
                    @endif
                </select>
                @error('estado')
                <div class="error">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="cliente_id">Cliente</label>
            <div class="col-md-4">
                <input id="cliente_id" name="cliente_id" type="text" placeholder="" class="form-control input-md"
                    value="{{old('cliente_id') ?? $encomenda->cliente_id ?? '' }}">
                @error('cliente_id')
                <div class="error">
                    {{$message}}
                </div>
                @enderror

            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="data">Data</label>
            <div class="col-md-4">
                <input type="date" name="data" id="data" placeholder="2021-05-24" class="form-control input-md"
                    value="{{old('data') ?? $encomenda->data ?? '' }}">
                @error('data')
                <div class="error">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="preco_total">Preço</label>
            <div class="col-md-4">
                <input id="preco_total" name="preco_total" type="number" placeholder="" class="form-control input-md"
                    value="{{old('preco_total') ?? $encomenda->preco_total ?? '' }}">
                @error('preco_total')
                <div class="error">
                    {{$message}}
                </div>
                @enderror

            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="notas">Notas</label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="notas" name="notas"
                    value="{{old('preco_total') ?? $encomenda->notas ?? '' }}">
                @error('notas')
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
                <input id="nif" name="nif" type="text" placeholder="" class="form-control input-md"
                    value="{{old('nif') ?? $encomenda->nif ?? '' }}">
                @error('nif')
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
                <input id="endereco" name="endereco" type="text" placeholder="" class="form-control input-md"
                    required="" value="{{old('endereco') ?? $encomenda->endereco ?? '' }}">
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
                    @if (isset($encomenda))
                    @foreach(["VISA" => "VISA", "MC" => "Multibanco", "PAYPAL" => "PAYPAL"] AS $tipo_pagamento =>
                    $encLabel)
                    <option value="{{ $tipo_pagamento }}"
                        {{ old("tipo_pagamento", $encomenda->tipo_pagamento) == $tipo_pagamento ? "selected" : "" }}>
                        {{ $encLabel }}</option>
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
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="ref_pagamento">Referencia</label>
            <div class="col-md-4">
                <input id="ref_pagamento" name="ref_pagamento" type="text" placeholder="" class="form-control input-md"
                    value="{{old('ref_pagamento') ?? $encomenda->ref_pagamento ?? '' }}">
                @error('ref_pagamento')
                <div class="error">
                    {{$message}}
                </div>
                @enderror

            </div>
        </div>
    </fieldset>
    <!-- Button (Double) -->
    <div class="form-group">
        <label class="col-md-4 control-label" for="button1id"></label>
        <div class="col-md-8">
            @if (isset($encomenda))
            <button id="submit" name="submit" class="btn btn-success">Guardar</button>
            @else
            <button id="submit" name="submit" class="btn btn-success">Criar</button>
            @endif
            <a href="{{url()->previous()}}" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
    </form>
</div>
<div class="checkout-table-container">
    <h2>Your Order</h2>

    <div class="checkout-table">
        @foreach (Cart::content() as $item)
        <div class="checkout-table-row">
            <div class="checkout-table-row-left">
                <img src="{{ productImage($item->model->image) }}" alt="item" class="checkout-table-img">
                <div class="checkout-item-details">
                    <div class="checkout-table-item">{{ $item->model->name }}</div>
                    <div class="checkout-table-description">{{ $item->model->details }}</div>
                    <div class="checkout-table-price">{{ $item->model->presentPrice() }}</div>
                </div>
            </div> <!-- end checkout-table -->

            <div class="checkout-table-row-right">
                <div class="checkout-table-quantity">{{ $item->qty }}</div>
            </div>
        </div> <!-- end checkout-table-row -->
        @endforeach

    </div> <!-- end checkout-table -->

    <div class="checkout-totals">
        <div class="checkout-totals-left">
            Subtotal <br>
            @if (session()->has('coupon'))
            Discount ({{ session()->get('coupon')['name'] }}) :
            <br>
            <hr>
            New Subtotal <br>
            @endif
            Tax ({{config('cart.tax')}}%)<br>
            <span class="checkout-totals-total">Total</span>

        </div>

        <div class="checkout-totals-right">
            {{Cart::subtotal() }} <br>
            <span class="checkout-totals-total">0</span>
        </div>
    </div> <!-- end checkout-totals -->
</div>
</div> <!-- end checkout-section -->
</div>
@endsection