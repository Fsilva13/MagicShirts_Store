<?php

namespace App\Http\Controllers;

use App\Encomenda;
use App\Mail\NotificarPendente;
use App\Preco;
use App\Tshirt;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class EncomendasController extends Controller
{

	public function index()
	{
		$encomenda = Encomenda::paginate(15);
		return view('Encomenda.list', compact('encomenda'));
	}

	public function store(Request $request)
	{

		$rules = [
			'nif' => 'required|digits:9',
			'endereco' => 'required|string',
			'tipo_pagamento' => ['required', Rule::in(['MC', 'PAYPAL', 'VISA'])],
			'ref_pagamento' => ['required', $request->tipo_pagamento == 'PAYPAL' ? 'email' : 'digits:16'],
			'notas' => 'sometimes',
		];

		$messages = [
			'nif.required' => 'Nif Obrigatório',
			'nif.digits' => 'O nif tem que ter 9 digitos',
			'endereco.required' => 'Endereço Obrigatório',
			'tipo_pagamento.required' => 'Tipo pagamento obrigatório',
			'tipo_pagamento.in' => 'Tipo de pagamento Invalido',
			'ref_pagamento.email'	=> 'Email da Ref.Pagamento Invalido',
			'ref_pagamento.digits' => 'Ref.Pagamento Invalida',
		];

		$input =  $request->validate($rules, $messages);

		$input['estado'] = 'pendente';
		$input['cliente_id'] = Auth::user()->cliente->id;
		$input['data'] = date('Y-m-d');

		$cart_items = Cart::content();
		$precos = Preco::all()->first();
		$preco_total = 0;

		foreach ($cart_items as $item) {
			if ($item->model->cliente_id) {
				if ($item->qty >= $precos->quantidade_desconto) {
					$preco_un = $precos->preco_un_proprio_desconto;
				} else {
					$preco_un = $precos->preco_un_proprio;
				}
			} else {
				if ($item->qty >= $precos->quantidade_desconto) {
					$preco_un = $precos->preco_un_catalogo_desconto;
				} else {
					$preco_un = $precos->preco_un_catalogo;
				}
			}
			$preco_total += $preco_un;
		}
		$input['preco_total'] = $preco_total * 1.23;
		$encomenda = Encomenda::create($input);

		foreach ($cart_items as $item) {
			if ($item->model->cliente_id) {
				if ($item->qty >= $precos->quantidade_desconto) {
					$preco_un = $precos->preco_un_proprio_desconto;
				} else {
					$preco_un = $precos->preco_un_proprio;
				}
			} else {
				if ($item->qty >= $precos->quantidade_desconto) {
					$preco_un = $precos->preco_un_catalogo_desconto;
				} else {
					$preco_un = $precos->preco_un_catalogo;
				}

				Tshirt::create([
					'encomenda_id' => $encomenda->id,
					'estampa_id' => $item->model->id,
					'cor_codigo' => $item->options['cor']->codigo,
					'tamanho' => $item->options['tamanho'],
					'quantidade' => $item->qty,
					'preco_un' => $preco_un,
					'subtotal' => $item->qty * $preco_un,
				]);
			}
		}
			
		if ($encomenda) {
			Session::flash('success', "Registro #{$encomenda->id} criada com sucesso!");
			Cart::destroy();
			Mail::to(Auth::user()->email)->send(new NotificarPendente($encomenda));
			return redirect()->route('estampas.list');
		}
		return redirect()->back()->withErrors(['error', "Registo não foi salvo."]);
	}

	public function create()
	{
		return view('encomenda.create');
	}

	public function edit($id)
	{
		$encomenda = Encomenda::findOrFail($id);

		if ($encomenda) {
			return view('encomenda.create', compact('encomenda'));
		} else {
			return redirect()->back();
		}
	}

	public function update(Request $request, $id)
	{
		$encomenda = Encomenda::find($id)->update($request->except('_token', '_method'));

		if ($encomenda) {
			Session::flash('success', "Registro #{$id} atualizado com êxito");

			return redirect()->route('encomenda.list');
		}
		return redirect()->back()->withErrors(['error', "Registo #{$id} não foi encontrado"]);
	}

	public function destroy($id)
	{
		$encomenda = Encomenda::find($id)->delete();

		if ($encomenda) {

			Session::flash('success', "Registro #{$id} excluído com êxito");

			return redirect()->route('cliente.list');
		}
		return redirect()->back()->withErrors(['error', "Registo #{$id} não pode ser excluído"]);
	}
}
