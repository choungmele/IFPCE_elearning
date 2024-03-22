<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class examen extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'id_formateur',
        'specialite',
        'fichier',
        'publier',
        'id_apprenants',
        'session',
        'formateur',
        'delais',
    ];
}
