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
        Schema::create('detail_transaction', function (Blueprint $table) {
            $table->id();
            $table->string("transaction_id");
            $table->string("product_code");
            $table->string("product_name");
            $table->integer("qty");
            $table->unsignedBigInteger("price");
            $table->unsignedBigInteger("total_price");
            $table->string("payment_method");
            $table->date("transaction_date");
            $table->string("customer_name");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaction');
    }
};
