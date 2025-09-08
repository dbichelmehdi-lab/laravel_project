<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Premium Wishlist Experience</title>
    <script>
        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                // optional if you want to prevent default form submit
                // e.preventDefault();  
                console.log('Button clicked:', this.innerText);
            });
        });


        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'premium-gold': '#D4AF37',
                        'premium-dark': '#1a1a1a',
                        'premium-gray': '#f8fafc',
                        'accent-rose': '#e11d48',
                        'accent-purple': '#8b5cf6',
                        'accent-blue': '#3b82f6'
                    },
                    animation: {
                        'float-slow': 'floatSlow 8s ease-in-out infinite',
                        'slide-up': 'slideUp 0.8s ease-out',
                        'fade-in-scale': 'fadeInScale 0.6s ease-out',
                        'pulse-glow': 'pulseGlow 3s ease-in-out infinite',
                        'shimmer': 'shimmer 2s linear infinite',
                        'bounce-gentle': 'bounceGentle 2s infinite',
                        'rotate-slow': 'rotateSlow 10s linear infinite'
                    },
                    boxShadow: {
                        'luxury': '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
                        'premium': '0 35px 60px -12px rgba(0, 0, 0, 0.3)',
                        'glow-pink': '0 0 20px rgba(225, 29, 72, 0.4)',
                        'glow-purple': '0 0 25px rgba(139, 92, 246, 0.5)',
                        'inner-luxury': 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.06)'
                    },
                    backgroundImage: {
                        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                        'gradient-conic': 'conic-gradient(from 180deg at 50% 50%, var(--tw-gradient-stops))',
                        'luxury-gradient': 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                        'premium-gradient': 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)',
                        'gold-gradient': 'linear-gradient(135deg, #ffd89b 0%, #19547b 100%)'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        @keyframes floatSlow {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-15px) rotate(1deg);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes pulseGlow {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(139, 92, 246, 0.3);
            }

            50% {
                box-shadow: 0 0 40px rgba(139, 92, 246, 0.6), 0 0 60px rgba(139, 92, 246, 0.3);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -200px 0;
            }

            100% {
                background-position: calc(200px + 100%) 0;
            }
        }

        @keyframes bounceGentle {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        @keyframes rotateSlow {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .glass-luxury {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .glass-premium {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.85));
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .neumorphic {
            background: linear-gradient(145deg, #ffffff, #f0f0f0);
            box-shadow: 20px 20px 60px #d1d1d1, -20px -20px 60px #ffffff;
        }

        .neumorphic-inset {
            background: linear-gradient(145deg, #f0f0f0, #ffffff);
            box-shadow: inset 20px 20px 60px #d1d1d1, inset -20px -20px 60px #ffffff;
        }

        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .text-gold-gradient {
            background: linear-gradient(135deg, #ffd89b 0%, #19547b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hover-lift {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.25);
        }

        .shimmer-effect {
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            background-size: 200px 100%;
            animation: shimmer 2s infinite;
        }

        .floating-shapes::before {
            content: '';
            position: absolute;
            top: 20%;
            left: -5%;
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(59, 130, 246, 0.1));
            border-radius: 50%;
            animation: floatSlow 12s ease-in-out infinite;
            z-index: -1;
        }

        .floating-shapes::after {
            content: '';
            position: absolute;
            bottom: 10%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, rgba(225, 29, 72, 0.1), rgba(139, 92, 246, 0.1));
            border-radius: 50%;
            animation: floatSlow 15s ease-in-out infinite reverse;
            z-index: -1;
        }

        .premium-card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.8));
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        .product-card {
            position: relative;
            overflow: hidden;
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
            z-index: 1;
        }

        .product-card:hover::before {
            left: 100%;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 via-white to-purple-50 min-h-screen">

    <!-- Luxury Header -->
    <nav class="sticky top-0 z-50 glass-luxury border-b border-white/10">
        @include('home.header')
    </nav>

    <!-- Floating Background Shapes -->
    <div class="fixed inset-0 z-0 overflow-hidden floating-shapes"></div>

    <!-- Hero Section -->
    <div class="relative z-10 pt-20 pb-12">
        <div class="container mx-auto px-6">
            <div class="text-center space-y-6 animate-slide-up">
                <!-- Premium Title -->
                <div class="inline-flex items-center space-x-4 glass-premium rounded-full px-8 py-3 mb-6">
                    <svg class="w-6 h-6 text-accent-rose animate-pulse-glow" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                    <span class="text-sm font-semibold text-gray-800 uppercase tracking-wider">Curated Collection</span>
                </div>

                <h1 class="text-6xl xl:text-7xl font-black leading-tight">
                    <span class="text-gradient">My Wishlist</span>
                </h1>

                <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Your personal collection of desired items, carefully curated for your perfect shopping experience
                </p>

                <!-- Statistics Cards -->
                <div class="flex justify-center space-x-8 mt-12">
                    <div class="premium-card rounded-2xl p-6 text-center hover-lift">
                        <div class="text-3xl font-bold text-gradient mb-2">{{ count($wishlists ?? []) }}</div>
                        <div class="text-sm text-gray-600 uppercase tracking-wide">Saved Items</div>
                    </div>
                    <div class="premium-card rounded-2xl p-6 text-center hover-lift">
                        <div class="text-3xl font-bold text-gold-gradient mb-2">Premium</div>
                        <div class="text-sm text-gray-600 uppercase tracking-wide">Quality</div>
                    </div>
                    <div class="premium-card rounded-2xl p-6 text-center hover-lift">
                        <div class="text-3xl font-bold text-gradient mb-2">24/7</div>
                        <div class="text-sm text-gray-600 uppercase tracking-wide">Available</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Premium Wishlist Section -->
    <section class="relative z-10 py-20 px-6">
        <div class="container mx-auto max-w-7xl">

            @forelse ($wishlists as $index => $item)
                @if ($loop->first)
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                @endif

                    <!-- Ultra-Premium Product Card -->
                    <div class="product-card premium-card rounded-3xl p-8 hover-lift animate-fade-in-scale group"
                        style="animation-delay: {{ $index * 0.1 }}s">

                        <!-- Premium Badge -->
                        <div class="absolute top-6 right-6 z-20">
                            <div class="glass-premium rounded-full p-3 shadow-luxury">
                                <svg class="w-5 h-5 text-accent-rose animate-bounce-gentle" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Luxury Product Image Container -->
                        <div
                            class="relative mb-8 group-hover:transform group-hover:scale-105 transition-transform duration-500">
                            <div class="aspect-w-1 aspect-h-1 rounded-2xl overflow-hidden shadow-luxury">
                                <img src="{{ asset('product_img/' . $item->product->image) }}"
                                    alt="{{ $item->product->name }}"
                                    class="w-full h-64 object-cover transition-transform duration-700 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                </div>
                            </div>

                            <!-- Floating Action Button -->
                            <div
                                class="absolute -bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                                <button
                                    class="w-12 h-12 bg-gradient-to-r from-accent-purple to-accent-blue rounded-full shadow-premium flex items-center justify-center hover:shadow-glow-purple transition-all duration-300 hover:scale-110">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Premium Product Details -->
                        <div class="space-y-6">
                            <!-- Product Title -->
                            <div>
                                <h3
                                    class="text-2xl font-bold text-gray-900 leading-tight group-hover:text-gradient transition-all duration-300">
                                    {{ $item->product->name }}
                                </h3>
                            </div>

                            <!-- Luxury Price Display -->
                            <div class="flex items-center justify-between">
                                <div class="space-y-1">
                                    <div class="text-3xl font-black text-gradient">
                                        ${{ $item->product->price }}
                                    </div>
                                    <div class="text-sm text-gray-500 uppercase tracking-wide">
                                        Premium Pricing
                                    </div>
                                </div>

                                <!-- Quality Indicator -->
                                <div class="text-right">
                                    <div class="flex items-center space-x-1 mb-1">
                                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="text-xs text-gray-500 font-medium">Premium Quality</div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex space-x-4">
                                <!-- Add to Cart Button -->

                                <form action="{{ route('add_cart', $item->product->id) }} method="POST"
                                    class="absolute left-0 right-0 bottom-3 max-w-[88%] mx-auto">
                                    @csrf
                                    <button
                                        class="add-to-cart-btn flex-1 group relative overflow-hidden bg-gradient-to-r from-accent-blue to-accent-purple text-white font-bold py-4 px-6 rounded-2xl shadow-premium hover:shadow-glow-purple transform hover:-translate-y-1 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-purple-500/50">
                                        <span class="relative z-10 flex items-center justify-center gap-2">
                                            <svg class="w-5 h-5 transition-transform group-hover:rotate-12" fill="none"
                                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13M7 13l-4-8m0 0H2m16 16a1 1 0 100-2 1 1 0 000 2zm-10 0a1 1 0 100-2 1 1 0 000 2z" />
                                            </svg>
                                            Add to Cart
                                        </span>
                                        <div
                                            class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-0 group-hover:opacity-20 transform -skew-x-12 group-hover:animate-shimmer">
                                        </div>
                                    </button>
                                </form>

                                <!-- Remove Button -->
                                <form action="{{ route('wishlist.remove', $item->product->id) }}" method="POST"
                                    class="remove-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="group relative overflow-hidden bg-gradient-to-r from-red-500 to-pink-500 text-white font-semibold p-4 rounded-2xl shadow-luxury hover:shadow-glow-pink transform hover:-translate-y-1 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-red-500/50">
                                        <svg class="w-5 h-5 transition-transform group-hover:scale-110 group-hover:rotate-12"
                                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span class="sr-only">Remove from wishlist</span>
                                    </button>
                                </form>
                            </div>

                            <!-- Premium Features -->
                            <div class="pt-4 border-t border-gray-100">
                                <div class="grid grid-cols-2 gap-4 text-xs">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse-glow"></div>
                                        <span class="text-gray-600 font-medium">Free Shipping</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse-glow"></div>
                                        <span class="text-gray-600 font-medium">30-Day Return</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-purple-500 rounded-full animate-pulse-glow"></div>
                                        <span class="text-gray-600 font-medium">Premium Support</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-yellow-500 rounded-full animate-pulse-glow"></div>
                                        <span class="text-gray-600 font-medium">2-Year Warranty</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($loop->last)
                        </div>
                    @endif

            @empty
                <!-- Ultra-Premium Empty State -->
                <div class="text-center py-20">
                    <div class="premium-card rounded-3xl p-16 max-w-2xl mx-auto animate-fade-in-scale">
                        <!-- Animated Empty Icon -->
                        <div class="w-32 h-32 mx-auto mb-8 relative">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-gray-200 to-gray-300 rounded-full animate-pulse-glow">
                            </div>
                            <div class="absolute inset-4 bg-white rounded-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400 animate-bounce-gentle" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Elegant Empty Message -->
                        <h3 class="text-3xl font-bold text-gradient mb-4">Your Wishlist Awaits</h3>
                        <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                            Start curating your perfect collection of desired items. Every great purchase begins with a
                            wish.
                        </p>

                        <!-- Call to Action -->
                        <a href="#"
                            class="inline-flex items-center space-x-3 bg-gradient-to-r from-accent-purple to-accent-blue text-white font-bold py-4 px-8 rounded-2xl shadow-premium hover:shadow-glow-purple transform hover:-translate-y-1 transition-all duration-300 group">
                            <svg class="w-6 h-6 transition-transform group-hover:rotate-12" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <span>Discover Products</span>
                            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Enhanced Remove Button Functionality
            const removeForms = document.querySelectorAll('.remove-form');
            removeForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    const button = this.querySelector('button[type="submit"]');

                    // Add loading state
                    button.innerHTML = `
                        <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        <span class="sr-only">Removing...</span>
                    `;

                    // Add removing animation to parent card
                    const card = this.closest('.product-card');
                    if (card) {
                        setTimeout(() => {
                            card.style.transform = 'scale(0.95)';
                            card.style.opacity = '0.5';
                        }, 100);
                    }
                });
            });

            // Advanced Scroll Animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.animationDelay = (index * 0.1) + 's';
                            entry.target.classList.add('animate-slide-up');
                        }, index * 100);
                    }
                });
            }, observerOptions);

            // Observe all product cards
            document.querySelectorAll('.product-card').forEach(card => {
                observer.observe(card);
            });

            // Premium Hover Effects
            const cards = document.querySelectorAll('.product-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function () {
                    this.style.zIndex = '20';
                });

                card.addEventListener('mouseleave', function () {
                    this.style.zIndex = '10';
                });
            });

            // Add to Cart Button Enhancement
            const addToCartButtons = document.querySelectorAll('button:contains("Add to Cart")');
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const originalHTML = this.innerHTML;

                    // Show loading state
                    this.innerHTML = `
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Adding to Cart...
                        </span>
                    `;

                    // Simulate success state after 1 second
                    setTimeout(() => {
                        this.innerHTML = `
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Added to Cart!
                            </span>
                        `;

                        // Reset after 2 seconds
                        setTimeout(() => {
                            this.innerHTML = originalHTML;
                        }, 2000);
                    }, 1000);
                });
            });
        });
    </script>
</body>

</html>