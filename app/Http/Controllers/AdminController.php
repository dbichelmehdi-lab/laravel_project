<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{



    public function add_product()
    {
        $categories = Category::all();
        return view('admin.add_product', compact('categories'));
    }

    public function upload_product(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|numeric',
            'product_details' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = new Product;

        $data->name = $request->name;
        $data->product_details = $request->product_details;
        $data->price = $request->price;
        $data->category_id = $request->category_id;

        $image = $request->image;
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image = $request->image->move('product_img', $filename);

        $data->image = $filename;


        $data->save();

        return redirect()->back();
    }


    public function view_product()
    {
        $data = Product::with('category')->get();
        return view('admin.show_product', compact('data'));
    }



    public function delete_product($id)
    {
        $data = Product::find($id);
        $data->delete();
        return redirect()->back();
    }


    public function update_product($id)
    {
        $product = Product::find($id);

        $categories = Category::all();

        return view('admin.update_product', compact('product', 'categories'));
    }

    public function edit_product(Request $request, $id)
    {
        $data = Product::find($id);
        $data->name = $request->name;
        $data->price = $request->price;
        $data->product_details = $request->product_details;
        $data->category_id = $request->category_id;

        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('product_img', $imagename);
            $data->image = $imagename;
        }

        $data->save();


        // Return JSON for AJAX (modal approach)
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully!',
                'product' => $data
            ]);
        }

        return redirect('view_product')->with('success', 'Product updated successfully!')->with('refresh', true);
    }




    public function view_category()
    {
        $data = Category::all();
        return view('admin.category', compact('data'));
    }



    public function add_category(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $category = new Category;
        $category->category_name = $request->category_name;

        // Handle image upload
        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('category_img'), $filename);
            $category->image = $filename;
        }

        $category->save();

        return redirect()->back()->with('success', 'Category added successfully!');
    }


    public function delete_category($id)
    {

        $data = Category::find($id);

        $data->delete();

        return redirect()->back();
    }


    public function edit_category($id)
    {
        $data = Category::find($id);
        return  view('admin.edit_category', compact('data'));
    }

    public function update_category(Request $request, $id)
    {

        $request->validate([
            'category' => 'required|string|max:255',
            // Added: Image validation (optional)
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = Category::find($id);
        $data->category_name = $request->category;

        // Added: Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($data->image && file_exists(public_path('category_img/' . $data->image))) {
                unlink(public_path('category_img/' . $data->image));
            }

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('category_img'), $filename);

            $data->image = $filename;
        }
        $data->save();
        return redirect('/view_category');
    }






    public function show_orders()
    {
        $orders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.orders', compact('orders'));
    }


    public function show_order_details($id)
    {
        $order = Order::with('user')->findOrFail($id);
        return view('admin.order_details', compact('order'));
    }


    public function update_order_status(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'payment_status' => 'required|in:pending,paid,failed,refunded'
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status,
            'payment_status' => $request->payment_status
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }







    public function adminHome()
    {


        // Get all dashboard statistics dynamically
        $stats = $this->getDashboardStats();
        $topCustomers = $this->getTopCustomers();
        $recentOrders = $this->getRecentOrders();
        $allUsers = $this->getAllUsers();

        return view('admin.index', compact('stats', 'topCustomers', 'recentOrders', 'allUsers'));
    }

    private function getDashboardStats()
    {
        $totalUsers = User::count();
        $adminUsers = User::where('usertype', 'admin')->count();
        $regularUsers = User::where('usertype', 'user')->count();

        // Orders statistics

        $totalOrders = Order::count();
        $paidOrders = Order::where('payment_status', 'paid')->count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_amount');

        // Order status breakdown

        $pendingOrders = Order::where('status', 'pending')->count();
        $processingOrders = Order::where('status', 'processing')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();


        // Payment status breakdown


        $paymentPending = Order::where('payment_status', 'pending')->count();
        $paymentChargePending = Order::where('payment_status', 'charge_pending')->count();
        $paymentError = Order::where('payment_status', 'error')->count();
        $paymentDeclined = Order::where('payment_status', 'declined')->count();
        $paymentCancelled = Order::where('payment_status', 'cancelled')->count();

        // Calculate metrics

        $averageOrderValue = $totalOrders > 0 ? Order::avg('total_amount') : 0;
        $paymentSuccessRate = $totalOrders > 0 ? ($paidOrders / $totalOrders) * 100 : 0;

        // Recent activity (last 7 days)

        $recentOrdersCount = Order::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $recentUsersCount = User::where('created_at', '>=', Carbon::now()->subDays(30))->count();

        return [
            'total_users' => $totalUsers,
            'admin_users' => $adminUsers,
            'regular_users' => $regularUsers,
            'total_orders' => $totalOrders,
            'total_revenue' => number_format($totalRevenue, 2),
            'pending_orders' => $pendingOrders,
            'processing_orders' => $processingOrders,
            'cancelled_orders' => $cancelledOrders,
            'paid_orders' => $paidOrders,
            'payment_pending' => $paymentPending,
            'payment_charge_pending' => $paymentChargePending,
            'payment_error' => $paymentError,
            'payment_declined' => $paymentDeclined,
            'payment_cancelled' => $paymentCancelled,
            'average_order_value' => number_format($averageOrderValue, 2),
            'payment_success_rate' => number_format($paymentSuccessRate, 1),
            'recent_orders' => $recentOrdersCount,
            'recent_users' => $recentUsersCount,
        ];
    }

    private function getTopCustomers()
    {
        return DB::table('orders')
            ->select(
                'customer_name',
                'customer_email',
                DB::raw('COUNT(*) as order_count'),
                DB::raw('SUM(CAST(total_amount AS DECIMAL(10,2))) as total_spent')
            )
            ->groupBy('customer_email', 'customer_name')
            ->orderBy('order_count', 'desc')
            ->orderBy('total_spent', 'desc')
            ->get()
            ->map(function ($customer) {
                $customer->total_spent = number_format($customer->total_spent, 2);
                $customer->customer_type = $this->getCustomerType($customer->order_count);
                return $customer;
            });
    }

    private function getCustomerType($orderCount)
    {
        if ($orderCount >= 5) return 'VIP Customer';
        if ($orderCount >= 2) return 'Regular Customer';
        return 'New Customer';
    }

    private function getRecentOrders($limit = 10)
    {
        return Order::select([
            'id',
            'order_number',
            'customer_name',
            'customer_email',
            'total_amount',
            'status',
            'payment_status',
            'created_at'
        ])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get()
            ->map(function ($order) {
                $order->total_amount = number_format($order->total_amount, 2);
                $order->formatted_date = $order->created_at->format('M j, Y');
                return $order;
            });
    }

    private function getAllUsers()
    {
        return User::select([
            'id',
            'name',
            'email',
            'usertype',
            'phone',
            'address',
            'created_at'
        ])
            ->withCount(['orders' => function ($query) {
                // Count orders for each user if relationship exists
                $query->select(DB::raw('count(*)'));
            }])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($user) {
                $user->formatted_date = $user->created_at->format('M j, Y');
                $user->order_status = $this->getUserOrderStatus($user->orders_count ?? 0);
                return $user;
            });
    }

    private function getUserOrderStatus($orderCount)
    {
        if ($orderCount == 0) return ['text' => '0 orders', 'class' => 'gray'];
        if ($orderCount >= 5) return ['text' => $orderCount . ' orders', 'class' => 'green'];
        return ['text' => $orderCount . ' orders', 'class' => 'blue'];
    }
}
