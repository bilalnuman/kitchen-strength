<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payment_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Reference to users table
            $table->string('order_number')->unique(); // Unique order number
            $table->decimal('amount', 10, 2); // Payment amount
            $table->string('currency', 3)->default('USD'); // Currency (e.g., USD, EUR)
            $table->string('payment_method'); // Payment method (e.g., PayPal, Stripe)
            $table->string('transaction_id')->nullable(); // Transaction ID from payment gateway
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending'); // Payment status
            $table->timestamp('paid_at')->nullable(); // Timestamp when payment was completed
            $table->json('metadata')->nullable(); // Store additional details (e.g., response from gateway)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_orders');
    }
};
