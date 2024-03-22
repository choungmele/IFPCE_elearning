<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursSpecialiteTable extends Migration
{
    public function up()
    {
        Schema::create('cours_specialite', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cours_id')->constrained();
            $table->foreignId('specialite_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cours_specialite');
    }
}

