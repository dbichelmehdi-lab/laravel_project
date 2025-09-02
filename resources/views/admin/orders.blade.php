<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Orders Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="flex max-h-screen overflow-hidden bg-gray-100">

        <!-- Sidebar -->
        @include('admin.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex overflow-y-auto flex-col">
            <!-- content -->
            <div class="container mx-auto px-4 py-8">
                <div class="bg-white rounded-lg shadow-md">
                    <!-- Header -->
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h1 class="text-2xl font-bold text-gray-800">Orders Management</h1>
                        <p class="text-gray-600 mt-1">Manage all customer orders</p>
                    </div>

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="mx-6 mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Orders Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Order Details
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Customer Info
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($orders as $order)
                                    <tr class="hover:bg-gray-50">
                                        <!-- Order Details -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $order->order_number }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ count($order->order_items) }} items
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Customer Info -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $order->customer_name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $order->customer_email }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $order->customer_phone }}
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Amount -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    ${{ number_format($order->total_amount, 2) }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    Subtotal: ${{ number_format($order->subtotal, 2) }}
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Status -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="space-y-1">
                                                <!-- Order Status -->
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                                @elseif($order->status == 'shipped') bg-purple-100 text-purple-800
                                                @elseif($order->status == 'delivered') bg-green-100 text-green-800
                                                @else bg-red-100 text-red-800
                                                @endif">
                                                    {{ ucfirst($order->status) }}
                                                </span>

                                                <!-- Payment Status -->
                                                <div>
                                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                    @if($order->payment_status == 'pending') bg-gray-100 text-gray-800
                                                    @elseif($order->payment_status == 'paid') bg-green-100 text-green-800
                                                    @elseif($order->payment_status == 'failed') bg-red-100 text-red-800
                                                    @else bg-orange-100 text-orange-800
                                                    @endif">
                                                        Payment: {{ ucfirst($order->payment_status) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Date -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div>
                                                <div>{{ $order->created_at->format('M d, Y') }}</div>
                                                <div class="text-xs">{{ $order->created_at->format('h:i A') }}</div>
                                            </div>
                                        </td>

                                        <!-- Actions -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.order.details', $order->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900 bg-indigo-100 hover:bg-indigo-200 px-3 py-1 rounded-md transition">
                                                View Details
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                            No orders found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($orders->hasPages())
                        <div class="px-6 py-4 border-t border-gray-200">
                            {{ $orders->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>




</body>

</html>