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

   public function destroy($id)
{
    //TODO
   /* foreach ($encomenda as $enc) { 

        $EncomendaAns = Encomenda::where('cliente_id',$enc->id)->get()->first();

         $EncomendaAns->delete();

     }
*/
    $cliente = Cliente::find($id)->delete();
 
    if ($cliente) {
   
         Session::flash('success', "Registro excluído com êxito");
   
         return redirect()->route('cliente.list');
    } 
    return redirect()->back()->withErrors(['error', "Registo não pode ser excluído"]);
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
   
  Session::flash('success', "Conta atualizada com êxito");
   
  return redirect()->back();
    }
    return redirect()->back()->withErrors(['error', "Registo não foi encontrado"]);
}
}