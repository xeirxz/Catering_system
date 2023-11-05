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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('price_id');
            $table->json('package_id');
            $table->integer('number_of_packs'); // Store the number of packs
            $table->unsignedBigInteger('total_price'); // Store the total price as an integer
            $table->string('image')->nullable();
            $table->date('date');
            $table->time('time');
            $table->enum('payment_method', ['Gcash', 'Cash on Deliver']);
            $table->enum('payment_type', ['Full Payment', 'Down Payment']);
            $table->string('status');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('price_id')->references('id')->on('prices');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
