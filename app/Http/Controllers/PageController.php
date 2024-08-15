<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function privacyPolicy()
    {
        return view('pages.privacy-policy');
    }
    
    public function termsOfService()
    {
        return view('pages.terms-of-service');
    }
}