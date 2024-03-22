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
        Schema::create('cours', function (Blueprint $table) {
            $table->id();
          
            $table->string('specialite');
            $table->string('moduleRattachement');
            $table->string('intituleCours');
            $table->string('code');
            $table->string('volumeHoraire');
            $table->string('coefficient');
            $table->string('observations');
            $table->foreignId('specialite_id')->nullable()->constrained('specialites');
            $table->string('fichier');
            $table->integer('publier');
            $table->integer('formateur');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours');
    }
};
