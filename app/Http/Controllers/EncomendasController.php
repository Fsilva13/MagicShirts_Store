<?php

namespace App\Http\Controllers;
use App\Encomenda;

use Illuminate\Http\Request;

class EncomendasController extends Controller
{

/*    public function index()
    {
        $encomenda = Encomenda::all();

       return view('encomenda.index', compact('encomenda'));
   }
*/
      public function create(){
   		return view('encomenda.create');
   }
   
   public function store(Request $request){
   		$rules = ['estado'=> 'nullable',
   		'notas' => 'nullable',
   		'nif' => 'required|digits:9',
   		'endereco'=> 'required',
   		'metpag' => 'required'

   	];

   	$messages = [
			 'nif.required' => 'É obrigatório ter um nif',
			 'nif.digits' => 'O nif tem que ter 9 digitos',
			 'endereco.required' => 'é obrigatório ter endereco',
			 'metpag.required' => 'é obrigatorio '
			 ];

   		$input = $request->validate($rules, $messages);
 		$novaEncomenda = Encomenda::create($input);

 		
   }

<<<<<<< Updated upstream

=======
   public function create(){
   		return view('encomenda.index');
   }
>>>>>>> Stashed changes
}