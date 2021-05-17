<?php

namespace App\Http\Controllers;
use App\Encomenda

use Illuminate\Http\Request;

class EncomendasController extends Controller
{
    public function index()
    {
        $encomenda = Encomenda::all();

       return view('Encomenda.index', compact('encomenda'));
   }
}