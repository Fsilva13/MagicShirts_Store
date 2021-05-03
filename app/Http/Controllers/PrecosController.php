<?php

namespace App\Http\Controllers;
use App\Preco

use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index()
    {
        $preco = Preco::all();

       return view('Preco.index', compact('preco'));
   }
}