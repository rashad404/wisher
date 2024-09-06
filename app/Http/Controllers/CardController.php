<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index()
    {
        return view('card.index');
    }

    public function checkout()
    {
        return view('card.checkout');
    }
}
