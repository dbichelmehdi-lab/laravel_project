<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - {{ $order->order_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="flex max-h-screen bg-gray-100 overflow-hidden">

        <!-- Sidebar -->

        @include('admin.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            <!-- Content -->
            <div class="container mx-auto px-4 py-8">
                <!-- Back Button -->
                <div class="mb-6">
                    <a href="{{ route('admin.orders') }}"
                        class="inline-flex items-center text-blue-600 hover:text-blue-800">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                        Back to Orders
                    </a>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <!-- Order Info & Customer Details -->
                    <div class="lg:col-span-2 space-y-6">

                        <!-- Order Information -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h2 class="text-xl font-semibold mb-4">Order Information</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Order Number</label>
                                    <p class="text-lg font-mono">{{ $order->order_number }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Order Date</label>
                                    <p>{{ $order->created_at->format('M d, Y h:i A') }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Order Status</label>
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                            @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                            @elseif($order->status == 'shipped') bg-purple-100 text-purple-800
                            @elseif($order->status == 'delivered') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800
                            @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Payment Status</label>
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                            @if($order->payment_status == 'pending') bg-gray-100 text-gray-800
                            @elseif($order->payment_status == 'paid') bg-green-100 text-green-800
                            @elseif($order->payment_status == 'failed') bg-red-100 text-red-800
                            @else bg-orange-100 text-orange-800
                            @endif">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Information -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h2 class="text-xl font-semibold mb-4">Customer Information</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Full Name</label>
                                    <p class="font-medium">{{ $order->customer_name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Email</label>
                                    <p class="text-blue-600">{{ $order->customer_email }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Phone</label>
                                    <p>{{ $order->customer_phone }}</p>
                                </div>
                                @if($order->user)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Registered User</label>
                                        <p class="text-green-600">Yes (ID: {{ $order->user_id }})</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Billing Address -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h2 class="text-xl font-semibold mb-4">Billing Address</h2>
                            <div class="space-y-2">
                                <p class="font-medium">{{ $order->billing_address }}</p>
                                <p>{{ $order->billing_city }}, {{ $order->billing_state }}
                                    {{ $order->billing_postal_code }}
                                </p>
                                <p>{{ $order->billing_country }}</p>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h2 class="text-xl font-semibold mb-4">Order Items</h2>
                            <div class="space-y-4">
                                @foreach($order->order_items as $item)
                                    <div class="flex items-center justify-between border-b pb-4">
                                        <div class="flex items-center">
                                            @if(isset($item['image']))
                                                <img src="{{ asset('product_img/' . $item['image']) }}"
                                                    class="w-16 h-16 object-cover rounded-md mr-4" alt="">
                                            @else
                                                <div
                                                    class="w-16 h-16 bg-gray-200 rounded-md mr-4 flex items-center justify-center">
                                                    <span class="text-gray-500 text-xs">No Image</span>
                                                </div>
                                            @endif
                                            <div>
                                                <h3 class="font-medium">{{ $item['name'] ?? 'Product Name' }}</h3>
                                                <p class="text-gray-600 text-sm">Quantity: {{ $item['quantity'] }}</p>
                                                <p class="text-gray-600 text-sm">Unit Price:
                                                    ${{ number_format($item['price'], 2) }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-semibold">
                                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Order Notes -->
                        @if($order->order_notes)
                            <div class="bg-white rounded-lg shadow-md p-6">
                                <h2 class="text-xl font-semibold mb-4">Order Notes</h2>
                                <p class="text-gray-700 bg-gray-50 p-3 rounded">{{ $order->order_notes }}</p>
                            </div>
                        @endif

                    </div>

                    <!-- Order Summary & Actions -->
                    <div class="space-y-6">

                        <!-- Order Summary -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span>Subtotal</span>
                                    <span>${{ number_format($order->subtotal, 2) }}</span>
                                </div>
                                <div class="border-t pt-3">
                                    <div class="flex justify-between font-semibold text-lg">
                                        <span>Total</span>
                                        <span>${{ number_format($order->total_amount, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Update Order Status -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h2 class="text-xl font-semibold mb-4">Update Status</h2>
                            <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
                                @csrf
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Order Status</label>
                                        <select name="status"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                                Processing</option>
                                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>
                                                Shipped</option>
                                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                                Delivered</option>
                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                                Cancelled</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Payment
                                            Status</label>
                                        <select name="payment_status"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>
                                                Paid
                                            </option>
                                            <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>
                                                Failed</option>
                                            <option value="refunded" {{ $order->payment_status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                        </select>
                                    </div>

                                    <button type="submit"
                                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200">
                                        Update Status
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Quick Actions -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h2 class="text-xl font-semibold mb-4">Quick Actions</h2>
                            <div class="space-y-2">
                                <a href="mailto:{{ $order->customer_email }}"
                                    class="block w-full text-center bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition">
                                    Email Customer
                                </a>
                                <a href="tel:{{ $order->customer_phone }}"
                                    class="block w-full text-center bg-purple-600 text-white py-2 px-4 rounded-md hover:bg-purple-700 transition">
                                    Call Customer
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>