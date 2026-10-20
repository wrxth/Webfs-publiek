<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('discount_type', ['fixed_price', 'amount_off', 'percentage']);
            $table->decimal('discount_value', 8, 2);
            $table->date('starts_at');
            $table->date('ends_at');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('menu_item_offer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_item_id')->constrained()->cascadeOnDelete();
            $table->foreignId('offer_id')->constrained()->cascadeOnDelete();
            $table->unique(['menu_item_id', 'offer_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_item_offer');
        Schema::dropIfExists('offers');
    }
};
