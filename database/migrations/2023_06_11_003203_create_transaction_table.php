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
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->string("product_code");
            $table->string("product_name");
            $table->unsignedBigInteger("price");
            $table->integer("qty");
            $table->unsignedBigInteger("total_price");
            $table->date("transaction_date");
            $table->string("payment_method");
            $table->string("payment_status");
            $table->string("customer_name");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
