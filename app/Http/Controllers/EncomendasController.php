<?php

namespace App\Http\Controllers;
use App\Encomenda;
use App\Cliente;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EncomendasController extends Controller
{

    public function index()
    {
        $encomenda = Encomenda::paginate(15);
		$clientes = Encomenda::with('clientes');
		return view('Encomenda.list', compact('encomenda'))->with('clientes',$clientes);
   }
 
   public function store(Request $request){
   		$rules = ['estado' => 'required','cliente_id' => 'required',
      'data' => 'required', 'preco_total'=> 'required', 'notas'=> 'required',
      'nif' => 'required', 'endereco' => 'required', 'tipo_pagamento'=> 'required',
      'ref_pagamento' => 'required'
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
		Session::flash('success', "Registro #{$novoCliente->id}  salvo com êxito");
        return redirect()->route('welcome');
    }
		return redirect()->back()->withErrors(['error', "Registo não foi salvo."]);
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
		$encomenda = Encomenda::find($id)->update($request->except('_token', '_method'));
	 
		if ($encomenda) {	   
	  		Session::flash('success', "Registro #{$id} atualizado com êxito");
	   
	  		return redirect()->route('encomenda.list');
		}
			return redirect()->back()->withErrors(['error', "Registo #{$id} não foi encontrado"]);
	}

	public function destroy($id)
	{
		//TODO
		if ($cliente) {
   
			Session::flash('success', "Registro #{$id} excluído com êxito");
	  
			return redirect()->route('cliente.list');
	   } 
	   return redirect()->back()->withErrors(['error', "Registo #{$id} não pode ser excluído"]);
	}
}