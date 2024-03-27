<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
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
        
        $review = $request->except('_token');

        $request->validate([
            'rating' => 'required|min:0|max:5|numeric',
            'comment' => 'required'
        ]);

        $review['user_id'] = auth()->user()->id;

        $product->reviews()->create($review);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        // If user is not logged in
        if (!Auth::check()) {
            return redirect()->route('auth.signin');
        }
        
        $review->delete();

        return back();
    }
}
