<?php

namespace App\Http\Controllers;
use App\Estampa

use Illuminate\Http\Request;

class EstampasController extends Controller
{
    public function index()
    {
        $estampa = Estampa::all();

       return view('Estampa.index', compact('estampa'));
   }

   public function store(Request $request){
    $rules = ['nome'=> 'required',
    'descricao' => 'nullable'
];

$messages = [
      'nome.required' => 'É obrigatório ter um nome',
      ];

    $input = $request->validate($rules, $messages);
  $novaEstampa = Estampa::create($input);

  
}

public function create(){
    return view('Estampa.index');
}
}