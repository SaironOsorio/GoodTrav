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
            $table->boolean('has_watched_weekly_video')->default(false)->after('gt_points');
            $table->timestamp('video_watched_at')->nullable()->after('has_watched_weekly_video');
            $table->integer('current_study_id')->nullable()->after('video_watched_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['has_watched_weekly_video', 'video_watched_at', 'current_study_id']);
        });
    }
};
