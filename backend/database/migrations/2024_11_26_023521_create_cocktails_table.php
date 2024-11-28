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
        Schema::create('cocktails', function (Blueprint $table) {
            $table->id('cocktail_id');
            $table->string('cocktail_name');
            $table->string('cocktail_name_english');
            $table->string('base_name');
            $table->string('technique_name');
            $table->string('taste_name');
            $table->string('style_name');
            $table->integer('alcohol');
            $table->string('tpo_name');
            $table->string('glass_name');
            $table->string('type_name');
            $table->string('color_name');
            $table->text('cocktail_digest');
            $table->text('cocktail_desc');
            $table->text('recipe_desc');
            $table->json('recipes');
            $table->json('tags');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cocktails');
    }
};
