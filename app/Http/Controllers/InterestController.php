<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use App\Models\InterestCategory;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    public function index()
    {
        $interests = Interest::with('category')->get();
        return view('interests.index', compact('interests'));
    }

    public function create()
    {
        $categories = InterestCategory::all();
        return view('interests.create', compact('categories'));
    }

    public function store(Request $request)
    {
        Interest::create($request->validate([
            'name' => 'required|array', // for translations
            'interest_category_id' => 'required|exists:interest_categories,id',
            'position' => 'required|integer',
            'status' => 'required|boolean',
        ]));

        return redirect()->route('interests.index');
    }

    // Implement edit, update, destroy as needed
}
