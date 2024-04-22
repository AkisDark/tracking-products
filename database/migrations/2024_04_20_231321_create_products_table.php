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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('delivery_company')->nullable();
            $table->string('name');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->string('wholesale_price', 50)->nullable()->default(0);
            $table->string('retail_price', 50)->nullable()->default(0);
            $table->string('weight', 10)->nullable()->default(0);
            $table->string('barcode')->nullable();
            $table->timestamps();

            //
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL')->onUpdate('cascade');
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('SET NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
