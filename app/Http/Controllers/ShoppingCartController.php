<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        // If user is not logged in
        if (!Auth::check()) {
            return redirect()->route('auth.signin');
        }

        // If product is already on shopping cart
        if (ShoppingCart::where(['user_id' => auth()->user()->id, 'product_id' => $product->id])->count() > 0) {
            return back();
        }

        ShoppingCart::create([
            'user_id' => auth()->user()->id,
            'product_id' => $product->id
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        // If user is not logged in
        if (!Auth::check()) {
            return redirect()->route('auth.signin');
        }

        $items = ShoppingCart::with('product')->where('user_id', auth()->user()->id)->get();
        
        return view('cart.view', compact(['items']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // If user is not logged in
        if (!Auth::check()) {
            return redirect()->route('auth.signin');
        }
        
        ShoppingCart::where(['user_id' => auth()->user()->id, 'product_id' => $product->id])->delete();

        return back();
    }
}
