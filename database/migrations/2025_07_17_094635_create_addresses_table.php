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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('number');        // e.g., "123", "No. 45A"
            $table->string('street');        // e.g., "Main Street"
            $table->string('line2')->nullable(); // Optional second line (e.g. Apt, Floor)
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('postal_code');
            $table->string('country');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
