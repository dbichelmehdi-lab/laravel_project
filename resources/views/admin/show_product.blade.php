<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/app.css')

    <title>Home Page</title>
</head>

<body class="bg-gray-100">

    <div class="flex max-h-screen overflow-hidden bg-gray-100">

        <!-- Sidebar -->
        @include('admin.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-y-auto">

            <!-- Content -->
            <div class="container mx-auto px-4 py-8">
                <!-- Page Header with Add Button -->
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-800">Product Table</h1>
                    <button onclick="openProductModal()"
                        class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Add Product
                    </button>
                </div>

                <!-- Filter Section -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Filter Products</h2>
                    <form method="GET" action="{{ route('admin.products') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Search by Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Search by Name</label>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                placeholder="Product name..." 
                                class="w-full rounded-lg border border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 text-sm px-3 py-2">
                        </div>

                        <!-- Filter by Category -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Category</label>
                            <select name="category" 
                                class="w-full rounded-lg border border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 text-sm px-3 py-2">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{$category->category_name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price Range -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Price Range</label>
                            <div class="flex space-x-2">
                                <input type="number" name="min_price" value="{{ request('min_price') }}" 
                                    placeholder="Min" step="0.01"
                                    class="w-1/2 rounded-lg border border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 text-sm px-3 py-2">
                                <input type="number" name="max_price" value="{{ request('max_price') }}" 
                                    placeholder="Max" step="0.01"
                                    class="w-1/2 rounded-lg border border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 text-sm px-3 py-2">
                            </div>
                        </div>

                        <!-- Filter Buttons -->
                        <div class="flex space-x-2 items-end">
                            <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex-1">
                                Filter
                            </button>
                            <a href="{{ route('admin.products') }}" 
                                class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200 text-center">
                                Reset
                            </a>
                        </div>
                    </form>

                    <!-- Active Filters Display -->
                    @if(request()->hasAny(['search', 'category', 'min_price', 'max_price']))
                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="text-sm text-gray-600">Active filters:</span>
                            
                            @if(request('search'))
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-800">
                                    Search: "{{ request('search') }}"
                                    <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="ml-1 text-blue-600 hover:text-blue-800">×</a>
                                </span>
                            @endif

                            @if(request('category'))
                                @php
                                    $selectedCategory = $categories->find(request('category'));
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs bg-green-100 text-green-800">
                                    Category: {{ $selectedCategory ? $selectedCategory->category_name : 'Unknown' }}
                                    <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" class="ml-1 text-green-600 hover:text-green-800">×</a>
                                </span>
                            @endif

                            @if(request('min_price') || request('max_price'))
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs bg-purple-100 text-purple-800">
                                    Price: ${{ request('min_price', '0') }} - ${{ request('max_price', '∞') }}
                                    <a href="{{ request()->fullUrlWithQuery(['min_price' => null, 'max_price' => null]) }}" class="ml-1 text-purple-600 hover:text-purple-800">×</a>
                                </span>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Results Summary -->
                <div class="mb-4">
                    <p class="text-gray-600">
                        Showing <span class="font-semibold">{{ $data->count() }}</span> 
                        @if($data->count() == 1) product @else products @endif
                        @if(request()->hasAny(['search', 'category', 'min_price', 'max_price']))
                            matching your filters
                        @endif
                    </p>
                </div>

                <!-- Product Table -->
                <div class="overflow-x-auto bg-white rounded-lg shadow">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">ID</th>
                                <th class="py-3 px-6 text-left">Name of Product</th>
                                <th class="py-3 px-6 text-left">Category</th>
                                <th class="py-3 px-6 text-left">Price</th>
                                <th class="py-3 px-6 text-left">Product Details</th>
                                <th class="py-3 px-6 text-left">Image</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm">

                            @forelse ($data as $product)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left">{{$product->id}}</td>
                                    <td class="py-3 px-6 text-left">{{$product->name}}</td>
                                    <td class="py-3 px-6 text-left">{{$product->category->category_name}}</td>
                                    <td class="py-3 px-6 text-left">${{$product->price}}</td>
                                    <td class="py-3 px-6 text-left">{{Str::limit($product->product_details, 50)}}</td>
                                    <td class="py-3 px-6 text-left">
                                        <img src="{{ asset('product_img/' . $product->image) }}" class="w-16 h-16 object-cover rounded" alt="Product Image">
                                            
                                    </td>

                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">
                                            <button
                                                onclick="openEditModal({{$product->id}}, '{{$product->name}}', {{$product->category_id}}, '{{$product->price}}', '{{addslashes($product->product_details)}}', '{{$product->image}}')"
                                                class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </button>
                                            <a href="{{url('delete_product', $product->id)}}" onclick="confirmation(event)"
                                                class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-8 px-6 text-center text-gray-500">
                                        @if(request()->hasAny(['search', 'category', 'min_price', 'max_price']))
                                            No products found matching your filters. 
                                            <a href="{{ route('admin.products') }}" class="text-blue-600 hover:underline">Clear filters</a> to see all products.
                                        @else
                                            No products available. 
                                            <button onclick="openProductModal()" class="text-purple-600 hover:underline">Add your first product</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

            </div>

            <!-- Add Product Modal -->
            <div id="productModal"
                class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
                <div class="relative top-10 mx-auto p-5 border w-full max-w-3xl shadow-lg rounded-lg bg-white">
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Add Product</h3>
                        <button type="button" onclick="closeProductModal()"
                            class="text-gray-400 hover:text-gray-600 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Form -->
                    <form action="{{ url('upload_product') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

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
                                <label for="image" class="block text-sm font-medium text-gray-600 mb-2">Image of
                                    Product</label>
                                <label for="image"
                                    class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-purple-500 transition cursor-pointer h-full flex flex-col justify-center">
                                    <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600">
                                        <span class="font-medium text-purple-600 hover:underline">Click to upload</span>
                                        or drag & drop
                                    </p>
                                    <p class="text-xs text-gray-400">PNG, JPG, GIF up to 5MB</p>
                                </label>
                                <input type="file" name="image" id="image" class="hidden" required />
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end space-x-3 pt-4">
                            <button type="button" onclick="closeProductModal()"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg transition duration-200">
                                Cancel
                            </button>
                            <button type="submit"
                                class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200 text-sm">
                                Add Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Edit Product Modal -->
            <div id="editProductModal"
                class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
                <div class="relative top-10 mx-auto p-5 border w-full max-w-3xl shadow-lg rounded-lg bg-white">
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Edit Product</h3>
                        <button type="button" onclick="closeEditModal()"
                            class="text-gray-400 hover:text-gray-600 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Edit Form -->
                    <form id="editProductForm" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <input type="hidden" id="edit_product_id" name="product_id">

                        <!-- Product Information -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Name</label>
                                <input name="name" id="edit_name" type="text" placeholder="Name of Product"
                                    class="w-full rounded-lg border border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 text-sm px-3 py-2"
                                    required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Category</label>
                                <select name="category_id" id="edit_category"
                                    class="w-full rounded-lg border border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 text-sm px-3 py-2"
                                    required>
                                    <option value="" disabled>Select a Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Price</label>
                                <input name="price" id="edit_price" type="number" placeholder="Price"
                                    class="w-full rounded-lg border border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 text-sm px-3 py-2"
                                    required>
                            </div>
                        </div>

                        <!-- Details + Product Image -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Details -->
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Details</label>
                                <textarea name="product_details" id="edit_details" placeholder="Describe the product..."
                                    rows="6"
                                    class="w-full rounded-lg border border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 text-sm px-3 py-2"></textarea>
                            </div>

                            <!-- Current Image + Upload New -->
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">Current Image</label>
                                <div class="mb-4">
                                    <img id="current_image" src="" alt="Current Product Image"
                                        class="w-32 h-32 object-cover rounded border border-gray-300">
                                </div>

                                <label for="edit_image" class="block text-sm font-medium text-gray-600 mb-2">
                                    Upload New Image (Optional)
                                </label>
                                <input type="file" name="image" id="edit_image" accept="image/*"
                                    class="w-full rounded-lg border border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 text-sm px-3 py-2">
                                <p class="text-xs text-gray-400 mt-1">Leave empty to keep current image</p>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end space-x-3 pt-4">
                            <button type="button" onclick="closeEditModal()"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg transition duration-200">
                                Cancel
                            </button>
                            <button type="submit" id="editSubmitBtn"
                                class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200 text-sm">
                                Update Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    <div id="alertMessage" class="fixed top-4 right-4 z-50 hidden">
        <div id="alertContent" class="px-4 py-3 rounded-lg shadow-lg">
            <span id="alertText"></span>
        </div>
    </div>

    <script>
        // Add Product Modal Functions
        function openProductModal() {
            document.getElementById('productModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeProductModal() {
            document.getElementById('productModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Edit Product Modal Functions
        function openEditModal(id, name, categoryId, price, details, image) {
            // Populate the form with product data
            document.getElementById('edit_product_id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_category').value = categoryId;
            document.getElementById('edit_price').value = price;
            document.getElementById('edit_details').value = details;
            document.getElementById('current_image').src = '{{ asset("") }}product_img/' + image;

            // Show the modal
            document.getElementById('editProductModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeEditModal() {
            document.getElementById('editProductModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            document.getElementById('editProductForm').reset();
        }

        
        // Handle edit form submission with AJAX
        document.getElementById('editProductForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const productId = document.getElementById('edit_product_id').value;
            const submitBtn = document.getElementById('editSubmitBtn');

            submitBtn.textContent = 'Updating...';
            submitBtn.disabled = true;

            fetch(`/edit_product/${productId}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.text())
                .then(text => {
                    console.log('Raw response:', text);
                    try {
                        const data = JSON.parse(text);
                        if (data.success) {
                            closeEditModal();
                            location.reload();
                        } else {
                            alert('Error: ' + data.message);
                        }
                    } catch (e) {
                        console.log('Not JSON, probably HTML error page');
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    location.reload();
                })
                .finally(() => {
                    submitBtn.textContent = 'Update Product';
                    submitBtn.disabled = false;
                });
        });
    </script>

</body>

</html>