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
        Schema::create('apprenants', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->date('date_naissance');
           // $table->string('specialite')->nullable();
            $table->string('matricule')->nullable();
            $table->string('numero_cni')->nullable();
            $table->date('date_delivrance')->nullable();
            $table->string('telephone')->nullable();
            $table->string('numero_inscription')->nullable();
            $table->string('nom_personne_contact')->nullable();
            $table->string('numero_personne_contact')->nullable();
            $table->foreignId('session_id')->constrained('sessions');
            $table->foreignId('specialite_id')->constrained('specialites');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apprenants');
    }
};
