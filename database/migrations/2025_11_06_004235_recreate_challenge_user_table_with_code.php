<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('challenge_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('challenge_code'); 
            $table->boolean('is_completed')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->integer('points_earned')->default(0);
            $table->text('submission')->nullable();
            $table->string('submission_url')->nullable();
            $table->timestamps();

            // Índices y constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['user_id', 'challenge_code']);
            $table->index('challenge_code');
            $table->index(['challenge_code', 'is_completed']);
            $table->index(['user_id', 'is_completed']);
        });
    }

    public function down(): void
    {
        Schema::drop('challenge_user');
    }
};
