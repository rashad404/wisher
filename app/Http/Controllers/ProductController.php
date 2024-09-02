<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('variants')->get();
        // Group categories by parent_id
        $categories = Category::all()->groupBy('parent_id');
        return view('products.index', compact('products', 'categories'));
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

    public function getSizes(Request $request) {
        $productId = $request->input('productId');
        $colorId = $request->input('colorId');

        // Retrieve sizes based on the selected product and color
        $sizes = DB::table('product_variants')
            ->where('product_id', $productId)
            ->where('color_id', $colorId)
            ->pluck('size_id');

        $availableSizes = DB::table('sizes')
            ->whereIn('id', $sizes)
            ->get();

        return response()->json([
            'sizes' => $availableSizes
        ]);
    }

    public function filterByCategory(Request $request) {
        $categoryId = $request->input('category_id');

        // Fetch products based on the category, including subcategories
        $products = Product::with('variants')
            ->when($categoryId, function ($query) use ($categoryId) {
                // Fetch products that belong to the selected category or its subcategories
                return $query->where(function ($subQuery) use ($categoryId) {
                    $subQuery->where('category_id', $categoryId)
                             ->orWhereIn('category_id', Category::where('parent_id', $categoryId)->pluck('id'));
                });
            })
            ->get();

        return response()->json($products);
    }

    public function showCategory($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->get();
        $brands = Brand::all();
        $colors = Color::all();

        return view('products.category', compact('category', 'products', 'brands', 'colors'));
    }
}
