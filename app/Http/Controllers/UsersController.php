<?php

namespace App\Http\Controllers;
use App\User

use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index()
    {
        $user = User::all();

       return view('User.index', compact('user'));
   }
}