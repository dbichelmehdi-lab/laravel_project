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


    <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 w-full max-w-5xl mx-auto">
      <form action="{{ url('upload_product') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Header -->
        <div class="flex items-center justify-between">
          <h2 class="text-xl font-semibold text-gray-800">Add Product</h2>
          <span class="text-sm text-gray-500">Fill in the details below</span>
        </div>

        <!-- Product Information -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Name</label>
            <input name="name" type="text" placeholder="Name of Product"
              class="w-full rounded-lg border border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 text-sm px-3 py-2">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Category</label>
            <select name="category_id" id="category"
              class="w-full rounded-lg border border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 text-sm px-3 py-2">
              <option value="" disabled selected>Select a Category</option>
              @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->category_name}}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Price</label>
            <input name="price" id="price" type="number" placeholder="Price"
              class="w-full rounded-lg border border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 text-sm px-3 py-2">
          </div>
        </div>

        <!-- Details + Product Image -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Details -->
          <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Details</label>
            <textarea name="product_details" placeholder="Describe the product..." rows="6"
              class="w-full rounded-lg border border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 text-sm px-3 py-2"></textarea>
          </div>

          <!-- Image of Product -->

          <div>
            <label for="image" class="block text-sm font-medium text-gray-600 mb-2">Image of Product</label>
            <label for="image"
              class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-purple-500 transition cursor-pointer h-full flex flex-col justify-center">
              <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
              </svg>
              <p class="mt-2 text-sm text-gray-600">
                <span class="font-medium text-purple-600 hover:underline">Click to upload</span> or drag & drop
              </p>
              <p class="text-xs text-gray-400">PNG, JPG, GIF up to 5MB</p>
            </label>
            <input type="file" name="image" id="image" class="hidden" required />
          </div>
        </div>

        <!-- Submit Button (Centered & Smaller) -->

        <div class="flex justify-center">
          <input type="submit" value="Add Product"
            class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200 text-sm cursor-pointer">
        </div>
      </form>
    </div>










</body>

</html>