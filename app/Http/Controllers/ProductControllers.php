<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductControllers extends Controller
{
    public function index()
    {
        $product = Product::all();
        return response()->json($product, 200);
    }
}
