<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <nav>
        @include('home.header')
    </nav>

    <!-- Page Content -->
    <main class="container mx-auto mt-10">
        <h2 class="text-3xl font-semibold mb-8">Checkout</h2>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('process.checkout') }}" method="POST" id="checkout-form">
            @csrf
            <div class="flex flex-col lg:flex-row gap-8">

                <!-- Customer Information & Addresses -->
                <div class="lg:w-2/3">

                    <!-- Customer Information -->
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h3 class="text-xl font-semibold mb-4">Customer Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">Full
                                    Name *</label>
                                <input type="text" id="customer_name" name="customer_name"
                                    value="{{ old('customer_name', $user->name ?? '') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required>
                            </div>
                            <div>
                                <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-1">Email
                                    Address *</label>
                                <input type="email" id="customer_email" name="customer_email"
                                    value="{{ old('customer_email', $user->email ?? '') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required>
                            </div>
                            <div class="md:col-span-2">
                                <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-1">Phone
                                    Number *
                                    <span class="text-gray-500 text-xs">(International format: +212123456789)</span>
                                </label>
                                <input type="tel" id="customer_phone" name="customer_phone"
                                    value="{{ old('customer_phone') }}" placeholder="+212123456789"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    pattern="^\+[1-9]\d{1,14}$" required>
                                <small class="text-gray-600">Must start with + followed by country code and
                                    number</small>
                            </div>
                        </div>
                    </div>

                    <!-- Billing Address -->
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h3 class="text-xl font-semibold mb-4">Billing Address</h3>
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="billing_address" class="block text-sm font-medium text-gray-700 mb-1">Street
                                    Address *</label>
                                <input type="text" id="billing_address" name="billing_address"
                                    value="{{ old('billing_address') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="billing_city" class="block text-sm font-medium text-gray-700 mb-1">City
                                        *</label>
                                    <input type="text" id="billing_city" name="billing_city"
                                        value="{{ old('billing_city') }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        required>
                                </div>
                                <div>
                                    <label for="billing_state"
                                        class="block text-sm font-medium text-gray-700 mb-1">State/Province *</label>
                                    <input type="text" id="billing_state" name="billing_state"
                                        value="{{ old('billing_state') }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        required>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="billing_postal_code"
                                        class="block text-sm font-medium text-gray-700 mb-1">Postal Code *</label>
                                    <input type="text" id="billing_postal_code" name="billing_postal_code"
                                        value="{{ old('billing_postal_code') }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        required>
                                </div>
                                <div>
                                    <label for="billing_country"
                                        class="block text-sm font-medium text-gray-700 mb-1">Country *</label>
                                    <select id="billing_country" name="billing_country"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        required>
                                        <option value="">Select Country</option>
                                        <option value="Morocco" {{ old('billing_country') == 'Morocco' ? 'selected' : '' }}>Morocco</option>
                                        <option value="France" {{ old('billing_country') == 'France' ? 'selected' : '' }}>
                                            France</option>
                                        <option value="Spain" {{ old('billing_country') == 'Spain' ? 'selected' : '' }}>
                                            Spain</option>
                                        <option value="USA" {{ old('billing_country') == 'USA' ? 'selected' : '' }}>United
                                            States</option>
                                        <option value="Canada" {{ old('billing_country') == 'Canada' ? 'selected' : '' }}>
                                            Canada</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Address -->
                    <!-- REMOVED - No shipping needed -->

                    <!-- Order Notes -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-semibold mb-4">Order Notes (Optional)</h3>
                        <textarea name="order_notes" id="order_notes" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Any special instructions for your order...">{{ old('order_notes') }}</textarea>
                    </div>

                </div>

                <!-- Order Summary -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                        <h3 class="text-xl font-semibold mb-4">Order Summary</h3>

                        <!-- Cart Items -->
                        <div class="space-y-3 mb-4">
                            @foreach($cart as $id => $item)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <img src="{{ asset('product_img/' . $item['image']) }}"
                                            class="w-12 h-12 object-cover rounded mr-3" alt="">
                                        <div>
                                            <p class="font-medium text-sm">{{ $item['name'] }}</p>
                                            <p class="text-gray-500 text-xs">Qty: {{ $item['quantity'] }}</p>
                                        </div>
                                    </div>
                                    <span
                                        class="font-medium">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                </div>
                            @endforeach
                        </div>

                        <!-- Totals -->
                        <div class="border-t pt-4 space-y-2">
                            <div class="flex justify-between">
                                <span>Subtotal</span>
                                <span>${{ number_format($total_amount, 2) }}</span>
                            </div>
                            <div class="flex justify-between font-semibold text-lg border-t pt-2">
                                <span>Total</span>
                                <span>${{ number_format($total_amount, 2) }}</span>
                            </div>
                        </div>

                        <!-- Place Order Button -->
                        <button type="submit" id="place-order-btn"
                            class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-semibold mt-6 hover:bg-blue-700 transition duration-200">
                            <span id="btn-text">Place Order</span>
                            <span id="btn-loading" class="hidden">Processing...</span>
                        </button>

                        <!-- Back to Cart -->
                        <a href="{{ route('my_cart') }}"
                            class="block text-center text-blue-600 hover:text-blue-800 mt-3">
                            ← Back to Cart
                        </a>
                    </div>
                </div>

            </div>
        </form>
    </main>

    <script>
        // Form submission handling
        document.getElementById('checkout-form').addEventListener('submit', function () {
            const btn = document.getElementById('place-order-btn');
            const btnText = document.getElementById('btn-text');
            const btnLoading = document.getElementById('btn-loading');

            // Disable button
            btn.disabled = true;

            // Change appearance
            btnText.classList.add('hidden');   // hide text
            btnLoading.classList.remove('hidden'); // show spinner
        });
    </script>