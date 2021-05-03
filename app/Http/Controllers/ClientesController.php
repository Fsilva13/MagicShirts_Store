<?php

namespace App\Http\Controllers;
use App\Cliente

use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index()
    {
        $cliente = Cliente::all();

       return view('Cliente.index', compact('cliente'));
   }
}