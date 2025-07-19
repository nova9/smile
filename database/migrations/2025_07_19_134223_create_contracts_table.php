<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id('contract_id'); // Primary key
            $table->unsignedBigInteger('user_id'); // Lawyer
            $table->unsignedBigInteger('requester_id');
            $table->unsignedBigInteger('opportunity_id');
            $table->string('contract_document')->nullable(); // File path
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();

            // Add foreign key constraints if needed
        });
    }

};
