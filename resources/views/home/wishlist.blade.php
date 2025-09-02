<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>
    {{-- Landing Section --}}
    @include('home.header')

    <section id="products" class="py-10 px-4 sm:px-6 bg-gradient-to-b from-gray-50 to-white rounded-xl shadow-sm">
        <h2 class="text-3xl font-bold text-center mb-6">My Wishlist</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($wishlists as $item)
                <div class="border p-4 rounded-lg shadow-md bg-white hover:shadow-xl transition duration-300">
                    {{-- Product Image --}}
                    <img src="{{ asset('product_img/' . $item->product->image) }}" alt="{{ $item->product->name }}"
                        class="w-full h-48 object-cover rounded-md mb-4">

                    {{-- Product Name --}}
                    <h3 class="text-lg font-semibold text-gray-800">
                        {{ $item->product->name }}
                    </h3>

                    {{-- Product Price --}}
                    <p class="text-gray-600 mb-4">
                        ${{ $item->product->price }}
                    </p>

                    {{-- Remove from Wishlist --}}
                    <form action="{{ route('wishlist.remove', $item->product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition">
                            Remove
                        </button>
                    </form>
                </div>
            @empty
                <p class="text-center text-gray-600 col-span-full">Your wishlist is empty.</p>
            @endforelse
        </div>
    </section>
</body>

</html>