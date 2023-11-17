<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('variants')->get();
        return view('products.index', compact('products'));
    }
    
    public function show($id) {
        $product = Product::with('variants')->findOrFail($id);
        $uniqueColors = $product->variants->unique('color_id')->pluck('color_id')->toArray();
        return view('products.show', compact('product', 'uniqueColors'));
    }

    public function getVariantQuantity(Request $request) {
        $colorId = $request->input('colorId');
        $sizeId = $request->input('sizeId');
    
        $variant = ProductVariant::where('color_id', $colorId)
            ->where('size_id', $sizeId)
            ->first();
    
        return response()->json([
            'quantity' => $variant ? $variant->quantity : 0
        ]);
    }

    public function getAvailableSizes(Request $request) {
        $colorId = $request->input('colorId');
    
        // Fetch available sizes based on the selected color
        $sizes = ProductVariant::where('color_id', $colorId)
            ->where('quantity', '>', 0) // Filter sizes with available quantity
            ->distinct('size_id')
            ->pluck('size_id')
            ->toArray();
    
        // Fetch the size names based on the IDs
        $sizeNames = Size::whereIn('id', $sizes)->get();
    
        return response()->json([
            'sizes' => $sizeNames
        ]);
    }
    
}
