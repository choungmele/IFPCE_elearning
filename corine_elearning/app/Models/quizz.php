<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quizz extends Model
{


    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    use HasFactory;
    protected $fillable = [
        'titre',
        'specialite',
        'formateur',
        'id_formateur',
        'delais',
        'publier',
        'nombre',
        'id_apprenant',
    ];
}
