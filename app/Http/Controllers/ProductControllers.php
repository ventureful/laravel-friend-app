<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductDetailResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductControllers extends Controller
{
    public function index()
    {
        $product = Product::all();
        // return response()->json(['message'=>"get all product",'data' => $product], 200);
        // return ProductResource::collection($product);

      
    }

    public function show($id){
        // $product = Product::with('user:id,username')->findOrFail($id);
        // return response()->json(['data' => $product], 200,);
        // return new ProductDetailResource($product);
            try {
                $product = Product::with('user:id,username')->findOrFail($id);
                return new ProductDetailResource($product);
            } catch (ModelNotFoundException $exception) {
                return response()->json([
                            'status' => 404, 
                            'data' => 'data not found'
                        ], 404);
            }
        
    }
}
