<?php

namespace App\Http\Controllers;
use App\Cliente;
use App\User;
use App\Encomenda;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientesController extends Controller
{
  
    public function index()
    {
        $cliente = Cliente::paginate(15);
        $user = Cliente::with('user');
       return view('Cliente.list', compact('cliente'))->with('user',$user);
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

    if ($novoCliente) { 
        Session::flash('success', "Registro #{$novoCliente->id}  salvo com êxito");
 
        return redirect()->route('welcome');
    }
        return redirect()->back()->withErrors(['error', "Registo não foi salvo."]);
   }


    public function create(){
   		return view('cliente.create');
   }


   public function destroy($id)
{

    foreach ($encomenda as $enc) { 

        $EncomendaAns = Encomenda::where('cliente_id',$enc->id)->get()->first();

         $EncomendaAns->delete();

     } //->where('is_complete',1) $users->delete();

    $cliente = Cliente::find($id)->delete();;
 
    if ($cliente) {
   
         Session::flash('success', "Registro #{$id} excluído com êxito");
   
         return redirect()->route('cliente.list');
    } 
    return redirect()->back()->withErrors(['error', "Registo #{$id} não pode ser excluído"]);
}

public function edit($id)
{
    $cliente = Cliente::findOrFail($id);
 
    if ($cliente) {
        return view('cliente.create', compact('cliente'));
    } else {
        return redirect()->back();
    }
}

public function update(Request $request, $id)
{
    $cliente = Cliente::find($id)->update($request->except('_token', '_method'));
 
    if ($cliente) {
   
  Session::flash('success', "Registro #{$id} atualizado com êxito");
   
  return redirect()->route('cliente.list');
    }
    return redirect()->back()->withErrors(['error', "Registo #{$id} não foi encontrado"]);
}
}
