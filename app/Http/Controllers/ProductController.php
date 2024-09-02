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

        $sizes = ProductVariant::where('color_id', $colorId)
            ->where('quantity', '>', 0)
            ->distinct('size_id')
            ->pluck('size_id')
            ->toArray();

        $sizeNames = Size::whereIn('id', $sizes)->get();

        return response()->json([
            'sizes' => $sizeNames
        ]);
    }

    public function getSizes(Request $request) {
        $productId = $request->input('productId');
        $colorId = $request->input('colorId');

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

        // Fetch all categories including subcategories
        $categoryIds = Category::where('id', $categoryId)
            ->orWhere('parent_id', $categoryId)
            ->pluck('id')
            ->toArray();

        $products = Product::with('variants')
            ->whereIn('category_id', $categoryIds)
            ->get();

        return response()->json(['products' => $products]);
    }

    public function showCategory($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->get();
        $brands = Brand::all();
        $colors = Color::all();

        return view('products.category', compact('category', 'products', 'brands', 'colors'));
    }

    public function filter(Request $request)
    {
        $priceRange = (int) $request->input('priceRange', 1000);
        $selectedColors = $request->input('color', []);
        $selectedBrand = $request->input('brand');
        $inStock = $request->input('in_stock');
        $subcategoryId = $request->input('subcategoryId');
        $categoryId = $request->input('category_id');

        $query = Product::query();

        if ($categoryId) {
            $categoryIds = Category::where('id', $categoryId)
                ->orWhere('parent_id', $categoryId)
                ->pluck('id')
                ->toArray();
            $query->whereIn('category_id', $categoryIds);
        }

        if ($subcategoryId) {
            $query->where('subcategory_id', $subcategoryId);
        }

        if ($priceRange) {
            $query->where('price', '<=', $priceRange);
        }

        if (!empty($selectedColors)) {
            $query->whereIn('color_id', $selectedColors);
        }

        if ($selectedBrand) {
            $query->where('brand_id', $selectedBrand);
        }

        if ($inStock) {
            $query->where('stock', '>', 0);
        }

        // Fetch products with review count and average rating
        $products = $query->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->get()
            ->map(function ($product) {
                $product->number_of_reviews = $product->reviews_count;
                $product->average_rating = $product->reviews_avg_rating;
                return $product;
            });



        return response()->json(['products' => $products]);
    }



}
