<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
        }

        .shadow-elegant {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 via-white to-gray-100 min-h-screen">

    <!-- Header -->
    <nav class="sticky top-0 z-50 glass-effect border-b border-white/20">
        @include('home.header')
    </nav>

    <!-- Main Product Section -->
    <div class="container mx-auto px-4 py-12 max-w-7xl">
        <div class="grid lg:grid-cols-2 gap-12 items-start">

            <!-- Product Images Section -->
            <div class="animate-fade-in">
                <div class="relative group">
                    <img src="{{ asset('product_img/' . $product->image) }}" alt="Product"
                        class="w-full h-[500px] object-cover rounded-2xl shadow-elegant transition-transform duration-500 group-hover:scale-[1.02]"
                        id="mainImage">
                    <div
                        class="absolute inset-0 rounded-2xl bg-gradient-to-t from-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                </div>

                <!-- Image indicators (placeholder for additional images) -->
                <div class="flex justify-center mt-6 space-x-3">
                    <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                    <div class="w-3 h-3 rounded-full bg-gray-300"></div>
                    <div class="w-3 h-3 rounded-full bg-gray-300"></div>
                </div>
            </div>

            <!-- Product Details Section -->
            <div class="animate-slide-up space-y-8">

                <!-- Product Header -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <span class="px-3 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-full">
                            Premium Quality
                        </span>
                        <span class="text-sm text-gray-500 font-medium">SKU: WH1000XM4</span>
                    </div>

                    <h1 class="text-4xl font-bold text-gray-900 leading-tight">
                        {{$product->name}}
                    </h1>

                    <!-- Rating Section -->
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5 text-yellow-400">
                                <path fill-rule="evenodd"
                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5 text-yellow-400">
                                <path fill-rule="evenodd"
                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5 text-yellow-400">
                                <path fill-rule="evenodd"
                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5 text-yellow-400">
                                <path fill-rule="evenodd"
                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5 text-yellow-400">
                                <path fill-rule="evenodd"
                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm font-medium text-gray-900">4.5</span>
                            <span class="text-sm text-gray-500">(120 reviews)</span>
                        </div>
                    </div>
                </div>

                <!-- Price Section -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-xl border border-blue-100">
                    <div class="flex items-baseline space-x-4">
                        <span class="text-4xl font-bold text-gray-900">${{$product->price}}</span>
                        <span class="text-xl text-gray-500 line-through">${{($product->price) + 50}}</span>
                        <span class="px-3 py-1 text-sm font-semibold text-green-700 bg-green-100 rounded-full">
                            Save $50
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 mt-2">Free shipping on orders over $100</p>
                </div>

                <!-- Product Description -->
                <div class="prose prose-gray max-w-none">
                    <p class="text-gray-700 leading-relaxed text-lg">
                        {{$product->product_details}}
                    </p>
                </div>

                <!-- Color Selection -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900">Choose Color:</h3>
                    <div class="flex space-x-4">
                        <button
                            class="relative w-12 h-12 bg-black rounded-full ring-2 ring-offset-2 ring-black focus:outline-none transition-transform hover:scale-110">
                            <span class="sr-only">Black</span>
                        </button>
                        <button
                            class="relative w-12 h-12 bg-gray-300 rounded-full ring-2 ring-offset-2 ring-transparent hover:ring-gray-300 focus:outline-none transition-transform hover:scale-110">
                            <span class="sr-only">Silver</span>
                        </button>
                        <button
                            class="relative w-12 h-12 bg-blue-500 rounded-full ring-2 ring-offset-2 ring-transparent hover:ring-blue-500 focus:outline-none transition-transform hover:scale-110">
                            <span class="sr-only">Blue</span>
                        </button>
                    </div>
                </div>

                <!-- Add to Cart Section -->
                <form action="{{url('add_cart', $product->id)}}" class="add-to-cart-form" method="POST">
                    @csrf
                    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 space-y-6">
                        <div class="flex items-center justify-between">
                            <label class="text-sm font-medium text-gray-700">Quantity:</label>
                            <input type="number" name="qty" min="1" value="1"
                                class="w-24 px-4 py-2 text-center border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" />
                        </div>

                        <button type="submit"
                            class="w-full flex items-center justify-center gap-3 px-8 py-4 text-white font-semibold bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl shadow-lg hover:shadow-xl hover:from-blue-700 hover:to-blue-800 transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-blue-500/50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13M7 13l-4-8m0 0H2m16 16a1 1 0 100-2 1 1 0 000 2zm-10 0a1 1 0 100-2 1 1 0 000 2z" />
                            </svg>
                            Add to Cart
                        </button>
                    </div>
                </form>

                <!-- Key Features -->
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-6 rounded-xl">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Key Features
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="flex items-center space-x-3 p-3 bg-white rounded-lg shadow-sm">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <span class="text-gray-700">Industry-leading noise cancellation</span>
                        </div>
                        <div class="flex items-center space-x-3 p-3 bg-white rounded-lg shadow-sm">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <span class="text-gray-700">30-hour battery life</span>
                        </div>
                        <div class="flex items-center space-x-3 p-3 bg-white rounded-lg shadow-sm">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <span class="text-gray-700">Touch sensor controls</span>
                        </div>
                        <div class="flex items-center space-x-3 p-3 bg-white rounded-lg shadow-sm">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <span class="text-gray-700">Speak-to-chat technology</span>
                        </div>
                    </div>
                </div>

                <!-- Additional Product Info -->
                <div class="grid grid-cols-2 gap-4 pt-4">
                    <div class="text-center p-4 bg-white rounded-lg shadow-sm border">
                        <svg class="w-8 h-8 text-green-600 mx-auto mb-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <p class="text-sm font-medium text-gray-900">2 Year Warranty</p>
                    </div>
                    <div class="text-center p-4 bg-white rounded-lg shadow-sm border">
                        <svg class="w-8 h-8 text-blue-600 mx-auto mb-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <p class="text-sm font-medium text-gray-900">Free Returns</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeImage(src) {
            document.getElementById('mainImage').src = src;
        }

        // Add smooth scroll behavior
        document.addEventListener('DOMContentLoaded', function () {
            // Add animation classes to elements as they come into view
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in');
                    }
                });
            }, observerOptions);

            // Observe all animated elements
            document.querySelectorAll('[class*="animate-"]').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
</body>

</html>