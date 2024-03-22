<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Formateur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'date_naissance',
        'telephone',
        'cours_dispense',
        'matricule',
        'numero_cni',
        'date_delivrance',
    ];
   

}
