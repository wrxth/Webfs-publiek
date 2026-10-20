<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('table_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_table_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('guest_count')->default(1);
            $table->json('guest_ages')->nullable();
            $table->boolean('deluxe_menu')->default(false);
            $table->enum('status', ['open', 'closed'])->default('open');
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('table_sessions');
    }
};
