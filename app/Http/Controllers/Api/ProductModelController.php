<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductModelController extends Controller
{
    public function index(Request $request)
    {
        $brandId = $request->query('brand_id');
        
        // Fetch filtered Product Model options based on $brandId
        $productModels = ProductModel::where('brand_id', $brandId)->get();

        return response()->json($productModels);
    }
}
