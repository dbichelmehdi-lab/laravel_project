<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/app.css')


    <title>Home Page</title>
</head>
<body>
    
<div class="flex min-h-screen bg-gray-100">
  
  <!-- Sidebar -->
  @include('admin.sidebar')

  <!-- Main Content -->
  <div class="flex-1 flex flex-col">
    <!-- Header -->
    @include('admin.header')

      </div>
    </header>


    

<!-- Content -->
    <div class="p-6 space-y-6">
        <form action="{{ url('edit_product',$product->id) }}" method="POST"  enctype="multipart/form-data">
        @csrf
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="product-name" class="text-sm font-medium text-gray-900 block mb-2">Product Name</label>
                    <input type="text" name="name" id="product-name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{$product->name}}" placeholder="{{$product->name}}" required>
                </div>

                <div class="input_deg">
                    <label>Product Category</label>

                    <select name="category_id" required>

                        <option value="" disabled selected>Select an Option</option>

                        @foreach($categories as $category)

                        <option value="{{$category->id}}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{$category->category_name}}</option>

                        @endforeach
                    </select>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="price" class="text-sm font-medium text-gray-900 block mb-2">Price</label>
                    <input type="number" name="price" id="price" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{$product->price}}"  required="">
                </div>

                <div class="col-span-full">
                    <label  class="text-sm font-medium text-gray-900 block mb-2">Product Details</label>
                    <textarea id="product-details" name="product_details"  rows="6" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-4">{{$product->product_details}}</textarea>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                    <img src="{{ asset('product_img/' . $product->image) }}" alt="Product Image" class="w-48 h-48 object-cover rounded border border-gray-300">
                
                
                    <label  class="text-sm font-medium text-gray-900 block mb-2">Image of Product</label>
                    <input type="file" name="image" id="image" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{$product->image}}" placeholder="Electronics">
                </div>

                <div>
                    <input type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200" value="Update">
                </div>   
                



            </div>
        </form>
    </div>
  

</body>
</html>






    

