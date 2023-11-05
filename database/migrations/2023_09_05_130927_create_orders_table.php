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
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('package_id');
            // $table->unsignedBigInteger('payment_method_id');
            $table->time('date_of_deliver')->nullable();
            $table->date('date_of_time')->nullable();
            $table->string('address');
            $table->string('status');
            $table->timestamps();
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('package_id')->references('id')->on('packages');
            // $table->foreign('payment_method_id')->references('id')->on('payment_method');
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




