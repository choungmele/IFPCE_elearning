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
            $table->string('code');
            $table->string('nom');
            $table->string('prenom');
            $table->date('naissance');
            $table->string('lieu');
            $table->string('pays');
            $table->string('ville');
            $table->integer('tel');
            $table->string('password');
            $table->string('email');
            $table->integer('cni');
            $table->string('specialite');
            $table->integer('inscription');
            $table->string('personne');
            $table->integer('tel_pers');
            $table->string('lien');
            $table->boolean('activer');
            $table->boolean('valider');
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
