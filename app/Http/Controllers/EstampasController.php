<?php

namespace App\Http\Controllers;

use App\Cor;
use App\Estampa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EstampasController extends Controller
{
    public function index()
    {
        $privada = false;
        $estampas = Estampa::whereNull('cliente_id')->paginate(12);
        $cores = Cor::all();
        return view('estampa.list', compact('estampas', 'cores', 'privada'));
    }

    public function store(Request $request)
    {

            $rules = [
                'nome' => 'required',
                'descricao' => 'nullable',
                'imagem' => 'required|image'
            ];

            $messages = [
                'nome.required' => 'É obrigatório ter um nome',
                'imagem.required' => 'Ficheiro inválido ou não selecionado'
            ];

            $request->validate($rules, $messages); //verifica rules
            Storage::put('estampas_privadas', $request->imagem);
    

        $estampa = Estampa::create([
        "nome" => $request->get('nome'),
        "cliente_id" => Auth::user()->id,
        "descricao" => $request->get('descricao'),
        "imagem_url" => $request->imagem->hashName()
    ]);
     return redirect()->route('estampas.privadas')->with('success', 'Estampa criada com sucesso!');
    }

    public function create()
    {
        return view('Estampa.create');
    }

    public function privadas()
    {
        $privada = true;
        $estampas = Estampa::where('cliente_id', '=', Auth::user()->id)->paginate(12);
        $cores = Cor::all();
        return view('estampa.list', compact('estampas', 'cores', 'privada'));
    }

    public function imagem(Estampa $estampa){
        return response()->file(storage_path('app/estampas_privadas/'.$estampa->imagem_url ));
    }
}
