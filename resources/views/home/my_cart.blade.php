<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Header -->
    <nav>
        @include('home.header')
    </nav>

    @php
        $cart = session('cart', []); // Get cart or empty array
        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $tax = ($subtotal > 0) ? $subtotal * 0.1 : 0;
        $shipping = ($subtotal > 0) ? 5 : 0;
        $total_amount = $subtotal + $tax + $shipping;
    @endphp

    <!-- Page Content -->
    <main class="container mx-auto mt-10">
        <h2 class="text-2xl font-semibold mb-6">Shopping Cart</h2>
        <div class="flex flex-col md:flex-row gap-4">

            <!-- Cart Items -->
            <div class="md:w-3/4">
                <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                    @if(count($cart) > 0)
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="text-left font-semibold">Product</th>
                                    <th class="text-left font-semibold">Price</th>
                                    <th class="text-left font-semibold">Quantity</th>
                                    <th class="text-left font-semibold">Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $id => $item)
                                    @php $total = $item['price'] * $item['quantity']; @endphp
                                    <tr class="border-b">
                                        <td class="py-4">
                                            <div class="flex items-center">
                                                <img src="{{ asset('product_img/' . $item['image']) }}" class="h-16 w-16 mr-4 object-cover rounded" alt="">
                                                <span class="font-semibold">{{ $item['name'] }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4">${{ number_format($item['price'], 2) }}</td>
                                        <td class="py-4">{{ $item['quantity'] }}</td>
                                        <td class="py-4">${{ number_format($total, 2) }}</td>
                                        <td class="py-4">
                                            <a href="{{ route('remove_cart', $id) }}" class="text-red-600 hover:underline">Remove</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500">Your cart is empty.</p>
                    @endif
                </div>
            </div>

            <!-- Summary -->
            <div class="md:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold mb-4">Summary</h2>
                    <div class="flex justify-between mb-2">
                        <span>Subtotal</span>
                        <span>${{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Taxes (10%)</span>
                        <span>${{ number_format($tax, 2) }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Shipping</span>
                        <span>${{ number_format($shipping, 2) }}</span>
                    </div>
                    <hr class="my-2">
                    <div class="flex justify-between mb-2 font-semibold">
                        <span>Total</span>
                        <span>${{ number_format($total_amount, 2) }}</span>
                    </div>
                    <button class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full hover:bg-blue-600 transition" {{ count($cart) == 0 ? 'disabled' : '' }}>
                        Checkout
                    </button>
                </div>
            </div>

        </div>
    </main>

</body>
</html>
