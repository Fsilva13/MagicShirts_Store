<?php

namespace App\Http\Controllers;
use App\Preco;

use Illuminate\Http\Request;

class PrecosController extends Controller
{
    public function index()
    {
        $precos = Preco::all();

       return view('Preco.list', compact('precos'));
   }

   public function edit($id)
   {
       $preco = Preco::find($id);

       if ($preco) {
           return view('preco.edit', compact('preco'));
       }
   }

   public function update(Request $request, $id)
   {
       $preco= Preco::find($id);
       if ($preco) {
           $preco->update($request->except('_token', '_method'));
       }

      
       return redirect()->route('preco.list')->with('success', 'Cor atualizada com êxito!');
       
   }
}