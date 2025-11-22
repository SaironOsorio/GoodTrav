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
            $table->longText('content_legal')->nullable()->change();
            $table->longText('content_privacy')->nullable()->change();
            $table->longText('content_cookies')->nullable()->change();
            $table->longText('content_terms')->nullable()->after('content_cookies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('legals', function (Blueprint $table) {
            $table->longText('content_legal')->nullable(false)->change();
            $table->longText('content_privacy')->nullable(false)->change();
            $table->longText('content_cookies')->nullable(false)->change();
            $table->dropColumn('content_terms');
        });
    }
};
