<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->unsignedBigInteger('user_id')->nullable(); // For registered users
            
            // Customer Information
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            
            // Billing Address
            $table->string('billing_address');
            $table->string('billing_city');
            $table->string('billing_state');
            $table->string('billing_postal_code');
            $table->string('billing_country');  
            

            
            // Order Details
            $table->json('order_items'); // Store cart items as JSON
            $table->decimal('subtotal', 10, 2);
            $table->decimal('total_amount', 10, 2);
            
            // Order Status
            $table->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending');
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            
            // Additional Info
            $table->text('order_notes')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            
            $table->timestamps();
            
            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
