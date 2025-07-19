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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(\App\Models\Category::class);
            $table->foreignIdFor(\App\Models\Chat::class);
            $table->foreignIdFor(\App\Models\User::class);
            $table->string('name');
            $table->string('description');
            $table->timestamp('starts_at');
            $table->timestamp('ends_at');
            $table->foreignIdFor(\App\Models\Address::class);
            $table->integer('maximum_participants');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('skills')->nullable();
            $table->integer('minimum_age');
            $table->text('notes')->nullable();
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
