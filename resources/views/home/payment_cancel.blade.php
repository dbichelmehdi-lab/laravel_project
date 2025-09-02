<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Cancelled</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <nav>
        @include('home.header')
    </nav>

    <!-- Cancel Content -->
    <main class="container mx-auto mt-10 px-4">
        <div class="max-w-2xl mx-auto">

            <!-- Cancel Message -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-medium text-yellow-800">Payment Cancelled</h3>
                        <p class="text-yellow-700">You have cancelled the payment process. Your order is still pending
                            and can be completed later.</p>
                    </div>
                </div>
            </div>

            <!-- Order Details (if order exists) -->
            @if(isset($order) && $order)
                <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                    <h2 class="text-2xl font-semibold mb-6">Order Details</h2>

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
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </p>
                                <p><span class="font-medium">Total Amount:</span>
                                    ${{ number_format($order->total_amount, 2) }}</p>
                            </div>
                        </div>

                        <!-- Customer Information -->
                        <div>
                            <h3 class="text-lg font-medium mb-3">Customer Information</h3>
                            <div class="space-y-2 text-sm">
                                <p><span class="font-medium">Name:</span> {{ $order->customer_name }}</p>
                                <p><span class="font-medium">Email:</span> {{ $order->customer_email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Information Box -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                <h4 class="font-medium text-blue-800 mb-2">Your order is safe!</h4>
                <p class="text-sm text-blue-700 mb-3">
                    Don't worry - your order hasn't been lost. You can complete the payment anytime by clicking the
                    button below.
                    Your items are reserved for 24 hours.
                </p>
                <div class="text-sm text-blue-600">
                    <p><strong>What happened?</strong> You cancelled the payment process before completing it.</p>
                    <p><strong>Next steps:</strong> You can try the payment again or continue shopping.</p>
                </div>
            </div>

            <!-- No Order Case -->
            @if(!isset($order) || !$order)
                <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                    <h2 class="text-2xl font-semibold mb-4">Payment Cancelled</h2>
                    <p class="text-gray-600 mb-4">
                        Your payment was cancelled and no order was created. Your cart items have been restored so you can
                        continue shopping.
                    </p>
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <p class="text-green-700 text-sm">
                            <strong>Good news:</strong> Your items are back in your cart and ready for checkout when you're
                            ready.
                        </p>
                    </div>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">What would you like to do?</h3>
                <div class="flex flex-col sm:flex-row gap-3">
                    @if(isset($order) && $order)
                        <a href="{{ route('checkout') }}"
                            class="bg-green-600 text-white py-3 px-6 rounded-lg hover:bg-green-700 text-center font-medium">
                            Complete Payment Now
                        </a>
                    @endif

                    <a href="{{ route('my_cart') }}"
                        class="bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 text-center font-medium">
                        View Cart
                    </a>

                    <a href="{{ route('home') }}"
                        class="bg-gray-600 text-white py-3 px-6 rounded-lg hover:bg-gray-700 text-center font-medium">
                        Continue Shopping
                    </a>
                </div>
            </div>

        </div>
    </main>

    <!-- Footer (optional) -->
    <footer class="mt-16 bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2024 Your Store. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>