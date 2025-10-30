<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_on_trial')->nullable()->default(null)->change();
        });

        // Poner en NULL a todos los usuarios que tienen false pero nunca han tenido suscripción
        DB::table('users')
            ->where('is_on_trial', false)
            ->whereNull('stripe_subscription_id')
            ->update(['is_on_trial' => null]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_on_trial')->default(false)->change();
        });
    }
};
