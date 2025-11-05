<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Challenge;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('challenges', function (Blueprint $table) {
            $table->string('code')->nullable()->after('id');
            $table->integer('order')->default(0)->after('code');
        });

        // Paso 2: Generar códigos únicos para registros existentes
        Challenge::whereNull('code')->orWhere('code', '')->get()->each(function ($challenge, $index) {
            $challenge->code = Str::slug($challenge->title) . '-' . Str::random(6);
            $challenge->order = $index;
            $challenge->save();
        });

        Schema::table('challenges', function (Blueprint $table) {
            $table->string('code')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('challenges', function (Blueprint $table) {
            $table->dropUnique('challenges_code_unique');
            $table->dropColumn(['code', 'order']);
        });
    }
};
