<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Add webhook tracking
            $table->timestamp('webhook_received_at')->nullable()->after('updated_at');
            $table->integer('webhook_retry_count')->default(0)->after('webhook_received_at');
            
            // Add payment method details
            $table->string('gateway_transaction_id')->nullable()->after('transaction_id');
            $table->decimal('refunded_amount', 10, 2)->default(0)->after('total_amount');
            
            // Add more payment statuses to the enum
            $table->enum('payment_status', [
                'pending', 'paid', 'failed', 'cancelled', 'refunded', 
                'authorized', 'chargeback', 'partial_refund'
            ])->default('pending')->change();
            
            // Add more order statuses
            $table->enum('status', [
                'pending', 'processing', 'shipped', 'delivered', 'cancelled', 'disputed'
            ])->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'webhook_received_at',
                'webhook_retry_count', 
                'gateway_transaction_id',
                'refunded_amount'
            ]);
        });
    }
};
