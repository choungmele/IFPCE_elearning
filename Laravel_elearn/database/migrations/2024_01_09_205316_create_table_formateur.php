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
        Schema::create('formateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email'); // Nouveau champ
            $table->date('date_naissance')->nullable(); // Nouveau champ
            $table->string('telephone')->nullable(); // Nouveau champ
            $table->string('cours_dispense')->nullable(); // Nouveau champ
            $table->string('matricule')->unique(); // Nouveau champ
            $table->string('numero_cni')->nullable(); // Nouveau champ
            $table->date('date_delivrance')->nullable(); // Nouveau champ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formateurs');
    }
};
