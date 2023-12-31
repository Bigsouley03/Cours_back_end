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
        Schema::create('cours_enrollers', function (Blueprint $table) {
            $table->id();
            $table->longText('objectifs');
            $table->integer('heureTotal');
            $table->integer('heureDeroule')->default(0);
            $table->integer('heureRestant')->default(0);
            $table->foreignId('module_id')->constrained();
            $table->foreignId('professeur_id')->constrained();
            $table->foreignId('classe_id')->constrained();
            $table->foreignId('semestre_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours_enrollers');
    }
};
