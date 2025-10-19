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
        Schema::table('messages', function (Blueprint $table) {
            $table->foreignId('file_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('message_type')->default('text'); // 'text', 'image', 'document'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['file_id']);
            $table->dropColumn(['file_id', 'message_type']);
        });
    }
};
