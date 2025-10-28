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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('country_id')->nullable()->constrained('countries')->after('password');
            $table->string('phone')->nullable()->after('country_id');
            $table->date('date_of_birth')->nullable()->after('phone');
            $table->text('address')->nullable()->after('date_of_birth');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['country_id', 'phone', 'date_of_birth', 'address']);
        });
    }
};
