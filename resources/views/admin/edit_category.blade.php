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
<!-- Sidebar Navigation end-->
      <body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <!-- Page Header -->
        <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Edit Category</h1>

        <!-- Add Category Form -->
        <div class="max-w-md mx-auto mb-8">
            <form action="{{ url('update_category',$data->id) }}" method="post" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                        Category Name
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="category" 
                        type="text" 
                        name="category" 
                        placeholder="Enter Category"
                        required
                    >
                </div>

            {{-- Added: Category Image Upload --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    Category Image
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="image" 
                    type="file" 
                    name="image" 
                    accept="image/*"
                    required
                >
            </div>

                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Edit Category
                    </button>
                </div>
            </form>
        </div>

        <!-- Categories Table -->
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Category Name</th>
                        <th class="py-3 px-6 text-left">Image</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left">{{ $data->id }}</td>
                        <td class="py-3 px-6 text-left">{{ $data->category_name }}</td>
                        <td class="py-3 px-6 text-left">
                            <img src="{{asset('category_img/' . $data->image)}}">
                        </td>

                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center">
                                <a href="{{ url('edit_category', $data->id) }}" class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                    <!-- Edit Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                                <a href="{{ url('delete_category', $data->id) }}" onclick="confirmation(event)" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                    <!-- Delete Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
</body>

  

</body>
</html>






    

