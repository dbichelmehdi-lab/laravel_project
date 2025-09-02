<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Live Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-purple-700">Admin Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500">Welcome, {{ Auth::user()->name ?? 'Admin' }}</span>
                    <img src="https://ui-avatars.com/api/?name={{ substr(Auth::user()->name ?? 'Admin', 0, 1) }}&color=7F9CF5&background=EBF4FF"
                        alt="Profile" class="w-12 h-12 rounded-full shadow">
                    {{-- <a href="{{ route('logout') }}" class="text-sm text-red-500 hover:text-red-700">Logout</a> --}}
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="p-6 space-y-6">
        {{-- Main Statistics --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-sm text-gray-500">Total Users</p>
                <h2 class="text-3xl font-bold text-purple-700 mt-2">{{ $stats['total_users'] }}</h2>
                <p class="text-xs text-gray-400 mt-1">{{ $stats['admin_users'] }} Admins, {{ $stats['regular_users'] }}
                    Users</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-sm text-gray-500">Revenue</p>
                <h2 class="text-3xl font-bold text-green-600 mt-2">${{ $stats['total_revenue'] }}</h2>
                <p class="text-xs text-green-400 mt-1">From {{ $stats['paid_orders'] }} paid orders</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-sm text-gray-500">Total Orders</p>
                <h2 class="text-3xl font-bold text-blue-600 mt-2">{{ $stats['total_orders'] }}</h2>
                <p class="text-xs text-blue-400 mt-1">{{ $stats['recent_orders'] }} in last 7 days</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-sm text-gray-500">Pending Orders</p>
                <h2 class="text-3xl font-bold text-yellow-500 mt-2">{{ $stats['pending_orders'] }}</h2>
                <p class="text-xs text-gray-400 mt-1">Need attention</p>
            </div>
        </div>

        {{-- Order Status Breakdown --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-bold text-purple-700 mb-4">Order Status</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Pending</span>
                        <span
                            class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-bold">{{ $stats['pending_orders'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Processing</span>
                        <span
                            class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-bold">{{ $stats['processing_orders'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Cancelled</span>
                        <span
                            class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-bold">{{ $stats['cancelled_orders'] }}</span>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-bold text-purple-700 mb-4">Payment Status</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Paid</span>
                        <span
                            class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-bold">{{ $stats['paid_orders'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Pending</span>
                        <span
                            class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-bold">{{ $stats['payment_pending'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Charge Pending</span>
                        <span
                            class="bg-orange-100 text-orange-800 px-2 py-1 rounded text-xs font-bold">{{ $stats['payment_charge_pending'] }}</span>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-bold text-purple-700 mb-4">Key Metrics</h3>
                <div class="space-y-3">
                    <div class="text-center">
                        <p class="text-2xl font-bold text-green-600">${{ $stats['average_order_value'] }}</p>
                        <p class="text-xs text-gray-500">Average Order Value</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-purple-600">{{ $stats['payment_success_rate'] }}%</p>
                        <p class="text-xs text-gray-500">Payment Success Rate</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Top Customers --}}
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-4 border-b font-bold text-purple-700">Top Customers by Orders</div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-purple-50">
                        <tr>
                            <th class="p-4">Rank</th>
                            <th class="p-4">Customer</th>
                            <th class="p-4">Email</th>
                            <th class="p-4">Orders</th>
                            <th class="p-4">Total Spent</th>
                            <th class="p-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topCustomers as $index => $customer)
                                            <tr class="border-t {{ $index == 0 ? 'bg-yellow-50' : ($index == 1 ? 'bg-gray-50' : '') }}">
                                                <td class="p-4">
                                                    @if($index == 0) 🥇
                                                    @elseif($index == 1) 🥈
                                                    @elseif($index == 2) 🥉
                                                    @else {{ $index + 1 }}
                                                    @endif
                                                </td>
                                                <td class="p-4 {{ $index < 3 ? 'font-bold' : '' }}">{{ $customer->customer_name }}</td>
                                                <td class="p-4">{{ $customer->customer_email }}</td>
                                                <td class="p-4">
                                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-bold">
                                                        {{ $customer->order_count }} order{{ $customer->order_count != 1 ? 's' : '' }}
                                                    </span>
                                                </td>
                                                <td class="p-4 {{ $index < 3 ? 'font-bold' : '' }} text-green-600">
                                                    ${{ $customer->total_spent }}</td>
                                                <td class="p-4">
                                                    <span
                                                        class="px-2 py-1 rounded text-xs
                                                                                                {{ $customer->customer_type == 'VIP Customer' ? 'bg-green-100 text-green-800' :
                            ($customer->customer_type == 'Regular Customer' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                                        {{ $customer->customer_type }}
                                                    </span>
                                                </td>
                                            </tr>
                        @empty
                            <tr class="border-t">
                                <td colspan="6" class="p-4 text-center text-gray-500">No orders found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Recent Orders --}}
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-4 border-b font-bold text-purple-700">Recent Orders</div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-purple-50">
                        <tr>
                            <th class="p-4">Order #</th>
                            <th class="p-4">Customer</th>
                            <th class="p-4">Amount</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Payment</th>
                            <th class="p-4">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                                            <tr class="border-t">
                                                <td class="p-4 font-mono text-xs">{{ $order->order_number }}</td>
                                                <td class="p-4">{{ $order->customer_name }}</td>
                                                <td class="p-4 font-bold">${{ $order->total_amount }}</td>
                                                <td class="p-4">
                                                    <span
                                                        class="px-2 py-1 rounded text-xs
                                                                                                {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' :
                            ($order->status == 'processing' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800') }}">
                                                        {{ $order->status }}
                                                    </span>
                                                </td>
                                                <td class="p-4">
                                                    <span
                                                        class="px-2 py-1 rounded text-xs
                                                                                                {{ $order->payment_status == 'paid' ? 'bg-green-100 text-green-800' :
                            ($order->payment_status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                        {{ $order->payment_status }}
                                                    </span>
                                                </td>
                                                <td class="p-4 text-xs text-gray-500">{{ $order->formatted_date }}</td>
                                            </tr>
                        @empty
                            <tr class="border-t">
                                <td colspan="6" class="p-4 text-center text-gray-500">No orders found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- All Users --}}
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-4 border-b font-bold text-purple-700">All Users ({{ $stats['total_users'] }} Total)</div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-purple-50">
                        <tr>
                            <th class="p-4">ID</th>
                            <th class="p-4">Name</th>
                            <th class="p-4">Email</th>
                            <th class="p-4">Role</th>
                            <th class="p-4">Phone</th>
                            <th class="p-4">Address</th>
                            <th class="p-4">Orders</th>
                            <th class="p-4">Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allUsers as $user)
                            <tr class="border-t {{ $user->usertype == 'admin' ? 'bg-red-50' : '' }}">
                                <td class="p-4">{{ $user->id }}</td>
                                <td class="p-4">{{ $user->name }}</td>
                                <td class="p-4">{{ $user->email }}</td>
                                <td class="p-4">
                                    <span
                                        class="px-2 py-1 rounded text-xs
                                                {{ $user->usertype == 'admin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ ucfirst($user->usertype) }}
                                    </span>
                                </td>
                                <td class="p-4">{{ $user->phone }}</td>
                                <td class="p-4">{{ $user->address }}</td>
                                <td class="p-4">
                                    <span
                                        class="px-2 py-1 rounded text-xs bg-{{ $user->order_status['class'] }}-100 text-{{ $user->order_status['class'] }}-800">
                                        {{ $user->order_status['text'] }}
                                    </span>
                                </td>
                                <td class="p-4 text-xs text-gray-500">{{ $user->formatted_date }}</td>
                            </tr>
                        @empty
                            <tr class="border-t">
                                <td colspan="8" class="p-4 text-center text-gray-500">No users found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Action Items (only show if there are issues) --}}

        @if($stats['pending_orders'] > 0 || $stats['payment_charge_pending'] > 0 || $stats['payment_error'] > 0)
            <div class="bg-red-50 border-l-4 border-red-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">
                            <strong>Action Required:</strong>
                            @if($stats['pending_orders'] > 0)
                                You have {{ $stats['pending_orders'] }} pending orders
                            @endif
                            @if($stats['payment_charge_pending'] > 0)
                                and {{ $stats['payment_charge_pending'] }} charge pending payments
                            @endif
                            that need attention!
                        </p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Admin Profile Section
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center gap-6">
            <img src="https://ui-avatars.com/api/?name={{ substr(Auth::user()->name ?? 'Admin', 0, 1) }}&color=7F9CF5&background=EBF4FF"
                alt="Profile" class="w-20 h-20 rounded-full shadow">
            <div>
                <h3 class="text-xl font-bold text-purple-700">{{ Auth::user()->name ?? 'Admin' }}</h3>
                <p class="text-gray-500">Administrator</p>
                <p class="text-sm text-gray-400">{{ Auth::user()->email ?? 'admin@example.com' }}</p>
                <p class="text-xs text-gray-400 mt-1">Managing {{ $stats['total_users'] }} users &
                    {{ $stats['total_orders'] }} orders
                </p>

            </div>
        </div> --}}
    </main>

    <!-- Footer -->
    <footer class="bg-white p-4 text-center text-sm text-gray-400 border-t">
        © {{ date('Y') }} AdminPanel. All rights reserved. | Live data automatically updated
    </footer>

    <script>
        // Optional: Add auto-refresh every 5 minutes
        // setInterval(function() {
        //     location.reload();
        // }, 300000); // 5 minutes

        // Add some interactivity
        document.addEventListener('DOMContentLoaded', function () {
            // Add click events to status badges if needed
            console.log('Dashboard loaded with live data!');
        });
    </script>
</body>

</html>