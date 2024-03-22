<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class apprenant extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
       'nom',
       'prenom',
       'naissance',
       'lieu',
       'pays',
       'ville',
       'tel',
       'password',
       'email',
       'cni',
       'specialite',
       'inscription',
       'personne',
       'tel_pers',
       'lien',
       'activer',
       'valider',
    ];
}
