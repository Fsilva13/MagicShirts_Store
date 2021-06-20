<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UtilizadoresController extends Controller
{

    public function index()
    {
        $cliente = Cliente::paginate(15);

        return view('utilizador.list', compact('cliente'));
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id)->delete();

        if ($cliente) {

            Session::flash('success', "Utilizador excluído com êxito");

            return redirect()->route('utilizador.list');
        }
        return redirect()->back()->withErrors(['error', "Utilizador não pode ser excluído"]);
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);

        if ($cliente) {
            return view('utilizador.create', compact('cliente'));
        } else {
            return redirect()->back();
        }
    }
    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id)->update($request->except('_token', '_method'));

        if ($request->file('foto_url')) {
            $path = $request->file('foto_url')->store('public/fotos');
            $path = str_replace('public/fotos/', '', $path);
            DB::table('users')
                ->where('id', $id)
                ->update(['foto_url' => $path]);
        }
        if ($cliente) {
            return redirect()->back()->with('success', 'Conta atualizada com êxito!');
        } else {
            return redirect()->back()->withErrors(['error', "Registo não foi encontrado"]);
        }
    }

    public function password(Request $request)
    {
        $request->validate(
            [
                'passwordAntiga' => 'required|password',
                'passwordNova' => ['required', 'string', 'min:8']
            ],
            [
                'passwordAntiga.required' => 'Password obrigatória',
                'passwordAntiga.password' => 'Password incorreta',
                'passwordNova.required'  => 'Password obrigatória',
                'passwordNova.min' => 'Password tem de ter pelo menos 8 caracteres'
            ]
        );

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->passwordNova);
        $user->save();

        return redirect()->back()->with('success', 'Password alterada com êxito!');
    }
}
