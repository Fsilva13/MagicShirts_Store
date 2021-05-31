<?php

namespace App\Http\Controllers;
use App\Estampa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EstampasController extends Controller
{
    /*public function index()
    {
        $estampa = Estampa::all();

       return view('Estampa.index', compact('estampa'));
   }*/

   public function store(Request $request){

    if($request->hasFile('imagem')){

    $rules = [
        'nome'=> 'required',
        'descricao' => 'nullable',
        'imagem' => 'mimes:jpeg,png,gif'
    ];

    $messages = [
      'nome.required' => 'É obrigatório ter um nome',
      'imagem.required' => 'Ficheiro inválido ou não selecionado'
      ];

    $input = $request->validate($rules, $messages);

    $request->file->store('estampas');

   /* $estampa = new Estampa([
        "nome" => $request->get('nome'),
        "descricao" => $request->get('descricao'),
        "imagem_url" => $request->file->hashName()

    ]);
     */  
    $novaEstampa = Estampa::create($input);
 
    }
        }

public function create(){
    return view('Estampa.index');
}


}