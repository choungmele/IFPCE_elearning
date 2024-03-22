<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class programmationCours extends Model
{
    use HasFactory;

    protected $fillable = [
        'session',
        'specialite',
        'intituleCours',
        'code',
        'formateur',
        'volumeHoraire',
        'debut',
        'fin',
        'site',
        'observations',
    ];
}
