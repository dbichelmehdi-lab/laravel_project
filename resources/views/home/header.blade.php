<!-- Premium Navbar Component -->
<style>
  /* Premium Animations */
  @keyframes slideDown {
    from {
      opacity: 0;
      transform: translateY(-10px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
    }

    to {
      opacity: 1;
    }
  }

  @keyframes pulse {

    0%,
    100% {
      transform: scale(1);
    }

    50% {
      transform: scale(1.05);
    }
  }

  /* Enhanced Hover Effects */
  .group:hover .animate-pulse {
    animation: pulse 1s infinite;
  }

  /* Smooth Backdrop Blur */
  .backdrop-filter {
    -webkit-backdrop-filter: blur(20px);
    backdrop-filter: blur(20px);
  }

  /* Custom Focus States */
  input:focus {
    transform: translateY(-1px);
  }

  /* Mobile Responsive Adjustments */
  @media (max-width: 640px) {

    .hidden.sm\\:inline,
    .hidden.sm\\:inline-block {
      display: none !important;
    }
  }

  /* Badge Animation */
  @keyframes badgePulse {

    0%,
    100% {
      transform: scale(1);
      opacity: 1;
    }

    50% {
      transform: scale(1.1);
      opacity: 0.8;
    }
  }

  .animate-pulse {
    animation: badgePulse 2s infinite;
  }
</style>
<div
  class="relative bg-white/95 backdrop-filter backdrop-blur-lg border-b border-gray-200/50 shadow-lg sticky top-0 z-50">
  <!-- Background Pattern -->
  <div class="absolute inset-0 opacity-5">
    <div class="absolute inset-0"
      style="background-image: radial-gradient(circle at 2px 2px, rgba(0,0,0,0.1) 1px, transparent 0); background-size: 30px 30px;">
    </div>
  </div>

  <div class="py-4 px-6 relative z-10">
    <div class="flex justify-between items-center max-w-7xl mx-auto">

      <!-- Enhanced Logo -->
      <div class="flex items-center">
        <a href="{{url('/')}}" class="flex items-center group">
          <div class="relative">
            <div
              class="absolute inset-0 bg-gradient-to-r from-red-500 to-red-600 rounded-xl blur opacity-25 group-hover:opacity-40 transition-opacity duration-300">
            </div>
            <div
              class="relative bg-gradient-to-r from-red-500 to-red-600 p-2 rounded-xl group-hover:scale-110 transition-all duration-300 shadow-lg">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
              </svg>
            </div>
          </div>
          <div class="ml-4">
            <span
              class="font-bold text-xl tracking-wide bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
              What a Market
            </span>
            <div
              class="h-0.5 w-0 bg-gradient-to-r from-red-500 to-red-600 group-hover:w-full transition-all duration-300">
            </div>
          </div>
        </a>
      </div>

      <!-- Enhanced Search -->
      <div class="ml-8 flex flex-1 max-w-lg">
        <div class="relative w-full">
          <div
            class="absolute inset-0 bg-gradient-to-r from-red-500/10 to-blue-500/10 rounded-2xl blur opacity-0 focus-within:opacity-100 transition-opacity duration-300">
          </div>
          <div class="relative flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 h-5 w-5 text-gray-400" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text"
              class="w-full pl-12 pr-6 py-3 rounded-2xl border border-gray-200 bg-white/80 backdrop-filter backdrop-blur-sm text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/20 focus:bg-white transition-all duration-300 shadow-sm hover:shadow-md"
              placeholder="Search for amazing products..." value="DJI phantom" />
            <div class="absolute right-3">
              <kbd
                class="hidden sm:inline-block px-2 py-1 text-xs text-gray-500 bg-gray-100 border border-gray-200 rounded">
                ⌘K
              </kbd>
            </div>
          </div>
        </div>
      </div>

      <!-- Enhanced Actions -->
      <div class="ml-6 flex items-center gap-x-4">

        <!-- Enhanced Wishlist -->
        <div class="relative group">
          <div
            class="absolute inset-0 bg-gradient-to-r from-pink-500/20 to-red-500/20 rounded-2xl blur opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          </div>
          <div
            class="relative flex items-center gap-x-3 px-4 py-3 rounded-2xl hover:bg-gray-50 transition-all duration-300 cursor-pointer border border-transparent hover:border-gray-200">
            <a href="{{ route('wishlist.index') }}" class="flex items-center gap-x-2">
              <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg"
                  class="h-6 w-6 text-gray-600 group-hover:text-red-500 transition-colors duration-300"
                  viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd"
                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                    clip-rule="evenodd" />
                </svg>

                {{-- Enhanced Count Badge --}}
                @auth
                  @php
                    $wishlistCount = \App\Models\Wishlist::where('user_id', auth()->id())->count();
                  @endphp
                  @if($wishlistCount > 0)
                    <span
                      class="absolute -top-2 -right-2 flex h-5 w-5 items-center justify-center rounded-full bg-gradient-to-r from-red-500 to-pink-500 text-xs text-white font-bold shadow-lg animate-pulse">
                      {{ $wishlistCount }}
                    </span>
                  @endif
                @endauth
              </div>

              <span
                class="hidden sm:inline text-sm font-medium text-gray-700 group-hover:text-gray-900 transition-colors duration-300">
                Wishlist
              </span>
            </a>
          </div>
        </div>

        @if(Route::has('login'))
          @auth
            <!-- Enhanced Cart -->
            <div class="relative group">
              <div
                class="absolute inset-0 bg-gradient-to-r from-blue-500/20 to-purple-500/20 rounded-2xl blur opacity-0 group-hover:opacity-100 transition-opacity duration-300">
              </div>
              <div class="relative">
                @php
                  $cartQty = session('cart') ? collect(session('cart'))->sum('quantity') : 0;
                @endphp
                <a href="{{ route('my_cart') }}"
                  class="flex items-center gap-x-2 px-4 py-3 rounded-2xl hover:bg-gray-50 transition-all duration-300 border border-transparent hover:border-gray-200">
                  <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg"
                      class="h-6 w-6 text-gray-600 group-hover:text-blue-600 transition-all duration-300 group-hover:scale-110"
                      viewBox="0 0 20 20" fill="currentColor">
                      <path
                        d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                    </svg>

                    @if($cartQty > 0)
                      <span
                        class="absolute -top-2 -right-2 flex h-5 w-5 items-center justify-center rounded-full bg-gradient-to-r from-blue-500 to-purple-500 text-xs text-white font-bold shadow-lg">
                        {{ $cartQty }}
                      </span>
                    @endif
                  </div>

                  <span
                    class="hidden sm:inline text-sm font-medium text-gray-700 group-hover:text-gray-900 transition-colors duration-300">
                    Cart
                  </span>
                </a>
              </div>
            </div>

            <!-- Simple Logout -->
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit"
                class="text-gray-700 hover:text-red-600 font-medium text-sm px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                Logout
              </button>
            </form>
          @else
            <!-- Simple Auth Buttons -->
            <div class="flex gap-3 items-center">
              <a href="{{ route('login') }}"
                class="text-gray-700 hover:text-blue-600 font-medium text-sm px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                Login
              </a>
              <a href="{{ route('register') }}"
                class="text-gray-700 hover:text-blue-600 font-medium text-sm px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                Register
              </a>
            </div>
          @endauth
        @endif
      </div>
    </div>
  </div>
</div>