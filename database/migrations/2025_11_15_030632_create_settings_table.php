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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('url_youtube_landing')->nullable();
            $table->text('title_contributors_list_title')->nullable();
            $table->text('title_contributors_list_subtitle')->nullable();
            $table->text('title_contributors_new_title')->nullable();
            $table->text('title_contributors_new_subtitle')->nullable();
            $table->integer('title_contributors_price_base')->nullable();
            $table->integer('title_contributors_price_new')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
