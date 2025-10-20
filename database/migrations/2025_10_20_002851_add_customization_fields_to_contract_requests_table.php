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
        Schema::table('contract_requests', function (Blueprint $table) {
            $table->text('customized_terms')->nullable()->after('notes');
            $table->enum('customization_status', ['approved', 'rejected'])->nullable()->after('customized_terms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contract_requests', function (Blueprint $table) {
            $table->dropColumn(['customized_terms', 'customization_status']);
        });
    }
};
