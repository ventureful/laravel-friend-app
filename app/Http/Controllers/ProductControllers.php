<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductDetailResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductControllers extends Controller
{
    public function index()
    {
        $product = Product::all();
        return ProductDetailResource::collection($product->loadMissing('user:id,username'));
    }

    public function show($id){
            try {
                $product = Product::with('user:id,username')->findOrFail($id);
                return new ProductDetailResource($product);
            } catch (ModelNotFoundException $exception) {
                return response()->json([
                            'status' => 404, 
                            'error' => $exception->getMessage()
                        ], 404);
            }
        
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|max:192',
            'description' => 'required',
            'price' => 'required'
        ]);

        // dd($validated->fails());
    
            // $request['creator'] = Auth::user()->id; //Memasukan column author yang terlogin
            // $product = Product::create($request->all());
            // return new ProductDetailResource($product->loadMissing('user:id,username'));
        
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'title' => 'required|max:192',
            'description' => 'required',
            'price' => 'required'
        ]);

        try {
            $product = Product::findOrFail($id);
    
            $updated = $product->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'price' => $validated['price']
            ]);
    
            $res = ['message' => "sucess updated"];

            return response()->json($res, 200);
        }  catch (ModelNotFoundException $exception) {
            return response()->json([
                        'status' => 404, 
                        'error' => $exception->getMessage()
                    ], 404);
        }
       }
    
       public function destroy(Request $request, $id){
        
        $product = Product::findOrFail($id);

        $deleted = $product->delete();

        $res = ['message' => "sucess deleted"];

        return response()->json($res, 200);
       }
}
