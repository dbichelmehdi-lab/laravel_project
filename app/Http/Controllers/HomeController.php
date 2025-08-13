<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Models\user;
use App\Models\Cart;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class HomeController extends Controller
{
    public function my_home()
    {
        $data = Product::all();  
        $categories = Category::all();
        return view('home.index',compact('data','categories'));
    
    }






    public function productsByCategory($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id',$id)->get();

        return view('home.category_products', compact('category', 'products'));
    }


  

    public function index(){
        if(Auth::id())
        {
            $usertype = Auth()->user()->usertype;

            if($usertype == 'user')
            {
                $data = Product::all();
                return view('home.index',compact('data'));
            }

            else{
                return view('admin.index');
            }
        }
    }


    public function productDetails($id)
    {
        $product = Product::findOrFail($id);
        return view('home.product_details', compact('product'));
    }




 
    // Add to cart
    public function add_cart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Get existing cart from session or initialize empty array
        $cart = session()->get('cart', []);

        // If product already in cart, just update quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->qty;
        } else {
            // Add new product to cart
            $cart[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => $request->qty,
                "image" => $product->image
            ];
        }

        // Save cart back to session
        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart!');
        
    }

    // View cart
    public function my_cart()
    {
        $cart = session()->get('cart', []);
        return view('home.my_cart', compact('cart'));
    }

    // Remove from cart
    public function remove_cart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('my_cart')->with('success', 'Product removed from cart!');
    }
}




    
   

 













 


  


  








