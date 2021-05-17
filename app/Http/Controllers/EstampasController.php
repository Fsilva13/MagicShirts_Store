<?php

namespace App\Http\Controllers;
use App\Estampa

use Illuminate\Http\Request;

class EstampasController extends Controller
{
    public function index()
    {
        $estampa = Estampa::all();

       return view('Estampa.index', compact('estampa'));
   }

   public function store(Request $request)
   {

        $input = $request->validate();
        $novaEstampa = Estampa::create($input);
    }
}