<div class="p-4 mx-auto lg:max-w-6xl md:max-w-4xl">
  <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-6 sm:mb-8">Our Products</h2>

  <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
    @foreach($data as $product)
    <div class="bg-white flex flex-col rounded-sm overflow-hidden shadow-md hover:scale-[1.01] transition-all relative">
      <!-- Product Link -->
      <a href="{{ route('product.details', $product->id) }}" class="block">
        <div class="w-full">
          <img src="{{ asset('product_img/' . $product->image) }}" alt="{{ $product->name }}"
            class="w-full aspect-[18/24] object-cover object-top" />
        </div>
        <div class="p-4">
          <!-- Product Name -->
          <h5 class="text-sm sm:text-base font-semibold text-slate-900 line-clamp-2">
            {{ $product->name }}
          </h5>
          <!-- Product Description -->
          <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $product->product_details }}</p>
          
          <!-- Price + Wishlist -->
          <div class="mt-2 flex items-center flex-wrap gap-2">
            <h6 class="text-sm sm:text-base font-semibold text-slate-900">${{ $product->price }}</h6>
            
            <!-- Wishlist Button -->
            <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="ml-auto">
              @csrf
              <button type="submit" class="bg-slate-100 w-8 h-8 flex items-center justify-center rounded-full hover:bg-red-100 transition" title="Add to Wishlist">
                <svg xmlns="http://www.w3.org/2000/svg" width="16px" class="fill-slate-800 group-hover:fill-red-500 transition" viewBox="0 0 64 64">
                  <path d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"/>
                </svg>
              </button>
            </form>
          </div>
        </div>
      </a>

      <!-- Add to Cart -->
      <div class="min-h-[50px] p-4 !pt-0">
        <form action="{{ url('add_cart', $product->id) }}" method="POST" class="absolute left-0 right-0 bottom-3 max-w-[88%] mx-auto">
          @csrf
          <input type="number" name="qty" value="1" min="1" class="hidden">
          <button type="submit" class="cursor-pointer text-sm px-2 py-2 font-medium w-full bg-blue-600 hover:bg-blue-700 text-white tracking-wide outline-none border-none rounded-sm">
            Add to cart
          </button>
        </form>
      </div>
    </div>
    @endforeach
  </div>
</div>
