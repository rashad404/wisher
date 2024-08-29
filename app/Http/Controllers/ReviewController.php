<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of reviews for a specific product.
     */
    public function index(Product $product)
    {
        $reviews = $product->reviews()->latest()->get();

        return view('reviews.index', compact('reviews', 'product'));
    }

    /**
     * Show the form for creating a new review.
     */
    public function create(Product $product)
    {
        return view('reviews.create', compact('product'));
    }

    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'review' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $product->reviews()->create([
            'user_id' => auth()->id(),
            'review' => $request->input('review'),
            'rating' => $request->input('rating'),
        ]);

        return redirect()->route('reviews.index', $product)->with('success', 'Review added successfully.');
    }

    /**
     * Show the form for editing the specified review.
     */
    public function edit(Review $review)
    {
        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified review in storage.
     */
    public function update(Request $request, Review $review)
    {
        $request->validate([
            'review' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review->update([
            'review' => $request->input('review'),
            'rating' => $request->input('rating'),
        ]);

        return redirect()->route('reviews.index', $review->product)->with('success', 'Review updated successfully.');
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('reviews.index', $review->product)->with('success', 'Review deleted successfully.');
    }
}
