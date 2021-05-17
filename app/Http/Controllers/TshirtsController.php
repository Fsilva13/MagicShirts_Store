<?php

namespace App\Http\Controllers;
use App\Tshirt

use Illuminate\Http\Request;

class TshirtsController extends Controller
{
    public function index()
    {
        $tshirt = Tshirt::all();

       return view('Tshirt.index', compact('tshirt'));
   }
}