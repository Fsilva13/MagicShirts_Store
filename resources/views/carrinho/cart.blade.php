@extends('layouts.app')

@section('content')
@include('layouts.messages')

<body>
    <main>
        <div class="basket">
            <div class="basket-labels">
                <ul>
                    <li class="item item-heading">Item</li>
                    <li class="price">Price</li>
                    <li class="quantity">Quantity</li>
                    <li class="subtotal">Subtotal</li>
                </ul>
            </div>
            
            @foreach (Cart::content() as $item)

            <div class="basket-product">
                <div class="item">
                    <div class="product-image">
                        <img id="estampa" src="{{$item->model->cliente_id ? route('estampas.privadas.imagem', $item->model->id) : asset('storage/estampas/' . $item->model->imagem_url) }}" alt="Placholder Image " >
                        <img id="shirt" src="{{asset('storage/tshirt_base/'. $item->options['cor']->codigo) . '.jpg'}}" alt="Placholder Image "
                            class="product-frame">

                    </div>
                    <div class="product-details">
                        
                        <h1><strong><span class="item-quantity">{{$item->qty}}</span> x Tshirt {{$item->model->nome}}</strong></h1>
                        <p><strong>{{ $item->options['cor']->nome}}, {{$item->options['tamanho']}}</strong></p>
                    </div>
                </div>
                <div class="price">{{$item->price}}</div>
                <div class="quantity">
                    <input type="number" value="{{$item->qty}}" min="1" max="" class="quantity-field">
                </div>
                <div class="subtotal">{{$item->subtotal()}}</div>
                <div class="remove">
                    <form action="{{ route('carrinho.destroy', ['id' => $item->rowId]) }}" method="POST">
                        @csrf
                        {{method_field('Delete')}}
                        <button type="submit" class="cart_options">Remover</button>
                    </form>
                </div>
            </div>
            @endforeach

        </div>
        <aside>
            <div class="summary">
                <div class="summary-total-items"><span class="total-items"></span> Itens no Carrinho</div>
                <div class="summary-subtotal">
                    <div class="subtotal-title">Subtotal</div>
                    <div class="subtotal-value final-value" id="basket-subtotal">{{Cart::subtotal()}}</div><br>

                    <div class="summary-total">
                        <div class="total-title">IVA(23%)</div>
                        <div class="total-value final-value" id="basket-tax">{{Cart::tax()}}</div>
                        <div class="total-title">Total</div>
                        <div class="total-value final-value" id="basket-total">{{Cart::total()}}</div>
                    </div>
                    <div class="summary-checkout">
                        @if(Cart::count() == 0)
                        <a href="{{route('estampas.list')}}"> <button class="checkout-cta">Voltar à loja</button></a>
                        @else
                        @if (Auth::user())
                        <a href="{{route('encomenda.create')}}"> <button class="checkout-cta">Comprar</button></a><br>
                        <a href="{{route('estampas.list')}}"> <button class="checkout-cta">Voltar à loja</button></a>
                        @else
                        <a href="{{route('register')}}"> <button class="checkout-cta">Criar conta
                                cliente</button></a><br>
                        @endif
                        @endif
                    </div>
                </div>
        </aside>
    </main>
</body>
<script src="{{ asset('js/carrinho.js') }}" defer></script>

</html>
@endsection