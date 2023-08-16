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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->dateTime('date', $precision = 0)->useCurrent();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->integer('tax')->default(0);
            $table->integer('total')->default(0);
            $table->integer('bill')->default(0);
            $table->enum('status', ['paid', 'unpaid', 'cancel'])->default('unpaid');
            $table->string('desc')->nullable();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
