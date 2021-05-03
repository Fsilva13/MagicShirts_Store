<?php

namespace App\Http\Controllers;
use App\Cor

use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index()
    {
        $cor = Cor::all();

       return view('Cor.index', compact('cor'));
   }
}