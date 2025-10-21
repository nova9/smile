<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(\App\Models\Category::class);
            $table->foreignIdFor(\App\Models\Chat::class);
            $table->foreignIdFor(\App\Models\User::class);
            $table->string('name');
            $table->text('description');
            $table->timestamp('starts_at');
            $table->timestamp('ends_at');
            $table->integer('maximum_participants');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->json('skills')->nullable();
            $table->integer('minimum_age');
            $table->text('notes')->nullable();
            $table->string('city');
            $table->json('embedding')->nullable();
            $table->json('participant_requirements')->nullable();
            $table->string('recruiting_method')->default('first_come'); // Stores recruiting method
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
