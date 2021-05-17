<?php

namespace App\Http\Controllers;
use App\Encomenda

use Illuminate\Http\Request;

class EncomendasController extends Controller
{
    public function index()
    {
        $encomenda = Encomenda::all();

       return view('encomenda.index', compact('encomenda'));
   }

   public function store(Request $request){

   		$input = $request->validate();
 		$novaEncomenda = Encomenda::create($input);

   }
}