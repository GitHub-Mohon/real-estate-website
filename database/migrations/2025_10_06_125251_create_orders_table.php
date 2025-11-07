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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('agent_id');
            $table->integer('package_id');
            $table->string('invoice_no')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payment_method');
            $table->string('paid_amount');
            $table->date('purchase_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->string('status')->nullable();
            $table->integer('currently_active')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
