<?php

namespace App\Http\Controllers;
use App\Encomenda;

use Illuminate\Http\Request;

class EncomendasController extends Controller
{

    public function index()
    {
        $encomenda = Encomenda::all();
       return view('encomenda.list', compact('encomenda'));
   }
 
   public function store(Request $request){
   		$rules = [
   		'nif' => 'required|digits:9',
   		'endereco'=> 'required',
   		'tipo_pagamento' => 'required',
   		'data' => 'required'

   	];

   	$messages = [
			 'nif.required' => 'É obrigatório ter um nif',
			 'nif.digits' => 'O nif tem que ter 9 digitos',
			 'endereco.required' => 'é obrigatório ter endereco',
			 'tipo_pagamento.required' => 'é obrigatorio ',
			 'data.required' => 'insira a data'
			 ];

   		$input = $request->validate($rules, $messages);
 		$encomenda = Encomenda::create($input);

 		if($encomenda) {
        return redirect()->route('encomenda.index');
    }
   }

    public function create(){
   
		return view('encomenda.create');
   }

	public function edit($id)
	{
	    $encomenda = Encomenda::findOrFail($id);
	 
	    if ($encomenda) {
	        return view('encomenda.list', compact('encomenda'));
	    } else {
	        return redirect()->back();
	    }
	}

	public function update(Request $request, $id)
	{
    $encomenda = Encomenda::where('id', $id)->update($request->except('_token', '_method'));
 
    if ($encomenda) {
        return redirect()->route('customers.list');
    }
	}
}