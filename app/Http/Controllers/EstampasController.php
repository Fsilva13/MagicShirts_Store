<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Cor;
use App\Estampa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class EstampasController extends Controller
{
    public function index(Request $request)
    {
        $estampas = Estampa::whereNull('cliente_id');


        if ($request->inputsearch) {

            $categorias_id = [];

            $categorias = Categoria::where('nome', 'like', '%' . $request->inputsearch . '%')->get('id');
            foreach ($categorias as $categoria) {
                array_push($categorias_id, strval($categoria->id));
            }

            $estampas->where('nome', 'like', '%' . $request->inputsearch . '%')
                ->orWhere('descricao', 'like', '%' . $request->inputsearch . '%')
                ->orWhereIn('categoria_id', $categorias_id);
        }

        if ($request->categoria_id != null) {
            $estampas->where('categoria_id', '=', $request->categoria_id);
        }

        $estampas = $estampas->paginate(12);


        $privada = false;
        $cores = Cor::all();
        $categorias = Categoria::all();
        $request->flash();
        return view('estampa.list', compact('estampas', 'cores', 'privada', 'categorias'));
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


        if (Auth::user()->tipo != 'C') {

            Storage::put('public/estampas', $request->imagem);

            $estampa = Estampa::create([
                "nome" => $request->get('nome'),
                "descricao" => $request->get('descricao'),
                "imagem_url" => $request->imagem->hashName()
            ]);

            return redirect()->route('estampas.list')->with('success', 'Estampa criada com sucesso!');
        } else {

            Storage::put('estampas_privadas', $request->imagem);

            Estampa::create([
                "nome" => $request->get('nome'),
                "cliente_id" => Auth::user()->id,
                "descricao" => $request->get('descricao'),
                "imagem_url" => $request->imagem->hashName()
            ]);

            return redirect()->route('estampas.privadas')->with('success', 'Estampa criada com sucesso!');
        }
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

    public function imagem(Estampa $estampa)
    {
        return response()->file(storage_path('app/estampas_privadas/' . $estampa->imagem_url));
    }

    public function edit(Estampa $estampa)
    {
        return view('estampa.create', compact('estampa'));
    }

    public function destroy(Estampa $estampa)
    {
        $estampa->delete();

        return redirect()->route('estampas.list')->with('success', "Estampa excluída com êxito");
    }

    public function update(Request $request, Estampa $estampa)
    {
        $rules = [
            'nome' => 'required',
            'descricao' => 'nullable',
            'imagem' => 'image'
        ];

        $messages = [
            'nome.required' => 'É obrigatório ter um nome',
        ];

        $request->validate($rules, $messages); //verifica rules

        $estampa->nome = request()->nome;
        
        $estampa->descricao = request()->descricao;

        if ($request->imagem) {

            Storage::delete('public/estampas/' . $estampa->imagem_url);

            Storage::put('public/estampas', $request->imagem);

            $estampa->imagem_url = request()->imagem->hashName();
        }

        $estampa->save();

        return redirect()->route('estampas.list')->with('success', "Estampa actualizada com êxito");
    }
}
