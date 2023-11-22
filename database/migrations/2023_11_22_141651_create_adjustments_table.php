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
        Schema::create('adjustments', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->dateTime('date', $precision = 0)->useCurrent();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->integer('current_value')->default(0);
            $table->enum('type', ['plus', 'minus'])->default('plus');
            $table->integer('value')->default(0);
            $table->integer('after_value')->default(0);
            $table->enum('status', ['done', 'cancel'])->default('done');
            $table->string('desc')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adjustments');
    }
};
