<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CreatorProduct
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUser = Auth::user();
        $product = Product::findOrFail($request->id);

        if ($product['creator'] != $currentUser['id']) {
            return response()->json(['message'=>'your product is not found!'], 200);
        }

        // return response()->json(['product'=>$product, 'user'=>$currentUser], 200);
        return $next($request);
    }
}
