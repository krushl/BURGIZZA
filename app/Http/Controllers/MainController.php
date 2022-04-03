<?php

namespace App\Http\Controllers;

use App\Models\Burger;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function menu()
    {
        $burgers = Burger::all();

        return view('menu.index', compact('burgers'));
    }
}
