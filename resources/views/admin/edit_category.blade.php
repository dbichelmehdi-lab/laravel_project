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
                <!-- Page Header with Edit Button -->
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-800">Edit Category</h1>
                    <button onclick="openEditModal()"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                            </path>
                        </svg>
                        Edit Category
                    </button>
                </div>

                <!-- Category Table -->
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
                                    @if($data->image)
                                        <img src="{{asset('category_img/' . $data->image)}}"
                                            alt="{{ $data->category_name }}" class="w-16 h-16 object-cover rounded">
                                    @else
                                        <span class="text-gray-400 italic">No image</span>
                                    @endif
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <button onclick="openEditModal()"
                                            class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110 cursor-pointer">
                                            <!-- Edit Icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </button>
                                        <a href="{{ url('delete_category', $data->id) }}" onclick="confirmation(event)"
                                            class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                            <!-- Delete Icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Edit Category Modal -->
            <div id="editCategoryModal"
                class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-lg bg-white">
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Edit Category</h3>
                        <button type="button" onclick="closeEditModal()"
                            class="text-gray-400 hover:text-gray-600 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Form -->
                    <form action="{{ url('update_category', $data->id) }}" method="post" enctype="multipart/form-data"
                        class="space-y-4">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                                Category Name
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="category" type="text" name="category" placeholder="Enter Category"
                                value="{{ $data->category_name }}" required>
                        </div>

                        {{-- Category Image Upload --}}
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                                Category Image
                            </label>
                            @if($data->image)
                                <div class="mb-2">
                                    <img src="{{asset('category_img/' . $data->image)}}" alt="Current image"
                                        class="w-20 h-20 object-cover rounded border">
                                    <p class="text-xs text-gray-500 mt-1">Current image</p>
                                </div>
                            @endif
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="image" type="file" name="image" accept="image/*">
                            <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image</p>
                        </div>

                        <!-- Modal Buttons -->
                        <div class="flex justify-end space-x-3 pt-4">
                            <button type="button" onclick="closeEditModal()"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg transition duration-200">
                                Cancel
                            </button>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                function openEditModal() {
                    document.getElementById('editCategoryModal').classList.remove('hidden');
                }

                function closeEditModal() {
                    document.getElementById('editCategoryModal').classList.add('hidden');
                }

                // Close modal when clicking outside
                document.getElementById('editCategoryModal').addEventListener('click', function (e) {
                    if (e.target === this) {
                        closeEditModal();
                    }
                });

                // Close modal with Escape key
                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape') {
                        closeEditModal();
                    }
                });

                // Auto-open modal when page loads (since this is an edit page)
                document.addEventListener('DOMContentLoaded', function () {
                    openEditModal();
                });
            </script>

        </body>

</body>

</html>