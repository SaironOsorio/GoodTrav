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
            $table->string('gt_points')->nullable()->after('address');
            $table->string('subscription_type')->nullable()->after('gt_points');
            $table->string('subscription_start_date')->nullable()->after('subscription_type');
            $table->string('subscription_end_date')->nullable()->after('subscription_start_date');
            $table->string('referral_code')->nullable()->after('subscription_end_date');
            $table->string('discount_code')->nullable()->after('referral_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'gt_points',
                'subscription_type',
                'subscription_start_date',
                'subscription_end_date',
                'referral_code',
                'discount_code'
            ]);
        });
    }
};
