<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rendre extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_apprenant',
        'nom_apprenant',
        'id_formateur',
        'nom_formateur',
        'id_examen',
        'titre_examen',
        'date_envoie',
        'fichier',
        'session',
    ];
}
