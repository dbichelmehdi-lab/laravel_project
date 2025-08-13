<section class="bg-gradient-to-b from-gray-50 to-white py-24">
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Nike Home</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900 font-sans">



<!-- Hero Section -->
<section class="relative min-h-screen bg-gradient-to-b from-black via-gray-900 to-black text-white overflow-hidden -mt-24">
  <!-- Background Image with Overlay -->
  <div class="absolute inset-0">
    <img src="https://images.unsplash.com/photo-1718309602791-8f3cc83840b7?q=80&w=1974&auto=format&fit=crop"
      alt="Luxury Watch" class="w-full h-full object-cover opacity-40" />
    <div class="absolute inset-0 bg-gradient-to-r from-black via-transparent to-black"></div>
  </div>

  <!-- Content -->
  <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-12 flex flex-col md:flex-row items-center justify-center min-h-screen">
    
    <!-- Text -->
    <div class="md:w-1/2 space-y-6 animate-fadeInUp">
      <h1 class="text-5xl md:text-6xl font-light leading-tight">
        Timeless <span class="font-semibold text-gray-200">Luxury</span><br>
        Crafted for You
      </h1>
      <p class="text-lg text-gray-300 max-w-md">
        Discover our exclusive collection of premium watches, where elegance meets precision.
      </p>
      <div class="flex space-x-4">
        <a href="#" class="px-6 py-3 bg-white text-black rounded-lg hover:bg-gray-200 transition shadow-lg">
          Shop Now
        </a>
        <a href="#" class="px-6 py-3 border border-gray-400 rounded-lg hover:bg-gray-800 transition">
          Learn More
        </a>
      </div>
    </div>

    <!-- Product Image Card -->
    <div class="md:w-1/2 mt-10 md:mt-0 animate-fadeIn">
      <div class="backdrop-blur-lg bg-white/5 p-6 rounded-2xl shadow-2xl border border-gray-700 hover:scale-105 transition transform duration-500">
        <img src="https://images.unsplash.com/photo-1718309602791-8f3cc83840b7?q=80&w=1974&auto=format&fit=crop"
          alt="Watch" class="rounded-xl shadow-lg" />
      </div>
    </div>
  </div>
</section>

<!-- Tailwind Animations -->
<style>
@keyframes fadeIn {
  0% { opacity: 0; transform: translateY(20px); }
  100% { opacity: 1; transform: translateY(0); }
}
@keyframes fadeInUp {
  0% { opacity: 0; transform: translateY(40px); }
  100% { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn { animation: fadeIn 1.2s ease-out forwards; }
.animate-fadeInUp { animation: fadeInUp 1.4s ease-out forwards; }
</style>









 




<div class="py-10 px-4 sm:px-6 bg-gradient-to-b from-gray-50 to-white rounded-xl shadow-sm">
    <h2 class="text-3xl font-extrabold text-center text-slate-900 tracking-tight mb-12">
        Top Categories
    </h2>

    <div class="flex flex-wrap justify-center gap-6">
        @foreach ($categories as $category)
            <a href="{{ route('category.products', $category->id) }}" 
               class="px-8 py-4 bg-white border border-gray-200 rounded-full shadow-md 
                      text-gray-700 font-semibold text-sm uppercase tracking-wide
                      hover:bg-gray-800 hover:text-white hover:scale-105 hover:shadow-xl
                      transition-all duration-300 ease-in-out transform">
                {{ $category->category_name }}
            </a>
        @endforeach
    </div>
</div>

</section>


</body>
</html>