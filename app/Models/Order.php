<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'billing_address',
        'billing_city',
        'billing_state',
        'billing_postal_code',
        'billing_country',
        'order_items',
        'subtotal',
        'total_amount',
        'refunded_amount',
        'status',
        'payment_status',
        'order_notes',
        'payment_method',
        'transaction_id',
        'gateway_transaction_id',
        'webhook_received_at',
        'webhook_retry_count'
    ];

    protected $casts = [
        'order_items' => 'array',

        // 'subtotal' => 'decimal:2',
        // 'tax_amount' => 'decimal:2',

        // 'total_amount' => 'decimal:2',
        // 'refunded_amount' => 'decimal:2',
        // 'webhook_received_at' => 'datetime'
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Generate unique order number
    public static function generateOrderNumber()
    {
        do {
            $orderNumber = 'ORD-' . date('Y') . '-' . strtoupper(uniqid());
        } while (self::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }

    // Calculate totals
    public function calculateTotals($cartItems)
    {
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $taxAmount = $subtotal * 0.1;                   // 10% tax.
        $shippingAmount = $subtotal > 0 ? 5 : 0;       //  $5 shipping.
        $totalAmount = $subtotal + $taxAmount + $shippingAmount;

        return [
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'shipping_amount' => $shippingAmount,
            'total_amount' => $totalAmount
        ];
    }

    // Check if order can be refunded
    public function canBeRefunded()
    {
        return $this->payment_status === 'paid' &&
            $this->refunded_amount < $this->total_amount;
    }

    // Calculate remaining refundable amount

    public function refundableAmount()
    {
        return $this->total_amount - $this->refunded_amount;
    }

    // Scope for recent orders

    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', Carbon::now()->subDays($days));
    }

    // Scope for paid orders

    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
