<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('contract_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('requester_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('agreement_id')->constrained()->onDelete('cascade');
            $table->foreignId('lawyer_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');
            $table->json('requester_details')->nullable(); // Store organization/requester info
            $table->text('notes')->nullable(); // Additional notes from requester
            $table->string('signature_path')->nullable()->after('notes');
            $table->timestamp('signed_at')->nullable()->after('signature_path');
            $table->text('customized_terms')->nullable()->after('notes');
            $table->enum('customization_status', ['approved', 'rejected'])->nullable()->after('customized_terms');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('contract_requests');
    }
};
