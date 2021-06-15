<?php

namespace App\Http\Controllers;
use App\Tshirt;

use Illuminate\Http\Request;

class TshirtsController extends Controller
{
    public function index()
    {
        $tshirt = Tshirt::paginate(10);

       return view('Tshirt.list', compact('tshirt'));
   }
}