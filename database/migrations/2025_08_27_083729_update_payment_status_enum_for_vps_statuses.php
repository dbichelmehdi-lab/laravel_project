<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // For MySQL, we need to modify the enum column
        DB::statement("ALTER TABLE orders MODIFY COLUMN payment_status ENUM(
            'pending', 'authorize_pending', 'authorized', 'auth_reversed', 
            'cancelled', 'declined', 'charge_pending', 'paid', 'chargeback', 
            'chargeback_reversed', 'chargeback_pending', 'refund_pending', 
            'refunded', 'error', 'credit_pending', 'credited'
        ) DEFAULT 'pending'");
    }

    public function down()
    {
        // Revert back to old enum values
        DB::statement("ALTER TABLE orders MODIFY COLUMN payment_status ENUM(
            'pending', 'paid', 'failed', 'cancelled', 'refunded'
        ) DEFAULT 'pending'");
    }
};

