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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id');
            $table->string('name');
            $table->string('contact');
            $table->string('address');
            $table->dateTime('borrowed_at');
            $table->dateTime('returned_at');
            $table->integer('status')->default(0); // 0 = pending, 1 = approved, 2 = rejected
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
