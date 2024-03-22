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
        Schema::create('programmation_cours', function (Blueprint $table) {
            $table->id();
            $table->string('session');
            $table->string('specialite');
            $table->string('intituleCours');
            $table->string('code');
            $table->string('formateur');
            $table->string('volumeHoraire');
            $table->string('debut');
            $table->string('fin');
            $table->string('site');
            $table->string('observations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programmation_cours');
    }
};
