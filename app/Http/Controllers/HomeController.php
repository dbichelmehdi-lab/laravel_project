<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Http\Models\user;
use App\Models\Cart;
use App\Services\VPSPaymentService;

use Illuminate\Support\Facades\Auth;




class HomeController extends Controller
{
    public function my_home()
    {
        $data = Product::all();
        $categories = Category::all();
        return view('home.index', compact('data', 'categories'));
    }






    public function productsByCategory($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->get();

        return view('home.category_products', compact('category', 'products'));
    }




    public function index()
    {
        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;

            if ($usertype == 'user') {
                $data = Product::all();
                return view('home.index', compact('data'));
            } else {



                return redirect('/admin');
            }
        }
    }


    public function productDetails($id)
    {
        $product = Product::findOrFail($id);
        return view('home.product_details', compact('product'));
    }





    // Add to cart
    public function add_cart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Get existing cart from session or initialize empty array
        $cart = session()->get('cart', []);

        $request->validate([
            'qty' => 'required|integer|min:1|max:100'
        ]);

        // If product already in cart, just update quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->qty;
        } else {
            // Add new product to cart
            $cart[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => $request->qty,
                "image" => $product->image
            ];
        }

        // Save cart back to session
        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart!');
    }

    // View cart

    public function my_cart()
    {
        $cart = session()->get('cart', []);
        return view('home.my_cart', compact('cart'));
    }

    // Remove from cart
    public function remove_cart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('my_cart')->with('success', 'Product removed from cart!');
    }



    public function update_cart(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);

            // Return JSON response for AJAX
            if ($request->expectsJson()) {
                return response()->json(['success' => true]);
            }

            return back()->with('success', 'Cart updated!');
        }

        return response()->json(['success' => false], 400);
    }



    // Show checkout page ====================================================================

    public function show_checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('my_cart')->with('error', 'Your cart is empty!');
        }

        // Calculate total (no tax or shipping)
        $total_amount = 0;
        foreach ($cart as $item) {
            $total_amount += $item['price'] * $item['quantity'];
        }

        $user = auth()->check() ? auth()->user() : null;

        return view('home.checkout', compact('cart', 'total_amount', 'user'));
    }


    /**
     * Process checkout and redirect to VPS PayWall ==============================================================================================
     */


    /**
     * Process checkout and redirect to VPS PayWall (Production Version)
     */

    public function process_checkout(Request $request)
    {

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('my_cart')->with('error', 'Your cart is empty!');
        }



        // Calculate total:

        $total_amount = 0;
        foreach ($cart as $item) {
            $total_amount += $item['price'] * $item['quantity'];
        }

        // CREATE ORDER IMMEDIATELY with pending status:


        $orderNumber = 'ORDER_' . time();

        $order = Order::create([
            'order_number' => $orderNumber,
            'user_id' => auth()->check() ? auth()->id() : null,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'billing_address' => $request->billing_address,
            'billing_city' => $request->billing_city,
            'billing_state' => $request->billing_state,
            'billing_postal_code' => $request->billing_postal_code,
            'billing_country' => $request->billing_country,
            'order_items' => $cart,
            'subtotal' => $total_amount,
            'total_amount' => $total_amount,
            'order_notes' => $request->order_notes,
            'status' => 'pending',
            'payment_status' => 'pending'
        ]);


        // Prepare order data for VPS/


        $orderData = [
            'cart' => $cart,
            'total_amount' => $total_amount,
            'order_number' => $orderNumber          // Pass the order number
        ];

        $vpsService = new VPSPaymentService();
        $paymentForm = $vpsService->createPaymentForm($orderData, $request->all());

        session()->forget('cart');

        return view('home.vps_redirect', [
            'paymentForm' => $paymentForm,
            'orderData' => $orderData,
            'customerData' => $request->all()
        ]);
    }





    /**
     * Handle VPS payment notification (webhook) - Production Version
     */





    public function vps_notification(Request $request)
    {
        $input = file_get_contents('php://input');
        $signature = $request->header('x-callback-signature', '');

        // Log webhook details
        \Log::info('VPS Webhook - Complete Details', [
            'timestamp' => now(),
            'signature' => $signature,
            'headers' => $request->headers->all(),
            'raw_body' => $input,
            'ip_address' => $request->ip()
        ]);

        // Signature validation
        $vpsService = new VPSPaymentService();
        if (!$vpsService->validateNotification($input, $signature)) {
            \Log::error('VPS Webhook - Invalid Signature', [
                'received_signature' => $signature,
                'ip_address' => $request->ip()
            ]);
            return response()->json(['status' => 'KO', 'message' => 'Invalid signature'], 401);
        }

        $notificationData = json_decode($input, true);

        if (!$notificationData) {
            \Log::error('VPS Webhook - Invalid JSON', ['raw_input' => $input]);
            return response()->json(['status' => 'KO', 'message' => 'Invalid JSON'], 400);
        }

        // Extract data




        $orderReference = $notificationData['orderId'] ?? null;
        $status = $notificationData['status'] ?? null;
        $transactionId = $notificationData['internalId'] ?? null;
        $webhookAmount = $notificationData['lineItem']['amount'] ?? 0;
        $transactions = $notificationData['transactions'] ?? [];

        \Log::info('VPS Webhook - Parsed Data', [
            'order_id' => $orderReference,
            'transaction_id' => $transactionId,
            'status' => $status,
            'amount' => $webhookAmount,
            'transactions_count' => count($transactions)
        ]);

        if (!$orderReference) {
            \Log::error('VPS Webhook - Missing Order Reference');
            return response()->json(['status' => 'KO', 'message' => 'No order reference'], 400);
        }

        $order = Order::where('order_number', $orderReference)->first();

        if (!$order) {
            \Log::error('VPS Webhook - Order Not Found', ['order_reference' => $orderReference]);
            return response()->json(['status' => 'KO', 'message' => 'Order not found'], 404);
        }

        // Duplicate prevention:


        if ($order->transaction_id === $transactionId && $order->payment_status !== 'charge_pending') {
            // Only block if not progressing from pending
            return response()->json(['status' => 'OK', 'message' => 'Already processed'], 200);
        }

        \Log::info('VPS Webhook - Order Before Update', [
            'order_number' => $order->order_number,
            'current_status' => $order->status,
            'current_payment_status' => $order->payment_status
        ]);


        $orderUpdated = false;

        switch ($status) {
            case 'AUTHORIZE_PENDING':

                // Merchant must process the charge.paymentOption to advance the charge status

                $order->payment_status = 'authorize_pending';
                $order->transaction_id = $transactionId;
                $orderUpdated = true;

                \Log::info('VPS Webhook - Authorization Pending', [
                    'order_number' => $order->order_number,
                    'requires_merchant_action' => true,
                    'note' => 'Merchant must process charge.paymentOption'
                ]);
                break;

            case 'AUTHORIZED':
                // Amount approved, can be captured with SETTLE or released with AUTH_REVERSAL
                $order->payment_status = 'authorized';
                $order->transaction_id = $transactionId;
                $orderUpdated = true;

                \Log::info('VPS Webhook - Payment Authorized', [
                    'order_number' => $order->order_number,
                    'can_be_captured' => true,
                    'can_be_reversed' => true
                ]);
                break;

            case 'AUTH_REVERSED':

                $order->payment_status = 'auth_reversed';
                $order->status = 'cancelled';
                $order->transaction_id = $transactionId;
                $orderUpdated = true;

                \Log::info('VPS Webhook - Authorization Reversed', [
                    'order_number' => $order->order_number,
                    'final_status' => true,
                    'amount_released' => true
                ]);
                break;

            case 'CANCELLED':
                // Customer cancelled the charge (final status)
                $order->payment_status = 'cancelled';
                $order->status = 'cancelled';
                $order->transaction_id = $transactionId;
                $orderUpdated = true;

                \Log::info('VPS Webhook - Payment Cancelled by Customer', [
                    'order_number' => $order->order_number,
                    'final_status' => true,
                    'cancelled_by' => 'customer'
                ]);
                break;

            case 'DECLINED':

                $order->payment_status = 'declined';
                $order->status = 'cancelled';
                $order->transaction_id = $transactionId;
                $orderUpdated = true;

                \Log::info('VPS Webhook - Payment Declined by Processor', [
                    'order_number' => $order->order_number,
                    'final_status' => true,
                    'declined_by' => 'processor'
                ]);
                break;

            case 'CHARGE_PENDING':
                // Charge initiated.
                $order->payment_status = 'charge_pending';
                $order->transaction_id = $transactionId;
                $orderUpdated = true;

                \Log::info('VPS Webhook - Charge Pending', [
                    'order_number' => $order->order_number,
                    'awaiting' => 'PSP_response',
                    'note' => 'Wait for next notification'
                ]);
                break;

            case 'CHARGED':
                // Amount captured, product can be released
                $order->payment_status = 'paid';
                $order->status = 'processing';
                $order->transaction_id = $transactionId;
                $order->payment_method = 'VPS_PayWall';
                $orderUpdated = true;

                \Log::info('VPS Webhook - Payment Charged Successfully', [
                    'order_number' => $order->order_number,
                    'can_release_product' => true,
                    'amount' => $webhookAmount
                ]);
                break;

            case 'CHARGED_BACK':
                // Customer reclaimed captured amount
                $order->payment_status = 'chargeback';
                $order->status = 'disputed';
                $order->transaction_id = $transactionId;
                $orderUpdated = true;

                \Log::critical('VPS Webhook - Chargeback Occurred', [
                    'order_number' => $order->order_number,
                    'amount_reclaimed' => true,
                    'requires_immediate_attention' => true
                ]);
                break;

            case 'CHARGEBACK_REVERSED':
                // Amount disputed and recaptured after chargeback
                $order->payment_status = 'chargeback_reversed';
                $order->status = 'processing';
                $order->transaction_id = $transactionId;
                $orderUpdated = true;

                \Log::info('VPS Webhook - Chargeback Reversed Successfully', [
                    'order_number' => $order->order_number,
                    'amount_recaptured' => true
                ]);
                break;

            case 'CHARGEBACK_PENDING':
                // Chargeback initiated, funds not yet returned
                $order->payment_status = 'chargeback_pending';
                $order->transaction_id = $transactionId;
                $orderUpdated = true;

                \Log::warning('VPS Webhook - Chargeback Pending', [
                    'order_number' => $order->order_number,
                    'funds_not_returned_yet' => true,
                    'requires_monitoring' => true
                ]);
                break;

            case 'REFUND_PENDING':
                // Refund initiated, funds not returned to customer yet
                $order->payment_status = 'refund_pending';
                $order->transaction_id = $transactionId;
                $orderUpdated = true;

                \Log::info('VPS Webhook - Refund Pending', [
                    'order_number' => $order->order_number,
                    'refund_initiated' => true,
                    'awaiting_completion' => true
                ]);
                break;

            case 'REFUNDED':
                // Full refund completed (final status)
                $order->payment_status = 'refunded';
                $order->transaction_id = $transactionId;
                $orderUpdated = true;

                \Log::info('VPS Webhook - Payment Refunded', [
                    'order_number' => $order->order_number,
                    'refund_type' => 'full',
                    'final_status' => true,
                    'funds_returned' => true
                ]);
                break;

            case 'ERROR':
                // Payment failed for any reason (final status)
                $order->payment_status = 'error';
                $order->status = 'cancelled';
                $order->transaction_id = $transactionId;
                $orderUpdated = true;

                \Log::error('VPS Webhook - Payment Error', [
                    'order_number' => $order->order_number,
                    'final_status' => true,
                    'error_reason' => 'Check transactions array for details',
                    'transactions' => $transactions
                ]);
                break;

            case 'CREDITED_PENDING':
                // Credit in progress
                $order->payment_status = 'credit_pending';
                $order->transaction_id = $transactionId;
                $orderUpdated = true;

                \Log::info('VPS Webhook - Credit Pending', [
                    'order_number' => $order->order_number,
                    'credit_in_progress' => true
                ]);
                break;

            case 'CREDITED':
                // Amount credited to customer
                $order->payment_status = 'credited';
                $order->transaction_id = $transactionId;
                $orderUpdated = true;

                \Log::info('VPS Webhook - Amount Credited', [
                    'order_number' => $order->order_number,
                    'credited_to_customer' => true
                ]);
                break;

            default:
                \Log::warning('VPS Webhook - Unknown Status', [
                    'order_number' => $order->order_number,
                    'unknown_status' => $status,
                    'requires_investigation' => true
                ]);

                return response()->json(['status' => 'OK', 'message' => 'Unknown status logged'], 200);
        }

        // Save order
        if ($orderUpdated) {
            try {
                $order->save();

                \Log::info('VPS Webhook - Order Updated Successfully', [
                    'order_number' => $order->order_number,
                    'new_status' => $order->status,
                    'new_payment_status' => $order->payment_status,
                    'transaction_id' => $order->transaction_id
                ]);
            } catch (\Exception $e) {
                \Log::error('VPS Webhook - Database Update Failed', [
                    'order_number' => $order->order_number,
                    'error' => $e->getMessage()
                ]);

                return response()->json(['status' => 'KO', 'message' => 'Database error'], 500);
            }
        }

        \Log::info('VPS Webhook - Processing Complete', [
            'order_reference' => $orderReference,
            'status_processed' => $status,
            'order_updated' => $orderUpdated
        ]);

        return response()->json([
            'status' => 'OK',
            'message' => 'Status recorded successfully'
        ], 200);
    }











    /*redirect-successful 
      * Handle successful payment - Production Version
     */
    public function vps_success(Request $request)
    {
        $orderReference = $request->get('order');

        if (!$orderReference) {
            return redirect()->route('my_cart')->with('error', 'Invalid order reference');
        }


        $order = Order::where('order_number', $orderReference)->first();

        if (!$order) {
            // Check if order data is still in session (payment completed before webhook)
            $pendingOrderData = session('pending_order_' . $orderReference);
            if ($pendingOrderData) {
                // Create order as successful (webhook will update if needed)
                $order = Order::create(array_merge($pendingOrderData, [
                    'order_number' => $orderReference,
                    'status' => 'processing',
                    'payment_status' => 'paid',
                    'payment_method' => 'VPS_PayWall'
                ]));

                session()->forget('pending_order_' . $orderReference);
            } else {
                return redirect()->route('my_cart')->with('error', 'Order not found');
            }
        }

        return view('home.payment_success', compact('order'));
    }

    /**
     * Handle failed payment ====================================================================
     */

    public function vps_failure(Request $request)
    {
        $orderReference = $request->get('order');

        if (!$orderReference) {
            return redirect()->route('my_cart')->with('error', 'Invalid order reference');
        }

        $order = Order::where('order_number', $orderReference)->first();

        if (!$order) {
            // Create failed order
            $pendingOrderData = session('pending_order_' . $orderReference);
            if ($pendingOrderData) {
                $order = Order::create(array_merge($pendingOrderData, [
                    'order_number' => $orderReference,
                    'status' => 'cancelled',
                    'payment_status' => 'failed'
                ]));

                session()->forget('pending_order_' . $orderReference);
            }
        }

        return view('home.payment_failure', compact('order'));
    }

    /**
     * Handle cancelled payment
     */
    public function vps_cancel(Request $request)
    {
        $orderReference = $request->get('order');

        if (!$orderReference) {
            return redirect()->route('my_cart')->with('error', 'Invalid order reference');
        }

        // Find the order in database
        $order = Order::where('order_number', $orderReference)->first();

        if ($order) {
            // Restore cart from order items
            $restoredCart = [];
            foreach ($order->order_items as $index => $item) {
                $restoredCart[$index] = [
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'image' => $item['image']
                ];
            }

            // Put cart back in session
            session(['cart' => $restoredCart]);

            // Update order status to cancelled
            $order->payment_status = 'cancelled';
            $order->status = 'cancelled';
            $order->save();

            return redirect()->route('my_cart')->with('info', 'Payment cancelled. Your items have been restored to your cart.');
        }

        return redirect()->route('my_cart')->with('error', 'Order not found');
    }














    // Temporary payment page (placeholder)


    // Add this method to your HomeController


    /*public function complete_order(Request $request) 
    {
        // Get pending order from session
        $pendingOrder = session()->get('pending_order');
    
        if (!$pendingOrder) {
            return redirect()->route('my_cart')->with('error', 'No pending order found!');
        }
    
        // Save order to database
        $order = Order::create($pendingOrder);
    
        // Clear cart and pending order from session
        session()->forget(['cart', 'pending_order']);
    
        // Redirect to success page
        return redirect()->route('order.success', $order->order_number)
           ->with('success', 'Order placed successfully!');
    }*/




    public function order_success($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();
        return view('home.order_success', compact('order'));
    }



    // Add this method to HomeController
    public function payment_page()
    {
        // Get pending order from session
        $pendingOrder = session()->get('pending_order');

        if (!$pendingOrder) {
            return redirect()->route('my_cart')->with('error', 'No pending order found!');
        }

        // Prepare Payzone payload
        $merchantAccount = 'Test_integration';                                           // From Payzone
        $paywallSecretKey = '9uhPPPQH14ThccEn';                                         // from Payzone
        $paywallUrl = 'https://payment-sandbox.payzone.ma/pwthree/launch';              // Payzone URL

        $payload = [
            // Authentication parameters
            'merchantAccount' => $merchantAccount,
            'timestamp' => time(),
            'skin' => 'vps-1-vue',

            // Customer parameters
            'customerId' => $pendingOrder['customer_email'],   // Use email as unique customer ID
            'customerCountry' => 'MA',
            'customerLocale' => 'en_US',
            'customerName' => $pendingOrder['customer_name'],
            'customerEmail' => $pendingOrder['customer_email'],

            // Charge parameters
            'chargeId' => $pendingOrder['order_number'], // Use order number as charge ID
            'orderId' => $pendingOrder['order_number'],
            'price' => $pendingOrder['total_amount'],
            'currency' => 'MAD',
            'description' => 'Order ' . $pendingOrder['order_number'],

            // Deep linking
            'mode' => 'DEEP_LINK',
            'paymentMethod' => 'CREDIT_CARD',
            'showPaymentProfiles' => false,

            // Callback URLs
            'callbackUrl' => route('payment.callback'),
            'successUrl' => route('payment.success'),
            'failureUrl' => route('payment.failure'),
            'cancelUrl' => route('payment.cancel'),
        ];

        // Encode and sign payload
        $json_payload = json_encode($payload);
        $signature = hash('sha256', $paywallSecretKey . $json_payload);

        return view('home.payment', compact('paywallUrl', 'json_payload', 'signature', 'pendingOrder'));
    }




    // Add these methods to HomeController

    public function payment_success()
    {
        // Complete the order after successful payment
        return $this->complete_order_after_payment('paid');
    }

    public function payment_failure()
    {
        return redirect()->route('checkout')->with('error', 'Payment failed. Please try again.');
    }

    public function payment_cancel()
    {
        return redirect()->route('my_cart')->with('info', 'Payment was cancelled.');
    }

    public function payment_callback(Request $request)
    {
        // Handle Payzone notification
        $input = file_get_contents('php://input');
        $notificationKey = '0c4ihAHdWwcJV60s'; // From Payzone

        // Validate signature
        $signature = hash_hmac('sha256', $input, $notificationKey);
        $headers = apache_request_headers();

        if (strcasecmp($signature, $headers['X-callback-signature']) == 0) {
            $notification = json_decode($input, true);

            // Find order by orderId
            $order = Order::where('order_number', $notification['orderId'])->first();

            if ($order) {
                // Update order based on payment status
                if ($notification['status'] == 'CHARGED') {
                    $order->update([
                        'payment_status' => 'paid',
                        'status' => 'processing',
                        'transaction_id' => $notification['id']
                    ]);
                } else {
                    $order->update(['payment_status' => 'failed']);
                }
            }
        }

        return response('OK', 200);
    }

    private function complete_order_after_payment($paymentStatus)
    {
        $pendingOrder = session()->get('pending_order');

        if (!$pendingOrder) {
            return redirect()->route('my_cart')->with('error', 'No pending order found!');
        }

        // Update payment status
        $pendingOrder['payment_status'] = $paymentStatus;
        if ($paymentStatus == 'paid') {
            $pendingOrder['status'] = 'processing';
        }

        // Save order to database
        $order = Order::create($pendingOrder);

        // Clear session
        session()->forget(['cart', 'pending_order']);

        return redirect()->route('order.success', $order->order_number);
    }









    public function payment_page2()
    {
        $orderData = session()->get('pending_order');

        if (!$orderData) {
            return redirect()->route('my_cart')->with('error', 'No order data found!');
        }

        return view('home.payment', compact('orderData'));
    }
}
