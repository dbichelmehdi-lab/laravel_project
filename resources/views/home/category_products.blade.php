<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>V e-comm</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

  <!-- Header -->
  <nav>
    @include('home.header')
  </nav>


  <!-- Landing Page -->

  @include('home.landing_page')







  <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 bg-white p-2 rounded-lg shadow">
    Available Products in <span class="text-gray-600">{{ $category->category_name }}</span>
  </h1>












  <section class="py-24">
    <div class="bg-white">
      <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">


        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
          @foreach($products as $product)
            <div class="group relative">
              <img src="{{ asset('product_img/' . $product->image) }}" alt="Front of men&#039;s Basic Tee in black."
                class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />
              <div class="mt-4 flex justify-between">
                <div>
                  <h3 class="text-sm text-gray-700">
                    <a href="{{ route('product.details', $product->id) }}">
                      <span aria-hidden="true" class="absolute inset-0"></span>
                      {{$product->name}}
                    </a>
                  </h3>
                  <p class="mt-1 text-sm text-gray-500">{{$product->product_details}}</p>
                </div>
                <p class="text-sm font-medium text-gray-900">${{$product->price}}</p>
              </div>
              <form action="{{url('add_cart', $product->id)}}" class="add-to-cart-form mt-3" method="POST">
                @csrf
                <div class="flex justify-between items-center gap-4">
                  <input type="number" name="qty" min="1" value="1" class="hidden" />

                  <button type="submit"
                    class="flex items-center gap-2 px-5 py-2 rounded-lg text-white font-medium bg-gradient-to-r from-blue-500 to-blue-700 shadow-md hover:shadow-lg hover:from-blue-600 hover:to-blue-800 transform hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13M7 13l-4-8m0 0H2m16 16a1 1 0 100-2 1 1 0 000 2zm-10 0a1 1 0 100-2 1 1 0 000 2z" />
                    </svg>

                  </button>


                </div>
              </form>
            </div>
          @endforeach
        </div>

      </div>
    </div>
    </div>
  </section>



  </a>

</body>

</html>