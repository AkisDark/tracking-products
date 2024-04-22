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
        Schema::create('price_product_states', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products', 'id')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignId('state_id')->constrained('states', 'id')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->string('wholesale_price')->default(0);
            $table->string('retail_price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_product_states');
    }
};
