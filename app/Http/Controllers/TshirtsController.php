<?php

namespace App\Http\Controllers;
use App\Tshirt;
use App\Cor;

use Illuminate\Http\Request;

class TshirtsController extends Controller
{
    public function index()
    {
        $tshirt = Tshirt::paginate(9);
        $cor = Tshirt::with('cor');
       return view('Tshirt.list', compact('tshirt'))->with('cor', $cor);
   }
}