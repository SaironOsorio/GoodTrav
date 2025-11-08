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
        Schema::table('legals', function (Blueprint $table) {
            $table->renameColumn('content-cookies', 'content_cookies');
            $table->renameColumn('content-legal', 'content_legal');
            $table->renameColumn('content-privacity', 'content_privacy');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('legals', function (Blueprint $table) {
            $table->renameColumn('content_cookies', 'content-cookies');
            $table->renameColumn('content_legal', 'content-legal');
            $table->renameColumn('content_privacy', 'content-privacy');
        });
    }
};
