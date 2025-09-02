<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <nav>
        @include('home.header')
    </nav>

    <!-- Success Content -->
    <main class="container mx-auto mt-10 px-4">
        <div class="max-w-2xl mx-auto">

            <!-- Success Message -->
            <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-medium text-green-800">Payment Successful!</h3>
                        <p class="text-green-700">Your order has been placed and payment has been processed
                            successfully.</p>
                    </div>
                </div>
            </div>

            <!-- Order Details -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-6">Order Confirmation</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Order Information -->
                    <div>
                        <h3 class="text-lg font-medium mb-3">Order Information</h3>
                        <div class="space-y-2 text-sm">
                            <p><span class="font-medium">Order Number:</span> {{ $order->order_number }}</p>
                            <p><span class="font-medium">Order Date:</span>
                                {{ $order->created_at->format('M d, Y H:i') }}</p>
                            <p><span class="font-medium">Payment Status:</span>
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </p>
                            <p><span class="font-medium">Order Status:</span>
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <!-- Customer Information -->
                    <div>
                        <h3 class="text-lg font-medium mb-3">Customer Information</h3>
                        <div class="space-y-2 text-sm">
                            <p><span class="font-medium">Name:</span> {{ $order->customer_name }}</p>
                            <p><span class="font-medium">Email:</span> {{ $order->customer_email }}</p>
                            <p><span class="font-medium">Phone:</span> {{ $order->customer_phone }}</p>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="mt-6">
                    <h3 class="text-lg font-medium mb-3">Order Items</h3>
                    <div class="border rounded-lg overflow-hidden">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($order->order_items as $item)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center">
                                                <img src="{{ asset('product_img/' . $item['image']) }}"
                                                    class="h-12 w-12 object-cover rounded mr-3" alt="">
                                                <span class="font-medium">{{ $item['name'] }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">${{ number_format($item['price'], 2) }}</td>
                                        <td class="px-4 py-3">{{ $item['quantity'] }}</td>
                                        <td class="px-4 py-3">${{ number_format($item['price'] * $item['quantity'], 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="mt-6 bg-gray-50 rounded-lg p-4">
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span>Subtotal:</span>
                            <span>${{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        @if($order->tax_amount > 0)
                            <div class="flex justify-between">
                                <span>Tax:</span>
                                <span>${{ number_format($order->tax_amount, 2) }}</span>
                            </div>
                        @endif
                        @if($order->shipping_amount > 0)
                            <div class="flex justify-between">
                                <span>Shipping:</span>
                                <span>${{ number_format($order->shipping_amount, 2) }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between font-semibold text-lg border-t pt-2">
                            <span>Total:</span>
                            <span>${{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('home') }}"
                        class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 text-center">
                        Continue Shopping
                    </a>
                    <a href="#" onclick="window.print()"
                        class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 text-center">
                        Print Receipt
                    </a>
                </div>

            </div>
        </div>
    </main>

</body>

</html>