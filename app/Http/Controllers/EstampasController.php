<?php

namespace App\Http\Controllers;
use App\Estampa

use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index()
    {
        $estampa = Estampa::all();

       return view('Estampa.index', compact('estampa'));
   }
}