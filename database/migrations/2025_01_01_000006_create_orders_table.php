<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('table_session_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('type', ['takeaway', 'delivery', 'table'])->default('takeaway');
            $table->enum('status', ['new', 'preparing', 'ready', 'paid', 'cancelled'])->default('new');
            $table->unsignedTinyInteger('round_number')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('customer_postcode')->nullable();
            $table->string('customer_city')->nullable();
            $table->decimal('delivery_fee', 8, 2)->default(0);
            $table->text('notes')->nullable();
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('discount_total', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->timestamp('ordered_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
