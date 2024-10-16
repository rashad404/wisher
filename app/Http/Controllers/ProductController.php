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

        $brands = Brand::all();
        $colors = Color::all();
        $sizes = Size::all();

        if ($categories->isEmpty()) {
            return 'No categories found!';
        }

        // Pass the data to the view
        return view('products.index', compact('products', 'categories', 'brands', 'colors', 'sizes'));
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
        $sizes = Size::all();

        $categories = Category::with('subcategories')->get()->groupBy('parent_id');

        return view('products.category', compact('category', 'products', 'brands', 'colors', 'sizes', 'categories'));
    }

    public function showBrand($id)
    {
        $brand = Brand::findOrFail($id);
        $products = Product::where('brand_id', $id)->get();
        //$categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        $categories = Category::with('subcategories')->get()->groupBy('parent_id');
        return view('products.brand', compact('brand', 'products', 'categories', 'colors', 'sizes'));
    }

    public function filter(Request $request)
    {
        $priceRange = (int) $request->input('priceRange', 1000);
        $selectedColors = $request->input('colors', []);
        $selectedSizes = $request->input('sizes', []);
        $selectedBrands = $request->input('brands', []);
        $brandId = $request->input('brand_id');
        $inStock = $request->input('in_stock');
        $subcategoryId = $request->input('subcategoryId');
        $categoryId = $request->input('category_id');

        $query = Product::with('reviews');

        // Filter by brand ID
        if ($brandId) {
            $query->where('brand_id', $brandId);
        }

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

        // Filter by both color and size for exact match
        if (!empty($selectedColors) && !empty($selectedSizes)) {
            $query->whereHas('productVariants', function ($q) use ($selectedColors, $selectedSizes) {
                $q->whereIn('color_id', $selectedColors)
                  ->whereIn('size_id', $selectedSizes);
            });
        }
        // Filter by color only
        else if (!empty($selectedColors)) {
            $query->whereHas('productVariants', function ($q) use ($selectedColors) {
                $q->whereIn('color_id', $selectedColors);
            });
        }
        // Filter by size only
        else if (!empty($selectedSizes)) {
            $query->whereHas('productVariants', function ($q) use ($selectedSizes) {
                $q->whereIn('size_id', $selectedSizes);
            });
        }

        // Filter by selected brands (if any)
        if (!empty($selectedBrands)) {
            $query->whereIn('brand_id', $selectedBrands);
        }

        if ($inStock) {
            $query->where('stock', '>', 0);
        }

        // Fetch products and add average rating and review count
        $products = $query->get()->map(function ($product) {
            $product->average_rating = $product->reviews->avg('rating');
            $product->number_of_reviews = $product->reviews->count();
            return $product;
        });

        return response()->json(['products' => $products]);
    }
}
