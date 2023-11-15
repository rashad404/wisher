<?php
 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        return view('main.index');
    }

    public function about()
    {
        return view('main.about');
    }
    public function howItWorks()
    {
        return view('main.howItWorks');
    }
}
