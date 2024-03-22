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
        Schema::create('module_specialites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('specialite_id');
            $table->string('nom');
            $table->string('code');
            // Ajoutez d'autres champs liés à votre module

            // Contrainte de clé étrangère vers la table des spécialités
            $table->foreign('specialite_id')->references('id')->on('specialites')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_specialites');
    }
};
