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
        $users = User::paginate(25);

        return view('utilizador.list', compact('users'));
    }

    public function destroy(User $user)
    {
        if ($user->tipo == 'C') {
            $user->cliente->delete();
        }
        $user->delete();

        return redirect()->route('utilizador.list')->with('success', "Utilizador excluído com êxito");
    }

    public function edit($id)
    {
        $cliente = Cliente::find($id);
        if ($cliente) {
            return view('utilizador.create', compact('cliente'));
        } else {
            $user = User::findOrFail($id);
            return view('utilizador.utilizadores', compact('user'));
        }
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        if ($cliente) {
            $cliente->update($request->except('_token', '_method'));
        } else {
            $user = User::findOrFail($id);
            $user->update($request->except('_token', '_method'));
        }

        if ($request->file('foto_url')) {
            if ($cliente) {
                Storage::delete('public/fotos/' . $cliente->user->foto_url);
            } else {
                Storage::delete('public/fotos/' . $user->foto_url);
            }
            Storage::delete('public/fotos/' . $request->file('foto_url'));
            $path = $request->file('foto_url')->store('public/fotos');
            $path = str_replace('public/fotos/', '', $path);
            DB::table('users')
                ->where('id', $id)
                ->update(['foto_url' => $path]);
        }

        return redirect()->back()->with('success', 'Conta atualizada com êxito!');
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


    public function bloquear(User $user)
    {

        $user->bloqueado = $user->bloqueado == '1' ? '0' : '1';
        $user->save();

        return redirect()->back();
    }

    public function create()
    {
        return view('utilizador.utilizadores');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'password' => ['required', 'string', 'min:8'],
            'email' => 'email:rfc,dns|unique:users,email',
            'tipo' => 'required',
            'imagem' => 'image'
        ];

        $messages = [
            'nome.required' => 'É obrigatório ter um nome',
            'email.email' => 'Email Invalido!'
        ];

        $request->validate($rules, $messages); //verifica rules

        if ($request->file('foto_url')) {

            
            $path = $request->file('foto_url')->store('public/fotos');
            $path = str_replace('public/fotos/', '', $path);

           $user = User::create([
                "name" => $request->get('name'),
                "email" => $request->get('email'),
                "password" => $path,
                "tipo" => $request->get('tipo'),
                "foto_url" => $request->foto_url->hashName()
            ]);
        } else {
            $user = User::create([
                "name" => $request->get('name'),
                "email" => $request->get('email'),
                "password" => Hash::make($request->get('password')),
                "tipo" => $request->get('tipo'),
            ]);
        }
        if($user){
            return redirect()->route('estampas.list')->with('success', 'Utilizador criado com sucesso!');
        }else{
            return redirect()->route('estampas.list')->with('error', 'Erro ao criar utilizador!');
        }
        
    }
}
