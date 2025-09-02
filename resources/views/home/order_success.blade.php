<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <nav>
        @include('home.header')
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-8 text-center max-w-2xl mx-auto">
            <div class="text-green-600 text-6xl mb-4">✓</div>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Order Placed Successfully!</h1>
            <p class="text-gray-600 mb-4">Your order number is: <strong
                    class="text-blue-600">{{ $order->order_number }}</strong></p>
            <p class="text-gray-600 mb-8">We'll send you updates at <strong>{{ $order->customer_email }}</strong></p>
            <div class="space-x-4">
                <a href="{{ url('/') }}"
                    class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
</body>

</html>