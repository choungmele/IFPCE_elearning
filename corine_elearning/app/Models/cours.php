<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cours extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'titre',
        'specialite',
        'coef',
        'objectif',
        'formateur',
        'suivi',
        'publier',
        'fichier',
    ];
}
