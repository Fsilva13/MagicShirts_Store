<?php

namespace App\Http\Controllers;

use App\Cor;

use Illuminate\Http\Request;

class CoresController extends Controller
{
    public function index()
    {
        $cores = Cor::all();

        return view('Cor.listCores', compact('cores'));
    }

    public function edit($id)
    {
        $cor = Cor::find($id);

        if ($cor) {
            return view('cor.edit', compact('cor'));
        }
    }

    public function update(Request $request, $id)
    {
        $cor= Cor::find($id);
        if ($cor) {
            $cor->update($request->except('_token', '_method'));
        }

       
        return redirect()->route('cor.list')->with('success', 'Cor atualizada com êxito!');
        
    }

    public function destroy($id)
    {
        $cor= Cor::find($id);
        $cor->delete();

        return redirect()->route('cor.list')->with('success', "Cor excluída com êxito");
    }

}
