<?php

namespace App\Services;

use App\Models\Order;

class VPSPaymentService
{
    private $merchantAccount;
    private $paywallSecretKey;
    private $paywallUrl;
    private $notificationKey;

    public function __construct()
    {
        $this->merchantAccount = env('VPS_MERCHANT_ACCOUNT');
        $this->paywallSecretKey = env('VPS_PAYWALL_SECRET_KEY');
        $this->paywallUrl = env('VPS_PAYWALL_URL');
        $this->notificationKey = env('VPS_NOTIFICATION_KEY');
    }

    /**
     * Generate payment payload for VPS PayWall (Production Version)
     */
    public function generatePaymentPayload($orderData, $customerData)
    {
        
        // Calculate totals from cart data (no tax or shipping)
        $total_amount = 0;
        foreach ($orderData['cart'] as $item) {
            $total_amount += $item['price'] * $item['quantity'];
        }

        // Generate unique IDs
        $timestamp = time();
        $uniqueOrderId = 'ORDER_' . $timestamp;
        $uniqueChargeId = 'CHARGE_' . $timestamp;

        $payload = [
            // Authentication parameters
            'merchantAccount' => $this->merchantAccount,
            'timestamp' => $timestamp,
            'skin' => 'vps-1-vue',

            // Customer parameters
            'customerId' => $uniqueOrderId,   // Unique customer ID
            'customerCountry' => 'MA',
            'customerLocale' => 'en_US',

            // Charge parameters
            // In generatePaymentPayload method
            'orderId' => $orderData['order_number'], // Use passed order number
            'chargeId' => $orderData['order_number'] . '_CHARGE',
            'price' => (string) number_format($total_amount, 2, '.', ''), // Ensure proper decimal format
            'currency' => 'MAD',
            'description' => 'Order from ' . $customerData['customer_name'] . ' - ' . count($orderData['cart']) . ' items',

            // Deep linking
            'mode' => 'DEEP_LINK',
            'paymentMethod' => 'CREDIT_CARD',
            'showPaymentProfiles' => false,

        // In generatePaymentPayload method, replace the callback URLs:
        
        'callbackUrl' => 'https://f1b370c46b8a.ngrok-free.app/api/payment/webhook',
        'successUrl' => 'https://f1b370c46b8a.ngrok-free.app/vps/success?order=' . $uniqueOrderId,
        'failureUrl' => 'https://f1b370c46b8a.ngrok-free.app/vps/failure?order=' . $uniqueOrderId,
        'cancelUrl' => 'https://f1b370c46b8a.ngrok-free.app/vps/cancel?order=' . $uniqueOrderId,
        ];

        return $payload;
    }






    /**
     * Create signed form for VPS PayWall
     */

    





    public function createPaymentForm($orderData, $customerData)
    {
        $payload = $this->generatePaymentPayload($orderData, $customerData);
        $json_payload = json_encode($payload);
        $signature = hash('sha256', $this->paywallSecretKey . $json_payload);

        return [
            'action' => $this->paywallUrl,
            'payload' => $json_payload,
            'signature' => $signature,
            'orderId' => $payload['orderId'],             // Return for session storage
            'amount' => $payload['price']
        ];
    }



    /**
     * Validate VPS notification
     */


   /**
     * Validate VPS notification signature
     */

    public function validateNotification($input, $signature)
    {
        if (empty($signature) || empty($this->notificationKey)) {
            \Log::warning('VPS Signature Validation - Missing signature or notification key', [
                'signature_empty' => empty($signature),
                'notification_key_empty' => empty($this->notificationKey)
            ]);
            return false;
        }
        
        // Calculate expected signature using HMAC SHA256
        $calculated_signature = strtoupper(hash_hmac('sha256', $input, $this->notificationKey));
        $received_signature = strtoupper($signature);
        
        \Log::info('VPS Signature Validation', [
            'calculated_signature' => $calculated_signature,
            'received_signature' => $received_signature,
            'signatures_match' => ($calculated_signature === $received_signature),
            
            
        ]);
        
        return hash_equals($calculated_signature, $received_signature);
    }



    /**
     * Process notification data and create/update order
     */



/**
     * Process notification data and create/update order (Individual Status Logic)
     */
    public function processNotification($notificationData)
    {
        $orderReference = $notificationData['orderId'] ?? null;
        $status = $notificationData['status'] ?? null;
        $transactionId = $notificationData['internalId'] ?? null;
        $amount = $notificationData['lineItem']['amount'] ?? 0;

        if (!$orderReference) {
            return ['success' => false, 'message' => 'Order reference not found'];
        }

        // Find existing order
        $order = Order::where('order_number', $orderReference)->first();
        
        if (!$order) {
            return ['success' => false, 'message' => 'Order not found'];
        }

        // Handle each VPS status individually according to documentation
        switch ($status) {
            case 'AUTHORIZE_PENDING':
                $order->payment_status = 'authorize_pending';
                $order->transaction_id = $transactionId;
                break;
                
            case 'AUTHORIZED':
                $order->payment_status = 'authorized';
                $order->transaction_id = $transactionId;
                break;
                
            case 'AUTH_REVERSED':
                $order->payment_status = 'auth_reversed';
                $order->status = 'cancelled';
                $order->transaction_id = $transactionId;
                break;
                
            case 'CANCELLED':
                $order->payment_status = 'cancelled';
                $order->status = 'cancelled';
                $order->transaction_id = $transactionId;
                break;
                
            case 'DECLINED':
                $order->payment_status = 'declined';
                $order->status = 'cancelled';
                $order->transaction_id = $transactionId;
                break;
                
            case 'CHARGE_PENDING':
                $order->payment_status = 'charge_pending';
                $order->transaction_id = $transactionId;
                break;
                
            case 'CHARGED':
                $order->payment_status = 'paid';
                $order->status = 'processing';
                $order->transaction_id = $transactionId;
                $order->payment_method = 'VPS_PayWall';
                break;
                
            case 'CHARGED_BACK':
                $order->payment_status = 'chargeback';
                $order->status = 'disputed';
                $order->transaction_id = $transactionId;
                break;
                
            case 'CHARGEBACK_REVERSED':
                $order->payment_status = 'chargeback_reversed';
                $order->status = 'processing';
                $order->transaction_id = $transactionId;
                break;
                
            case 'CHARGEBACK_PENDING':
                $order->payment_status = 'chargeback_pending';
                $order->transaction_id = $transactionId;
                break;
                
            case 'REFUND_PENDING':
                $order->payment_status = 'refund_pending';
                $order->transaction_id = $transactionId;
                break;
                
            case 'REFUNDED':
                $order->payment_status = 'refunded';
                $order->transaction_id = $transactionId;
                break;
                
            case 'ERROR':
                $order->payment_status = 'error';
                $order->status = 'cancelled';
                $order->transaction_id = $transactionId;
                break;
                
            case 'CREDITED_PENDING':
                $order->payment_status = 'credit_pending';
                $order->transaction_id = $transactionId;
                break;
                
            case 'CREDITED':
                $order->payment_status = 'credited';
                $order->transaction_id = $transactionId;
                break;
                
            default:
                // Unknown status - log but don't update
                \Log::warning('Unknown VPS status in service', [
                    'status' => $status,
                    'order' => $orderReference
                ]);
                return ['success' => true, 'order' => $order, 'message' => 'Unknown status ignored'];
        }

        $order->save();

        return ['success' => true, 'order' => $order];
    }
}