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
            $table->string('code')->unique();
            $table->string('sku')->nullable();
            $table->string('name');
            $table->string('desc');
            $table->string('satuan')->default('pcs');
            $table->string('image')->nullable();
            $table->integer('disc')->default(0);
            $table->integer('stock')->default(0);
            $table->integer('min_stock')->default(0);
            $table->integer('sell_price')->default(0);
            $table->integer('purc_price')->default(0);
            $table->enum('status', ['active', 'nonactive'])->default('active');
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->timestamps();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->cascadeOnUpdate()->nullOnDelete();
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
