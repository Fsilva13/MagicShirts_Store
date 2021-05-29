<?php

namespace App\Http\Controllers;
use App\Cliente;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientesController extends Controller
{
  
    public function index()
    {
        $cliente = Cliente::all();
       return view('Cliente.list', compact('cliente'));
   } 

      public function store(Request $request){

   		$rules = [
   		'Id' => 'required|numeric|unique:Clientes,Id',
  		'NIF' => 'required|digits:9|unique:Clientes,NIF',
  		'endereco' => 'required',
  		'tipo_pagamento' => 'required',
  		'ref_pagamento' => 'required',
    	];

   	$messages = [
   			'Id.required' => 'Id Invalido!',
   			'Id.unique' => 'Este Id já se encontra registado',
			 'NIF.digits' => 'O nif tem que ter 9 digitos',
			 'NIF.unique' => 'O NIF já se encontra registado',
			 'endereco.required' => 'NIF invalido!',
			 'tipo_pagamento' => 'Tipo pagamento errado',
			 'ref_pagamento' => 'Referencia Invalida',
			 ];


   		  $input = $request->validate($rules, $messages);
 		  $novoCliente = Cliente::create($input);

 	  return redirect()->route('home');	
   }

    public function create(){
   		return view('cliente.create');
   }

   public function destroy($id)
{
    $cliente = Cliente::findOrFail($id);
    $cliente->delete();
       
    
    return redirect()->route('cliente.list');
    
}
}