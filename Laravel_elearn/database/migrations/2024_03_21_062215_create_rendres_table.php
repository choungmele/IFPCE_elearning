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
        Schema::create('rendres', function (Blueprint $table) {
            $table->id();
            $table->integer('id_apprenant');
            $table->string('nom_apprenant');
            $table->integer('id_examen');
            $table->string('fichier');
            $table->date('date_envoie');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendres');
    }
};
