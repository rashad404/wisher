<?php

namespace App\Http\Controllers;

use App\Models\InterestCategory;
use Illuminate\Http\Request;

class InterestCategoryController extends Controller
{
    public function index()
    {
        $categories = InterestCategory::all();
        return view('interest_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('interest_categories.create');
    }

    public function store(Request $request)
    {
        InterestCategory::create($request->validate([
            'name' => 'required|array', // for translations
            'position' => 'required|integer',
            'status' => 'required|boolean',
        ]));

        return redirect()->route('interest_categories.index');
    }

    // Implement edit, update, destroy as needed
}
