<?php

namespace App\Http\Controllers;

use App\Encomenda;
use App\Mail\NotificarAnulada;
use App\Mail\NotificarFechada;
use App\Mail\NotificarPaga;
use App\Mail\NotificarPendente;
use App\Preco;
use App\Tshirt;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use PDF;

class EncomendasController extends Controller
{

	public function index()
	{
		$tipo_user = Auth::user()->tipo;

		switch ($tipo_user) {
			case 'C':
				$encomendas = Encomenda::where('cliente_id', '=', Auth::user()->id)->orderBy('estado', 'desc')->paginate(15);
				break;
			case 'F':
				$encomendas = Encomenda::whereIn('estado', ['pendente', 'paga'])->paginate(15);
				break;
			case 'A':
				$encomendas = Encomenda::paginate(15);
				break;
		}
		return view('Encomenda.list', compact('encomendas'));
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
			Session::flash('success', "A encomenda #{$encomenda->id} foi criada com sucesso!");
			Cart::destroy();
			Mail::to(Auth::user()->email)->send(new NotificarPendente($encomenda));
			return redirect()->route('estampas.list');
		}
		return redirect()->back()->withErrors(['error', "Erro na Encomenda!"]);
	}

	public function create()
	{
		return view('encomenda.create');
	}

	public function update(Request $request, Encomenda $encomenda)
	{
		$request->validate(['estado' => ['required', Rule::in(['paga', 'fechada','anulada'])]]);

		$encomenda->estado = request()->estado;

		if ($request->estado == 'paga') {
			Mail::to(Auth::user()->email)->send(new NotificarPaga($encomenda));
		} elseif($request->estado == 'fechada') {
			// Generate PDF
			// share data to view
			$pdf = PDF::loadView('pdf.pdf_view', compact('encomenda'));

			Storage::put('pdf_recibos/' . $encomenda->id . '.pdf', $pdf->output());

			$encomenda->recibo_url = $encomenda->id . '.pdf';

			Mail::to(Auth::user()->email)->send(new NotificarFechada($encomenda));
		}else{
			Mail::to(Auth::user()->email)->send(new NotificarAnulada());
		}

		$encomenda->save();

		return redirect()->back()->with(['success', "A encomenda #{$encomenda->id} foi atualizada com sucesso!"]);
	}

	public function pdf(Encomenda $encomenda)
	{
		if ($encomenda->recibo_url) {
			$headers = array(
				'Content-Type: application/pdf',
			);

			return response()->download(storage_path('app/pdf_recibos/' . $encomenda->recibo_url, 'Fatura' . $encomenda->id . '.pdf', $headers));
		}

		abort(404,'Ficheiro não encontrado!');
	}

}
