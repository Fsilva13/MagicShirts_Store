<?php

namespace App\Http\Controllers;

use App\Cor;
use App\Estampa;
use App\Preco;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Carrinho.cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $duplicado = Cart::search(function ($carItem, $rowId) use ($request) {
            return $carItem->id === $request->id and $carItem->tamanho === $request->tamanho and $carItem->cor === $request->cor;
        });

        if ($duplicado->isNotEmpty()) {
            return redirect()->route('carrinho.index')->withErrors(["Item já se encontra no Carrinho!"]);
        }
        $estampa = Estampa::find($request->id);
        $precos = Preco::all()->first();

        if ($estampa->cliente_id) {
            if ($request->quantidade >= $precos->quantidade_desconto) {
                $preco_un = $precos->preco_un_proprio_desconto;
            } else {
                $preco_un = $precos->preco_un_proprio;
            }
        } else {
            if ($request->quantidade >= $precos->quantidade_desconto) {
                $preco_un = $precos->preco_un_catalogo_desconto;
            } else {
                $preco_un = $precos->preco_un_catalogo;
            }
        }

        $cor = Cor::find($request->cor_codigo);
        Cart::add($request->id, $estampa->nome, $request->quantidade, $preco_un, ['tamanho' => $request->tamanho, 'cor' => $cor])->associate('App\Estampa');

        Session::flash('success', "Item Adicionado!");

        return redirect()->route('carrinho.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);

        return back();
    }
}
