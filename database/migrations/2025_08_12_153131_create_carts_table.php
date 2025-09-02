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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            
            $table->string('name')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->longText('product_details')->nullable();
            $table->string('quantity')->nullable();
            $table->string('price')->nullable();
            $table->string('image')->nullable();

            // Foreign key to users
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('category_id')
                  ->references('id')->on('categories')
                  ->onDelete('set null'); // If category deleted, keep product in cart but category is null
        
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade'); // If user deleted, delete their cart

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations. 
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
