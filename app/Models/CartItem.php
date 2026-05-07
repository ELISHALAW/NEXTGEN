<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();

            // Link to the user who owns the cart
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Link to the product being added
            $table->foreignId('product_id')->constrained()->onDelete('cascade');

            // Product variations
            $table->string('size');
            $table->string('color');

            // Quantity of the item
            $table->integer('quantity')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
