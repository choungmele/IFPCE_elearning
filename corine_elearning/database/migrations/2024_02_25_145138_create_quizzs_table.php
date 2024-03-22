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
        Schema::create('quizzs', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('specialite');
            $table->string('formateur');
            $table->integer('id_formateur');
            $table->date('delais');
            $table->boolean('publier');
            $table->integer('nombre');
            $table->string('id_apprenant');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzs');
    }
};
