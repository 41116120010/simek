<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained()->onDelete('cascade');
            $table->string('reference')->unique(); // reference dari tripay
            $table->string('merchant_ref')->unique(); // merchant reference
            $table->string('payment_method')->nullable(); // BCAVA, MANDIRIVA, dll
            $table->string('payment_channel')->nullable(); // nama channel
            $table->decimal('amount', 10, 2);
            $table->decimal('fee', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['unpaid', 'paid', 'expired', 'failed', 'refund'])->default('unpaid');
            $table->string('checkout_url')->nullable(); // URL pembayaran
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->json('payment_response')->nullable(); // response dari tripay
            $table->timestamps();
            
            $table->index('registration_id');
            $table->index('status');
            $table->index('reference');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};