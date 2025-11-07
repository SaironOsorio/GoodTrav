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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('destination');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('rank');
            $table->integer('points')->default(0);
            $table->integer('price')->default(0);
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('image_path')->nullable();
            $table->json('itinerary')->nullable();
            $table->string('note')->nullable();
            $table->string('path_image_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
