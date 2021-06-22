<?php

namespace App\Http\Controllers;
use App\Categoria;

use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index()
    {
        $categoria = Categoria::all();

       return view('Categoria.index', compact('categoria'));
   }
}