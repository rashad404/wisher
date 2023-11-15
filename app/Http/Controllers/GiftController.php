<?php
 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class GiftController extends Controller
{
    public function index()
    {
    
        return view('gifts.index');
    }
}
