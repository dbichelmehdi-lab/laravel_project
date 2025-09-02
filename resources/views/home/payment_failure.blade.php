<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <nav>
        @include('home.header')
    </nav>

    <!-- Failure Content -->
    <main class="container mx-auto mt-10 px-4">
        <div class="max-w-2xl mx-auto">

            <!-- Failure Message -->
            <div class="bg-red-50 border border-red-200 rounded-lg p-6 mb-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-medium text-red-800">Payment Failed</h3>
                        <p class="text-red-700">Unfortunately, your payment could not be processed. Please try again or
                            use a different payment method.</p>
                    </div>
                </div>
            </div>

            <!-- Order Details -->
            <div class="bg-white shadow-md rounded-lg p-6">
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
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
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

                <!-- Recommended Actions -->
                <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <h4 class="font-medium text-yellow-800 mb-2">What to do next:</h4>
                    <ul class="text-sm text-yellow-700 space-y-1">
                        <li>• Check your card details and try again</li>
                        <li>• Ensure you have sufficient funds</li>
                        <li>• Try using a different payment method</li>
                        <li>• Contact your bank if the issue persists</li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('checkout') }}"
                        class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 text-center">
                        Try Payment Again
                    </a>
                    <a href="{{ route('my_cart') }}"
                        class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 text-center">
                        Return to Cart
                    </a>
                    <a href="{{ route('home') }}"
                        class="bg-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-400 text-center">
                        Continue Shopping
                    </a>
                </div>

            </div>
        </div>
    </main>

</body>

</html>