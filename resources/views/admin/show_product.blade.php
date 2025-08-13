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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Table</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-8">Product Table</h1>

        <!-- Search and Add User (Static) -->
        

        <!-- User Table -->
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Name of Product</th>
                        <th class="py-3 px-6 text-left">Gategory</th>
                        <th class="py-3 px-6 text-left">Price</th>
                        <th class="py-3 px-6 text-left">Product Details</th>
                        <th class="py-3 px-6 text-left">image</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">

                    @foreach ( $data as $data )

                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left">{{$data->id}}</td>
                        <td class="py-3 px-6 text-left">{{$data->name}}</td>
                        <td class="py-3 px-6 text-left">{{$data->category->category_name}}</td>
                        <td class="py-3 px-6 text-left">{{$data->price}}</td>
                        <td class="py-3 px-6 text-left">{{$data->product_details}}</td>
                        <td class="py-3 px-6 text-left">
                            <img src="product_img/{{$data->image}}" class="w-16 h-16 object-cover rounded" alt="Product Image">
                        </td>

                        
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center">
                                <a href="{{url('update_product',$data->id)}}" class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                                <a href="{{url('delete_product',$data->id)}}" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                    
                </tbody>
            </table>
        </div>

        <!-- Static Pagination -->
        
    </div>
</body>
</html>

</body>
</html>






    

