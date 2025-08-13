<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function add_product()
    {
        $categories = Category::all();
        return view('admin.add_product',compact('categories'));
    }

    public function upload_product(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|numeric',
            'product_details' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = new Product;

        $data->name = $request->name;
        $data->product_details = $request->product_details;
        $data->price = $request->price;
        $data->category_id = $request->category_id;

        $image = $request->image;
        $filename = time().'.'.$image->getClientOriginalExtension();
        $image = $request->image->move('product_img',$filename);

        $data->image = $filename;
        

        $data->save();
        
        return redirect()->back();
    }

    public function view_product()
    {
        $data = Product::with('category')->get();
        return view('admin.show_product',compact('data'));
    }


    
    public function delete_product($id)
    {
        $data = Product::find($id);
        $data->delete();
        return redirect()->back();
    }


    public function update_product($id)
    {
        $product = Product::find($id);

        $categories = Category::all();

        return view('admin.update_product',compact('product','categories'));

    }

       public function edit_product(Request $request,$id)
       {
        $data = Product::find($id);
        $data->name = $request->name;
        $data->price = $request->price;
        $data->product_details = $request->product_details;
        $data->category_id = $request->category_id;

        $image = $request->image;
        if($image) {
            $imagename = time().'.' .$image->getClientOriginalExtension();
            $request->image->move('product_img',$imagename);
            $data->image = $imagename;
        }

        $data->save();

        return redirect('view_product');
        }


        public function view_category()
        {
            $data =Category::all();
            return view('admin.category',compact('data'));
        }



public function add_category(Request $request)
{
    $request->validate([
        'category_name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $category = new Category;
    $category->category_name = $request->category_name;

    // Handle image upload
    if ($request->hasFile('image')) {
        $filename = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('category_img'), $filename);
        $category->image = $filename;
    }

    $category->save();

    return redirect()->back()->with('success', 'Category added successfully!');
}


        public function delete_category($id)
        {

            $data=Category::find($id);

            $data->delete();
        
            return redirect()->back();

        }


        public function edit_category($id)
        {
            $data = Category::find($id);
            return  view('admin.edit_category',compact('data')); 
        }

        public function update_category(Request $request ,$id)
        {

            $request->validate([
                'category' => 'required|string|max:255',
                // Added: Image validation (optional)
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $data = Category::find($id);
            $data -> category_name = $request->category;



            // Added: Handle new image upload
            if ($request->hasFile('image')) {
            // Delete old image if exists
                if ($data->image && file_exists(public_path('category_img/' . $data->image))) {
                    unlink(public_path('category_img/' . $data->image));
                }

                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('category_img'), $filename);

                $data->image = $filename;
                }
            $data->save();
            return redirect('/view_category');
        }

}
