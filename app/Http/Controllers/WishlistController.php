<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
       public function index()
    {
        $wishlists = Wishlist::with('product')->where('user_id', Auth::id())->get();
        return view('home.wishlist', compact('wishlists'));
    }

    public function store(Product $product)
    {
        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $product->id
        ]); 

        return back()->with('success', 'Product added to wishlist!');
    }

    public function destroy(Product $product)
    {
        Wishlist::where('user_id', Auth::id())->where('product_id', $product->id)->delete();
        return back()->with('success', 'Product removed from wishlist.');
    }
}
